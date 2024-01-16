<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
</head>
<body>
    <h1>Reset Your Password</h1>
    <p>Hello {{ $user->name }},</p>
    <p>Click the following link to reset your password:</p>
    <a href="{{ url('password/reset', [$token]) }}">Reset Password</a>
    <p>If you didn't request a password reset, ignore this email.</p>
</body>
</html>