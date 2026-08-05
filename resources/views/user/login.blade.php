@extends('layouts.app')

@section('content')

{{-- Thông báo lỗi --}}
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
                        <h2 class="fw-bold mb-1">Đăng Nhập Job Search</h2>
                        <p class="text-muted mb-0">Chào mừng bạn quay trở lại</p>
                    </div>

                    <form action="{{ route('login.post') }}" method="POST">
                        @csrf

                        {{-- Email --}}
                        <div class="mb-3">
                            <label for="email" class="form-label fw-semibold">Email</label>
                            <input 
                                type="email" 
                                name="email" 
                                id="email" 
                                class="form-control shadow-none @error('email') is-invalid @enderror" 
                                placeholder="Nhập email của bạn"
                                value="{{ old('email') }}"
                                style="border-radius: 15px; height: 45px;"
                            >
                            @error('email')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Password --}}
                        <div class="mb-3">
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

                        {{-- Button --}}
                        <div class="d-grid mb-3">
                            <button type="submit" class="btn btn-primary fw-bold" style="border-radius: 15px; height: 45px;">
                                Đăng Nhập
                            </button>
                        </div>

                        {{-- Link đăng ký --}}
                        <div class="text-center">
                            <small>Bạn chưa có tài khoản? 
                                <a href="{{ route('register') }}" class="text-decoration-none fw-semibold">Đăng ký ngay</a>
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