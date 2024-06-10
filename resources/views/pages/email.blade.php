@extends('layouts.site_layout')
@section('content')
<div class="auth-form-container">
    <div class="auth-form-wrapper">
        <div class="main mt-3 mt-md-5 pt-md-5 mx-auto">
            <h1>Reset Password</h1>
            <form action="{{ route('password.email') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" name="email" id="email" required class="form-control"
                        placeholder="Nhập email của bạn">
                </div>

                <button type="submit" class="btn btn-success">Send Reset Link</button>
            </form>
        </div>
    </div>
</div>
@endsection