@extends('layouts.app')

@section('content')

@if(session()->has('error'))
    <div class="alert alert-danger alert-dismissible fade show m-0" role="alert">
        {{ session()->get('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="container mt-5">
    <div class="row d-flex justify-content-center mt-5">
        <div class="col-md-5 col-lg-4">
            <div class="card shadow border-0" style="border-radius: 30px;">
                <div class="card-body p-4">

                    <div class="text-center mb-4">
                        <img src="{{ asset('image/logo-jobsearch.png') }}" alt="Job Search Logo" width="80" class="mb-3">
                        <h2 class="fw-bold mb-1">Đăng Ký Ứng Viên</h2>
                        <p class="text-muted mb-0">Tạo tài khoản Job Search để bắt đầu tìm việc</p>
                    </div>

                    <form action="{{ route('store.employee') }}" method="POST">
                        @csrf

                        {{-- Họ tên --}}
                        <div class="mb-3 position-relative">
                            <label for="name" class="form-label fw-semibold">Họ và tên</label>
                            <input 
                                type="text" 
                                name="name" 
                                id="name" 
                                class="form-control shadow-none @error('name') is-invalid @enderror"
                                placeholder="Nhập họ và tên"
                                style="border-radius: 15px; height: 45px;"
                                value="{{ old('name') }}"
                            >
                            @error('name')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Email --}}
                        <div class="mb-3 position-relative">
                            <label for="email" class="form-label fw-semibold">Email</label>
                            <input 
                                type="email" 
                                name="email" 
                                id="email" 
                                class="form-control shadow-none @error('email') is-invalid @enderror"
                                placeholder="Nhập email"
                                style="border-radius: 15px; height: 45px;"
                                value="{{ old('email') }}"
                            >
                            @error('email')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Mật khẩu --}}
                        <div class="mb-3 position-relative">
                            <label for="password" class="form-label fw-semibold">Mật khẩu</label>
                            <input 
                                type="password" 
                                name="password" 
                                id="password" 
                                class="form-control shadow-none @error('password') is-invalid @enderror"
                                placeholder="Nhập mật khẩu"
                                style="border-radius: 15px; height: 45px;"
                            >
                            @error('password')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Hiện mật khẩu --}}
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="showPassword" onclick="togglePassword()">
                            <label class="form-check-label" for="showPassword">Hiển thị mật khẩu</label>
                        </div>

                        {{-- Nút đăng ký --}}
                        <div class="d-grid mb-3">
                            <button type="submit" class="btn btn-primary fw-bold" style="border-radius: 15px; height: 45px;">
                                Đăng Ký
                            </button>
                        </div>

                        {{-- Link đăng nhập --}}
                        <div class="text-center">
                            <small>Đã có tài khoản? 
                                <a href="{{ route('login') }}" class="text-decoration-none fw-semibold">Đăng nhập ngay</a>
                            </small>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function togglePassword() {
        var passwordInput = document.getElementById("password");
        passwordInput.type = (passwordInput.type === "password") ? "text" : "password";
    }
</script>

@endsection