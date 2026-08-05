<?php

namespace App\Http\Controllers;

use App\Http\Middleware\isPremiumUser;
use App\Http\Requests\JobEditFormRequest;
use App\Http\Requests\JobPostFormRequest;
use App\Models\Listing;
use App\Post\JobPost;
use App\Http\Controllers\MatchingController; // 🔥 thêm dòng này

class PostJobController extends Controller
{
    protected $job;

    public function __construct(JobPost $job)
    {
        $this->job = $job;
        $this->middleware('auth');
        $this->middleware(isPremiumUser::class)->only('create', 'store');
    }

    /**
     * Form tạo job
     */
    public function create()
    {
        return view('job.create');
    }

    /**
     * Danh sách job của employer
     */
    public function index()
    {
        $jobs = Listing::with('skills')
            ->where('user_id', auth()->user()->id)
            ->get();

        // 🔥 FIX CHÍNH Ở ĐÂY (dùng app() thay vì new)
        $matchingController = app(MatchingController::class);

        foreach ($jobs as $job) {
            $job->matched_count = $matchingController->countMatchedCandidates($job);
        }

        return view('job.index', compact('jobs'));
    }

    /**
     * Lưu job mới
     */
    public function store(JobPostFormRequest $request)
    {
        $this->job->store($request);
        return back()->with('message', 'Đã Tạo Bài Đăng Thành Công!');
    }

    /**
     * Form sửa job
     */
    public function edit(Listing $listing)
    {
        return view('job.edit', compact('listing'));
    }

    /**
     * Cập nhật job
     */
    public function update(Listing $listing, JobEditFormRequest $request)
    {
        $this->job->updatePost($listing->id, $request);

        return back()->with('message', 'Đã Lưu Thành Công!');
    }

    /**
     * Xóa job
     */
    public function destroy(Listing $listing)
    {
        $listing->delete();
        return back()->with('success', 'Đã Xóa Thành Công!');
    }
}