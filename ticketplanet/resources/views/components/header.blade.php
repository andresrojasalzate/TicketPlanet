<nav>

    <div class="nav">
        <!--Menu desplegable-->
        <div class="dropdown">
            <img id="menuIcon" class="menuIMG @yield('hide')" src="{{ asset('images/menu.png') }}" alt="">

            <div class="dropdown-content">
                <div class="homeMenu">
                    <img src="{{ asset('images/menu/home.png') }}" alt="home" width="20">
                    <a href="{{ route('home') }}">Home</a>

                </div>
                <div class="homePromotorMenu">
                    <img src="{{ asset('images/menu/homePromotor.png') }}" alt="home promotor" width="20">
                    <a href="{{ route('links.homePromotors') }}">Home Promotor</a>

                </div>
                <hr>
                <div class="categoriasMenu">
                    @foreach ($categories as $category)
                        <p>{{ $category->name }}</p>
                    @endforeach
                </div>

                <hr>

                <div class="logout">
                    <img src="{{ asset('images/login/logout.png') }}" alt="cerrar sesion" width="18">
                    <a href="{{ route('auth.logout') }}" class="">Cerrar sesión</a>
                </div>

                <div class="aboutusMenu">
                    <img src="">
                    <a href="{{ route('links.aboutus') }}">Sobre nosotros</a>
                </div>
                <div class="legalnoticeMenu">
                    <img src="">
                    <a href="{{ route('links.legalnotice') }}">Avisos legales</a>
                </div>

                <img class="imagenUsuarioDespegable" src="{{ asset('images/logo.jpg') }}" alt="" width="80">
            </div>
        </div>

        <!--Contenido header-->
        <!--Logo-->
        <img src="{{ asset('images/logo.jpg') }}" alt="Logo" class="logoNav">

        <div>
            <!--Contenido vacio para la parte central del header-->
        </div>

        <!--Login-->
        <div class="auth @yield('hide')">
            <img src="{{ asset('images/usuario.png') }}" alt="User">
            @guest
                <a href="{{ route('auth.login') }}">Acceder</a>
            @else
                <span>{{ auth()->user()->name }}</span>
            @endguest
        </div>

    </div>

    <!--Logo con el Nombre-->
    <div class="navLogo @yield('hide')">
        <img src="{{ asset('images/LogoNombre.png') }}" alt="User">
        <hr class="separator">
    </div>

    <script src="{{ asset('js/header.js') }}"></script>
</nav>
