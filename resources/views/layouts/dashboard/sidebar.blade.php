{{-- ================= JOB SEARCH SIDEBAR ================= --}}

<ul class="navbar-nav bg-gradient-danger sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- ================= LOGO ================= -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('homepage')}}">
        <div class="sidebar-brand-icon">
            <i class="fas fa-briefcase fa-lg"></i>
        </div>
        <div class="sidebar-brand-text mx-2">JOB SEARCH</div>
    </a>

    <hr class="sidebar-divider my-0">

    <!-- ================= DASHBOARD ================= -->
    <li class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="{{route('dashboard')}}">
            <i class="fas fa-chart-line"></i>
            <span>Bảng Điều Khiển</span>
        </a>
    </li>

    <hr class="sidebar-divider">

    {{-- ================= EMPLOYER MENU ================= --}}
    @if(auth()->user()->user_type == 'employer')

    <div class="sidebar-heading">
        Công Cụ Tuyển Dụng
    </div>

    <li class="nav-item">
        <a class="nav-link" href="{{route('job.create')}}">
            <i class="fas fa-plus-circle"></i>
            <span>Đăng Tin Tuyển Dụng</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{route('job.index')}}">
            <i class="fas fa-folder-open"></i>
            <span>Quản Lý Bài Đăng</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{route('applicants.index')}}">
            <i class="fas fa-users"></i>
            <span>Quản Lý Ứng Viên</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{route('suggest.index')}}">
            <i class="fas fa-robot"></i>
            <span>Trợ Lý AI Tuyển Dụng</span>
        </a>
    </li>

    @endif


    {{-- ================= EMPLOYEE MENU ================= --}}
    @if(auth()->user()->user_type == 'employee')

    <div class="sidebar-heading">
        Công Cụ Cá Nhân
    </div>

    <li class="nav-item">
        <a class="nav-link" href="{{route('user.cv')}}">
            <i class="fas fa-file-alt"></i>
            <span>CV Của Bạn</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{route('create.cv')}}">
            <i class="fas fa-pen-nib"></i>
            <span>Tạo CV Online</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{route('suggest.index')}}">
            <i class="fas fa-robot"></i>
            <span>Trợ Lý AI</span>
        </a>
    </li>

    @endif


    <hr class="sidebar-divider">

    <!-- ================= TRANG CHỦ WEBSITE ================= -->
    <li class="nav-item">
        <a class="nav-link" href="{{route('homepage')}}">
            <i class="fas fa-home"></i>
            <span>Về Trang Chủ</span>
        </a>
    </li>

</ul>


{{-- ================= FONT AWESOME ================= --}}
<script src="https://kit.fontawesome.com/5f924928fd.js" crossorigin="anonymous"></script>