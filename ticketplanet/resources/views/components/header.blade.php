<nav>
    <div class="nav">
        <!--Menu desplegable-->
        <div class="dropdown">
            <img class="menuIMG" src="{{ asset('images/menu.png') }}" alt="">

            <div class="dropdown-content">
                <p>Home</p>
                <p>Categoria 1</p>
                <p>Categoria 2</p>
                <p>Categoria 3</p>
                <p>Categoria 4</p>
                <p>Categoria 5</p>
                <hr>

                <p>Sobre nosotros</p>
                <p>Avisos legales</p>

                <img class="imagenUsuarioDespegable" src="{{ asset('images/logo.jpg') }}" alt="" width="80">
            </div>
        </div>

        <!--Contenido header-->
        <!--Logo-->
        <img src="{{ asset('images/logo.jpg') }}" alt="Logo" width="100">

        <!--Links-->
        <div class="links">
            <ul>
                <li><a href="{{ route('links.home') }}">Home</a></li>
                <li><a href="{{ route('links.aboutus') }}">Sobre nosotros</a></li>
                <li><a href="{{ route('links.legalnotice') }}">Avisos legales</a></li>
            </ul>
        </div>

        <!--Login-->
        <div class="auth">
            <img src="{{ asset('images/usuario.png') }}" alt="User">
            <a href="">Acceder</a>
        </div>
    </div>

    <!--Logo con el Nombre-->
    <div class="navLogo">
        <img src="{{ asset('images/LogoNombre.png') }}" alt="User">
        <hr class="separator">
    </div>
</nav>
