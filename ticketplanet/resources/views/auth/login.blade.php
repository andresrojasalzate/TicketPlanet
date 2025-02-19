@extends('layouts.app')

@section('title', 'Inicio Sesión')
@section('meta_description', 'Inicio de sesión en la app TicketPlanet')

@section('hide')
    hide
@endsection

@section('content')
    <div class="login">
        <div class="titleLogin">
            <p>BIENVENIDO</p>
            <img src="{{ asset('images/logo.jpg') }}" alt="" loading="lazy">
        </div>
        <div class="accede">
            <p>Accede</p>
        </div>
        <div class="registrate">
            <p>¿No tienes una cuenta? <a href="">Regístrate</a></p>
        </div>
        @if ($errors->has('email'))
            <span class="emailerror">{{ $errors->first('email') }}</span>
        @endif

        @if ($errors->has('password'))
            <span class="passworderror">{{ $errors->first('password') }}</span>
        @endif
        @if (session('status') && session('status')['message'])
            <div class="mensaje-estado {{ session('status')['class'] ?? '' }}">
                {{ session('status')['message'] }}
            </div>
        @endif

        <form action="{{ route('auth.login') }}" method="post">
            @csrf
            <div class="correoLogin">
                <label>Correo electrónico</label>
                <input type="email" name="email" value="{{ old('email') }}" maxlength="50">
            </div>
            <div class="contraLogin">
                <label>Contraseña</label>
                <input type="password" name="password" id="passwordInput" value="" maxlength="20">
                <div class="toggle-password" onclick="togglePasswordVisibility()">
                    <img src="{{ asset('images/login/ojono.png') }}" alt="Toggle Password Visibility" id="eyeIcon"
                        width="60" loading="lazy">
                </div>
            </div>
            <p class="olvidadoContra"><a href="{{ route('password.request') }}">¿Has olvidado tu contraseña?</a></p>
            <input type="submit" value="Iniciar sesión" class="btnIniciaSesion">
        </form>
    </div>
@endsection

<script>
    function togglePasswordVisibility() {
        const passwordInput = document.getElementById('passwordInput');
        const eyeIcon = document.querySelector('#eyeIcon');

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            eyeIcon.src = "{{ asset('images/login/ojosi.png') }}";
        } else {
            passwordInput.type = 'password';
            eyeIcon.src = "{{ asset('images/login/ojono.png') }}";
        }
    }
</script>
{{-- <script src="{{ asset('js/login.js') }}"></script> --}}
