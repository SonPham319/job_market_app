@extends('layouts.app')
@section('title', 'Giới thiệu - JOB SEARCH')

@section('content')

<div class="container py-5">

```
<!-- HERO -->
<div class="text-center mb-5">
    <h1 class="fw-bold display-5">JOB SEARCH</h1>
    <p class="lead text-muted">
        Nền tảng kết nối <strong>ứng viên</strong> và <strong>nhà tuyển dụng</strong> nhanh chóng,
        thông minh và hiệu quả.
    </p>
</div>

<!-- GIỚI THIỆU -->
<div class="row justify-content-center mb-5">
    <div class="col-md-9 text-center">
        <p class="fs-5 text-muted">
            <strong>JOB SEARCH</strong> không chỉ là một website tìm việc.
            Chúng tôi xây dựng một hệ sinh thái giúp ứng viên và doanh nghiệp
            kết nối nhanh chóng, chính xác và hiệu quả trong thời đại số.
        </p>
    </div>
</div>

<!-- FEATURES -->
<div class="row g-4 mb-5">

    <!-- Feature 1 -->
    <div class="col-md-4">
        <div class="card shadow border-0 h-100 text-center p-3 hover-card">
            <div class="card-body">
                <i class="fa-solid fa-id-card fa-3x text-primary mb-3"></i>
                <h5 class="fw-bold">Tạo CV Chuyên Nghiệp</h5>
                <p class="text-muted">
                    Thiết kế CV ấn tượng, thể hiện rõ năng lực và kinh nghiệm
                    để gây ấn tượng với nhà tuyển dụng.
                </p>
            </div>
        </div>
    </div>

    <!-- Feature 2 -->
    <div class="col-md-4">
        <div class="card shadow border-0 h-100 text-center p-3 hover-card">
            <div class="card-body">
                <i class="fa-solid fa-magnifying-glass fa-3x text-success mb-3"></i>
                <h5 class="fw-bold">Tìm Việc Thông Minh</h5>
                <p class="text-muted">
                    Hệ thống tìm kiếm mạnh mẽ giúp bạn lọc công việc
                    theo kỹ năng, vị trí và địa điểm mong muốn.
                </p>
            </div>
        </div>
    </div>

    <!-- Feature 3 -->
    <div class="col-md-4">
        <div class="card shadow border-0 h-100 text-center p-3 hover-card">
            <div class="card-body">
                <i class="fa-solid fa-robot fa-3x text-danger mb-3"></i>
                <h5 class="fw-bold">Trợ Lý AI</h5>
                <p class="text-muted">
                    AI hỗ trợ tối ưu CV, gợi ý công việc phù hợp
                    và đồng hành cùng bạn trên hành trình sự nghiệp.
                </p>
            </div>
        </div>
    </div>

</div>

<!-- THỐNG KÊ -->
<div class="row text-center mb-5">

    <div class="col-md-4">
        <h2 class="fw-bold text-primary">1000+</h2>
        <p class="text-muted">Công Việc Được Đăng</p>
    </div>

    <div class="col-md-4">
        <h2 class="fw-bold text-success">500+</h2>
        <p class="text-muted">Doanh Nghiệp</p>
    </div>

    <div class="col-md-4">
        <h2 class="fw-bold text-danger">3000+</h2>
        <p class="text-muted">Ứng Viên</p>
    </div>

</div>

<!-- SỨ MỆNH -->
<div class="row justify-content-center text-center mb-5">
    <div class="col-md-8">
        <h4 class="fw-bold mb-3">Sứ Mệnh Của Chúng Tôi</h4>
        <p class="text-muted">
            Chúng tôi cam kết xây dựng một môi trường trực tuyến minh bạch,
            đáng tin cậy và hiệu quả – nơi ứng viên tìm được công việc mơ ước
            và doanh nghiệp tìm được nhân tài phù hợp.
        </p>
    </div>
</div>

<!-- CTA -->
<div class="text-center">
    <a href="{{ route('homepage') }}" class="btn btn-primary btn-lg me-2">
        Tìm Việc Ngay
    </a>

    <a href="{{ route('createjob') }}" class="btn btn-outline-dark btn-lg">
        Đăng Tuyển Dụng
    </a>
</div>
```

</div>

<style>

.hover-card{
    transition: all 0.3s ease;
}

.hover-card:hover{
    transform: translateY(-10px);
    box-shadow: 0 10px 30px rgba(0,0,0,0.15);
}

</style>

@endsection
