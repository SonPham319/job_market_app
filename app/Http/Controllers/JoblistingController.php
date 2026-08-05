<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\User;
use Illuminate\Http\Request;

class JoblistingController extends Controller
{
    public function index()
    {
        // Lấy 8 job mới nhất
        $jobs = Listing::with('profile')->latest()->paginate(8);

        $jobType = "";
        $salaryRange = "";
        $search = "";
        $address = "";

        // Đếm số lượng job
        $count = Listing::count();

        // Đếm số lượng công ty đăng bài
        $countCompany = Listing::with('profile')->get()->unique('user_id')->count();

        // Đếm số lượng employee
        $countEmployee = User::where('user_type', 'employee')->count();

        return view('homepage', compact(
            'jobs',
            'count',
            'countCompany',
            'countEmployee',
            'search',
            'address',
            'jobType',
            'salaryRange'
        ));
    }

    public function show(Listing $listing)
    {
        $listing->load('users');

        // Lấy user người đăng bài
        $user = User::where('id', $listing->user_id)->first();

        return view('job.show', compact('listing', 'user'));
    }

    public function search(Request $request)
    {
        $jobType = $request->job_type;
        $salaryRange = $request->salary_range;
        $search = $request->search;
        $address = $request->address;

        $jobs = Listing::where(function ($q) use ($search, $address, $jobType, $salaryRange) {
            if ($search) {
                $q->where('title', 'like', "%{$search}%");
            }

            if ($address) {
                $q->where('address', 'like', "%{$address}%");
            }

            if ($jobType) {
                $q->where('job_type', $jobType);
            }

            if ($salaryRange) {
                if ($salaryRange == "Thỏa Thuận") {
                    $q->where('salary', 0);
                }

                if ($salaryRange == "Dưới 5 triệu") {
                    $q->whereBetween('salary', [1, 5000000]);
                }

                if ($salaryRange == "5 - 10 triệu") {
                    $q->whereBetween('salary', [5000000, 10000000]);
                }

                if ($salaryRange == "10 - 15 triệu") {
                    $q->whereBetween('salary', [10000000, 15000000]);
                }

                if ($salaryRange == "Trên 15 triệu") {
                    $q->where('salary', '>=', 15000000);
                }
            }
        })->latest()->paginate(8);

        $count = Listing::count();
        $countCompany = Listing::with('profile')->get()->unique('user_id')->count();
        $countEmployee = User::where('user_type', 'employee')->count();

        return view('homepage', compact(
            'jobs',
            'count',
            'countCompany',
            'countEmployee',
            'search',
            'address',
            'jobType',
            'salaryRange'
        ));
    }
}