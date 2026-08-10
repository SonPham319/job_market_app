@extends('layouts.app')

@section('title', $listing->title . ' - JOB SEARCH')

@section('content')

@php
    /*
    |--------------------------------------------------------------------------
    | PREPARE DATA
    |--------------------------------------------------------------------------
    */

    $profile = $listing->profile;

    $companyName = $profile
        ? $profile->name
        : 'Chưa cập nhật công ty';

    $companyEmail = $profile && $profile->email
        ? $profile->email
        : null;

    $companyLogo = $profile && $profile->profile_pic
        ? asset('storage/' . $profile->profile_pic)
        : asset('images/default-company.png');

    $isPremium = $user && $user->plan == 'yearly';

    /*
    |--------------------------------------------------------------------------
    | JOB TYPE
    |--------------------------------------------------------------------------
    */

    $jobTypeClasses = [
        'Fulltime' => 'job-type-fulltime',
        'Parttime' => 'job-type-parttime',
        'Từ Xa' => 'job-type-remote',
        'Hợp Đồng' => 'job-type-contract',
    ];

    $jobTypeClass = $jobTypeClasses[$listing->job_type]
        ?? 'job-type-default';

    /*
    |--------------------------------------------------------------------------
    | SALARY
    |--------------------------------------------------------------------------
    */

    if (is_numeric($listing->salary) && (float) $listing->salary > 0) {
        $salaryText = number_format(
            (float) $listing->salary,
            0,
            ',',
            '.'
        ) . ' VNĐ';
    } else {
        $salaryText = $listing->salary ?: 'Thỏa thuận';
    }

    /*
    |--------------------------------------------------------------------------
    | DEADLINE
    |--------------------------------------------------------------------------
    */

    $closeDate = $listing->application_close_date
        ? \Carbon\Carbon::parse($listing->application_close_date)
        : null;

    $isExpired = $closeDate
        ? $closeDate->isPast()
        : false;

    if (!$closeDate) {
        $deadlineText = 'Không giới hạn';
        $daysLeft = null;
    } elseif ($isExpired) {
        $deadlineText = 'Đã hết hạn';
        $daysLeft = null;
    } else {
        $daysLeft = now()->startOfDay()->diffInDays(
            $closeDate->copy()->startOfDay()
        );

        if ($daysLeft == 0) {
            $deadlineText = 'Hết hạn hôm nay';
        } else {
            $deadlineText = 'Còn ' . $daysLeft . ' ngày';
        }
    }

    /*
    |--------------------------------------------------------------------------
    | USER STATUS
    |--------------------------------------------------------------------------
    */

    $isLoggedIn = auth()->check();

    $currentUser = auth()->user();

    $isOwner = $isLoggedIn
        && $listing->user_id == auth()->id();

    $isEmployee = $isLoggedIn
        && $currentUser->user_type == 'employee';

    $hasApplied = $isLoggedIn
        && $listing->users->contains(auth()->id());
@endphp


