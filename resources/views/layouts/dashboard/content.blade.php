<style>
    #cv-container {
        transform-origin: 0 0;
        position: relative;
        transform: scale(1.9);
    }

    #cv-container > * {
        position: absolute;
        top: 0;
        left: 0;
    }

    #cv-wrapper {
        width: 100%;
    }
</style>

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Bảng Điều Khiển</h1>
    </div>

    {{-- Thông báo dùng thử --}}
    <div class="row justify-content-center">
        @if(auth()->user()->user_trial != null && auth()->user()->user_trial > now())
            <div class="col-md mb-4">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">Thông Báo</div>
                    <div class="card-body">
                        <p>Hạn đăng ký dùng thử của bạn còn <b>{{ now()->diffInDays(auth()->user()->user_trial) }}</b> ngày</p>
                        <p>Nếu bạn muốn tiếp tục sử dụng toàn bộ dịch vụ của <b>JOB SEARCH</b>, vui lòng đăng ký thành viên.</p>
                        <a href="{{ route('subscribe') }}" class="btn btn-success">Đăng Ký Thành Viên</a>
                    </div>
                </div>
            </div>
        @elseif(auth()->user()->user_trial != null && auth()->user()->user_trial < now())
            <div class="col-md mb-4">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">Thông Báo</div>
                    <div class="card-body">
                        <p>Hạn đăng ký dùng thử của bạn đã <b>hết hạn</b></p>
                        <p>Nếu bạn muốn tiếp tục sử dụng toàn bộ dịch vụ của <b>JOB SEARCH</b>, vui lòng đăng ký thành viên.</p>
                        <a href="{{ route('subscribe') }}" class="btn btn-success">Đăng Ký Thành Viên</a>
                    </div>
                </div>
            </div>
        @endif
    </div>

    @if(auth()->user()->user_type == "employer")

        <!-- Employer Dashboard -->
        <div class="row">

            <!-- Số bài đăng -->
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text font-weight-bold text-info text-uppercase mb-1">Số bài đăng</div>
                                <div class="row no-gutters align-items-center">
                                    <div class="col-11">
                                        <div class="h1 mb-0 mr-3 font-weight-bold text-gray-800">{{ $jobs->count() }}</div>
                                    </div>
                                    <div class="col-1 d-flex justify-content-end">
                                        <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Tổng số ứng viên -->
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text font-weight-bold text-info text-uppercase mb-1">Tổng Số Ứng Viên</div>
                                <div class="row no-gutters align-items-center">
                                    <div class="col-11">
                                        <div class="h1 mb-0 mr-3 font-weight-bold text-gray-800">{{ $listings->sum('users_count') }}</div>
                                    </div>
                                    <div class="col-1 d-flex justify-content-end">
                                        <i class="fas fa-users fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Ứng viên chờ duyệt -->
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-danger shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text font-weight-bold text-danger text-uppercase mb-1">Số Ứng Viên Đợi Duyệt</div>
                                <div class="row no-gutters align-items-center">
                                    <div class="col-11">
                                        <div class="h1 mb-0 mr-3 font-weight-bold text-gray-800">{{ $count }}</div>
                                    </div>
                                    <div class="col-1 d-flex justify-content-end">
                                        <i class="fas fa-user-clock fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Ứng viên đã duyệt -->
            <div class="col-md-12 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text font-weight-bold text-info text-uppercase mb-1">Số Ứng Viên Đã Duyệt</div>
                                <div class="row no-gutters align-items-center">
                                    <div class="col-11">
                                        <div class="h1 mb-0 mr-3 font-weight-bold text-gray-800">{{ $listings->sum('users_count') - $count }}</div>
                                    </div>
                                    <div class="col-1 d-flex justify-content-end">
                                        <i class="fas fa-user-check fa-2x text-gray-300"></i>
                                    </div>
                                    <div class="col-12">
                                        @if($listings->sum('users_count') != 0)
                                            <h4 class="small font-weight-bold">
                                                Tỉ Lệ
                                                <span class="float-right">
                                                    {{ round((($listings->sum('users_count') - $count) / $listings->sum('users_count')) * 100, 1) }}%
                                                </span>
                                            </h4>
                                            <div class="progress">
                                                <div class="progress-bar bg-info" role="progressbar"
                                                     style="width: {{ (($listings->sum('users_count') - $count) / $listings->sum('users_count')) * 100 }}%"
                                                     aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        @else
                                            <p>Bạn chưa có ứng viên nào</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @else

        <!-- Employee Dashboard -->
        <div class="row">

            <!-- Checklist hồ sơ -->
            <div class="col-md-12 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text font-weight-bold text-success text-uppercase mb-1">
                                    Công việc cần hoàn thành
                                </div>
                                <div class="row no-gutters align-items-center">
                                    <div class="col-11">
                                        @if($count2 == 4)
                                            <div class="h3 mb-0 mr-3 font-weight-bold text-gray-800">Tuyệt vời! Bạn đã hoàn thành mọi công việc</div>
                                        @else
                                            <div class="h1 mb-0 mr-3 font-weight-bold text-gray-800">{{ $count2 }}</div>
                                        @endif
                                    </div>
                                    <div class="col-1 d-flex justify-content-end">
                                        <i class="fa-solid fa-list-check fa-2x text-gray-300"></i>
                                    </div>

                                    <div class="col-12 mb-4">
                                        <h4 class="small font-weight-bold">
                                            Tỉ Lệ
                                            <span class="float-right">{{ round($count2 / 4 * 100, 0) }}%</span>
                                        </h4>
                                        <div class="progress">
                                            <div class="progress-bar bg-success" role="progressbar"
                                                 style="width: {{ $count2 / 4 * 100 }}%"
                                                 aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>

                                    <div class="col-12 mt-2">
                                        <h5><i class="fa-solid fa-check" style="color: #15b96c"></i> Xác minh Email</h5>
                                    </div>

                                    <div class="col-12 mt-2">
                                        @if(auth()->user()->profile_pic == null)
                                            <h5><i class="fa-solid fa-triangle-exclamation" style="color: #e3b20e"></i> Cập nhật ảnh đại diện</h5>
                                        @else
                                            <h5><i class="fa-solid fa-check" style="color: #15b96c"></i> Cập nhật ảnh đại diện</h5>
                                        @endif
                                    </div>

                                    <div class="col-12 mt-2">
                                        @if(auth()->user()->resume == null)
                                            <h5><i class="fa-solid fa-triangle-exclamation" style="color: #e3b20e"></i> Tải lên CV</h5>
                                        @else
                                            <h5><i class="fa-solid fa-check" style="color: #15b96c"></i> Tải lên CV</h5>
                                        @endif
                                    </div>

                                    <div class="col-12 mt-2">
                                        @if(auth()->user()->about == null)
                                            <h5><i class="fa-solid fa-triangle-exclamation" style="color: #e3b20e"></i> Cập nhật phần giới thiệu bản thân</h5>
                                        @else
                                            <h5><i class="fa-solid fa-check" style="color: #15b96c"></i> Cập nhật phần giới thiệu bản thân</h5>
                                        @endif
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- CV tải lên -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="text font-weight-bold text-primary text-uppercase mb-3">CV tải lên của bạn</div>

                        @if(auth()->user()->resume && file_exists(public_path('storage/' . auth()->user()->resume)))
                            <embed class="shadow-sm"
                                   style="border: solid 2px #ffffff"
                                   src="{{ asset('storage/' . auth()->user()->resume) }}"
                                   type="application/pdf"
                                   width="100%"
                                   height="260px" />

                            <a class="btn btn-primary container-fluid mt-2"
                               href="{{ asset('storage/' . auth()->user()->resume) }}"
                               target="_blank">
                                Xem CV
                            </a>
                        @else
                            <div class="h4 font-weight-bold text-gray-800 mb-3">Chưa có CV</div>
                            <a href="{{ route('user.cv') }}" class="btn btn-primary container-fluid">Tải lên CV</a>
                        @endif
                    </div>
                </div>
            </div>


            <!-- Chức năng nổi bật -->
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="text font-weight-bold text-info text-uppercase mb-3">Trải nghiệm các tính năng nổi bật</div>

                        <a href="{{ route('create.cv') }}" class="btn btn-info container-fluid mt-2">
                            Tạo CV với mẫu độc quyền của JOB SEARCH
                        </a>

                        <a href="{{ route('suggest.index') }}" class="btn btn-dark container-fluid mt-3">
                            Nhận gợi ý thu hút nhà tuyển dụng từ AI
                        </a>

                        <hr class="my-4">

                        <div class="text font-weight-bold text-danger text-uppercase mb-3">
                            Chế độ nhận cơ hội việc làm
                        </div>

                        <form action="{{ route('user.mail') }}" method="post">
                            @csrf
                            @if(auth()->user()->mail == 1)
                                <button type="submit" class="btn btn-primary container-fluid mt-2" style="height: 60px">
                                    Dừng nhận email
                                </button>
                            @else
                                <button type="submit" class="btn btn-success container-fluid mt-2" style="height: 60px">
                                    Bật chế độ nhận việc
                                </button>
                            @endif
                        </form>
                    </div>
                </div>
            </div>


            <!-- Mẫu CV -->
            <div class="col-xl-5 col-md-12 mb-4">
                <div class="card border-left-danger shadow h-100 py-2">
                    <div class="card-body">
                        <div class="text font-weight-bold text-danger text-uppercase mb-3">
                            Các mẫu CV nổi bật của JOB SEARCH
                        </div>

                        <div class="row">
                            @php
                                $cvSamples = ['cv1.pdf', 'cv2.pdf', 'cv3.pdf', 'cv4.pdf'];
                            @endphp

                            @foreach($cvSamples as $cv)
                                <div class="col-6 col-md-3 mb-3">
                                    @if(file_exists(public_path('storage/' . $cv)))
                                        <embed class="shadow-sm"
                                               style="border: solid 2px #ffffff"
                                               src="{{ asset('storage/' . $cv) }}"
                                               type="application/pdf"
                                               width="100%"
                                               height="220px" />
                                        <a class="btn btn-primary container-fluid mt-2"
                                           href="{{ asset('storage/' . $cv) }}"
                                           target="_blank">
                                            Xem
                                        </a>
                                    @else
                                        <div class="border rounded p-3 text-center bg-light" style="height: 220px;">
                                            <p class="mt-5 text-muted">Chưa có file</p>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

        </div>


        <!-- Công việc đã ứng tuyển -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Các công việc đã ứng tuyển</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="table" class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Tiêu đề</th>
                            <th>Ngày ứng tuyển</th>
                            <th>Trạng thái</th>
                            <th>Thao tác</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($jobs_applied as $listing)
                            <tr>
                                <td>{{ $listing->title }}</td>
                                <td>{{ $listing->pivot->created_at->format('d/m/Y') }}</td>
                                <td>
                                    @if($listing->pivot->shortlisted == 0)
                                        <span class="badge badge-warning">Đang chờ</span>
                                    @elseif($listing->pivot->shortlisted == 1)
                                        <span class="badge badge-success">Đã chấp nhận</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('job.show', $listing->slug) }}" class="btn btn-success container-fluid">Xem</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>Tiêu đề</th>
                            <th>Ngày ứng tuyển</th>
                            <th>Trạng thái</th>
                            <th>Thao tác</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>

    @endif
</div>