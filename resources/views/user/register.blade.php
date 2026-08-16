@extends('layouts.app')

@section('title', 'Chọn loại tài khoản - JOB SEARCH')

@section('content')

<div class="register-choice-page">

    <div class="container">

        {{-- HEADER --}}
        <div class="register-choice-header text-center">

            <span class="register-choice-badge">
                <i class="fa-solid fa-user-plus"></i>
                Bắt đầu với JOB SEARCH
            </span>

            <h1>
                Bạn muốn sử dụng JOB SEARCH với vai trò nào?
            </h1>

            <p>
                Chọn loại tài khoản phù hợp để bắt đầu sử dụng hệ thống.
            </p>

        </div>


        {{-- ROLE CARDS --}}
        <div class="row g-4 justify-content-center">

            {{-- =========================
                EMPLOYEE
            ========================== --}}
            <div class="col-lg-5 col-md-6">

                <div class="role-card employee-card">

                    <div class="role-icon employee-icon">
                        <i class="fa-solid fa-user-tie"></i>
                    </div>

                    <span class="role-label">
                        Dành cho ứng viên
                    </span>

                    <h2>
                        Tôi đang tìm việc
                    </h2>

                    <p class="role-description">
                        Tạo hồ sơ cá nhân, quản lý CV và ứng tuyển
                        vào những công việc phù hợp với bạn.
                    </p>


                    <div class="role-features">

                        <div class="role-feature">
                            <i class="fa-solid fa-circle-check"></i>
                            <span>Tìm kiếm việc làm theo nhu cầu</span>
                        </div>

                        <div class="role-feature">
                            <i class="fa-solid fa-circle-check"></i>
                            <span>Tạo và quản lý CV trực tuyến</span>
                        </div>

                        <div class="role-feature">
                            <i class="fa-solid fa-circle-check"></i>
                            <span>Ứng tuyển trực tiếp trên hệ thống</span>
                        </div>

                        <div class="role-feature">
                            <i class="fa-solid fa-circle-check"></i>
                            <span>Nhận gợi ý việc làm bằng AI</span>
                        </div>

                    </div>


                    <a
                        href="{{ route('create.employee') }}"
                        class="btn role-button employee-button"
                    >
                        Đăng ký ứng viên

                        <i class="fa-solid fa-arrow-right"></i>
                    </a>

                </div>

            </div>


            {{-- =========================
                EMPLOYER
            ========================== --}}
            <div class="col-lg-5 col-md-6">

                <div class="role-card employer-card">

                    <div class="recommended-label">
                        Dành cho doanh nghiệp
                    </div>

                    <div class="role-icon employer-icon">
                        <i class="fa-solid fa-building"></i>
                    </div>

                    <span class="role-label employer-role-label">
                        Dành cho nhà tuyển dụng
                    </span>

                    <h2>
                        Tôi muốn tuyển người
                    </h2>

                    <p class="role-description">
                        Đăng tin tuyển dụng, quản lý ứng viên
                        và tìm kiếm những nhân sự phù hợp cho doanh nghiệp.
                    </p>


                    <div class="role-features">

                        <div class="role-feature">
                            <i class="fa-solid fa-circle-check"></i>
                            <span>Đăng và quản lý tin tuyển dụng</span>
                        </div>

                        <div class="role-feature">
                            <i class="fa-solid fa-circle-check"></i>
                            <span>Xem danh sách ứng viên</span>
                        </div>

                        <div class="role-feature">
                            <i class="fa-solid fa-circle-check"></i>
                            <span>Xem và tải CV ứng viên</span>
                        </div>

                        <div class="role-feature">
                            <i class="fa-solid fa-circle-check"></i>
                            <span>Matching ứng viên phù hợp</span>
                        </div>

                    </div>


                    <a
                        href="{{ route('create.employer') }}"
                        class="btn role-button employer-button"
                    >
                        Đăng ký nhà tuyển dụng

                        <i class="fa-solid fa-arrow-right"></i>
                    </a>

                </div>

            </div>

        </div>


        {{-- LOGIN --}}
        <div class="register-login text-center">

            <span>
                Bạn đã có tài khoản?
            </span>

            <a href="{{ route('login') }}">
                Đăng nhập ngay
            </a>

        </div>

    </div>

