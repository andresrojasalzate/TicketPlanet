<nav>

    <div class="nav">
        <div class="dropdown">
            <img id="menuIcon" class="menuIMG @yield('hide')" src="{{ asset('images/menu.png') }}" alt="" loading="lazy">

            <div class="dropdown-content">
                <div class="homeMenu">
                    <img src="{{ asset('images/menu/home.png') }}" alt="home" width="20" loading="lazy">
                    <a href="{{ route('home') }}">Home</a>

                </div>
                <div class="homePromotorMenu">
                    <img src="{{ asset('images/menu/homePromotor.png') }}" alt="home promotor" width="20" loading="lazy">
                    <a href="{{ route('links.homePromotors') }}">Home Promotor</a>

                </div>

                <hr>

                <div class="logout">
                    <img src="{{ asset('images/login/logout.png') }}" alt="cerrar sesion" width="18" loading="lazy">
                    <a href="{{ route('auth.logout') }}" class="">Cerrar sesión</a>
                </div>

                <div class="aboutusMenu">
                    <img src="" loading="lazy">
                    <a href="{{ route('links.aboutus') }}">Sobre nosotros</a>
                </div>
                <div class="legalnoticeMenu">
                    <img src="" loading="lazy">
                    <a href="{{ route('links.legalnotice') }}">Avisos legales</a>
                </div>

                <img class="imagenUsuarioDespegable" src="{{ asset('images/logo.jpg') }}" alt=""
                    width="80" loading="lazy">
            </div>
        </div>

        <!--Contenido header-->
        <!--Logo-->
        <a href="{{ route('home') }}">
            <img src="{{ asset('images/logo.jpg') }}" alt="Logo" class="logoNav" loading="lazy">
        </a>
        <div>
            <!--Contenido vacio para la parte central del header-->
        </div>

        <!--Login-->
        <div class="auth @yield('hide')">
            <img src="{{ asset('images/usuario.png') }}" alt="User" loading="lazy">
            @guest
                <a href="{{ route('auth.login') }}">Acceder</a>
            @else
                <span class="userAuth">{{ auth()->user()->name }}</span>
            @endguest
        </div>

    </div>

    <!--Logo con el Nombre-->
    <div class="navLogo @yield('hide')">
        <img src="{{ asset('images/LogoNombre.png') }}" alt="User" loading="lazy">
        <hr class="separator">
    </div>

</nav>

