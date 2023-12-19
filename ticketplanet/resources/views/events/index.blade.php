<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="{{ asset('css/styles.css') }}"> 
</head>
<body>
  <header>
    <div class="dropdown">
      <button class="botonDespegable"></button>
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

      <img  class="imagenUsuarioDespegable" src="{{ asset('images/logo.jpg') }}" alt="" width="80">
      </div>
    </div>
    <div class="header">
    <img src="{{ asset('images/logo.jpg') }}" alt="" height="50">

    <div class="h1">
      <p>Home</p>
      <p>Sobre nosotros</p>
      <p>Avisos Legales</p>
    </div>
    <img class="imagenUsuario"  src="{{ asset('images/usuario.png') }}" alt="" width="40">
    </div>
    <div class="nombre">

      <img class="imagenNombre" src="{{ asset('images/LogoNombre.png') }}" alt="" width="300">

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
      </form>
    </div>
   <div class="event-counter">
      @foreach  ($events as $event)
        <div>
          <x-event-component :event="$event"/>
        </div>
        
      @endforeach
    </div>
  </div>
  
  <footer>
    <p class="item-1">Home Promotor</p>
    <p class="item-2">Sobre nosaltres</p>
    <p class="item-3">Avisos legales</p>
    <p class="item-4">Mostrar Esdeveniments</p>
    <p class="item-5">Comprar entrades</p>
  </footer>
</body>
</html>