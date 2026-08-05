<?php

namespace App\Http\Controllers;

use App\Mail\ShortlistMail;
use App\Models\Listing;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use App\Services\MatchingService;

class ApplicantController extends Controller
{
    public function index()
    {
        // Lấy tất cả job của employer hiện tại kèm users
        $shortlists = Listing::latest()
            ->with('users')
            ->where('user_id', auth()->user()->id)
            ->get();

        // Đếm số ứng viên chưa shortlist
        $counts = [];
        foreach ($shortlists as $shortlist) {
            $count = 0;
            foreach ($shortlist->users as $user) {
                if ($user->pivot->shortlisted == false) {
                    $count++;
                }
            }
            $counts[] = $count;
        }

        // Lấy danh sách job + tổng số ứng viên
        $listings = Listing::latest()
            ->withCount('users')
            ->where('user_id', auth()->user()->id)
            ->get();

        // Gắn số chưa shortlist vào từng listing
        foreach ($listings as $key => $listing) {
            $listing->count = $counts[$key] ?? 0;
        }

        return view('applicants.index', compact('listings', 'shortlists'));
    }

    public function view(Listing $listing)
    {
        // Chỉ employer sở hữu job mới được xem
        if ($listing->user_id != auth()->user()->id) {
            abort(403);
        }

        $listing = Listing::with('users')->where('slug', $listing->slug)->first();

        // Phân trang ứng viên + sắp xếp theo độ phù hợp cao nhất
        $users = $listing->users()
            ->orderByPivot('match_score', 'desc')
            ->paginate(6);

        return view('applicants.view', compact('listing', 'users'));
    }

    public function shortlist($listingId, $userId)
    {
        $company_name = auth()->user()->name;
        $company_email = auth()->user()->email;

        $listing = Listing::find($listingId);
        $user = User::find($userId);

        if (!$listing || !$user) {
            return redirect()->back()->with('error', 'Không tìm thấy dữ liệu');
        }

        // Chỉ employer sở hữu job mới được shortlist
        if ($listing->user_id != auth()->user()->id) {
            abort(403);
        }

        $listing->users()->updateExistingPivot($userId, ['shortlisted' => true]);

        // Nếu ứng viên bật nhận mail thì gửi mail
        if (isset($user->mail) && $user->mail == true) {
            Mail::to($user->email)->queue(
                new ShortlistMail($user->name, $listing->title, $company_name, $company_email)
            );
        }

        return redirect()->back()->with('message', 'Đã thêm vào danh sách shortlist');
    }

    public function apply($listingId)
    {
        $user = auth()->user();

        // Chỉ employee mới được apply
        if ($user->user_type !== 'employee') {
            return back()->with('error', 'Chỉ ứng viên mới được ứng tuyển');
        }

        // Kiểm tra có CV chưa
        if (!$user->resume) {
            return back()->with('error', 'Bạn cần tải CV trước khi ứng tuyển');
        }

        // Kiểm tra file CV còn tồn tại không
        if (!Storage::disk('public')->exists($user->resume)) {
            return back()->with('error', 'CV của bạn không tồn tại trong hệ thống. Vui lòng tải lại CV');
        }

        $listing = Listing::with('skills')->find($listingId);

        if (!$listing) {
            return back()->with('error', 'Không tìm thấy công việc');
        }

        // Không cho apply job của chính mình
        if ($listing->user_id == $user->id) {
            return back()->with('error', 'Bạn không thể ứng tuyển vào công việc của chính mình');
        }

        // Không cho apply trùng
        if ($user->listings()->where('listing_id', $listingId)->exists()) {
            return back()->with('error', 'Bạn đã ứng tuyển công việc này rồi');
        }

        // Load skills của user
        $user->load('skills');

        // Gọi thuật toán matching duy nhất
        $matchingService = new MatchingService();
        $matchResult = $matchingService->calculateScore($listing, $user);

        $score = $matchResult['score'];
        $level = $matchResult['level'];
        $matchedSkills = implode(', ', $matchResult['matched_skills']);

        // Lưu apply + kết quả matching vào pivot
        $user->listings()->attach($listingId, [
            'shortlisted' => 0,
            'match_score' => $score,
            'match_level' => $level,
            'matched_skills' => $matchedSkills,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return back()->with(
            'message',
            'Ứng tuyển thành công! Độ phù hợp của bạn là ' . $score . '% (' . $level . ')'
        );
    }

    public function viewApplicantCv($userId)
    {
        $applicant = User::find($userId);

        if (!$applicant) {
            return back()->with('error', 'Không tìm thấy ứng viên');
        }

        if (!$applicant->resume) {
            return back()->with('error', 'Ứng viên chưa tải lên CV');
        }

        if (!Storage::disk('public')->exists($applicant->resume)) {
            return back()->with('error', 'Không tìm thấy file CV');
        }

        $path = storage_path('app/public/' . $applicant->resume);

        return response()->file($path);
    }

    public function downloadApplicantCv($userId)
    {
        $applicant = User::find($userId);

        if (!$applicant) {
            return back()->with('error', 'Không tìm thấy ứng viên');
        }

        if (!$applicant->resume) {
            return back()->with('error', 'Ứng viên chưa tải lên CV');
        }

        if (!Storage::disk('public')->exists($applicant->resume)) {
            return back()->with('error', 'Không tìm thấy file CV');
        }

        $path = storage_path('app/public/' . $applicant->resume);

        return response()->download($path);
    }
}