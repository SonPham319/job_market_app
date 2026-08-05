<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

    <!-- Toggle Sidebar -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>

    <!-- JOB SEARCH -->
    <div class="d-flex align-items-center mr-4">
        <i class="fas fa-briefcase text-danger mr-2"></i>
        <span class="font-weight-bold text-dark">JOB SEARCH</span>
    </div>

    <!-- Search Job -->
    <form action="{{route('homepage')}}" method="GET"
        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 navbar-search">

        <div class="input-group">
            <input type="text"
                   name="search"
                   class="form-control bg-light border-0 small"
                   placeholder="Tìm kiếm việc làm..."
                   aria-label="Search">

            <div class="input-group-append">
                <button class="btn btn-danger" type="submit">
                    <i class="fas fa-search fa-sm"></i>
                </button>
            </div>
        </div>
    </form>


    <!-- Right Menu -->
    <ul class="navbar-nav ml-auto">

        <!-- Notifications -->
        <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown"
               role="button" data-toggle="dropdown">

                <i class="fas fa-bell fa-fw"></i>
                <span class="badge badge-danger badge-counter">3+</span>

            </a>

            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in">

                <h6 class="dropdown-header">
                    Thông báo
                </h6>

                <a class="dropdown-item d-flex align-items-center" href="#">
                    <div class="mr-3">
                        <div class="icon-circle bg-primary">
                            <i class="fas fa-file-alt text-white"></i>
                        </div>
                    </div>
                    <div>
                        <div class="small text-gray-500">Hôm nay</div>
                        Có ứng viên mới ứng tuyển
                    </div>
                </a>

                <a class="dropdown-item text-center small text-gray-500" href="#">
                    Xem tất cả
                </a>

            </div>
        </li>


        <div class="topbar-divider d-none d-sm-block"></div>


        <!-- User -->
        <li class="nav-item dropdown no-arrow">

            <a class="nav-link dropdown-toggle" href="#" id="userDropdown"
               role="button" data-toggle="dropdown">

                <span class="mr-2 d-none d-lg-inline text-gray-600 small">

                    {{auth()->user()->name}}

                </span>

                @if(auth()->user()->profile_pic)

                    <img class="img-profile rounded-circle"
                         src="{{asset('storage/'.auth()->user()->profile_pic)}}">

                @else

                    <img class="img-profile rounded-circle"
                         src="{{asset('img/undraw_profile.svg')}}">

                @endif

            </a>


            <!-- Dropdown -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in">

                <a class="dropdown-item" href="{{route('user.profile')}}">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    Hồ sơ cá nhân
                </a>

                <a class="dropdown-item" href="{{route('dashboard')}}">
                    <i class="fas fa-chart-line fa-sm fa-fw mr-2 text-gray-400"></i>
                    Dashboard
                </a>

                @if(auth()->user()->user_type === 'employer')

                <a class="dropdown-item" href="{{route('subscribe')}}">
                    <i class="fas fa-rocket fa-sm fa-fw mr-2 text-gray-400"></i>
                    Nâng cấp gói
                </a>

                @endif

                <div class="dropdown-divider"></div>

                <form action="{{route('logout')}}" method="POST">
                    @csrf
                    <button type="submit" class="dropdown-item">

                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>

                        Đăng Xuất

                    </button>
                </form>

            </div>

        </li>

    </ul>

</nav>


<script src="https://kit.fontawesome.com/5f924928fd.js" crossorigin="anonymous"></script>