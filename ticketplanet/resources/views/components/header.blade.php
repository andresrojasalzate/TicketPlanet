<nav>

    <div class="nav">
        <!--Menu desplegable-->
        <div class="dropdown">
            <img id="menuIcon" class="menuIMG @yield('hide')" src="{{ asset('images/menu.png') }}" alt="">

            <div class="dropdown-content">
                <p><a href="{{ route('home') }}">Home</a></p>
                <p><a href="{{ route('links.homePromotors') }}">Home Promotors</a></p>
                <hr>
                @foreach ($categories as $category)
                    <p>{{ $category->name }}</p>
                @endforeach
                <hr>

                <div class="logout">
                    <a href="{{ route('auth.logout') }}" class="">Cerrar sesión</a>
                    <img src="{{ asset('images/login/logout.png') }}" alt="cerrar sesion" width="20">
                </div>


                <p>Sobre nosotros</p>
                <p>Avisos legales</p>
                

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
