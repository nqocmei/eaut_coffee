@extends('layouts.site_layout')
@section('content')
<div class="auth-form-container" style="height: unset !important; margin-top: -105px!important;">
    <div class="main" style="padding-top: 180px; padding-bottom: 15px; margin-bottom: 0;">
        <form action="{{ route('register') }}" method="POST" class="form" style="width: 400px;" id="form-1">
            @csrf
            <h3 class="my-2">Đăng ký tài khoản</h3>
            <div class="my-2 fs-6">
                Bạn đã có tài khoản? <a class="account-register" href="{{ URL::to('login') }}">Đăng nhập</a>
            </div>
            <div class="form-group">
                <label class="control-label text-start">Họ và tên:</label>
                <div>
                    <input type="text" name="fullname" class="form-control">
                </div>
            </div>
            <!-- Hiển thị lỗi của ô input -->
            @error('fullname')
                <span class="required-field ps-2 text-small">{{ $message }}</span>
            @enderror
            <div class="form-group">
                <label class="control-label text-start">Email:</label>
                <div>
                    <input type="text" name="email" class="form-control">
                </div>
            </div>
            <!-- Hiển thị lỗi của ô input -->
            @error('email')
                <span class="required-field ps-2 text-small">{{ $message }}</span>
            @enderror

            <!-- phone -->
            <div class="form-group">
                <label class="control-label text-start">Phone:</label>
                <div>
                    <input type="text" name="phone" class="form-control">
                </div>
            </div>
            <!-- Hiển thị lỗi của ô input -->
            @error('phone')
                <span class="required-field ps-2 text-small">{{ $message }}</span>
            @enderror
            <div class="form-group">
                <label class="control-label text-start">Mật khẩu:</label>
                <div>
                    <input type="password" name="password" class="form-control">
                </div>
            </div>
            <!-- Hiển thị lỗi của ô input -->
            @error('password')
                <span class="required-field ps-2 text-small">{{ $message }}</span>
            @enderror

            <div class="form-group">
                <label class="control-label text-start">Nhắc lại mật khẩu:</label>
                <div>
                    <input type="password" name="password_confirmation" class="form-control">
                </div>
            </div>
            <!-- Hiển thị lỗi của ô input -->
            @error('password_confirmation')
                <span class="required-field ps-2 text-small">{{ $message }}</span>
            @enderror
            <button type="submit" value="Create" class="form-submit" name="register_submit">Đăng ký</button>
        </form>
    </div>
</div>
@endsection