</div>

@endsection


@push('styles')

<style>

    :root {
        --register-primary: #ff3d57;
        --register-primary-dark: #e62c47;

        --register-heading: #102a43;

        --register-text: #52606d;

        --register-muted: #8292a2;

        --register-border: #e7ecf2;

        --register-background: #f6f8fb;
    }


    /*
    |--------------------------------------------------------------------------
    | PAGE
    |--------------------------------------------------------------------------
    */

    .register-choice-page {

        min-height: calc(100vh - 80px);

        padding: 70px 0;

        background:

            radial-gradient(
                circle at 10% 10%,
                rgba(255, 61, 87, .08),
                transparent 28%
            ),

            radial-gradient(
                circle at 90% 90%,
                rgba(59, 130, 246, .08),
                transparent 30%
            ),

            #f8fafc;

    }


    /*
    |--------------------------------------------------------------------------
    | HEADER
    |--------------------------------------------------------------------------
    */

    .register-choice-header {

        max-width: 760px;

        margin: 0 auto 48px;

    }


    .register-choice-badge {

        display: inline-flex;

        align-items: center;

        gap: 8px;

        margin-bottom: 16px;

        padding: 8px 14px;

        border-radius: 999px;

        background:
            rgba(255, 61, 87, .08);

        color:
            var(--register-primary);

        font-size: 13px;

        font-weight: 700;

    }


    .register-choice-header h1 {

        margin-bottom: 16px;

        color:
            var(--register-heading);

        font-size:
            clamp(36px, 5vw, 55px);

        font-weight: 850;

        line-height: 1.1;

        letter-spacing: -2px;

    }


    .register-choice-header p {

        margin: 0;

        color:
            var(--register-muted);

        font-size: 16px;

        line-height: 1.7;

    }



    /*
    |--------------------------------------------------------------------------
    | ROLE CARD
    |--------------------------------------------------------------------------
    */

    .role-card {

        position: relative;

        display: flex;

        height: 100%;

        min-height: 590px;

        flex-direction: column;

        padding: 36px;

        overflow: hidden;

        border:
            1px solid
            var(--register-border);

        border-radius: 28px;

        background: white;

        box-shadow:

            0 20px 60px
            rgba(16, 42, 67, .07);

        transition:
            transform .25s,
            box-shadow .25s,
            border-color .25s;

    }


    .role-card:hover {

        transform:
            translateY(-7px);

        box-shadow:

            0 30px 70px
            rgba(16, 42, 67, .12);

    }



    /*
    |--------------------------------------------------------------------------
    | EMPLOYEE
    |--------------------------------------------------------------------------
    */

    .employee-card:hover {

        border-color:
            rgba(255, 61, 87, .28);

    }


    .employee-icon {

        color:
            var(--register-primary);

        background:
            rgba(255, 61, 87, .09);

    }



    /*
    |--------------------------------------------------------------------------
    | EMPLOYER
    |--------------------------------------------------------------------------
    */

    .employer-card {

        border-color:
            rgba(37, 99, 235, .16);

        background:

            linear-gradient(
                180deg,
                #ffffff 0%,
                #f9fbff 100%
            );

    }


    .employer-card:hover {

        border-color:
            rgba(37, 99, 235, .35);

    }


    .employer-icon {

        color: #2563eb;

        background:
            rgba(37, 99, 235, .09);

    }


    .employer-role-label {

        color: #2563eb !important;

    }


    .recommended-label {

        position: absolute;

        top: 22px;

        right: 22px;

        padding: 6px 10px;

        border-radius: 999px;

        background: #eff6ff;

        color: #2563eb;

        font-size: 10px;

        font-weight: 800;

        text-transform: uppercase;

        letter-spacing: .5px;

    }



    /*
    |--------------------------------------------------------------------------
    | ICON
    |--------------------------------------------------------------------------
    */

    .role-icon {

        display: grid;

        width: 62px;

        height: 62px;

        margin-bottom: 25px;

        place-items: center;

        border-radius: 18px;

        font-size: 23px;

    }



    /*
    |--------------------------------------------------------------------------
    | TEXT
    |--------------------------------------------------------------------------
    */

    .role-label {

        display: block;

        margin-bottom: 8px;

        color:
            var(--register-primary);

        font-size: 12px;

        font-weight: 800;

        text-transform: uppercase;

        letter-spacing: .7px;

    }


    .role-card h2 {

        margin-bottom: 14px;

        color:
            var(--register-heading);

        font-size: 30px;

        font-weight: 850;

        letter-spacing: -1px;

    }


    .role-description {

        margin-bottom: 28px;

        color:
            var(--register-text);

        font-size: 14px;

        line-height: 1.75;

    }



    /*
    |--------------------------------------------------------------------------
    | FEATURES
    |--------------------------------------------------------------------------
    */

    .role-features {

        display: grid;

        gap: 15px;

        margin-bottom: 35px;

    }


    .role-feature {

        display: flex;

        align-items: center;

        gap: 11px;

        color:
            var(--register-text);

        font-size: 13px;

    }


    .role-feature i {

        flex: 0 0 auto;

        color: #16a34a;

        font-size: 14px;

    }



    /*
    |--------------------------------------------------------------------------
    | BUTTONS
    |--------------------------------------------------------------------------
    */

    .role-button {

        display: flex;

        min-height: 52px;

        align-items: center;

        justify-content: space-between;

        gap: 10px;

        margin-top: auto;

        padding: 0 20px;

        border: 0;

        border-radius: 14px;

        font-size: 14px;

        font-weight: 750;

        transition: .2s;

    }


    .employee-button {

        background:
            var(--register-primary);

        color: white;

        box-shadow:

            0 12px 25px
            rgba(255, 61, 87, .18);

    }


    .employee-button:hover {

        background:
            var(--register-primary-dark);

        color: white;

        transform:
            translateY(-2px);

    }


    .employer-button {

        background: #102a43;

        color: white;

        box-shadow:

            0 12px 25px
            rgba(16, 42, 67, .15);

    }


    .employer-button:hover {

        background: #2563eb;

        color: white;

        transform:
            translateY(-2px);

    }



    /*
    |--------------------------------------------------------------------------
    | LOGIN
    |--------------------------------------------------------------------------
    */

    .register-login {

        margin-top: 35px;

        color:
            var(--register-muted);

        font-size: 14px;

    }


    .register-login a {

        margin-left: 4px;

        color:
            var(--register-heading);

        font-weight: 700;

        text-decoration: none;

    }


    .register-login a:hover {

        color:
            var(--register-primary);

    }



    /*
    |--------------------------------------------------------------------------
    | TABLET
    |--------------------------------------------------------------------------
    */

    @media(max-width: 991px) {

        .register-choice-page {

            padding: 50px 0;

        }


        .role-card {

            min-height: 550px;

            padding: 30px;

        }

    }



    /*
    |--------------------------------------------------------------------------
    | MOBILE
    |--------------------------------------------------------------------------
    */

    @media(max-width: 767px) {

        .register-choice-page {

            padding: 35px 0;

        }


        .register-choice-header {

            margin-bottom: 32px;

        }


        .register-choice-header h1 {

            font-size: 36px;

            letter-spacing: -1.5px;

        }


        .role-card {

            min-height: auto;

            padding: 28px 24px;

            border-radius: 22px;

        }


        .role-card h2 {

            font-size: 26px;

        }


        .recommended-label {

            top: 18px;

            right: 18px;

        }

    }

</style>

@endpush