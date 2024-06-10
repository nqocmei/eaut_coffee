@extends('layouts.site_layout')
@section('content')
<div class="auth-form-container">
    <div class="auth-form-wrapper">
        <div class="main mt-3 mt-md-5 pt-md-5 mx-auto">
            <h1>Reset Password</h1>
            <form action="{{ route('password.update', ['token' => $token]) }}" method="POST">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" name="email" id="email" required class="form-control"
                        placeholder="Nhập email của bạn">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">New Password:</label>
                    <input type="password" name="password" id="password" required class="form-control"
                        placeholder="Nhập mật khẩu mới">
                </div>
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Confirm New Password:</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" required
                        class="form-control" placeholder="Nhập lại mật khẩu">
                </div>

                <button type="submit" class="btn btn-success">Reset Password</button>
            </form>
        </div>
    </div>
</div>

@endsection