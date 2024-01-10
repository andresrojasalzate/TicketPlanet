<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="shortcut icon" href="favicon/logoFavicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>

<body>
    <header>
        <x-header/>
    </header>
    
    <div class="layout">
    <div class="contenedorBuscador">
      <form class="form-buscador" action="{{ route('events.search') }}" method="post">
        @csrf
        <img class="imagenLupa" src="images/buscador/lupa.png" alt="" height="30">
            <input class="buscador" type="search" placeholder="Buscar">
            <img class="imagenFiltrar" src="images/buscador/filter.png" alt="" height="30">
            <button class="botonBuscador" type="button">Buscar</button>
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
            @foreach ($events as $event)
                <div>
                    <x-event-component :event="$event" />
                </div>
            @endforeach
        </div>

        <div class="contenedor-pagination-menu">
            {{ $events->links() }} 
        </div>

    </div>
    
    <footer>
        <x-footer/>
    </footer>
</body>

</html>
