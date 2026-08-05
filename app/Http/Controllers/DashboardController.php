<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\MatchingService;

class DashboardController extends Controller
{
    protected $matchingService;

    public function __construct(MatchingService $matchingService)
    {
        $this->middleware(['auth']);
        $this->matchingService = $matchingService;
    }

    public function index()
    {
        $user = Auth::user();

        // Lấy danh sách job của employer + số user apply
        $listings = Listing::withCount('users')
            ->with('skills')
            ->where('user_id', $user->id)
            ->get();

        // Lấy danh sách apply để đếm chưa shortlist
        $shortlists = Listing::with('users')
            ->where('user_id', $user->id)
            ->get();

        $count = 0;
        foreach ($shortlists as $shortlist) {
            foreach ($shortlist->users as $appliedUser) {
                if ($appliedUser->pivot->shortlisted == false) {
                    $count++;
                }
            }
        }

        // Mức độ hoàn thiện hồ sơ
        $count2 = 0;
        if ($user->profile_pic != null) $count2++;
        if ($user->resume != null) $count2++;
        if ($user->about != null) $count2++;
        if (isset($user->email_verified_at) && $user->email_verified_at != null) $count2++;

        // Job của employer
        $jobs = Listing::with('skills')
            ->where('user_id', $user->id)
            ->get();

        // Job đã apply của employee
        $jobs_applied = collect();
        if ($user->user_type == 'employee') {
            $employee = User::where('id', $user->id)->with('listings')->first();
            $jobs_applied = $employee ? $employee->listings()->get() : collect();
        }

        // User đã shortlist
        $users_shortlisted = collect();
        if ($user->user_type == 'employer') {
            $users_shortlisted = Listing::where('user_id', $user->id)
                ->with('users')
                ->get()
                ->pluck('users')
                ->flatten()
                ->where('pivot.shortlisted', true);
        }

        /**
         * ==========================
         * AUTO MATCHING CHO EMPLOYER
         * ==========================
         */
        if ($user->user_type == 'employer') {
            foreach ($jobs as $job) {
                $job->matched_count = $this->matchingService->countMatchedCandidates($job);
            }
        }

        return view('dashboard', compact(
            'listings',
            'jobs',
            'count',
            'count2',
            'jobs_applied',
            'users_shortlisted'
        ));
    }

    public function verify()
    {
        return view('user.verify');
    }

    public function resend(Request $request)
    {
        $user = Auth::user();

        if ($user->hasVerifiedEmail()) {
            return redirect()->route('homepage')->with('success', 'Email của bạn đã được xác minh');
        }

        $user->sendEmailVerificationNotification();

        return back()->with('success', 'Email xác minh đã được gửi');
    }

    public function mail(Request $request)
    {
        $user = Auth::user();

        if ($user->mail == true) {
            $user->mail = false;
            $user->save();

            return redirect()->back()->with(
                'message',
                'Đã tắt nhận mail, bạn sẽ không còn nhận được mail khi có nhà tuyển dụng chấp nhận bạn'
            );
        }

        $user->mail = true;
        $user->save();

        return redirect()->back()->with(
            'message',
            'Đã bật nhận mail, bạn sẽ nhận được mail khi có nhà tuyển dụng chấp nhận bạn'
        );
    }
}