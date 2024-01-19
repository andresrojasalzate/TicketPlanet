<nav>

    <div class="nav">
        <!--Menu desplegable-->
        <div class="dropdown">
            <img id="menuIcon" class="menuIMG @yield('hide')" src="{{ asset('images/menu.png') }}" alt="">

            <div class="dropdown-content">
                <p>Home</p>
                <p>Categoria 1</p>
                <p>Categoria 2</p>
                <p>Categoria 3</p>
                <p>Categoria 4</p>
                <p>Categoria 5</p>
                <hr>

                <div class="logout">
                    <a href="{{ route('auth.logout') }}" class="">Cerrar sesión</a>
                    <img src="{{ asset('images/login/logout.png') }}" alt="cerrar sesion" width="20">
                </div>


                <p>Sobre nosotros</p>
                <p>Avisos legales</p>
                <a href="{{ route('links.homePromotors') }}">Home Promotors</a>

                <img class="imagenUsuarioDespegable" src="{{ asset('images/logo.jpg') }}" alt="" width="80">
            </div>
        </div>

        <!--Contenido header-->
        <!--Logo-->
        <img src="{{ asset('images/logo.jpg') }}" alt="Logo" width="100">

        <!--Links-->
        <div class="links">
            <ul>
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="{{ route('links.aboutus') }}">Sobre nosotros</a></li>
                <li><a href="{{ route('links.legalnotice') }}">Avisos legales</a></li>
            </ul>
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var menuIcon = document.getElementById('menuIcon');
            var dropdownContent = document.querySelector('.dropdown-content');

            menuIcon.addEventListener('click', function() {
                // Alternar la visibilidad del menú desplegable al hacer clic en el icono
                dropdownContent.style.display = (dropdownContent.style.display === 'none' || dropdownContent
                    .style.display === '') ? 'block' : 'none';

                // Alternar la clase que deshabilita la interacción y el scroll
                document.body.classList.toggle('disable-interaction');
            });

            // Opcional: cerrar el menú desplegable al hacer clic fuera de él
            document.addEventListener('click', function(event) {
                if (!menuIcon.contains(event.target) && !dropdownContent.contains(event.target)) {
                    dropdownContent.style.display = 'none';
                    // Remover la clase que deshabilita la interacción y el scroll al cerrar el menú
                    document.body.classList.remove('disable-interaction');
                }
            });
        });
    </script>
</nav>