<div class="job-detail-page">

    {{-- ============================================================
        SUCCESS MESSAGE
    ============================================================ --}}

    @if(session()->has('message'))

        <div class="container pt-4">

            <div class="job-alert-success">

                <div class="job-alert-icon">

                    <i class="fa-solid fa-circle-check"></i>

                </div>

                <div>

                    <strong>Thành công</strong>

                    <p>
                        {{ session()->get('message') }}
                    </p>

                </div>

                <button
                    type="button"
                    class="btn-close ms-auto"
                    data-bs-dismiss="alert"
                    aria-label="Đóng">
                </button>

            </div>

        </div>

    @endif



    {{-- ============================================================
        JOB COVER
    ============================================================ --}}

    <section class="job-cover-section">

        <div class="container">

            <div class="job-cover">

                @if($listing->feature_image)

                    <img
                        src="{{ asset('storage/' . $listing->feature_image) }}"
                        alt="Ảnh bìa {{ $listing->title }}"
                        class="job-cover-image">

                @endif

                <div class="job-cover-overlay"></div>

            </div>

        </div>

    </section>



    {{-- ============================================================
        COMPANY + JOB HEADER
    ============================================================ --}}

    <section class="job-header-section">

        <div class="container">

            <div class="job-header-card">

                <div class="job-company-header">

                    {{-- COMPANY LOGO --}}
                    <div class="job-company-logo-wrapper">

                        <img
                            src="{{ $companyLogo }}"
                            alt="Logo {{ $companyName }}"
                            class="job-company-logo">

                        @if($isPremium)

                            <div
                                class="company-verified"
                                title="Nhà tuyển dụng nổi bật">

                                <i class="fa-solid fa-circle-check"></i>

                            </div>

                        @endif

                    </div>


                    {{-- COMPANY INFO --}}
                    <div class="job-company-info">

                        <div class="company-name-row">

                            <h2>
                                {{ $companyName }}
                            </h2>

                            @if($isPremium)

                                <span class="premium-badge">

                                    <i class="fa-solid fa-bolt"></i>

                                    Nhà tuyển dụng nổi bật

                                </span>

                            @endif

                        </div>


                        <div class="company-meta">

                            @if($listing->address)

                                <span>

                                    <i class="fa-solid fa-location-dot"></i>

                                    {{ $listing->address }}

                                </span>

                            @endif


                            @if($companyEmail)

                                <a href="mailto:{{ $companyEmail }}">

                                    <i class="fa-regular fa-envelope"></i>

                                    {{ $companyEmail }}

                                </a>

                            @endif

                        </div>

                    </div>

                </div>


                {{-- JOB TITLE --}}
                <div class="job-title-section">

                    <div class="job-title-content">

                        <div class="job-badges">

                            <span class="job-type-badge {{ $jobTypeClass }}">

                                <i class="fa-solid fa-briefcase"></i>

                                {{ $listing->job_type ?? 'Khác' }}

                            </span>


                            @if($isExpired)

                                <span class="deadline-badge deadline-expired">

                                    <i class="fa-regular fa-clock"></i>

                                    Đã hết hạn

                                </span>

                            @else

                                <span class="deadline-badge deadline-active">

                                    <i class="fa-regular fa-clock"></i>

                                    {{ $deadlineText }}

                                </span>

                            @endif

                        </div>


                        <h1 class="job-main-title">

                            {{ $listing->title }}

                        </h1>


                        <div class="job-quick-meta">

                            <div>

                                <i class="fa-solid fa-location-dot"></i>

                                <span>

                                    {{ $listing->address
                                        ?? 'Chưa cập nhật địa điểm' }}

                                </span>

                            </div>


                            <div>

                                <i class="fa-solid fa-coins"></i>

                                <span class="job-salary">

                                    {{ $salaryText }}

                                </span>

                            </div>

                        </div>

                    </div>



                    {{-- HEADER ACTION --}}
                    <div class="job-header-action">

                        @if($isOwner)

                            <a
                                href="{{ route('job.edit', $listing) }}"
                                class="btn job-edit-button">

                                <i class="fa-solid fa-pen"></i>

                                Sửa bài đăng

                            </a>

                        @elseif($hasApplied)

                            <button
                                type="button"
                                class="btn job-applied-button"
                                disabled>

                                <i class="fa-solid fa-circle-check"></i>

                                Đã ứng tuyển

                            </button>

                        @elseif($isEmployee)

                            @if($isExpired)

                                <button
                                    type="button"
                                    class="btn job-disabled-button"
                                    disabled>

                                    <i class="fa-regular fa-clock"></i>

                                    Đã hết hạn

                                </button>

                            @else

                                <button
                                    type="button"
                                    class="btn job-apply-button"
                                    data-bs-toggle="modal"
                                    data-bs-target="#applyModal">

                                    <i class="fa-solid fa-paper-plane"></i>

                                    Ứng tuyển ngay

                                </button>

                            @endif

                        @elseif(!$isLoggedIn)

                            @if($isExpired)

                                <button
                                    class="btn job-disabled-button"
                                    disabled>

                                    <i class="fa-regular fa-clock"></i>

                                    Đã hết hạn

                                </button>

                            @else

                                <button
                                    type="button"
                                    class="btn job-apply-button"
                                    data-bs-toggle="modal"
                                    data-bs-target="#applyModal2">

                                    <i class="fa-solid fa-paper-plane"></i>

                                    Ứng tuyển ngay

                                </button>

                            @endif

                        @else

                            <div class="employer-notice">

                                <i class="fa-solid fa-circle-info"></i>

                                Tài khoản nhà tuyển dụng không thể ứng tuyển.

                            </div>

                        @endif

                    </div>

                </div>

            </div>

        </div>

    </section>



    {{-- ============================================================
        MAIN CONTENT
    ============================================================ --}}

    <section class="job-main-section">

        <div class="container">

            <div class="row g-4">

                {{-- =================================================
                    LEFT CONTENT
                ================================================== --}}

                <div class="col-lg-8">

                    {{-- JOB DESCRIPTION --}}
                    <article class="job-content-card">

                        <div class="content-heading">

                            <div class="content-heading-icon">

                                <i class="fa-solid fa-align-left"></i>

                            </div>

                            <div>

                                <span>
                                    Thông tin công việc
                                </span>

                                <h2>
                                    Mô tả công việc
                                </h2>

                            </div>

                        </div>


                        <div class="job-rich-content">

                            {!! $listing->description !!}

                        </div>

                    </article>



                    {{-- REQUIREMENTS --}}
                    <article class="job-content-card">

                        <div class="content-heading">

                            <div class="content-heading-icon">

                                <i class="fa-solid fa-list-check"></i>

                            </div>

                            <div>

                                <span>
                                    Điều kiện ứng tuyển
                                </span>

                                <h2>
                                    Yêu cầu ứng viên
                                </h2>

                            </div>

                        </div>


                        <div class="job-rich-content">

                            {!! $listing->roles !!}

                        </div>

                    </article>



                    {{-- CONTACT --}}
                    <article class="job-content-card">

                        <div class="content-heading">

                            <div class="content-heading-icon">

                                <i class="fa-regular fa-envelope"></i>

                            </div>

                            <div>

                                <span>
                                    Nhà tuyển dụng
                                </span>

                                <h2>
                                    Thông tin liên hệ
                                </h2>

                            </div>

                        </div>


                        <div class="contact-box">

                            <div class="contact-company">

                                <img
                                    src="{{ $companyLogo }}"
                                    alt="{{ $companyName }}">

                                <div>

                                    <strong>
                                        {{ $companyName }}
                                    </strong>

                                    <span>
                                        Nhà tuyển dụng
                                    </span>

                                </div>

                            </div>


                            @if($companyEmail)

                                <a
                                    href="mailto:{{ $companyEmail }}"
                                    class="contact-email">

                                    <i class="fa-regular fa-envelope"></i>

                                    {{ $companyEmail }}

                                </a>

                            @else

                                <span class="contact-email text-muted">

                                    Chưa cập nhật email

                                </span>

                            @endif

                        </div>

                    </article>

                </div>



                {{-- =================================================
                    RIGHT SIDEBAR
                ================================================== --}}

                <div class="col-lg-4">

                    <div class="job-sidebar">

                        {{-- OVERVIEW --}}
                        <div class="job-sidebar-card">

                            <h3>
                                Tổng quan công việc
                            </h3>


                            {{-- SALARY --}}
                            <div class="overview-item">

                                <div class="overview-icon">

                                    <i class="fa-solid fa-coins"></i>

                                </div>

                                <div>

                                    <span>
                                        Mức lương
                                    </span>

                                    <strong class="overview-salary">

                                        {{ $salaryText }}

                                    </strong>

                                </div>

                            </div>


                            {{-- LOCATION --}}
                            <div class="overview-item">

                                <div class="overview-icon">

                                    <i class="fa-solid fa-location-dot"></i>

                                </div>

                                <div>

                                    <span>
                                        Địa điểm
                                    </span>

                                    <strong>

                                        {{ $listing->address
                                            ?? 'Chưa cập nhật' }}

                                    </strong>

                                </div>

                            </div>


                            {{-- JOB TYPE --}}
                            <div class="overview-item">

                                <div class="overview-icon">

                                    <i class="fa-solid fa-briefcase"></i>

                                </div>

                                <div>

                                    <span>
                                        Hình thức
                                    </span>

                                    <strong>

                                        {{ $listing->job_type
                                            ?? 'Chưa cập nhật' }}

                                    </strong>

                                </div>

                            </div>


                            {{-- DEADLINE --}}
                            <div class="overview-item">

                                <div class="overview-icon">

                                    <i class="fa-regular fa-calendar"></i>

                                </div>

                                <div>

                                    <span>
                                        Hạn ứng tuyển
                                    </span>

                                    <strong>

                                        @if($closeDate)

                                            {{ $closeDate->format('d/m/Y') }}

                                        @else

                                            Không giới hạn

                                        @endif

                                    </strong>

                                </div>

                            </div>



                            {{-- DEADLINE STATUS --}}
                            <div class="sidebar-deadline
                                {{ $isExpired
                                    ? 'sidebar-deadline-expired'
                                    : 'sidebar-deadline-active' }}">

                                @if($isExpired)

                                    <i class="fa-solid fa-circle-xmark"></i>

                                    <div>

                                        <strong>
                                            Đã hết hạn
                                        </strong>

                                        <span>
                                            Vị trí này không còn nhận hồ sơ.
                                        </span>

                                    </div>

                                @else

                                    <i class="fa-solid fa-clock"></i>

                                    <div>

                                        <strong>
                                            {{ $deadlineText }}
                                        </strong>

                                        <span>
                                            Hãy ứng tuyển trước khi vị trí đóng.
                                        </span>

                                    </div>

                                @endif

                            </div>



                            {{-- APPLY ACTION --}}
                            <div class="sidebar-action">

                                @if($isOwner)

                                    <a
                                        href="{{ route('job.edit', $listing) }}"
                                        class="btn sidebar-edit-btn">

                                        <i class="fa-solid fa-pen"></i>

                                        Sửa bài đăng

                                    </a>


                                @elseif($hasApplied)

                                    <button
                                        class="btn sidebar-applied-btn"
                                        disabled>

                                        <i class="fa-solid fa-circle-check"></i>

                                        Bạn đã ứng tuyển

                                    </button>


                                @elseif($isEmployee && !$isExpired)

                                    <button
                                        type="button"
                                        class="btn sidebar-apply-btn"
                                        data-bs-toggle="modal"
                                        data-bs-target="#applyModal">

                                        <i class="fa-solid fa-paper-plane"></i>

                                        Ứng tuyển ngay

                                    </button>


                                @elseif(!$isLoggedIn && !$isExpired)

                                    <button
                                        type="button"
                                        class="btn sidebar-apply-btn"
                                        data-bs-toggle="modal"
                                        data-bs-target="#applyModal2">

                                        <i class="fa-solid fa-paper-plane"></i>

                                        Ứng tuyển ngay

                                    </button>


                                @elseif($isExpired)

                                    <button
                                        class="btn sidebar-disabled-btn"
                                        disabled>

                                        <i class="fa-regular fa-clock"></i>

                                        Đã hết hạn

                                    </button>

                                @endif

                            </div>

                        </div>



                        {{-- SAFE APPLY MESSAGE --}}
                        <div class="job-tip-card">

                            <div class="job-tip-icon">

                                <i class="fa-solid fa-shield-halved"></i>

                            </div>

                            <div>

                                <strong>
                                    Lưu ý khi ứng tuyển
                                </strong>

                                <p>
                                    Kiểm tra kỹ thông tin nhà tuyển dụng
                                    và không cung cấp mật khẩu hoặc thông tin
                                    tài chính cá nhân.
                                </p>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>



    {{-- ============================================================
        BOTTOM CTA
    ============================================================ --}}

    <section class="job-bottom-section">

        <div class="container">

            <div class="job-bottom-card">

                <div>

                    <span class="job-bottom-label">

                        <i class="fa-solid fa-wand-magic-sparkles"></i>

                        JOB SEARCH

                    </span>

                    <h2>
                        Chưa chắc vị trí này phù hợp với bạn?
                    </h2>

                    <p>
                        Khám phá thêm những cơ hội nghề nghiệp khác
                        hoặc sử dụng hệ thống gợi ý việc làm.
                    </p>

                </div>


                <div class="job-bottom-actions">

                    <a
                        href="{{ route('homepage') }}#jobs"
                        class="btn bottom-secondary-btn">

                        <i class="fa-solid fa-arrow-left"></i>

                        Xem việc làm khác

                    </a>


                    @auth

                        <a
                            href="{{ route('suggest.index') }}"
                            class="btn bottom-primary-btn">

                            <i class="fa-solid fa-wand-magic-sparkles"></i>

                            AI gợi ý việc làm

                        </a>

                    @endauth

                </div>

            </div>

        </div>

    </section>

