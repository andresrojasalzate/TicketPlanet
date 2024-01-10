@section('hideNavLogo', 'hidden') <!--Oculta el Logo del header-->
@include('components/header')
<title>Login</title>
<link rel="shortcut icon" href="favicon/logoFavicon.ico" type="image/x-icon">
<link rel="stylesheet" href="{{ asset('css/styles.css') }}">

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
            </div>
            <div class="contraLogin">
                <label>Contraseña</label>
                <input type="password" name="password" id="passwordInput" value="" maxlength="20">
                <div class="toggle-password" onclick="togglePasswordVisibility()">
                    <img src="{{ asset('images/login/ojono.png') }}" alt="Toggle Password Visibility" id="eyeIcon">
                </div>
            </div>
            <p class="olvidadoContra"><a href="">¿Has olvidado tu contraseña?</a></p>
            <input type="submit" value="Iniciar sesión" class="btnIniciaSesion">
        </form>
    </div>
    
        <script src="{{ asset('js/login.js') }}"></script>
    
</body>
@include('components/footer')
