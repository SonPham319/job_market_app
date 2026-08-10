@extends('layouts.app')

@section('title', 'Trang chủ - JOB SEARCH')

@section('content')

<div class="job-home">

    {{-- =========================
        HERO SECTION
    ========================== --}}
    <section class="hero-section">
        <div class="container">

            <div class="hero-box">

                {{-- Background --}}
                <div class="hero-background"></div>

                <div class="row align-items-center position-relative hero-content">

                    {{-- LEFT --}}
                    <div class="col-lg-7">

                        <div class="hero-badge">
                            <i class="fa-solid fa-bolt"></i>
                            Nền tảng tuyển dụng thông minh
                        </div>

                        <h1 class="hero-title">
                            Công việc phù hợp.
                            <span>Sự nghiệp tốt hơn.</span>
                        </h1>

                        <p class="hero-description">
                            Khám phá những cơ hội việc làm phù hợp với kỹ năng,
                            kinh nghiệm và định hướng nghề nghiệp của bạn.
                        </p>

                        {{-- CTA --}}
                        <div class="hero-actions">

                            <a href="#jobs"
                               class="btn hero-primary-btn">

                                <i class="fa-solid fa-magnifying-glass"></i>

                                Khám phá việc làm
                            </a>

                            @guest

                                <a href="{{ route('register') }}"
                                   class="btn hero-secondary-btn">

                                    Đăng ký miễn phí

                                    <i class="fa-solid fa-arrow-right"></i>

                                </a>

                            @endguest


                            @auth

                                <a href="{{ route('suggest.index') }}"
                                   class="btn hero-secondary-btn">

                                    <i class="fa-solid fa-wand-magic-sparkles"></i>

                                    AI gợi ý việc làm

                                </a>

                            @endauth

                        </div>

                        {{-- TRUST --}}
                        <div class="hero-trust">

                            <div class="hero-trust-item">
                                <i class="fa-solid fa-circle-check"></i>
                                Việc làm mới mỗi ngày
                            </div>

                            <div class="hero-trust-item">
                                <i class="fa-solid fa-circle-check"></i>
                                Nhà tuyển dụng đa dạng
                            </div>

                        </div>

                    </div>


                    {{-- RIGHT --}}
                    <div class="col-lg-5 d-none d-lg-block">

                        <div class="hero-visual">

                            <img src="{{ asset('img/banner.png') }}"
                                 alt="Tìm kiếm việc làm"
                                 class="hero-image">

                        </div>

                    </div>

                </div>

            </div>

        </div>
    </section>


    {{-- =========================
        STATISTICS
    ========================== --}}
    <section class="stats-section">

        <div class="container">

            <div class="stats-container">

                <div class="row">

                    {{-- EMPLOYEE --}}
                    <div class="col-md-4">

                        <div class="stat-item">

                            <div class="stat-icon">
                                <i class="fa-solid fa-user-group"></i>
                            </div>

                            <div>

                                <div class="stat-number">
                                    {{ number_format($countEmployee) }}+
                                </div>

                                <div class="stat-label">
                                    Ứng viên
                                </div>

                            </div>

                        </div>

                    </div>


                    {{-- JOB --}}
                    <div class="col-md-4">

                        <div class="stat-item">

                            <div class="stat-icon">
                                <i class="fa-solid fa-briefcase"></i>
                            </div>

                            <div>

                                <div class="stat-number">
                                    {{ number_format($count) }}+
                                </div>

                                <div class="stat-label">
                                    Việc làm
                                </div>

                            </div>

                        </div>

                    </div>


                    {{-- COMPANY --}}
                    <div class="col-md-4">

                        <div class="stat-item stat-item-last">

                            <div class="stat-icon">
                                <i class="fa-solid fa-building"></i>
                            </div>

                            <div>

                                <div class="stat-number">
                                    {{ number_format($countCompany) }}+
                                </div>

                                <div class="stat-label">
                                    Nhà tuyển dụng
                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>


    {{-- =========================
        JOB SECTION
    ========================== --}}
    <section class="jobs-section" id="jobs">

        <div class="container">

            {{-- HEADER --}}
            <div class="jobs-header">

                <div>

                    <div class="section-label">
                        <i class="fa-solid fa-fire"></i>
                        Cơ hội nghề nghiệp
                    </div>

                    <h2 id="res">
                        Việc làm mới nhất
                    </h2>

                    <p>
                        Khám phá những vị trí vừa được nhà tuyển dụng đăng tải.
                    </p>

                </div>


                {{-- RESET FILTER --}}
                @if($search || $address || $jobType || $salaryRange)

                    <a href="{{ route('homepage') }}#jobs"
                       class="clear-filter">

                        <i class="fa-solid fa-rotate-left"></i>

                        Xóa bộ lọc

                    </a>

                @endif

            </div>


            {{-- =========================
                SEARCH BOX
            ========================== --}}
            <div class="search-panel">

                <form action="{{ route('job.search') }}#res"
                      method="GET">

                    <div class="row g-3">

                        {{-- KEYWORD --}}
                        <div class="col-lg-4">

                            <label class="search-label">
                                Từ khóa
                            </label>

                            <div class="input-wrapper">

                                <i class="fa-solid fa-magnifying-glass"></i>

                                <input
                                    type="text"
                                    name="search"
                                    value="{{ $search }}"
                                    placeholder="Vị trí, kỹ năng..."
                                    class="form-control">

                            </div>

                        </div>


                        {{-- LOCATION --}}
                        <div class="col-lg-3">

                            <label class="search-label">
                                Địa điểm
                            </label>

                            <div class="input-wrapper">

                                <i class="fa-solid fa-location-dot"></i>

                                <input
                                    type="text"
                                    name="address"
                                    value="{{ $address }}"
                                    placeholder="Hà Nội, TP.HCM..."
                                    class="form-control">

                            </div>

                        </div>


                        {{-- TYPE --}}
                        <div class="col-sm-6 col-lg-2">

                            <label class="search-label">
                                Hình thức
                            </label>

                            <select
                                name="job_type"
                                class="form-select custom-select">

                                <option value="">
                                    Tất cả
                                </option>

                                <option
                                    value="Fulltime"
                                    {{ $jobType == 'Fulltime' ? 'selected' : '' }}>
                                    Fulltime
                                </option>

                                <option
                                    value="Parttime"
                                    {{ $jobType == 'Parttime' ? 'selected' : '' }}>
                                    Parttime
                                </option>

                                <option
                                    value="Từ Xa"
                                    {{ $jobType == 'Từ Xa' ? 'selected' : '' }}>
                                    Từ xa
                                </option>

                                <option
                                    value="Hợp Đồng"
                                    {{ $jobType == 'Hợp Đồng' ? 'selected' : '' }}>
                                    Hợp đồng
                                </option>

                            </select>

                        </div>


                        {{-- SALARY --}}
                        <div class="col-sm-6 col-lg-2">

                            <label class="search-label">
                                Mức lương
                            </label>

                            <select
                                name="salary_range"
                                class="form-select custom-select">

                                <option value="">
                                    Tất cả
                                </option>

                                <option
                                    value="Dưới 5 triệu"
                                    {{ $salaryRange == 'Dưới 5 triệu' ? 'selected' : '' }}>
                                    Dưới 5 triệu
                                </option>

                                <option
                                    value="5 - 10 triệu"
                                    {{ $salaryRange == '5 - 10 triệu' ? 'selected' : '' }}>
                                    5 - 10 triệu
                                </option>

                                <option
                                    value="10 - 15 triệu"
                                    {{ $salaryRange == '10 - 15 triệu' ? 'selected' : '' }}>
                                    10 - 15 triệu
                                </option>

                                <option
                                    value="Trên 15 triệu"
                                    {{ $salaryRange == 'Trên 15 triệu' ? 'selected' : '' }}>
                                    Trên 15 triệu
                                </option>

                                <option
                                    value="Thỏa Thuận"
                                    {{ $salaryRange == 'Thỏa Thuận' ? 'selected' : '' }}>
                                    Thỏa thuận
                                </option>

                            </select>

                        </div>


                        {{-- BUTTON --}}
                        <div class="col-lg-1 d-flex align-items-end">

                            <button
                                type="submit"
                                class="search-btn">

                                <i class="fa-solid fa-arrow-right"></i>

                            </button>

                        </div>

                    </div>

                </form>

            </div>


            {{-- =========================
                ACTIVE FILTER
            ========================== --}}

            @if($search || $address || $jobType || $salaryRange)

                <div class="active-filters">

                    <span class="active-filter-title">
                        Đang lọc:
                    </span>

                    @if($search)

                        <span class="filter-chip">
                            {{ $search }}
                        </span>

                    @endif


                    @if($address)

                        <span class="filter-chip">
                            <i class="fa-solid fa-location-dot"></i>
                            {{ $address }}
                        </span>

                    @endif


                    @if($jobType)

                        <span class="filter-chip">
                            {{ $jobType }}
                        </span>

                    @endif


                    @if($salaryRange)

                        <span class="filter-chip">
                            {{ $salaryRange }}
                        </span>

                    @endif

                </div>

            @endif


            {{-- =========================
                JOB LIST
            ========================== --}}

            @if($jobs->count() > 0)

                <div class="row g-4">

                    @foreach($jobs as $job)

                        @php

                            $jobColors = [
                                'Fulltime' => 'job-fulltime',
                                'Parttime' => 'job-parttime',
                                'Từ Xa' => 'job-remote',
                                'Hợp Đồng' => 'job-contract'
                            ];

                            $jobTypeClass =
                                $jobColors[$job->job_type]
                                ?? 'job-default';

                        @endphp


                        <div class="col-md-6 col-xl-3">

                            <article class="job-card">

                                <a
                                    href="{{ route('job.show', $job->slug) }}"
                                    class="job-card-link">


                                    {{-- TOP --}}
                                    <div class="job-card-top">

                                        {{-- LOGO --}}
                                        <div class="company-logo-box">

                                            <img
                                                src="{{ ($job->profile && $job->profile->profile_pic)
                                                    ? asset('storage/' . $job->profile->profile_pic)
                                                    : asset('images/default-company.png') }}"
                                                alt="Logo công ty"
                                                loading="lazy">


                                            {{-- VERIFIED --}}
                                            @if(
                                                $job->profile &&
                                                $job->profile->plan == 'yearly'
                                            )

                                                <div
                                                    class="verified-company"
                                                    title="Nhà tuyển dụng nổi bật">

                                                    <i class="fa-solid fa-circle-check"></i>

                                                </div>

                                            @endif

                                        </div>


                                        {{-- JOB TYPE --}}
                                        <span class="job-type {{ $jobTypeClass }}">

                                            {{ $job->job_type ?? 'Khác' }}

                                        </span>

                                    </div>


                                    {{-- TITLE --}}
                                    <div class="job-info">

                                        <h3 class="job-title">

                                            {{ $job->title }}

                                        </h3>


                                        <div class="company-name">

                                            <i class="fa-regular fa-building"></i>

                                            {{ $job->profile
                                                ? $job->profile->name
                                                : 'Chưa cập nhật công ty' }}

                                        </div>

                                    </div>


                                    {{-- META --}}
                                    <div class="job-meta">

                                        {{-- LOCATION --}}
                                        <div class="job-meta-item">

                                            <div class="meta-icon">

                                                <i class="fa-solid fa-location-dot"></i>

                                            </div>

                                            <span>
                                                {{ $job->address ?? 'Chưa cập nhật' }}
                                            </span>

                                        </div>


                                        {{-- SALARY --}}
                                        <div class="job-meta-item">

                                            <div class="meta-icon">

                                                <i class="fa-solid fa-coins"></i>

                                            </div>


                                            <span class="salary">

                                                @if(is_numeric($job->salary) && $job->salary > 0)

                                                    {{ number_format(
                                                        $job->salary,
                                                        0,
                                                        ',',
                                                        '.'
                                                    ) }} VNĐ

                                                @else

                                                    Thỏa thuận

                                                @endif

                                            </span>

                                        </div>

                                    </div>


                                    {{-- DESCRIPTION --}}
                                    <p class="job-description">

                                        {{ $job->predes
                                            ?? 'Nhà tuyển dụng chưa cung cấp mô tả ngắn cho vị trí này.' }}

                                    </p>


                                    {{-- FOOTER --}}
                                    <div class="job-card-footer">

                                        <span>
                                            Xem công việc
                                        </span>

                                        <div class="job-arrow">

                                            <i class="fa-solid fa-arrow-right"></i>

                                        </div>

                                    </div>

                                </a>

                            </article>

                        </div>

                    @endforeach

                </div>


                {{-- PAGINATION --}}
                @if($jobs->hasPages())

                    <div class="pagination-wrapper">

                        {{ $jobs
                            ->appends([
                                'search' => $search,
                                'address' => $address,
                                'job_type' => $jobType,
                                'salary_range' => $salaryRange
                            ])
                            ->links('vendor.pagination.bootstrap-5') }}

                    </div>

                @endif


            @else

                {{-- =========================
                    EMPTY STATE
                ========================== --}}

                <div class="empty-jobs">

                    <div class="empty-icon">

                        <i class="fa-solid fa-magnifying-glass"></i>

                    </div>

                    <h3>
                        Không tìm thấy công việc phù hợp
                    </h3>

                    <p>
                        Hãy thử thay đổi từ khóa, địa điểm
                        hoặc mức lương để mở rộng kết quả.
                    </p>

                    <a
                        href="{{ route('homepage') }}#jobs"
                        class="btn empty-btn">

                        Xem tất cả việc làm

                    </a>

                </div>

            @endif

        </div>

    </section>


    {{-- =========================
        AI CTA
    ========================== --}}

    <section class="ai-section">

        <div class="container">

            <div class="ai-card">

                <div class="row align-items-center g-4">

                    <div class="col-lg-8">

                        <div class="ai-label">

                            <i class="fa-solid fa-wand-magic-sparkles"></i>

                            AI Matching

                        </div>

                        <h2>
                            Chưa biết công việc nào phù hợp với bạn?
                        </h2>

                        <p>
                            Hệ thống gợi ý việc làm có thể phân tích thông tin
                            của bạn để đề xuất những cơ hội phù hợp hơn.
                        </p>

                    </div>


                    <div class="col-lg-4 text-lg-end">

                        @auth

                            <a
                                href="{{ route('suggest.index') }}"
                                class="btn ai-button">

                                Khám phá với AI

                                <i class="fa-solid fa-arrow-right"></i>

                            </a>

                        @endauth


                        @guest

                            <a
                                href="{{ route('login') }}"
                                class="btn ai-button">

                                Đăng nhập để sử dụng

                                <i class="fa-solid fa-arrow-right"></i>

                            </a>

                        @endguest

                    </div>

                </div>

            </div>

        </div>

    </section>


    {{-- =========================
        EMPLOYER CTA
    ========================== --}}

    <section class="employer-section">

        <div class="container">

            <div class="employer-card">

                <div>

                    <span>
                        Dành cho nhà tuyển dụng
                    </span>

                    <h2>
                        Tìm kiếm ứng viên phù hợp cho doanh nghiệp
                    </h2>

                    <p>
                        Đăng tin tuyển dụng và tiếp cận ứng viên
                        tiềm năng trên JOB SEARCH.
                    </p>

                </div>


                @auth

                    <a
                        href="{{ route('job.create') }}"
                        class="btn employer-btn">

                        <i class="fa-solid fa-plus"></i>

                        Đăng việc ngay

                    </a>

                @endauth


                @guest

                    <a
                        href="{{ route('create.employer') }}"
                        class="btn employer-btn">

                        Trở thành nhà tuyển dụng

                    </a>

                @endguest

            </div>

        </div>

    </section>

