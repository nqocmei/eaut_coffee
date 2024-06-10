@extends('layouts.site_layout')
@section('content')
    <div class="auth-form-container">
        <div class="auth-form-wrapper">
            <div class="main mt-3 mt-md-5 pt-md-5 mx-auto">
                <form action="{{ route('login') }}" method="POST" class="form mt-5 pt-2">
                    @csrf
                    <h3 class="my-2">Đăng nhập</h3>
                    <div class="form-group">
                        <label for="email" class="text-start">Nhập email: </label>
                        <input id="email" type="email" name="email" class="form-control">
                        <span class="form-message"></span>
                    </div>
                    <div class="form-group">
                        <label for="password" class="text-start">Mật khẩu: </label>
                        <input type="password" name="password" class="form-control">
                        <span class="form-message"></span>
                    </div>
                    <button type="submit" class="form-submit" name="login_submit">Đăng nhập</button>
                    <div class="mt-2 fs-6">
                        Bạn chưa có tài khoản? <a class="account-register" href="{{ URL::to('register') }}">Đăng ký ngay</a>
                    </div>
                    <div class="mt-2 fs-6">
                    Quên mật khẩu? <a class="account-register" href="{{ route('password.request') }}">Lấy lại mật khẩu</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
