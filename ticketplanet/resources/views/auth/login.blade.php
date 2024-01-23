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
            @if ($errors->has('email'))
                <span class="emailerror">{{ $errors->first('email') }}</span>
            @endif

            @if ($errors->has('password'))
                <span class="passworderror">{{ $errors->first('password') }}</span>
            @endif
            {{-- @if (session('status'))
                <span class="credenciales">{{ session('status') }}</span>
            @endif --}}
            @if (session('status'))
                <div class="correcto">
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
                            width="60">
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

</body>