</div>



{{-- ============================================================
    APPLY MODAL - LOGGED IN EMPLOYEE
============================================================ --}}

@if($isLoggedIn && $isEmployee && !$hasApplied && !$isExpired)

<div
    class="modal fade"
    id="applyModal"
    tabindex="-1"
    aria-labelledby="applyModalLabel"
    aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content apply-modal-content">

            <form
                action="{{ route('application.submit', $listing->id) }}"
                method="POST">

                @csrf


                <div class="modal-body text-center">

                    <button
                        type="button"
                        class="btn-close apply-modal-close"
                        data-bs-dismiss="modal"
                        aria-label="Đóng">
                    </button>


                    <div class="apply-modal-icon">

                        <i class="fa-solid fa-paper-plane"></i>

                    </div>


                    <span class="apply-modal-label">
                        Xác nhận ứng tuyển
                    </span>


                    <h3>
                        {{ $listing->title }}
                    </h3>


                    <p>
                        Hồ sơ của bạn sẽ được gửi đến
                        <strong>{{ $companyName }}</strong>.
                        Bạn có chắc chắn muốn ứng tuyển vị trí này?
                    </p>


                    <div class="apply-modal-job">

                        <img
                            src="{{ $companyLogo }}"
                            alt="{{ $companyName }}">

                        <div>

                            <strong>
                                {{ $companyName }}
                            </strong>

                            <span>

                                <i class="fa-solid fa-location-dot"></i>

                                {{ $listing->address
                                    ?? 'Chưa cập nhật địa điểm' }}

                            </span>

                        </div>

                    </div>


                    <div class="apply-modal-actions">

                        <button
                            type="button"
                            class="btn modal-cancel-btn"
                            data-bs-dismiss="modal">

                            Hủy

                        </button>


                        <button
                            type="submit"
                            class="btn modal-confirm-btn">

                            <i class="fa-solid fa-paper-plane"></i>

                            Xác nhận ứng tuyển

                        </button>

                    </div>

                </div>

            </form>

        </div>

    </div>

