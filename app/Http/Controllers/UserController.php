<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistrationFormRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth'])->except([
            'login',
            'register',
            'createEmployee',
            'storeEmployee',
            'createEmployer',
            'storeEmployer',
            'postLogin'
        ]);
    }

    // =========================
    // AUTH
    // =========================

    public function login()
    {
        return view('user.login');
    }

    public function register()
    {
        return view('user.register');
    }

    public function postLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ], [
            'email.required' => 'Vui lòng nhập email',
            'email.email' => 'Email không đúng định dạng',
            'password.required' => 'Vui lòng nhập mật khẩu',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            if (auth()->user()->user_type === 'employer') {
                return redirect()->intended('/dashboard');
            }

            return redirect()->intended('/');
        }

        return back()->withInput()->with('error', 'Tài khoản hoặc mật khẩu không đúng');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    // =========================
    // REGISTER EMPLOYEE
    // =========================

    public function createEmployee()
    {
        return view('user.employee-register');
    }

    public function storeEmployee(RegistrationFormRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'user_type' => 'employee',
            'email_verified_at' => now(),
        ]);

        Auth::login($user);

        return redirect()->route('homepage')->with('success', 'Đăng ký ứng viên thành công!');
    }

    // =========================
    // REGISTER EMPLOYER
    // =========================

    public function createEmployer()
    {
        return view('user.employer-register');
    }

    public function storeEmployer(RegistrationFormRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'user_type' => 'employer',
            'user_trial' => now()->addWeek(),
            'email_verified_at' => now(),
        ]);

        Auth::login($user);

        return redirect()->route('dashboard')->with('success', 'Đăng ký nhà tuyển dụng thành công!');
    }

    // =========================
    // PROFILE
    // =========================

    public function profile()
    {
        return view('user.profile');
    }

   public function updateProfile(Request $request)
{
    $request->validate([
        'profile_pic' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        'name' => 'required',
        'about' => 'required',
    ], [
        // 🔥 MESSAGE TIẾNG VIỆT
        'profile_pic.image' => 'File phải là hình ảnh',
        'profile_pic.mimes' => 'Ảnh phải có định dạng jpeg, png, jpg, gif, svg hoặc webp',
        'profile_pic.max' => 'Ảnh không được vượt quá 2MB',

        'name.required' => 'Vui lòng nhập họ tên',

        'about.required' => 'Vui lòng nhập phần giới thiệu',
    ]);

    $user = auth()->user();

    if ($request->hasFile('profile_pic')) {
        if ($user->profile_pic && Storage::disk('public')->exists($user->profile_pic)) {
            Storage::disk('public')->delete($user->profile_pic);
        }

        $imagePath = $request->file('profile_pic')->store('images', 'public');
        $user->profile_pic = $imagePath;
    }

    $user->name = $request->name;
    $user->about = $request->about;
    $user->save();

    auth()->setUser($user);

    return back()->with('message', 'Đã cập nhật thông tin thành công!');
}

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|min:6',
        ], [
            'current_password.required' => 'Vui lòng nhập mật khẩu hiện tại',
            'password.required' => 'Vui lòng nhập mật khẩu mới',
            'password.min' => 'Mật khẩu mới phải có ít nhất 6 ký tự',
        ]);

        $user = auth()->user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->with('error', 'Mật khẩu hiện tại không đúng');
        }

        $user->password = Hash::make($request->password);
        $user->save();

        return back()->with('message', 'Đã cập nhật mật khẩu thành công!');
    }

    // =========================
    // CV
    // =========================

    public function cv()
    {
        if (auth()->user()->user_type === 'employer') {
            return redirect()->route('dashboard')->with('error', 'Bạn là nhà tuyển dụng, không có quyền truy cập vào trang này');
        }

        return view('user.cv');
    }

    public function updateCv(Request $request)
    {
        $request->validate([
            'resume' => 'required|mimes:pdf,doc,docx|max:5120'
        ], [
            'resume.required' => 'Vui lòng chọn file CV',
            'resume.mimes' => 'CV phải là file PDF, DOC hoặc DOCX',
            'resume.max' => 'Dung lượng CV không được vượt quá 5MB',
        ]);

        if ($request->hasFile('resume')) {
            if (auth()->user()->resume && Storage::disk('public')->exists(auth()->user()->resume)) {
                Storage::disk('public')->delete(auth()->user()->resume);
            }

            $cvPath = $request->file('resume')->store('resume', 'public');

            User::find(auth()->id())->update([
                'resume' => $cvPath
            ]);
        }

        return back()->with('message', 'Đã tải lên CV thành công!');
    }

    public function viewCv()
    {
        $user = auth()->user();

        if (!$user->resume) {
            return back()->with('error', 'Bạn chưa tải lên CV');
        }

        if (!Storage::disk('public')->exists($user->resume)) {
            return back()->with('error', 'Không tìm thấy file CV');
        }

        $path = storage_path('app/public/' . $user->resume);

        return response()->file($path);
    }

    public function downloadCv()
    {
        $user = auth()->user();

        if (!$user->resume) {
            return back()->with('error', 'Bạn chưa tải lên CV');
        }

        if (!Storage::disk('public')->exists($user->resume)) {
            return back()->with('error', 'Không tìm thấy file CV');
        }

        $path = storage_path('app/public/' . $user->resume);

        return response()->download($path);
    }

    public function deleteCv()
    {
        $user = auth()->user();

        if ($user->resume && Storage::disk('public')->exists($user->resume)) {
            Storage::disk('public')->delete($user->resume);
        }

        $user->resume = null;
        $user->save();

        return back()->with('message', 'Đã xóa CV thành công!');
    }

    public function createCv()
    {
        return view('user.create-cv');
    }

    public function previewPDF(Request $request)
    {
        $data = $request->all();

        if ($request->hasFile('img')) {
            $path = $request->file('img')->store('images', 'public');
            return view('pdf', compact('data', 'path'));
        }

        return view('pdf', compact('data'));
    }
}