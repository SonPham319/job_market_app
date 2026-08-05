<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <h1 class="h3 mb-1 text-gray-800">Danh sách công việc có ứng viên</h1>
            <p class="mb-0 text-muted">Quản lý các công việc đã có ứng viên nộp hồ sơ</p>
        </div>
    </div>

    @if(session('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('message') }}
            <button type="button" class="close" data-dismiss="alert">
                <span>&times;</span>
            </button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert">
                <span>&times;</span>
            </button>
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Danh sách bài tuyển dụng</h6>
        </div>

        <div class="card-body">
            <div class="table-responsive">

                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead-light">
                    <tr>
                        <th>#</th>
                        <th>Tên công việc</th>
                        <th>Tổng ứng viên</th>
                        <th>Chưa shortlist</th>
                        <th>Thao tác</th>
                    </tr>
                    </thead>

                    <tbody>
                    @forelse($listings as $index => $listing)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td><strong>{{ $listing->title }}</strong></td>
                            <td>
                                <span class="badge badge-primary px-3 py-2">
                                    {{ $listing->users_count }}
                                </span>
                            </td>
                            <td>
                                <span class="badge badge-warning px-3 py-2 text-dark">
                                    {{ $listing->count }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('applicants.view', $listing->slug) }}" class="btn btn-sm btn-primary">
                                    <i class="fas fa-users"></i> Xem ứng viên
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">
                                Chưa có công việc nào có ứng viên ứng tuyển
                            </td>
                        </tr>
                    @endforelse
                    </tbody>

                </table>

            </div>
        </div>
    </div>

</div>