<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperación de Contraseña</title>
</head>
<body>
    <p>Hola {{ $user->name }},</p>
    
    <p>Recibiste este correo porque solicitaste restablecer tu contraseña. Haz clic en el siguiente enlace para continuar:</p>
    
    <a href="{{ url('auth/resetPwd', $token) }}">Restablecer Contraseña</a>

    <!-- log para registrar el envío del correo -->
    @php
        Log::info('Recibido el correo para restablecer la contraseña');
    @endphp
    
    <p>Si no solicitaste restablecer tu contraseña, puedes ignorar este correo.</p>
    
    <p>Saludos,<br>{{ config('app.name') }}</p>

    <img src="{{ asset('images/logo.jpg') }}" alt="logo" width="55">
    <img src="{{ asset('images/LogoNombre.png') }}" alt="logo con Nombre">
</body>
</html>