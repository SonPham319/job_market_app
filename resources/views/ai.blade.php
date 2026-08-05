<!DOCTYPE html>
<html lang="vi">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="JOB SEARCH - Trợ lý AI hỗ trợ tìm việc và tuyển dụng">
    <meta name="author" content="JOB SEARCH">
    <link rel="shortcut icon" href="{{ asset('img/logo.png') }}" type="image/x-icon">

    <title>Trợ lý AI - JOB SEARCH</title>

    <!-- Font Awesome -->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,600,700,800,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@600;700;800&display=swap" rel="stylesheet">

    <!-- Main CSS -->
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">

    <!-- Summernote -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background: #f8f9fc;
        }

        .ai-title {
            font-family: 'Inter', sans-serif;
            font-weight: 800;
            color: #0C3149;
        }

        .ai-card {
            border: none;
            border-radius: 24px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
            background: #fff;
        }

        .ai-input {
            border-radius: 18px !important;
            min-height: 58px;
            border: 1px solid #e5e7eb !important;
            padding-left: 18px !important;
            font-size: 15px;
        }

        .ai-input:focus {
            border-color: #dc3545 !important;
            box-shadow: 0 0 0 0.15rem rgba(220,53,69,.15) !important;
        }

        .ai-btn {
            border-radius: 18px;
            font-weight: 700;
            min-height: 58px;
            min-width: 150px;
        }

        .section-label {
            font-weight: 700;
            color: #0C3149;
            margin-bottom: 12px;
        }

        .result-box {
            background: #f8f9fc;
            border-left: 5px solid #dc3545;
            border-radius: 18px;
            padding: 24px;
            margin-top: 25px;
            line-height: 1.8;
            font-size: 15px;
            color: #333;
            box-shadow: 0 8px 25px rgba(0,0,0,0.04);
        }

        .page-subtitle {
            color: #6c757d;
            margin-top: -5px;
            margin-bottom: 30px;
        }
    </style>

</head>

