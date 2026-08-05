@extends('layouts.app')

@section('content')

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-5 col-lg-4">
            <div class="card border-0 shadow-lg" style="border-radius: 25px;">
                <div class="card-body p-4">

                    <div class="text-center mb-4">
                        <h2 class="fw-bold text-primary">Đăng ký Nhà Tuyển Dụng</h2>
                        <p class="text-muted mb-0">Tạo tài khoản để đăng tuyển và quản lý ứng viên</p>
                    </div>

                    {{-- Thông báo lỗi chung --}}
                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    {{-- Thông báo thành công --}}
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('store.employer') }}" method="POST">
                        @csrf

                        {{-- Tên công ty --}}
                        <div class="mb-3 position-relative">
                            <label for="name" class="form-label fw-semibold">Tên công ty</label>
                            <input 
                                type="text" 
                                name="name" 
                                id="name" 
                                class="form-control shadow-none @error('name') is-invalid @enderror" 
                                placeholder="Nhập tên công ty"
                                value="{{ old('name') }}"
                                style="border-radius: 15px;"
                            >
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message ?: 'Bạn chưa nhập tên công ty' }}
                                </div>
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
                                value="{{ old('email') }}"
                                style="border-radius: 15px;"
                            >
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message ?: 'Bạn chưa nhập email' }}
                                </div>
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
                                style="border-radius: 15px;"
                            >
                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message ?: 'Bạn chưa nhập mật khẩu' }}
                                </div>
                            @enderror
                        </div>

                        {{-- Hiển thị mật khẩu --}}
                        <div class="form-check mb-4">
                            <input class="form-check-input" type="checkbox" id="showPassword" onclick="togglePassword()">
                            <label class="form-check-label" for="showPassword">
                                Hiển thị mật khẩu
                            </label>
                        </div>

                        {{-- Nút đăng ký --}}
                        <div class="d-grid mb-3">
                            <button type="submit" class="btn btn-primary fw-semibold py-2" style="border-radius: 15px;">
                                Đăng Ký
                            </button>
                        </div>

                        {{-- Link đăng nhập --}}
                        <div class="text-center">
                            <small class="text-muted">
                                Đã có tài khoản?
                                <a href="{{ route('login') }}" class="text-decoration-none fw-semibold">Đăng nhập</a>
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
        var password = document.getElementById("password");
        password.type = password.type === "password" ? "text" : "password";
    }
</script>

@endsection