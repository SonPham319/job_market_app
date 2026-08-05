<div class="container-fluid">

    @if(Session::has('success'))
        <div class="alert alert-success">{{ Session::get('success') }}</div>
    @endif

    @if(Session::has('message'))
        <div class="alert alert-success">{{ Session::get('message') }}</div>
    @endif

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Danh sách bài đăng</h1>

    <!-- DataTables Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Bài đăng</h6>
        </div>

        <div class="card-body">
            <div class="table-responsive">

                <table class="table table-bordered text-center align-middle" id="dataTable" width="100%" cellspacing="0">
                    <thead class="table-dark">
                    <tr>
                        <th>STT</th>
                        <th>Tiêu đề</th>
                        <th>Ngày đăng</th>
                        <th>Ứng viên phù hợp</th>
                        <th>Xem Matching</th>
                        <th>Sửa</th>
                        <th>Xóa</th>
                    </tr>
                    </thead>

                    <tfoot>
                    <tr>
                        <th>STT</th>
                        <th>Tiêu đề</th>
                        <th>Ngày đăng</th>
                        <th>Ứng viên phù hợp</th>
                        <th>Xem Matching</th>
                        <th>Sửa</th>
                        <th>Xóa</th>
                    </tr>
                    </tfoot>

                    <tbody>
                    @foreach($jobs as $job)
                        <tr>
                            <td>{{ $loop->iteration }}</td>

                            <td>{{ $job->title }}</td>

                            <td>{{ $job->created_at->format('d-m-Y') }}</td>

                            {{-- Số ứng viên phù hợp --}}
                            <td>
                                @if(isset($job->matched_count))
                                    <span class="badge bg-success px-3 py-2">
                                        {{ $job->matched_count }} ứng viên
                                    </span>
                                @else
                                    <span class="badge bg-secondary px-3 py-2">
                                        Chưa tính
                                    </span>
                                @endif
                            </td>

                            {{-- Nút xem matching --}}
                            <td>
                                <a class="btn btn-warning container-fluid"
                                   href="{{ route('matching.candidates', $job->id) }}">
                                    Xem
                                </a>
                            </td>

                            {{-- Sửa --}}
                            <td>
                                <a class="btn btn-info container-fluid"
                                   href="{{ route('job.edit', $job->id) }}">
                                    Sửa Bài
                                </a>
                            </td>

                            {{-- Xóa --}}
                            <td>
                                <a class="btn btn-outline-danger container-fluid"
                                   href="#"
                                   data-bs-toggle="modal"
                                   data-bs-target="#delpost{{ $job->id }}">
                                    Xóa Bài
                                </a>
                            </td>
                        </tr>

                        {{-- Modal Xóa --}}
                        <div class="modal fade" id="delpost{{ $job->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">

                                    <form action="{{ route('job.destroy', $job->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')

                                        <div class="modal-header">
                                            <h5 class="modal-title">Thông Báo</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>

                                        <div class="modal-body">
                                            Bạn có chắc chắn muốn xóa bài:
                                            <strong>{{ $job->title }}</strong> ?
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Không</button>
                                            <button type="submit" class="btn btn-danger">Chắc chắn</button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->