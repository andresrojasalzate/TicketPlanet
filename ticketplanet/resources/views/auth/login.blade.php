@extends('layouts.app')

@section('content')

    <body class="body-login">
        <div class="login">
            <div class="titleLogin">
                <p>BIENVENIDO</p>
                <img src="{{ asset('images/logo.jpg') }}" alt="" height="80">
            </div>
            <div class="accede">
                <p>Accede</p>
            </div>
            <div class="registrate">
                <p>¿No tienes una cuenta? <a href="">Regístrate</a></p>
            </div>
            <form action="{{ route('auth.login') }}" method="post">
                @csrf
                <div class="correoLogin">
                    <label>Correo electrónico</label>
                    <input type="text" name="email" value="{{ old('email') }}" maxlength="50">
                    @if ($errors->has('email'))
                        <span>{{ $errors->first('email') }}</span>
                    @endif
                </div>
                <div class="contraLogin">
                    <label>Contraseña</label>
                    <input type="password" name="password" id="passwordInput" value="" maxlength="20">
                    @if ($errors->has('password'))
                        <span>{{ $errors->first('password') }}</span>
                    @endif
                    <div class="toggle-password" onclick="togglePasswordVisibility()">
                        <img src="{{ asset('images/login/ojono.png') }}" alt="Toggle Password Visibility" id="eyeIcon">
                    </div>
                </div>
                <p class="olvidadoContra"><a href="">¿Has olvidado tu contraseña?</a></p>
                <input type="submit" value="Iniciar sesión" class="btnIniciaSesion">
                @if(session('status'))
                    <span class="credenciales">{{ session('status') }}</span>
                @endif
            </form>
        </div>
    @endsection

    <script src="{{ asset('js/login.js') }}"></script>

</body>