</div>

@endsection



{{-- ============================================================
    CSS
============================================================ --}}

@push('styles')

<style>

    /*
    |--------------------------------------------------------------------------
    | ROOT
    |--------------------------------------------------------------------------
    */

    :root {

        --primary: #ff3d57;
        --primary-dark: #e52845;

        --navy: #0c2135;

        --heading: #102a43;

        --text: #52606d;

        --muted: #8292a2;

        --border: #e8edf2;

        --background: #f7f9fc;

        --white: #ffffff;

    }


    /*
    |--------------------------------------------------------------------------
    | GLOBAL
    |--------------------------------------------------------------------------
    */

    .job-home {

        background:
            linear-gradient(
                180deg,
                #ffffff 0%,
                #f8fafc 100%
            );

        color: var(--heading);

        overflow: hidden;

    }


    /*
    |--------------------------------------------------------------------------
    | HERO
    |--------------------------------------------------------------------------
    */

    .hero-section {

        padding-top: 40px;

    }


    .hero-box {

        position: relative;

        overflow: hidden;

        min-height: 520px;

        border-radius: 36px;

        background: var(--navy);

        box-shadow:
            0 30px 80px rgba(12, 33, 53, 0.15);

    }


    .hero-background {

        position: absolute;

        inset: 0;

        background:

            radial-gradient(
                circle at 85% 20%,
                rgba(80, 132, 220, 0.35),
                transparent 35%
            ),

            radial-gradient(
                circle at 10% 100%,
                rgba(255, 61, 87, 0.22),
                transparent 35%
            );

    }


    .hero-content {

        min-height: 520px;

        padding: 55px 60px;

        z-index: 2;

    }


    .hero-badge {

        display: inline-flex;

        align-items: center;

        gap: 8px;

        padding: 8px 14px;

        margin-bottom: 22px;

        border:

            1px solid
            rgba(255,255,255,.15);

        border-radius: 999px;

        color: rgba(255,255,255,.85);

        background:
            rgba(255,255,255,.07);

        backdrop-filter: blur(10px);

        font-size: 14px;

        font-weight: 600;

    }


    .hero-badge i {

        color: #ffcf5c;

    }


    .hero-title {

        max-width: 680px;

        margin-bottom: 20px;

        color: #ffffff;

        font-size:

            clamp(
                42px,
                5vw,
                72px
            );

        font-weight: 800;

        line-height: 1.04;

        letter-spacing: -3px;

    }


    .hero-title span {

        display: block;

        color: #ff6479;

    }


    .hero-description {

        max-width: 610px;

        margin-bottom: 30px;

        color:
            rgba(255,255,255,.72);

        font-size: 18px;

        line-height: 1.75;

    }


    .hero-actions {

        display: flex;

        flex-wrap: wrap;

        gap: 12px;

    }


    .hero-primary-btn {

        display: inline-flex;

        align-items: center;

        gap: 10px;

        padding: 13px 22px;

        border: 0;

        border-radius: 14px;

        background: var(--primary);

        color: white;

        font-weight: 700;

        transition: .25s;

    }


    .hero-primary-btn:hover {

        transform: translateY(-2px);

        background: var(--primary-dark);

        color: white;

    }


    .hero-secondary-btn {

        display: inline-flex;

        align-items: center;

        gap: 10px;

        padding: 13px 22px;

        border:

            1px solid
            rgba(255,255,255,.2);

        border-radius: 14px;

        background:
            rgba(255,255,255,.08);

        color: white;

        font-weight: 600;

        backdrop-filter: blur(10px);

    }


    .hero-secondary-btn:hover {

        background:
            rgba(255,255,255,.15);

        color: white;

    }


    .hero-trust {

        display: flex;

        flex-wrap: wrap;

        gap: 20px;

        margin-top: 30px;

    }


    .hero-trust-item {

        display: flex;

        align-items: center;

        gap: 7px;

        color:
            rgba(255,255,255,.7);

        font-size: 13px;

    }


    .hero-trust-item i {

        color: #4ade80;

    }


    /*
    |--------------------------------------------------------------------------
    | HERO IMAGE
    |--------------------------------------------------------------------------
    */

    .hero-visual {

        display: flex;

        align-items: center;

        justify-content: center;

    }


    .hero-image {

        width: 100%;

        max-height: 400px;

        object-fit: contain;

        filter:
            drop-shadow(
                0 30px 40px
                rgba(0,0,0,.2)
            );

    }



    /*
    |--------------------------------------------------------------------------
    | STATS
    |--------------------------------------------------------------------------
    */

    .stats-section {

        position: relative;

        z-index: 10;

        margin-top: -42px;

        margin-bottom: 80px;

    }


    .stats-container {

        max-width: 950px;

        margin: auto;

        padding: 22px 30px;

        border:

            1px solid
            rgba(232,237,242,.9);

        border-radius: 24px;

        background:
            rgba(255,255,255,.95);

        box-shadow:
            0 20px 60px
            rgba(16,42,67,.10);

        backdrop-filter: blur(20px);

    }


    .stat-item {

        display: flex;

        align-items: center;

        justify-content: center;

        gap: 16px;

        min-height: 80px;

        border-right:
            1px solid var(--border);

    }


    .stat-item-last {

        border-right: none;

    }


    .stat-icon {

        display: grid;

        width: 50px;

        height: 50px;

        place-items: center;

        border-radius: 15px;

        background:
            rgba(255,61,87,.09);

        color: var(--primary);

        font-size: 19px;

    }


    .stat-number {

        color: var(--heading);

        font-size: 28px;

        font-weight: 800;

    }


    .stat-label {

        margin-top: 2px;

        color: var(--muted);

        font-size: 14px;

    }



    /*
    |--------------------------------------------------------------------------
    | JOB SECTION
    |--------------------------------------------------------------------------
    */

    .jobs-section {

        padding-bottom: 90px;

    }


    .jobs-header {

        display: flex;

        align-items: flex-end;

        justify-content: space-between;

        gap: 20px;

        margin-bottom: 28px;

    }


    .section-label {

        display: inline-flex;

        align-items: center;

        gap: 7px;

        margin-bottom: 8px;

        color: var(--primary);

        font-size: 14px;

        font-weight: 700;

    }


    .jobs-header h2 {

        margin-bottom: 7px;

        color: var(--heading);

        font-size:

            clamp(
                30px,
                4vw,
                44px
            );

        font-weight: 800;

        letter-spacing: -1.3px;

    }


    .jobs-header p {

        margin: 0;

        color: var(--muted);

    }


    .clear-filter {

        display: inline-flex;

        align-items: center;

        gap: 8px;

        padding: 10px 16px;

        border:

            1px solid
            var(--border);

        border-radius: 12px;

        color: var(--text);

        background: white;

        text-decoration: none;

        font-size: 14px;

        font-weight: 600;

    }


    .clear-filter:hover {

        color: var(--primary);

        border-color:
            rgba(255,61,87,.3);

    }



    /*
    |--------------------------------------------------------------------------
    | SEARCH
    |--------------------------------------------------------------------------
    */

    .search-panel {

        margin-bottom: 25px;

        padding: 22px;

        border:
            1px solid
            var(--border);

        border-radius: 20px;

        background: white;

        box-shadow:
            0 14px 45px
            rgba(16,42,67,.06);

    }


    .search-label {

        display: block;

        margin-bottom: 7px;

        color: var(--heading);

        font-size: 12px;

        font-weight: 700;

        text-transform: uppercase;

        letter-spacing: .5px;

    }


    .input-wrapper {

        position: relative;

    }


    .input-wrapper i {

        position: absolute;

        top: 50%;

        left: 15px;

        color: #9aa5b1;

        transform:
            translateY(-50%);

    }


    .input-wrapper input {

        height: 50px;

        padding-left: 43px;

        border:
            1px solid
            var(--border);

        border-radius: 12px;

        background:
            var(--background);

        box-shadow: none;

    }


    .input-wrapper input:focus {

        border-color:
            rgba(255,61,87,.5);

        background: white;

        box-shadow:
            0 0 0 4px
            rgba(255,61,87,.08);

    }


    .custom-select {

        height: 50px;

        border:
            1px solid
            var(--border);

        border-radius: 12px;

        background-color:
            var(--background);

        box-shadow: none;

    }


    .custom-select:focus {

        border-color:
            rgba(255,61,87,.5);

        box-shadow:
            0 0 0 4px
            rgba(255,61,87,.08);

    }


    .search-btn {

        display: grid;

        width: 100%;

        height: 50px;

        place-items: center;

        border: 0;

        border-radius: 12px;

        background: var(--primary);

        color: white;

        font-size: 17px;

        transition: .2s;

    }


    .search-btn:hover {

        background:
            var(--primary-dark);

        transform:
            translateY(-2px);

    }



    /*
    |--------------------------------------------------------------------------
    | FILTER CHIP
    |--------------------------------------------------------------------------
    */

    .active-filters {

        display: flex;

        flex-wrap: wrap;

        align-items: center;

        gap: 8px;

        margin-bottom: 28px;

    }


    .active-filter-title {

        color: var(--muted);

        font-size: 13px;

    }


    .filter-chip {

        display: inline-flex;

        align-items: center;

        gap: 6px;

        padding: 7px 12px;

        border-radius: 999px;

        background:
            rgba(255,61,87,.08);

        color: var(--primary);

        font-size: 12px;

        font-weight: 600;

    }



    /*
    |--------------------------------------------------------------------------
    | JOB CARD
    |--------------------------------------------------------------------------
    */

    .job-card {

        height: 100%;

        overflow: hidden;

        border:
            1px solid
            var(--border);

        border-radius: 20px;

        background: white;

        transition:
            transform .25s,
            box-shadow .25s,
            border .25s;

    }


    .job-card:hover {

        border-color:
            rgba(255,61,87,.25);

        box-shadow:
            0 22px 50px
            rgba(16,42,67,.10);

        transform:
            translateY(-6px);

    }


    .job-card-link {

        display: flex;

        min-height: 390px;

        height: 100%;

        flex-direction: column;

        padding: 22px;

        color: inherit;

        text-decoration: none;

    }


    .job-card-top {

        display: flex;

        align-items: flex-start;

        justify-content: space-between;

        margin-bottom: 20px;

    }


    .company-logo-box {

        position: relative;

    }


    .company-logo-box img {

        width: 58px;

        height: 58px;

        border:
            1px solid
            var(--border);

        border-radius: 15px;

        object-fit: cover;

        background: white;

    }


    .verified-company {

        position: absolute;

        right: -5px;

        bottom: -4px;

        display: grid;

        width: 22px;

        height: 22px;

        place-items: center;

        border:
            3px solid white;

        border-radius: 50%;

        background: white;

        color: #3b82f6;

        font-size: 14px;

    }


    /*
    |--------------------------------------------------------------------------
    | JOB TYPES
    |--------------------------------------------------------------------------
    */

    .job-type {

        display: inline-flex;

        align-items: center;

        padding: 6px 10px;

        border-radius: 999px;

        font-size: 11px;

        font-weight: 700;

    }


    .job-fulltime {

        color: #2563eb;

        background:
            rgba(37,99,235,.09);

    }


    .job-parttime {

        color: #7c3aed;

        background:
            rgba(124,58,237,.09);

    }


    .job-remote {

        color: #0891b2;

        background:
            rgba(8,145,178,.10);

    }


    .job-contract {

        color: #ea580c;

        background:
            rgba(234,88,12,.09);

    }


    .job-default {

        color: #64748b;

        background:
            #f1f5f9;

    }



    /*
    |--------------------------------------------------------------------------
    | JOB INFO
    |--------------------------------------------------------------------------
    */

    .job-info {

        margin-bottom: 18px;

    }


    .job-title {

        display: -webkit-box;

        min-height: 52px;

        margin-bottom: 8px;

        overflow: hidden;

        color: var(--heading);

        font-size: 18px;

        font-weight: 800;

        line-height: 1.45;

        -webkit-line-clamp: 2;

        -webkit-box-orient: vertical;

    }


    .company-name {

        display: flex;

        align-items: center;

        gap: 7px;

        overflow: hidden;

        color: var(--muted);

        font-size: 13px;

        text-overflow: ellipsis;

        white-space: nowrap;

    }



    /*
    |--------------------------------------------------------------------------
    | JOB META
    |--------------------------------------------------------------------------
    */

    .job-meta {

        display: grid;

        gap: 10px;

        padding: 15px 0;

        border-top:
            1px solid var(--border);

        border-bottom:
            1px solid var(--border);

    }


    .job-meta-item {

        display: flex;

        align-items: center;

        gap: 9px;

        color: var(--text);

        font-size: 13px;

    }


    .meta-icon {

        display: grid;

        width: 27px;

        height: 27px;

        flex: 0 0 27px;

        place-items: center;

        border-radius: 8px;

        background:
            var(--background);

        color: var(--primary);

        font-size: 11px;

    }


    .salary {

        color: #16a34a;

        font-weight: 700;

    }


    /*
    |--------------------------------------------------------------------------
    | DESCRIPTION
    |--------------------------------------------------------------------------
    */

    .job-description {

        display: -webkit-box;

        min-height: 63px;

        margin: 16px 0;

        overflow: hidden;

        color: var(--muted);

        font-size: 13px;

        line-height: 1.65;

        -webkit-line-clamp: 3;

        -webkit-box-orient: vertical;

    }



    /*
    |--------------------------------------------------------------------------
    | JOB FOOTER
    |--------------------------------------------------------------------------
    */

    .job-card-footer {

        display: flex;

        align-items: center;

        justify-content: space-between;

        margin-top: auto;

        color: var(--heading);

        font-size: 13px;

        font-weight: 700;

    }


    .job-arrow {

        display: grid;

        width: 35px;

        height: 35px;

        place-items: center;

        border-radius: 50%;

        background:
            var(--background);

        color: var(--primary);

        transition: .2s;

    }


    .job-card:hover .job-arrow {

        background: var(--primary);

        color: white;

        transform:
            translateX(3px);

    }



    /*
    |--------------------------------------------------------------------------
    | PAGINATION
    |--------------------------------------------------------------------------
    */

    .pagination-wrapper {

        display: flex;

        justify-content: center;

        margin-top: 50px;

    }



    /*
    |--------------------------------------------------------------------------
    | EMPTY
    |--------------------------------------------------------------------------
    */

    .empty-jobs {

        padding: 70px 20px;

        border:
            1px dashed
            #ccd6e0;

        border-radius: 22px;

        background: white;

        text-align: center;

    }


    .empty-icon {

        display: grid;

        width: 72px;

        height: 72px;

        margin:
            0 auto 20px;

        place-items: center;

        border-radius: 20px;

        background:
            rgba(255,61,87,.08);

        color: var(--primary);

        font-size: 24px;

    }


    .empty-jobs h3 {

        color: var(--heading);

        font-weight: 800;

    }


    .empty-jobs p {

        max-width: 450px;

        margin:
            10px auto 22px;

        color: var(--muted);

    }


    .empty-btn {

        padding: 11px 20px;

        border-radius: 12px;

        background: var(--primary);

        color: white;

        font-weight: 600;

    }


    .empty-btn:hover {

        background:
            var(--primary-dark);

        color: white;

    }



    /*
    |--------------------------------------------------------------------------
    | AI SECTION
    |--------------------------------------------------------------------------
    */

    .ai-section {

        padding-bottom: 35px;

    }


    .ai-card {

        padding: 42px;

        border-radius: 28px;

        background:

            radial-gradient(
                circle at 90% 10%,
                rgba(113, 86, 255, .4),
                transparent 38%
            ),

            linear-gradient(
                135deg,
                #17152f,
                #252450
            );

        color: white;

        box-shadow:
            0 30px 60px
            rgba(22,20,47,.15);

    }


    .ai-label {

        display: inline-flex;

        align-items: center;

        gap: 8px;

        margin-bottom: 12px;

        color: #b7adff;

        font-size: 13px;

        font-weight: 700;

    }


    .ai-card h2 {

        max-width: 650px;

        margin-bottom: 10px;

        font-size:
            clamp(
                28px,
                4vw,
                40px
            );

        font-weight: 800;

        letter-spacing: -1px;

    }


    .ai-card p {

        max-width: 650px;

        margin: 0;

        color:
            rgba(255,255,255,.65);

        line-height: 1.7;

    }


    .ai-button {

        display: inline-flex;

        align-items: center;

        gap: 10px;

        padding: 13px 20px;

        border-radius: 13px;

        background: white;

        color: #252450;

        font-weight: 700;

    }


    .ai-button:hover {

        color: #252450;

        background: #f2f0ff;

        transform:
            translateY(-2px);

    }



    /*
    |--------------------------------------------------------------------------
    | EMPLOYER
    |--------------------------------------------------------------------------
    */

    .employer-section {

        padding:
            35px 0 90px;

    }


    .employer-card {

        display: flex;

        align-items: center;

        justify-content: space-between;

        gap: 30px;

        padding: 38px;

        border:
            1px solid
            var(--border);

        border-radius: 26px;

        background: white;

    }


    .employer-card span {

        color: var(--primary);

        font-size: 13px;

        font-weight: 700;

    }


    .employer-card h2 {

        max-width: 670px;

        margin:
            8px 0;

        color: var(--heading);

        font-size:
            clamp(
                25px,
                4vw,
                36px
            );

        font-weight: 800;

        letter-spacing: -1px;

    }


    .employer-card p {

        margin: 0;

        color: var(--muted);

    }


    .employer-btn {

        display: inline-flex;

        align-items: center;

        flex: 0 0 auto;

        gap: 8px;

        padding: 13px 20px;

        border-radius: 13px;

        background: var(--heading);

        color: white;

        font-weight: 700;

    }


    .employer-btn:hover {

        background: var(--primary);

        color: white;

    }



    /*
    |--------------------------------------------------------------------------
    | RESPONSIVE TABLET
    |--------------------------------------------------------------------------
    */

    @media(max-width: 991px) {

        .hero-box {

            min-height: auto;

        }


        .hero-content {

            min-height: 500px;

            padding:
                50px 40px;

        }


        .hero-title {

            letter-spacing:
                -2px;

        }


        .stats-section {

            margin-top:
                -30px;

        }


        .stat-item {

            border-right:
                none;

        }


        .search-btn {

            margin-top: 0;

        }


        .employer-card {

            align-items:
                flex-start;

            flex-direction:
                column;

        }

    }



    /*
    |--------------------------------------------------------------------------
    | RESPONSIVE MOBILE
    |--------------------------------------------------------------------------
    */

    @media(max-width: 767px) {

        .hero-section {

            padding-top: 20px;

        }


        .hero-box {

            border-radius: 24px;

        }


        .hero-content {

            min-height: 520px;

            padding:
                38px 24px;

        }


        .hero-title {

            font-size: 42px;

            letter-spacing:
                -1.8px;

        }


        .hero-description {

            font-size: 16px;

        }


        .hero-actions {

            flex-direction:
                column;

        }


        .hero-primary-btn,
        .hero-secondary-btn {

            justify-content:
                center;

            width: 100%;

        }


        .hero-trust {

            gap: 10px;

            flex-direction:
                column;

        }


        .stats-section {

            margin-top:
                -25px;

            margin-bottom:
                60px;

        }


        .stats-container {

            padding: 15px;

        }


        .stat-item {

            justify-content:
                flex-start;

            padding:
                13px;

        }


        .jobs-header {

            align-items:
                flex-start;

            flex-direction:
                column;

        }


        .search-panel {

            padding: 18px;

        }


        .job-card-link {

            min-height: 360px;

        }


        .ai-card {

            padding:
                32px 24px;

        }


        .ai-button {

            width: 100%;

            justify-content:
                center;

        }


        .employer-card {

            padding:
                28px 22px;

        }


        .employer-btn {

            width: 100%;

            justify-content:
                center;

        }

    }



    /*
    |--------------------------------------------------------------------------
    | SMALL MOBILE
    |--------------------------------------------------------------------------
    */

    @media(max-width: 480px) {

        .hero-title {

            font-size: 36px;

        }


        .hero-content {

            min-height: 500px;

        }


        .job-card-link {

            padding: 20px;

        }

    }

</style>

@endpush