@extends('layouts.app')

@section('title', 'Trợ giúp - JOB SEARCH')

@section('content')

<div class="container py-5">

```
<div class="text-center mb-5">
    <h1 class="fw-bold">Trung Tâm Trợ Giúp</h1>
    <p class="text-muted">Hướng dẫn sử dụng hệ thống JOB SEARCH</p>
</div>

{{-- Search Help --}}
<div class="row justify-content-center mb-5">
    <div class="col-md-6">
        <input type="text" id="searchHelp" class="form-control form-control-lg"
            placeholder="🔎 Tìm kiếm trợ giúp...">
    </div>
</div>

{{-- Help Cards --}}
<div class="row g-4 help-section">

    <div class="col-md-6 help-item">
        <div class="card shadow-sm h-100">
            <div class="card-body">

                <h5 class="fw-bold">
                    <i class="fa-solid fa-file-lines text-primary me-2"></i>
                    Tạo Hồ Sơ CV
                </h5>

                <p class="text-muted">
                    Truy cập mục <b>Tạo CV</b>, chọn mẫu phù hợp và điền thông tin
                    cá nhân, kinh nghiệm và học vấn.
                </p>

            </div>
        </div>
    </div>

    <div class="col-md-6 help-item">
        <div class="card shadow-sm h-100">
            <div class="card-body">

                <h5 class="fw-bold">
                    <i class="fa-solid fa-briefcase text-success me-2"></i>
                    Tìm Việc Làm
                </h5>

                <p class="text-muted">
                    Sử dụng thanh tìm kiếm để lọc công việc theo từ khóa,
                    vị trí hoặc địa điểm mong muốn.
                </p>

            </div>
        </div>
    </div>

    <div class="col-md-6 help-item">
        <div class="card shadow-sm h-100">
            <div class="card-body">

                <h5 class="fw-bold">
                    <i class="fa-solid fa-user-tie text-warning me-2"></i>
                    Liên Hệ Nhà Tuyển Dụng
                </h5>

                <p class="text-muted">
                    Xem thông tin chi tiết bài đăng và liên hệ trực tiếp
                    với nhà tuyển dụng.
                </p>

            </div>
        </div>
    </div>

    <div class="col-md-6 help-item">
        <div class="card shadow-sm h-100">
            <div class="card-body">

                <h5 class="fw-bold">
                    <i class="fa-solid fa-robot text-danger me-2"></i>
                    Trợ Lý AI
                </h5>

                <p class="text-muted">
                    Sử dụng AI để tối ưu CV và nhận gợi ý công việc phù hợp.
                </p>

            </div>
        </div>
    </div>

</div>

<hr class="my-5">

{{-- FAQ Section --}}
<div class="mb-5">

    <h3 class="fw-bold text-center mb-4">Câu Hỏi Thường Gặp</h3>

    <div class="accordion" id="faq">

        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button" data-bs-toggle="collapse" data-bs-target="#faq1">
                    Làm sao để tạo CV?
                </button>
            </h2>

            <div id="faq1" class="accordion-collapse collapse show">
                <div class="accordion-body">
                    Bạn vào mục <b>Tạo CV</b>, nhập thông tin cá nhân và hệ thống sẽ
                    tạo CV tự động.
                </div>
            </div>
        </div>

        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#faq2">
                    Làm sao để ứng tuyển việc?
                </button>
            </h2>

            <div id="faq2" class="accordion-collapse collapse">
                <div class="accordion-body">
                    Sau khi tạo CV, bạn chỉ cần nhấn nút <b>Apply</b> trong
                    bài đăng tuyển dụng.
                </div>
            </div>
        </div>

    </div>

</div>

<hr class="my-5">

{{-- Quick Access --}}
<div class="text-center">

    <h4 class="fw-bold mb-4">Truy Cập Nhanh</h4>

    <div class="d-flex flex-wrap justify-content-center gap-3">

        <a href="{{route('dashboard')}}" class="btn btn-primary rounded-pill px-4">Dashboard</a>

        <a href="{{route('job.create')}}" class="btn btn-secondary rounded-pill px-4">Create Job</a>

        <a href="{{route('subscribe')}}" class="btn btn-danger rounded-pill px-4">Plan</a>

        <a href="{{route('user.profile')}}" class="btn btn-success rounded-pill px-4">Profile</a>

        <a href="{{route('create.cv')}}" class="btn btn-primary rounded-pill px-4">Tạo CV</a>

    </div>

</div>
```

</div>

{{-- Search Script --}}

<script>

document.getElementById("searchHelp").addEventListener("keyup", function(){

let value = this.value.toLowerCase();

document.querySelectorAll(".help-item").forEach(function(item){

item.style.display = item.innerText.toLowerCase().includes(value)
? "block"
: "none";

});

});

</script>

@endsection
