<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset</title>
</head>

<body>
    <h1>Password Reset</h1>
    <!-- Hiển thị thông báo -->
    @if (session('status'))
    <div class="alert alert-info">
        {{ session('status') }}
    </div>
    @endif
    <p>You are receiving this email because we received a password reset request for your account.</p>
    <p>Click the link below to reset your password:</p>
    <a href="{{ url('password/reset', $token) }}">Reset Password</a>
    <p>If you did not request a password reset, no further action is required.</p>
</body>

</html>
