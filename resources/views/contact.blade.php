@extends('layouts.app')
@section('title', 'Liên hệ - JOB SEARCH')
@section('content')
<div class="container py-5">

    <div class="text-center mb-5">
        <h1 class="fw-bold">Liên Hệ Với JOB SEARCH</h1>
        <p class="text-muted">Chúng tôi luôn sẵn sàng hỗ trợ bạn</p>
    </div>

    <div class="row g-4">

        <!-- Thông tin liên hệ -->
        <div class="col-md-5">
            <div class="card shadow-sm h-100 border-0">
                <div class="card-body p-4">

                    <h5 class="fw-bold mb-4">Thông Tin Liên Hệ</h5>

                    <p>
                        <i class="fa-solid fa-envelope text-primary me-2"></i>
                        info@jobsearch.vn
                    </p>

                    <p>
                        <i class="fa-solid fa-phone text-success me-2"></i>
                        (+84) 123 456 789
                    </p>

                    <p>
                        <i class="fa-solid fa-location-dot text-danger me-2"></i>
                        Hai Phong
                    </p>

                    <hr>

                    <h6 class="fw-bold mt-4">Kết Nối Mạng Xã Hội</h6>

                    <div class="d-flex gap-3 mt-3">
                        <a href="#" class="text-primary fs-4">
                            <i class="fa-brands fa-facebook"></i>
                        </a>
                        <a href="#" class="text-dark fs-4">
                            <i class="fa-brands fa-github"></i>
                        </a>
                        <a href="#" class="text-danger fs-4">
                            <i class="fa-brands fa-youtube"></i>
                        </a>
                    </div>

                </div>
            </div>
        </div>

        <!-- Form liên hệ -->
        <div class="col-md-7">
            <div class="card shadow-sm border-0">
                <div class="card-body p-4">

                    <h5 class="fw-bold mb-4">Gửi Tin Nhắn Cho Chúng Tôi</h5>

                    <form>

                        <div class="mb-3">
                            <label class="form-label">Họ và tên</label>
                            <input type="text" class="form-control" placeholder="Nhập họ tên">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" placeholder="Nhập email">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Nội dung</label>
                            <textarea class="form-control" rows="4" placeholder="Nhập nội dung"></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary rounded-pill px-4">
                            <i class="fa-solid fa-paper-plane me-2"></i>
                            Gửi Tin Nhắn
                        </button>

                    </form>

                </div>
            </div>
        </div>

    </div>

</div>
@endsection