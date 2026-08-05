<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <h1>Cập Nhật Thông Tin Cá Nhân</h1>

            @if(Session::has('message'))
                <div class="alert alert-success">{{ Session::get('message') }}</div>
            @endif

            @if(Session::has('error'))
                <div class="alert alert-danger">{{ Session::get('error') }}</div>
            @endif

            @php
                $user = auth()->user();
            @endphp

            <form action="{{ route('user.profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- ẢNH -->
                <div class="form-group">
                    <label>
                        {{ $user->user_type == 'employer' ? 'Logo Công Ty' : 'Ảnh Đại Diện' }}
                    </label>

                    <input type="file" name="profile_pic" class="form-control-file">

                    @if($errors->has('profile_pic'))
                        <div class="error">{{ $errors->first('profile_pic') }}</div>
                    @endif

                    <!-- HIỂN THỊ ẢNH -->
                    <div class="mt-4">
                       <img 
    src="{{ $user->profile_pic 
        ? asset('storage/' . $user->profile_pic) 
        : asset('images/default-avatar.png') }}" 
    height="200"
    style="border-radius:50%; object-fit:cover;"
>
                    </div>
                </div>

                <!-- EMAIL -->
                <div class="form-group">
                    <label>Email</label>
                    <input readonly type="text" class="form-control" value="{{ $user->email }}">
                </div>

                <!-- NAME -->
                <div class="form-group">
                    <label>
                        {{ $user->user_type == 'employer' ? 'Tên Công Ty' : 'Họ và Tên' }}
                    </label>

                    <input type="text" name="name" class="form-control" value="{{ $user->name }}">

                    @if($errors->has('about'))
                        <div class="error">{{ $errors->first('name') }}</div>
                    @endif
                </div>

                <!-- ABOUT -->
                <div class="form-group">
                    <label>Giới Thiệu</label>

                    <input type="text" name="about" class="form-control" value="{{ $user->about }}">

                    @if($errors->has('about'))
                        <div class="error">{{ $errors->first('about') }}</div>
                    @endif
                </div>

                <div class="form-group mt-4">
                    <button type="submit" class="btn btn-success">Cập Nhật Thông Tin</button>
                </div>

            </form>

            <div class="dropdown-divider"></div>

            <!-- PASSWORD -->
            <h1>Cập Nhật Mật Khẩu</h1>

            <form action="{{ route('user.profile.password') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label>Mật Khẩu Cũ</label>
                    <input type="password" name="current_password" id="current_password" class="form-control">
                    <input class="mt-2" type="checkbox" onclick="show1()"> Hiển Thị

                    @if($errors->has('current_password'))
                        <div class="error">{{ $errors->first('current_password') }}</div>
                    @endif
                </div>

                <div class="form-group">
                    <label>Mật Khẩu Mới</label>
                    <input type="password" name="password" id="password" class="form-control">
                    <input class="mt-2" type="checkbox" onclick="show2()"> Hiển Thị

                    @if($errors->has('password'))
                        <div class="error">{{ $errors->first('password') }}</div>
                    @endif
                </div>

                <div class="form-group mt-4">
                    <button type="submit" class="btn btn-success">Cập Nhật Mật Khẩu</button>
                </div>
            </form>

        </div>
    </div>
</div>

<script>
function show1() {
    var x = document.getElementById("current_password");
    x.type = x.type === "password" ? "text" : "password";
}

function show2() {
    var x = document.getElementById("password");
    x.type = x.type === "password" ? "text" : "password";
}
</script>

<style>
.error {
    margin-top: 10px;
    color: red;
    font-weight: bold;
}
</style>