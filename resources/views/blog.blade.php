@extends('layouts.app')
@section('title', 'Blog - JOB SEARCH')

@section('content')
<div class="container py-5">

    <!-- Title -->
    <div class="text-center mb-5">
        <h1 class="fw-bold">Tin Tức & Blog Nghề Nghiệp</h1>
        <p class="text-muted">
            Cập nhật xu hướng tuyển dụng và kỹ năng nghề nghiệp mới nhất
        </p>
    </div>

    <!-- Search -->
    <div class="row justify-content-center mb-4">
        <div class="col-md-6">
            <input type="text" class="form-control form-control-lg"
            placeholder="🔎 Tìm kiếm bài viết...">
        </div>
    </div>

    <!-- Categories -->
    <div class="text-center mb-5">

        <span class="badge bg-primary p-2 px-3">CV</span>

        <span class="badge bg-success p-2 px-3">Phỏng vấn</span>

        <span class="badge bg-warning text-dark p-2 px-3">Kỹ năng</span>

        <span class="badge bg-danger p-2 px-3">Xu hướng</span>

    </div>


    <!-- Blog list -->
    <div class="row">

        <!-- Blog 1 -->
        <div class="col-md-4 mb-4">
            <div class="card blog-card h-100">

                <img src="https://source.unsplash.com/600x400/?office"
                class="card-img-top">

                <div class="card-body">

                    <h5 class="card-title fw-bold">
                        Cách Viết CV Ấn Tượng
                    </h5>

                    <p class="text-muted small">
                        <i class="fa-solid fa-calendar"></i> 10/03/2026
                        &nbsp;
                        <i class="fa-solid fa-user"></i> Admin
                    </p>

                    <p class="card-text text-muted">
                        Bí quyết giúp CV của bạn nổi bật trước nhà tuyển dụng
                        và tăng cơ hội được gọi phỏng vấn.
                    </p>

                    <a href="#" class="btn btn-danger w-100">
                        Đọc thêm
                    </a>

                </div>
            </div>
        </div>


        <!-- Blog 2 -->
        <div class="col-md-4 mb-4">
            <div class="card blog-card h-100">

                <img src="https://source.unsplash.com/600x400/?job-interview"
                class="card-img-top">

                <div class="card-body">

                    <h5 class="card-title fw-bold">
                        Phỏng Vấn Thành Công
                    </h5>

                    <p class="text-muted small">
                        <i class="fa-solid fa-calendar"></i> 08/03/2026
                        &nbsp;
                        <i class="fa-solid fa-user"></i> HR Expert
                    </p>

                    <p class="card-text text-muted">
                        Những câu hỏi phỏng vấn thường gặp và cách trả lời
                        thông minh giúp bạn ghi điểm với nhà tuyển dụng.
                    </p>

                    <a href="#" class="btn btn-danger w-100">
                        Đọc thêm
                    </a>

                </div>
            </div>
        </div>


        <!-- Blog 3 -->
        <div class="col-md-4 mb-4">
            <div class="card blog-card h-100">

                <img src="https://source.unsplash.com/600x400/?career"
                class="card-img-top">

                <div class="card-body">

                    <h5 class="card-title fw-bold">
                        Xu Hướng Tuyển Dụng 2026
                    </h5>

                    <p class="text-muted small">
                        <i class="fa-solid fa-calendar"></i> 05/03/2026
                        &nbsp;
                        <i class="fa-solid fa-user"></i> Career Team
                    </p>

                    <p class="card-text text-muted">
                        Những ngành nghề được dự đoán sẽ phát triển mạnh
                        trong năm 2026.
                    </p>

                    <a href="#" class="btn btn-danger w-100">
                        Đọc thêm
                    </a>

                </div>
            </div>
        </div>

    </div>

</div>


<style>

.blog-card{
border:none;
border-radius:12px;
overflow:hidden;
transition:0.3s;
}

.blog-card img{
height:220px;
object-fit:cover;
}

.blog-card:hover{
transform:translateY(-8px);
box-shadow:0 15px 35px rgba(0,0,0,0.2);
}

.badge{
font-size:14px;
cursor:pointer;
}

</style>

@endsection