</div>

@endif



{{-- ============================================================
    LOGIN REQUIRED MODAL
============================================================ --}}

@guest

<div
    class="modal fade"
    id="applyModal2"
    tabindex="-1"
    aria-labelledby="loginApplyModalLabel"
    aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content apply-modal-content">

            <div class="modal-body text-center">

                <button
                    type="button"
                    class="btn-close apply-modal-close"
                    data-bs-dismiss="modal"
                    aria-label="Đóng">
                </button>


                <div class="apply-modal-icon login-modal-icon">

                    <i class="fa-solid fa-user-lock"></i>

                </div>


                <span class="apply-modal-label">
                    Yêu cầu đăng nhập
                </span>


                <h3 id="loginApplyModalLabel">
                    Đăng nhập để ứng tuyển
                </h3>


                <p>
                    Bạn cần đăng nhập vào JOB SEARCH
                    trước khi ứng tuyển vị trí
                    <strong>{{ $listing->title }}</strong>.
                </p>


                <div class="apply-modal-actions">

                    <button
                        type="button"
                        class="btn modal-cancel-btn"
                        data-bs-dismiss="modal">

                        Để sau

                    </button>


                    <a
                        href="{{ route('login') }}"
                        class="btn modal-confirm-btn">

                        <i class="fa-solid fa-right-to-bracket"></i>

                        Đăng nhập

                    </a>

                </div>

            </div>

        </div>

    </div>

</div>

@endguest

@endsection



{{-- ============================================================
    PAGE CSS
============================================================ --}}

@push('styles')

