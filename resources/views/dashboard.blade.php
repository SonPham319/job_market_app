@extends('layouts.dashboard.main')
@section('title', 'Dashboard - JOB SEARCH')

@section('content')
<div class="container mt-4">

    <h2 class="fw-bold mb-4">Dashboard</h2>

    {{-- THÔNG BÁO --}}
    @if(session('success'))
        <div class="alert alert-success rounded-4">
            {{ session('success') }}
        </div>
    @endif

    @if(session('message'))
        <div class="alert alert-info rounded-4">
            {{ session('message') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger rounded-4">
            {{ session('error') }}
        </div>
    @endif

    {{-- =========================
         DASHBOARD NHÀ TUYỂN DỤNG
    ========================== --}}
    @if(auth()->user()->user_type == 'employer')

        <div class="row mb-4">
            <div class="col-md-4 mb-3">
                <div class="card shadow border-0 rounded-4">
                    <div class="card-body text-center">
                        <h5 class="text-muted">Tổng công việc</h5>
                        <h2 class="fw-bold text-primary">{{ $jobs->count() }}</h2>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-3">
                <div class="card shadow border-0 rounded-4">
                    <div class="card-body text-center">
                        <h5 class="text-muted">Ứng viên chờ duyệt</h5>
                        <h2 class="fw-bold text-warning">{{ $count }}</h2>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-3">
                <div class="card shadow border-0 rounded-4">
                    <div class="card-body text-center">
                        <h5 class="text-muted">Đã shortlist</h5>
                        <h2 class="fw-bold text-success">{{ $users_shortlisted->count() }}</h2>
                    </div>
                </div>
            </div>
        </div>

        {{-- BẢNG CÔNG VIỆC --}}
        <div class="card shadow border-0 rounded-4">
            <div class="card-header bg-primary text-white rounded-top-4">
                <h5 class="mb-0">Danh sách công việc của bạn</h5>
            </div>
            <div class="card-body">
                @if($jobs->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover align-middle text-center">
                            <thead class="table-light">
                                <tr>
                                    <th>STT</th>
                                    <th>Tên công việc</th>
                                    <th>Địa chỉ</th>
                                    <th>Số ứng viên apply</th>
                                    <th>Auto Matching</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($jobs as $index => $job)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td class="fw-semibold">{{ $job->title }}</td>
                                        <td>{{ $job->address ?? 'Không có' }}</td>
                                        <td>
                                            <span class="badge bg-info text-dark fs-6">
                                                {{ $job->users()->count() }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge bg-success fs-6">
                                                {{ $job->matched_count ?? 0 }} ứng viên
                                            </span>
                                        </td>
                                        <td>
                                            <a href="{{ route('matching.candidates', $job->id) }}" class="btn btn-sm btn-primary rounded-pill">
                                                Xem phù hợp
                                            </a>

                                            <a href="{{ route('applicants.view', $job->slug) }}" class="btn btn-sm btn-outline-dark rounded-pill">
                                                Xem apply
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-muted mb-0">Bạn chưa đăng công việc nào.</p>
                @endif
            </div>
        </div>

    {{-- =========================
         DASHBOARD ỨNG VIÊN
    ========================== --}}
    @elseif(auth()->user()->user_type == 'employee')

        <div class="row mb-4">
            <div class="col-md-6 mb-3">
                <div class="card shadow border-0 rounded-4">
                    <div class="card-body text-center">
                        <h5 class="text-muted">Hồ sơ hoàn thiện</h5>
                        <h2 class="fw-bold text-primary">{{ $count2 }}/4</h2>
                    </div>
                </div>
            </div>

            <div class="col-md-6 mb-3">
                <div class="card shadow border-0 rounded-4">
                    <div class="card-body text-center">
                        <h5 class="text-muted">Công việc đã ứng tuyển</h5>
                        <h2 class="fw-bold text-success">{{ $jobs_applied->count() }}</h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow border-0 rounded-4">
            <div class="card-header bg-success text-white rounded-top-4">
                <h5 class="mb-0">Danh sách công việc đã ứng tuyển</h5>
            </div>
            <div class="card-body">
                @if($jobs_applied->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover align-middle text-center">
                            <thead class="table-light">
                                <tr>
                                    <th>STT</th>
                                    <th>Tên công việc</th>
                                    <th>Địa chỉ</th>
                                    <th>Loại công việc</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($jobs_applied as $index => $job)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td class="fw-semibold">{{ $job->title }}</td>
                                        <td>{{ $job->address ?? 'Không có' }}</td>
                                        <td>{{ $job->job_type ?? 'Không có' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-muted mb-0">Bạn chưa ứng tuyển công việc nào.</p>
                @endif
            </div>
        </div>

    @endif
</div>
@endsection