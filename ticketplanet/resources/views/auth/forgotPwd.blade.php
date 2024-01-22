@extends('layouts.app')

@section('content')

    <body class="body-resetPwd">
        <div class="resetPwd">
            <div class="titleResetPwd">
                <p>RESTABLECER LA CONTRASEÑA</p>
                <img src="{{ asset('images/logo.jpg') }}" alt="" height="80">
            </div>
                        
            <div class="txtResetPwd">
                <p>Introduce tu correo electrónico y te enviaremos instrucciones para poder restablecer la contraseña.</p>
            </div>

            @if (session('status'))
                <div class="resetPwdExito" >
                    {{ session('status') }}
                </div>
                <script src="{{ asset('js/forgotPwd.js') }}"></script>
            @endif

            @if ($errors->has('email'))
                <div class="resetPwdError" >
                    {{ $errors->first('email') }}
                </div>
            @endif
            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                <div class="correoReset">
                    <label>Correo electrónico</label>
                    <input type="email" name="email" value="{{ old('email') }}" maxlength="50">
                </div>
                <input type="submit" value="Enviar" class="btnResetPwd">
                <p class="volverInicioSesion"><a href="{{ route('auth.login') }}">Volver al inicio de sesión</a></p>
            </form>
        </div>
    @endsection
</body>