<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    @include('layouts.dashboard.sidebar')
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            @include('layouts.dashboard.topbar')
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container py-4">

                <div class="mb-4">
                    <h1 class="ai-title mb-2">
                        <i class="fas fa-robot me-2"></i> Trợ Lý AI - JOB SEARCH
                    </h1>
                    <p class="page-subtitle">
                        Công cụ hỗ trợ tạo CV, email ứng tuyển, bài đăng tuyển dụng và nội dung thu hút ứng viên.
                    </p>
                </div>

                <div class="card ai-card p-4 p-md-5">

                    @if(auth()->user()->user_type == 'employee')

                        {{-- ỨNG VIÊN --}}
                        <form class="pt-2" action="{{ route('suggest') }}" method="post">
                            @csrf
                            <label for="cv-message" class="section-label">
                                <i class="fas fa-file-alt me-2 text-danger"></i>Gợi ý nội dung CV chuyên nghiệp
                            </label>
                            <div class="row g-3 align-items-center">
                                <div class="col-md-10">
                                    <input id="cv-message" type="text" name="cv" autocomplete="off"
                                           class="form-control ai-input shadow-sm"
                                           placeholder="Ví dụ: Nguyễn Văn A, sinh viên CNTT, biết Laravel, PHP, MySQL, thiết kế UI cơ bản, từng làm website tuyển dụng">
                                </div>
                                <div class="col-md-2 d-grid">
                                    <button class="btn btn-danger ai-btn" type="submit">
                                        <i class="fas fa-wand-magic-sparkles me-1"></i> Tạo Gợi Ý
                                    </button>
                                </div>
                            </div>
                        </form>

                        <form class="pt-4" action="{{ route('suggest') }}" method="post">
                            @csrf
                            <label for="mail-message" class="section-label">
                                <i class="fas fa-envelope me-2 text-danger"></i>Gợi ý email gửi nhà tuyển dụng
                            </label>
                            <div class="row g-3 align-items-center">
                                <div class="col-md-10">
                                    <input id="mail-message" type="text" name="mail" autocomplete="off"
                                           class="form-control ai-input shadow-sm"
                                           placeholder="Ví dụ: Tôi mong muốn ứng tuyển vị trí lập trình viên web và được trao cơ hội phỏng vấn tại công ty">
                                </div>
                                <div class="col-md-2 d-grid">
                                    <button class="btn btn-danger ai-btn" type="submit">
                                        <i class="fas fa-paper-plane me-1"></i> Tạo Gợi Ý
                                    </button>
                                </div>
                            </div>
                        </form>

                    @else

                        {{-- NHÀ TUYỂN DỤNG --}}
                        <form class="pt-2" action="{{ route('suggest') }}" method="post">
                            @csrf
                            <label for="post-message" class="section-label">
                                <i class="fas fa-briefcase me-2 text-danger"></i>Gợi ý nội dung bài đăng tuyển dụng
                            </label>
                            <div class="row g-3 align-items-center">
                                <div class="col-md-10">
                                    <input id="post-message" type="text" name="post" autocomplete="off"
                                           class="form-control ai-input shadow-sm"
                                           placeholder="Ví dụ: Tuyển dụng Frontend Developer có kinh nghiệm ReactJS, HTML, CSS, JavaScript, làm việc fulltime tại Hải Phòng">
                                </div>
                                <div class="col-md-2 d-grid">
                                    <button class="btn btn-danger ai-btn" type="submit">
                                        <i class="fas fa-wand-magic-sparkles me-1"></i> Tạo Gợi Ý
                                    </button>
                                </div>
                            </div>
                        </form>

                        <form class="pt-4" action="{{ route('suggest') }}" method="post">
                            @csrf
                            <label for="mail2-message" class="section-label">
                                <i class="fas fa-user-check me-2 text-danger"></i>Gợi ý email thu hút ứng viên
                            </label>
                            <div class="row g-3 align-items-center">
                                <div class="col-md-10">
                                    <input id="mail2-message" type="text" name="mail2" autocomplete="off"
                                           class="form-control ai-input shadow-sm"
                                           placeholder="Ví dụ: Chúng tôi rất ấn tượng với hồ sơ của bạn và mong muốn mời bạn tham gia phỏng vấn tại JOB SEARCH">
                                </div>
                                <div class="col-md-2 d-grid">
                                    <button class="btn btn-danger ai-btn" type="submit">
                                        <i class="fas fa-envelope-open-text me-1"></i> Tạo Gợi Ý
                                    </button>
                                </div>
                            </div>
                        </form>

                    @endif

                    {{-- KẾT QUẢ AI --}}
                    @if(!empty($fakeResult))
    <div class="result-box">
        <h5 class="fw-bold mb-3 text-danger">
            <i class="fas fa-lightbulb me-2"></i>Kết quả gợi ý từ AI
        </h5>
        <div>
            {!! $fakeResult !!}
        </div>
    </div>
@endif

                </div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        @include('layouts.dashboard.footer')
        <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="logoutModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content rounded-4 border-0 shadow">
            <div class="modal-header">
                <h5 class="modal-title" id="logoutModalLabel">Đăng xuất khỏi hệ thống?</h5>
                <button class="close border-0 bg-transparent" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                Bạn có chắc chắn muốn đăng xuất khỏi <strong>JOB SEARCH</strong> không?
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Hủy</button>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="btn btn-danger" type="submit">Đăng xuất</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- jQuery -->
<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>

<!-- Bootstrap core JavaScript -->
<script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<!-- Core plugin JavaScript -->
<script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

<!-- Custom scripts -->
<script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

<!-- Chart.js -->
<script src="{{ asset('vendor/chart.js/Chart.min.js') }}"></script>

<!-- Demo charts -->
<script src="{{ asset('js/demo/chart-area-demo.js') }}"></script>
<script src="{{ asset('js/demo/chart-pie-demo.js') }}"></script>

<!-- Summernote -->
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

<!-- Font Awesome Kit -->
<script src="https://kit.fontawesome.com/5f924928fd.js" crossorigin="anonymous"></script>

<script>
    $(document).ready(function () {
        $('#summernote').summernote();
    });
</script>

</body>
</html>