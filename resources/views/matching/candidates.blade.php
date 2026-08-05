<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ứng viên phù hợp</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background: #f5f7fb;">

<div class="container py-5">

    <div class="mb-4">
        <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary rounded-pill px-4">
            ← Quay lại Dashboard
        </a>
    </div>

    <div class="card border-0 shadow rounded-4 mb-4">
        <div class="card-body p-4">
            <h2 class="fw-bold text-primary mb-3">Danh sách ứng viên phù hợp</h2>
            <h4 class="fw-semibold">{{ $listing->title }}</h4>
            <p class="text-muted mb-0">
                <strong>Địa chỉ:</strong> {{ $listing->address ?? 'Không có' }} <br>
                <strong>Mức lương:</strong>
                @if($listing->salary == 0)
                    Thỏa thuận
                @else
                    {{ number_format($listing->salary, 0, ',', '.') }} VNĐ
                @endif
            </p>
        </div>
    </div>

    <div class="card border-0 shadow rounded-4 mb-4">
        <div class="card-header bg-primary text-white rounded-top-4">
            <h5 class="mb-0">Kỹ năng yêu cầu của công việc</h5>
        </div>
        <div class="card-body">
            @if($listing->skills->count() > 0)
                @foreach($listing->skills as $skill)
                    <span class="badge bg-info text-dark fs-6 me-2 mb-2 px-3 py-2">
                        {{ $skill->name }} (Trọng số: {{ $skill->pivot->weight }})
                    </span>
                @endforeach
            @else
                <p class="text-danger mb-0">Công việc này chưa có kỹ năng yêu cầu.</p>
            @endif
        </div>
    </div>

    <div class="card border-0 shadow rounded-4">
        <div class="card-header bg-success text-white rounded-top-4">
            <h5 class="mb-0">Bảng xếp hạng ứng viên phù hợp</h5>
        </div>
        <div class="card-body">

            @if(count($matchedCandidates) > 0)
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle">
                        <thead class="table-light text-center">
                            <tr>
                                <th>Hạng</th>
                                <th>Ứng viên</th>
                                <th>Email</th>
                                <th>Kỹ năng trùng</th>
                                <th>Điểm phù hợp</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($matchedCandidates as $index => $item)
                                <tr>
                                    <td class="text-center fw-bold">{{ $index + 1 }}</td>
                                    <td class="fw-semibold">{{ $item['user']->name }}</td>
                                    <td>{{ $item['user']->email }}</td>
                                    <td>
                                        @if(count($item['matched_skills']) > 0)
                                            @foreach($item['matched_skills'] as $skill)
                                                <span class="badge bg-secondary me-1 mb-1 px-3 py-2">{{ $skill }}</span>
                                            @endforeach
                                        @else
                                            <span class="text-danger">Không khớp</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-success fs-6 px-3 py-2">
                                            {{ $item['score'] }}%
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="alert alert-warning mb-0">
                    Chưa có ứng viên nào để so khớp.
                </div>
            @endif

        </div>
    </div>

</div>

</body>
</html>