<style>

    :root {

        --job-primary: #ff3d57;
        --job-primary-dark: #e72946;

        --job-navy: #102a43;

        --job-heading: #102a43;

        --job-text: #52606d;

        --job-muted: #8292a2;

        --job-border: #e7ecf2;

        --job-background: #f6f8fb;

        --job-white: #ffffff;

        --job-green: #16a34a;

    }



    /*
    |--------------------------------------------------------------------------
    | PAGE
    |--------------------------------------------------------------------------
    */

    .job-detail-page {

        padding-bottom: 20px;

        background:
            linear-gradient(
                180deg,
                #ffffff 0%,
                #f7f9fc 55%,
                #ffffff 100%
            );

        color: var(--job-heading);

    }



    /*
    |--------------------------------------------------------------------------
    | SUCCESS ALERT
    |--------------------------------------------------------------------------
    */

    .job-alert-success {

        display: flex;

        align-items: center;

        gap: 14px;

        padding: 16px 18px;

        border:

            1px solid
            rgba(22, 163, 74, .18);

        border-radius: 16px;

        background: #f0fdf4;

        color: #166534;

    }


    .job-alert-icon {

        display: grid;

        width: 40px;

        height: 40px;

        flex: 0 0 40px;

        place-items: center;

        border-radius: 12px;

        background: #dcfce7;

        color: #16a34a;

    }


    .job-alert-success p {

        margin: 2px 0 0;

        color: #4b7860;

        font-size: 14px;

    }



    /*
    |--------------------------------------------------------------------------
    | COVER
    |--------------------------------------------------------------------------
    */

    .job-cover-section {

        padding-top: 35px;

    }


    .job-cover {

        position: relative;

        overflow: hidden;

        height: 330px;

        border-radius: 30px;

        background:

            radial-gradient(
                circle at 75% 20%,
                rgba(255, 61, 87, .28),
                transparent 35%
            ),

            radial-gradient(
                circle at 10% 100%,
                rgba(72, 111, 255, .28),
                transparent 35%
            ),

            linear-gradient(
                135deg,
                #102a43,
                #193c5a
            );

    }


    .job-cover-image {

        width: 100%;

        height: 100%;

        object-fit: cover;

    }


    .job-cover-overlay {

        position: absolute;

        inset: 0;

        background:

            linear-gradient(
                180deg,
                transparent 45%,
                rgba(5, 20, 33, .2)
            );

        pointer-events: none;

    }



    /*
    |--------------------------------------------------------------------------
    | HEADER
    |--------------------------------------------------------------------------
    */

    .job-header-section {

        position: relative;

        z-index: 5;

        margin-top: -75px;

    }


    .job-header-card {

        padding: 30px;

        border:

            1px solid
            var(--job-border);

        border-radius: 26px;

        background:

            rgba(255, 255, 255, .97);

        box-shadow:

            0 20px 60px
            rgba(16, 42, 67, .10);

        backdrop-filter: blur(18px);

    }


    .job-company-header {

        display: flex;

        align-items: center;

        gap: 20px;

        padding-bottom: 26px;

        border-bottom:

            1px solid
            var(--job-border);

    }


    .job-company-logo-wrapper {

        position: relative;

        flex: 0 0 auto;

    }


    .job-company-logo {

        width: 88px;

        height: 88px;

        border:

            1px solid
            var(--job-border);

        border-radius: 22px;

        background: white;

        object-fit: cover;

        box-shadow:

            0 10px 30px
            rgba(16, 42, 67, .08);

    }


    .company-verified {

        position: absolute;

        right: -6px;

        bottom: -5px;

        display: grid;

        width: 29px;

        height: 29px;

        place-items: center;

        border:

            4px solid
            white;

        border-radius: 50%;

        background: white;

        color: #3b82f6;

        font-size: 17px;

    }


    .job-company-info {

        min-width: 0;

        flex: 1;

    }


    .company-name-row {

        display: flex;

        flex-wrap: wrap;

        align-items: center;

        gap: 10px;

    }


    .company-name-row h2 {

        margin: 0;

        color: var(--job-heading);

        font-size: 24px;

        font-weight: 800;

        letter-spacing: -.5px;

    }


    .premium-badge {

        display: inline-flex;

        align-items: center;

        gap: 6px;

        padding: 6px 10px;

        border-radius: 999px;

        background: #fff7d6;

        color: #9a6700;

        font-size: 11px;

        font-weight: 700;

    }


    .premium-badge i {

        color: #f2aa00;

    }


    .company-meta {

        display: flex;

        flex-wrap: wrap;

        gap: 15px;

        margin-top: 9px;

    }


    .company-meta span,
    .company-meta a {

        display: inline-flex;

        align-items: center;

        gap: 7px;

        color: var(--job-muted);

        font-size: 13px;

        text-decoration: none;

    }


    .company-meta i {

        color: var(--job-primary);

    }


    .company-meta a:hover {

        color: var(--job-primary);

    }



    /*
    |--------------------------------------------------------------------------
    | JOB TITLE
    |--------------------------------------------------------------------------
    */

    .job-title-section {

        display: flex;

        align-items: center;

        justify-content: space-between;

        gap: 30px;

        padding-top: 28px;

    }


    .job-title-content {

        min-width: 0;

        flex: 1;

    }


    .job-badges {

        display: flex;

        flex-wrap: wrap;

        gap: 8px;

        margin-bottom: 14px;

    }


    .job-type-badge,
    .deadline-badge {

        display: inline-flex;

        align-items: center;

        gap: 6px;

        padding: 7px 11px;

        border-radius: 999px;

        font-size: 11px;

        font-weight: 700;

    }


    .job-type-fulltime {

        background: #eff6ff;

        color: #2563eb;

    }


    .job-type-parttime {

        background: #f5f3ff;

        color: #7c3aed;

    }


    .job-type-remote {

        background: #ecfeff;

        color: #0891b2;

    }


    .job-type-contract {

        background: #fff7ed;

        color: #ea580c;

    }


    .job-type-default {

        background: #f1f5f9;

        color: #64748b;

    }


    .deadline-active {

        background: #f0fdf4;

        color: #16a34a;

    }


    .deadline-expired {

        background: #fef2f2;

        color: #dc2626;

    }


    .job-main-title {

        max-width: 800px;

        margin-bottom: 15px;

        color: var(--job-heading);

        font-size:

            clamp(
                32px,
                4vw,
                50px
            );

        font-weight: 850;

        line-height: 1.15;

        letter-spacing: -1.6px;

    }


    .job-quick-meta {

        display: flex;

        flex-wrap: wrap;

        gap: 18px;

    }


    .job-quick-meta > div {

        display: inline-flex;

        align-items: center;

        gap: 8px;

        color: var(--job-text);

        font-size: 14px;

    }


    .job-quick-meta i {

        color: var(--job-primary);

    }


    .job-salary {

        color: var(--job-green);

        font-weight: 800;

    }



    /*
    |--------------------------------------------------------------------------
    | HEADER BUTTONS
    |--------------------------------------------------------------------------
    */

    .job-header-action {

        flex: 0 0 auto;

    }


    .job-apply-button,
    .job-edit-button,
    .job-applied-button,
    .job-disabled-button {

        display: inline-flex;

        min-width: 175px;

        align-items: center;

        justify-content: center;

        gap: 9px;

        padding: 13px 20px;

        border: 0;

        border-radius: 14px;

        font-size: 14px;

        font-weight: 700;

    }


    .job-apply-button {

        background: var(--job-primary);

        color: white;

        box-shadow:

            0 12px 25px
            rgba(255, 61, 87, .2);

    }


    .job-apply-button:hover {

        background: var(--job-primary-dark);

        color: white;

        transform: translateY(-2px);

    }


    .job-edit-button {

        background: var(--job-heading);

        color: white;

    }


    .job-edit-button:hover {

        background: var(--job-primary);

        color: white;

    }


    .job-applied-button {

        background: #dcfce7;

        color: #15803d;

    }


    .job-disabled-button {

        background: #eef2f6;

        color: #8292a2;

    }


    .employer-notice {

        max-width: 250px;

        padding: 12px 14px;

        border-radius: 12px;

        background: #f8fafc;

        color: var(--job-muted);

        font-size: 12px;

        line-height: 1.5;

    }


    .employer-notice i {

        margin-right: 5px;

        color: #64748b;

    }



    /*
    |--------------------------------------------------------------------------
    | MAIN CONTENT
    |--------------------------------------------------------------------------
    */

    .job-main-section {

        padding: 45px 0 80px;

    }


    .job-content-card {

        margin-bottom: 24px;

        padding: 30px;

        border:

            1px solid
            var(--job-border);

        border-radius: 22px;

        background: white;

        box-shadow:

            0 12px 40px
            rgba(16, 42, 67, .045);

    }


    .content-heading {

        display: flex;

        align-items: center;

        gap: 15px;

        margin-bottom: 28px;

        padding-bottom: 18px;

        border-bottom:

            1px solid
            var(--job-border);

    }


    .content-heading-icon {

        display: grid;

        width: 48px;

        height: 48px;

        flex: 0 0 48px;

        place-items: center;

        border-radius: 14px;

        background:

            rgba(255, 61, 87, .08);

        color: var(--job-primary);

        font-size: 17px;

    }


    .content-heading span {

        display: block;

        margin-bottom: 3px;

        color: var(--job-primary);

        font-size: 11px;

        font-weight: 700;

        text-transform: uppercase;

        letter-spacing: .7px;

    }


    .content-heading h2 {

        margin: 0;

        color: var(--job-heading);

        font-size: 23px;

        font-weight: 800;

    }



    /*
    |--------------------------------------------------------------------------
    | RICH TEXT
    |--------------------------------------------------------------------------
    */

    .job-rich-content {

        overflow-wrap: break-word;

        color: var(--job-text);

        font-size: 15px;

        line-height: 1.9;

    }


    .job-rich-content p {

        margin-bottom: 16px;

    }


    .job-rich-content ul,
    .job-rich-content ol {

        padding-left: 21px;

    }


    .job-rich-content li {

        margin-bottom: 9px;

    }


    .job-rich-content h1,
    .job-rich-content h2,
    .job-rich-content h3,
    .job-rich-content h4,
    .job-rich-content h5 {

        margin:

            25px 0 12px;

        color: var(--job-heading);

        font-weight: 750;

    }


    .job-rich-content img {

        max-width: 100%;

        height: auto;

        border-radius: 12px;

    }



    /*
    |--------------------------------------------------------------------------
    | CONTACT
    |--------------------------------------------------------------------------
    */

    .contact-box {

        display: flex;

        align-items: center;

        justify-content: space-between;

        gap: 20px;

        padding: 18px;

        border-radius: 16px;

        background:

            var(--job-background);

    }


    .contact-company {

        display: flex;

        align-items: center;

        gap: 13px;

    }


    .contact-company img {

        width: 48px;

        height: 48px;

        border:

            1px solid
            var(--job-border);

        border-radius: 12px;

        background: white;

        object-fit: cover;

    }


    .contact-company strong {

        display: block;

        color: var(--job-heading);

        font-size: 14px;

    }


    .contact-company span {

        display: block;

        margin-top: 3px;

        color: var(--job-muted);

        font-size: 12px;

    }


    .contact-email {

        display: inline-flex;

        align-items: center;

        gap: 8px;

        color: var(--job-primary);

        font-size: 13px;

        font-weight: 600;

        text-decoration: none;

    }



    /*
    |--------------------------------------------------------------------------
    | SIDEBAR
    |--------------------------------------------------------------------------
    */

    .job-sidebar {

        position: sticky;

        top: 25px;

    }


    .job-sidebar-card {

        padding: 25px;

        border:

            1px solid
            var(--job-border);

        border-radius: 22px;

        background: white;

        box-shadow:

            0 12px 40px
            rgba(16, 42, 67, .055);

    }


    .job-sidebar-card > h3 {

        margin-bottom: 22px;

        color: var(--job-heading);

        font-size: 19px;

        font-weight: 800;

    }


    .overview-item {

        display: flex;

        align-items: center;

        gap: 13px;

        padding: 14px 0;

        border-bottom:

            1px solid
            var(--job-border);

    }


    .overview-icon {

        display: grid;

        width: 42px;

        height: 42px;

        flex: 0 0 42px;

        place-items: center;

        border-radius: 12px;

        background:

            var(--job-background);

        color: var(--job-primary);

        font-size: 14px;

    }


    .overview-item span {

        display: block;

        margin-bottom: 3px;

        color: var(--job-muted);

        font-size: 11px;

    }


    .overview-item strong {

        display: block;

        color: var(--job-heading);

        font-size: 13px;

        font-weight: 700;

    }


    .overview-item .overview-salary {

        color: var(--job-green);

    }



    /*
    |--------------------------------------------------------------------------
    | DEADLINE SIDEBAR
    |--------------------------------------------------------------------------
    */

    .sidebar-deadline {

        display: flex;

        align-items: flex-start;

        gap: 10px;

        margin-top: 20px;

        padding: 14px;

        border-radius: 13px;

    }


    .sidebar-deadline-active {

        background: #f0fdf4;

        color: #15803d;

    }


    .sidebar-deadline-expired {

        background: #fef2f2;

        color: #dc2626;

    }


    .sidebar-deadline > i {

        margin-top: 3px;

    }


    .sidebar-deadline strong {

        display: block;

        margin-bottom: 3px;

        font-size: 13px;

    }


    .sidebar-deadline span {

        display: block;

        opacity: .75;

        font-size: 11px;

        line-height: 1.5;

    }



    /*
    |--------------------------------------------------------------------------
    | SIDEBAR ACTION
    |--------------------------------------------------------------------------
    */

    .sidebar-action {

        margin-top: 18px;

    }


    .sidebar-apply-btn,
    .sidebar-edit-btn,
    .sidebar-applied-btn,
    .sidebar-disabled-btn {

        display: flex;

        width: 100%;

        min-height: 50px;

        align-items: center;

        justify-content: center;

        gap: 9px;

        border: 0;

        border-radius: 13px;

        font-size: 14px;

        font-weight: 700;

    }


    .sidebar-apply-btn {

        background: var(--job-primary);

        color: white;

    }


    .sidebar-apply-btn:hover {

        background: var(--job-primary-dark);

        color: white;

    }


    .sidebar-edit-btn {

        background: var(--job-heading);

        color: white;

    }


    .sidebar-edit-btn:hover {

        background: var(--job-primary);

        color: white;

    }


    .sidebar-applied-btn {

        background: #dcfce7;

        color: #15803d;

    }


    .sidebar-disabled-btn {

        background: #eef2f6;

        color: #8292a2;

    }



    /*
    |--------------------------------------------------------------------------
    | SAFETY TIP
    |--------------------------------------------------------------------------
    */

    .job-tip-card {

        display: flex;

        gap: 13px;

        margin-top: 18px;

        padding: 18px;

        border:

            1px solid
            #dbeafe;

        border-radius: 16px;

        background: #eff6ff;

    }


    .job-tip-icon {

        display: grid;

        width: 37px;

        height: 37px;

        flex: 0 0 37px;

        place-items: center;

        border-radius: 10px;

        background: white;

        color: #2563eb;

    }


    .job-tip-card strong {

        display: block;

        margin-bottom: 5px;

        color: #1e3a5f;

        font-size: 12px;

    }


    .job-tip-card p {

        margin: 0;

        color: #526b83;

        font-size: 11px;

        line-height: 1.6;

    }



    /*
    |--------------------------------------------------------------------------
    | BOTTOM CTA
    |--------------------------------------------------------------------------
    */

    .job-bottom-section {

        padding-bottom: 80px;

    }


    .job-bottom-card {

        display: flex;

        align-items: center;

        justify-content: space-between;

        gap: 30px;

        padding: 38px;

        border-radius: 26px;

        background:

            radial-gradient(
                circle at 90% 10%,
                rgba(255, 61, 87, .26),
                transparent 35%
            ),

            linear-gradient(
                135deg,
                #102a43,
                #193c5a
            );

        color: white;

    }


    .job-bottom-label {

        display: inline-flex;

        align-items: center;

        gap: 7px;

        margin-bottom: 8px;

        color: #ff8394;

        font-size: 12px;

        font-weight: 700;

    }


    .job-bottom-card h2 {

        max-width: 620px;

        margin-bottom: 8px;

        color: white;

        font-size:

            clamp(
                25px,
                4vw,
                36px
            );

        font-weight: 800;

    }


    .job-bottom-card p {

        max-width: 620px;

        margin: 0;

        color:

            rgba(255, 255, 255, .65);

        font-size: 14px;

    }


    .job-bottom-actions {

        display: flex;

        flex: 0 0 auto;

        gap: 10px;

    }


    .bottom-primary-btn,
    .bottom-secondary-btn {

        display: inline-flex;

        align-items: center;

        gap: 8px;

        padding: 12px 17px;

        border-radius: 12px;

        font-size: 13px;

        font-weight: 700;

    }


    .bottom-primary-btn {

        background: var(--job-primary);

        color: white;

    }


    .bottom-primary-btn:hover {

        background: var(--job-primary-dark);

        color: white;

    }


    .bottom-secondary-btn {

        border:

            1px solid
            rgba(255, 255, 255, .2);

        background:

            rgba(255, 255, 255, .08);

        color: white;

    }


    .bottom-secondary-btn:hover {

        background:

            rgba(255, 255, 255, .15);

        color: white;

    }



    /*
    |--------------------------------------------------------------------------
    | MODAL
    |--------------------------------------------------------------------------
    */

    .apply-modal-content {

        overflow: hidden;

        border: 0;

        border-radius: 24px;

        box-shadow:

            0 30px 80px
            rgba(16, 42, 67, .2);

    }


    .apply-modal-content .modal-body {

        position: relative;

        padding: 38px;

    }


    .apply-modal-close {

        position: absolute;

        top: 18px;

        right: 18px;

    }


    .apply-modal-icon {

        display: grid;

        width: 68px;

        height: 68px;

        margin:

            0 auto 18px;

        place-items: center;

        border-radius: 20px;

        background:

            rgba(255, 61, 87, .09);

        color: var(--job-primary);

        font-size: 23px;

    }


    .login-modal-icon {

        background: #eff6ff;

        color: #2563eb;

    }


    .apply-modal-label {

        display: block;

        margin-bottom: 5px;

        color: var(--job-primary);

        font-size: 11px;

        font-weight: 700;

        text-transform: uppercase;

        letter-spacing: .6px;

    }


    .apply-modal-content h3 {

        margin-bottom: 12px;

        color: var(--job-heading);

        font-size: 24px;

        font-weight: 800;

    }


    .apply-modal-content p {

        max-width: 400px;

        margin:

            0 auto 23px;

        color: var(--job-muted);

        font-size: 13px;

        line-height: 1.7;

    }


    .apply-modal-job {

        display: flex;

        max-width: 390px;

        align-items: center;

        gap: 12px;

        margin:

            0 auto 25px;

        padding: 14px;

        border-radius: 14px;

        background:

            var(--job-background);

        text-align: left;

    }


    .apply-modal-job img {

        width: 46px;

        height: 46px;

        border-radius: 11px;

        object-fit: cover;

        background: white;

    }


    .apply-modal-job strong {

        display: block;

        color: var(--job-heading);

        font-size: 13px;

    }


    .apply-modal-job span {

        display: block;

        margin-top: 3px;

        color: var(--job-muted);

        font-size: 11px;

    }


    .apply-modal-actions {

        display: flex;

        justify-content: center;

        gap: 10px;

    }


    .modal-cancel-btn,
    .modal-confirm-btn {

        display: inline-flex;

        min-width: 130px;

        align-items: center;

        justify-content: center;

        gap: 8px;

        padding: 11px 17px;

        border-radius: 11px;

        font-size: 13px;

        font-weight: 700;

    }


    .modal-cancel-btn {

        border:

            1px solid
            var(--job-border);

        background: white;

        color: var(--job-text);

    }


    .modal-confirm-btn {

        border: 0;

        background: var(--job-primary);

        color: white;

    }


    .modal-confirm-btn:hover {

        background: var(--job-primary-dark);

        color: white;

    }



    /*
    |--------------------------------------------------------------------------
    | TABLET
    |--------------------------------------------------------------------------
    */

    @media(max-width: 991px) {

        .job-cover {

            height: 280px;

        }


        .job-header-section {

            margin-top: -55px;

        }


        .job-title-section {

            align-items: flex-start;

            flex-direction: column;

        }


        .job-header-action {

            width: 100%;

        }


        .job-header-action .btn {

            width: 100%;

        }


        .job-sidebar {

            position: static;

        }


        .job-bottom-card {

            align-items: flex-start;

            flex-direction: column;

        }

    }



    /*
    |--------------------------------------------------------------------------
    | MOBILE
    |--------------------------------------------------------------------------
    */

    @media(max-width: 767px) {

        .job-cover-section {

            padding-top: 20px;

        }


        .job-cover {

            height: 210px;

            border-radius: 22px;

        }


        .job-header-section {

            margin-top: -35px;

        }


        .job-header-card {

            padding: 22px;

            border-radius: 21px;

        }


        .job-company-header {

            align-items: flex-start;

        }


        .job-company-logo {

            width: 68px;

            height: 68px;

            border-radius: 17px;

        }


        .company-name-row h2 {

            font-size: 19px;

        }


        .company-meta {

            gap: 7px;

            flex-direction: column;

        }


        .job-main-title {

            font-size: 31px;

            letter-spacing: -1px;

        }


        .job-quick-meta {

            gap: 9px;

            flex-direction: column;

        }


        .job-main-section {

            padding:

                30px 0 60px;

        }


        .job-content-card {

            padding: 22px;

            border-radius: 18px;

        }


        .content-heading {

            align-items: flex-start;

        }


        .content-heading h2 {

            font-size: 20px;

        }


        .contact-box {

            align-items: flex-start;

            flex-direction: column;

        }


        .job-bottom-card {

            padding: 28px 22px;

        }


        .job-bottom-actions {

            width: 100%;

            flex-direction: column;

        }


        .job-bottom-actions .btn {

            width: 100%;

            justify-content: center;

        }


        .apply-modal-content .modal-body {

            padding:

                35px 22px 25px;

        }


        .apply-modal-actions {

            flex-direction: column-reverse;

        }


        .apply-modal-actions .btn {

            width: 100%;

        }

    }



    /*
    |--------------------------------------------------------------------------
    | SMALL MOBILE
    |--------------------------------------------------------------------------
    */

    @media(max-width: 480px) {

        .job-company-header {

            gap: 13px;

        }


        .job-company-logo {

            width: 60px;

            height: 60px;

        }


        .premium-badge {

            display: none;

        }


        .job-main-title {

            font-size: 28px;

        }

    }

</style>

@endpush