<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <!--<script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp"></script>-->
  <link rel="stylesheet" href="{{ asset('css/styles.css') }}"> 
</head>
<body>
  <header>
  <div class="dropdown">
            <img class="menuIMG" src="{{ asset('images/menu.png') }}" alt="" width="100" height="100">

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
    <img src="{{ asset('images/usuario.png') }}" alt="User" width="50" height="50">
    <a href="">Acceder</a>
</div>
</div>

<!--Logo con el Nombre-->
<div class="navLogo">
<img src="{{ asset('images/LogoNombre.png') }}" alt="User">
<hr class="separator">
</div>
  </header>
  <div class="layout">
    <div class="contenedorBuscador">
      <form class="form-buscador" action="{{ route('events.search') }}" method="post">
        @csrf
        <img  class="imagenLupa" src="Imagenes/lupa.png" alt="" height="30">     
        <input class="buscador" type="search" name="busqueda" placeholder="Buscar">
        <img  class="ImagenFiltrar" src="Imagenes/Filtrar.png" alt="" height="30">
        <button class="botonBuscador" type="submit">Buscar</button>
        <div class="div_filtro">
          <p>Filtrar por categoria:</p>
          <select class="filtro" name="category">
            <option value="" disabled selected>Selecciona una opción</option>
            <option value="musica">Musica</option>
            <option value="teatro">Teatro</option>
            <option value="cine">Cine</option>
          </select>
        </div>
      </form>
    </div>
   <div class="event-counter">
      @foreach  ($events as $event)
        <div>
          <x-event-component :event="$event"/>
        </div>
      @endforeach
    </div>
    <div class="contenedor-pagination-menu">
      {{ $events->links() }} 
    </div>
  </div>
  
  <footer>
    <p class="item-1">Home Promotor</p>
    <p class="item-2">Sobre nosaltres</p>
    <p class="item-3">Avisos legales</p>
    <p class="item-4">Mostrar Esdeveniments</p>
    <p class="item-5">Comprar entrades</p>
  </footer>
  <script src="{{ asset('js/home.js') }}"></script>
</body>
</html>