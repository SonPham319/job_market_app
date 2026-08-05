<div class="container-fluid">

    <div class="row align-items-center">
        <div class="col-md-7 col-12">
            <h1 class="h3 mb-2 text-gray-800">
                Danh sách ứng viên cho: <b>{{ $listing->title }}</b>
            </h1>
        </div>

        <div class="col-md-5 col-12 d-flex justify-content-md-end mt-3 mt-md-0">
            <p class="mr-2 mt-1 font-weight-bold">Chế độ hiển thị</p>
            <div role="group" aria-label="Bộ lọc ứng viên">
                <input type="checkbox" autocomplete="off" id="checkbox1" checked>
                <label for="checkbox1" class="mr-3">Đã thêm</label>

                <input type="checkbox" autocomplete="off" id="checkbox2" checked>
                <label for="checkbox2">Chưa thêm</label>
            </div>
        </div>
    </div>

    <div class="dropdown-divider"></div>

    @if(Session::has('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ Session::get('message') }}
            <button type="button" class="close" data-dismiss="alert">
                <span>&times;</span>
            </button>
        </div>
    @endif

    @if(Session::has('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ Session::get('error') }}
            <button type="button" class="close" data-dismiss="alert">
                <span>&times;</span>
            </button>
        </div>
    @endif

    <div class="row">
        @forelse($users as $user)

            @if($user->pivot->shortlisted)
                <div class="col-lg-6 col-xl-4 yes mt-4">
                    <div class="card border-left-success shadow pt-2 h-100">
            @else
                <div class="col-lg-6 col-xl-4 no mt-4">
                    <div class="card border-left-primary shadow pt-2 h-100">
            @endif

                        <div class="card-body">
                            <div class="row">

                                <div class="col-12 d-flex justify-content-center mb-3">
                                    @if($user->profile_pic)
                                        <img class="img-profile rounded-circle"
                                             src="{{ asset('storage/' . $user->profile_pic) }}"
                                             alt="avatar"
                                             width="150"
                                             height="150"
                                             style="object-fit: cover;">
                                    @else
                                        <img class="img-profile rounded-circle"
                                             src="{{ asset('img/undraw_profile.svg') }}"
                                             alt="avatar"
                                             width="150"
                                             height="150"
                                             style="object-fit: cover;">
                                    @endif
                                </div>

                                <div class="col-12 d-flex justify-content-between mb-2">
                                    <div class="text font-weight-bold text-primary text-uppercase mr-2">
                                        Ứng viên:
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800 text-right">
                                        {{ $user->name }}
                                    </div>
                                </div>

                                <div class="col-12 d-flex justify-content-between mb-2">
                                    <div class="text font-weight-bold text-primary text-uppercase mr-2">
                                        Email:
                                    </div>
                                    <div class="h6 mb-0 font-weight-bold text-gray-800 text-right">
                                        {{ $user->email }}
                                    </div>
                                </div>

                                <div class="col-12 d-flex justify-content-between mb-2">
                                    <div class="text font-weight-bold text-primary text-uppercase mr-2">
                                        Ứng tuyển:
                                    </div>
                                    <div class="h6 mb-0 font-weight-bold text-gray-800 text-right">
                                        {{ $user->pivot->created_at ? $user->pivot->created_at->format('d/m/Y') : 'Không rõ' }}
                                    </div>
                                </div>

                                <div class="col-12 mb-3 text-center">
                                    @if($user->pivot->shortlisted)
                                        <span class="badge badge-success px-3 py-2">Đã thêm vào shortlist</span>
                                    @else
                                        <span class="badge badge-primary px-3 py-2">Chưa thêm vào shortlist</span>
                                    @endif
                                </div>

                                <div class="col-6 mt-2 d-flex justify-content-start">
                                    @if($user->resume)
                                        <a class="btn btn-info mb-4"
                                           href="{{ route('applicant.cv.view', $user->id) }}"
                                           target="_blank">
                                            Xem CV
                                        </a>
                                    @else
                                        <button class="btn btn-secondary mb-4" disabled>
                                            Chưa có CV
                                        </button>
                                    @endif
                                </div>

                                <div class="col-6 mt-2 d-flex justify-content-end">
                                    <form action="{{ route('applicant.shortlist', [$listing->id, $user->id]) }}" method="POST">
                                        @csrf
                                        @if($user->pivot->shortlisted == 1)
                                            <button class="btn btn-dark mb-4" disabled>
                                                Đã thêm
                                            </button>
                                        @else
                                            <button type="submit" class="btn btn-success mb-4">
                                                Thêm
                                            </button>
                                        @endif
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

        @empty
            <div class="col-12">
                <div class="alert alert-warning text-center shadow-sm">
                    Chưa có ứng viên nào ứng tuyển vào công việc này.
                </div>
            </div>
        @endforelse
    </div>

    <div class="row mt-5 ml-1">
        <div class="col-12 d-flex justify-content-center">
            {{ $users->links('vendor.pagination.bootstrap-5') }}
        </div>
    </div>

</div>