<nav>
    <div class="nav">
        <img src="{{ asset('images/logo.jpg') }}" alt="Logo" width="100">
        <div class="links">
            <ul>
                <li><a href="{{ route('links.home') }}">Home</a></li>
                <li><a href="{{ route('links.aboutus') }}">Sobre nosotros</a></li>
                <li><a href="{{ route('links.legalnotice') }}">Avisos legales</a></li>
            </ul>
        </div>
        <div class="auth">
            <img src="{{ asset('images/usuario.png') }}" alt="User">
            <a href="">Acceder</a>
        </div>
    </div>
    <div class="navLogo">
        <img src="{{ asset('images/LogoNombre.png') }}" alt="User">
        <hr class="separator">
    </div>
</nav>
