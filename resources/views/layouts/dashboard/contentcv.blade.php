<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">CV của bạn</h1>
    </div>

    <!-- Alert Messages -->
    @if(session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row">

        <!-- Upload CV -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow mb-4 border-left-primary">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Tải lên CV mới</h6>
                </div>
                <div class="card-body">

                    <form action="{{ route('user.cv.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="resume"><strong>Chọn file CV</strong></label>
                            <input type="file" name="resume" id="resume" class="form-control" accept=".pdf,.doc,.docx" required>
                            <small class="text-muted">Hỗ trợ: PDF, DOC, DOCX (tối đa 2MB)</small>
                        </div>

                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-upload"></i> Tải CV lên
                        </button>
                    </form>

                </div>
            </div>
        </div>

        <!-- Current CV -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow mb-4 border-left-success">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-success">CV hiện tại</h6>
                </div>
                <div class="card-body">

                    @if(auth()->user()->resume)
                        <p><strong>Tên file:</strong> {{ basename(auth()->user()->resume) }}</p>

                        <div class="mb-3">
                            <a href="{{ route('user.cv.view') }}" target="_blank" class="btn btn-success btn-sm">
                                <i class="fas fa-eye"></i> Xem CV
                            </a>

                            <a href="{{ route('user.cv.download') }}" class="btn btn-info btn-sm text-white">
                                <i class="fas fa-download"></i> Tải CV
                            </a>

                            <form action="{{ route('user.cv.delete') }}" method="POST" class="d-inline" onsubmit="return confirm('Bạn có chắc muốn xóa CV này không?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash"></i> Xóa CV
                                </button>
                            </form>
                        </div>

                        <div class="alert alert-light border">
                            <i class="fas fa-file-pdf text-danger"></i>
                            CV của bạn đã được tải lên thành công.
                        </div>
                    @else
                        <div class="alert alert-warning mb-0">
                            <i class="fas fa-exclamation-circle"></i>
                            Bạn chưa tải lên CV nào.
                        </div>
                    @endif

                </div>
            </div>
        </div>

    </div>
</div>