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
            <img class="imagenLupa" src="images/buscador/lupa.png" alt="" height="30">
            <input class="buscador" type="search" placeholder="Buscar">
            <img class="imagenFiltrar" src="images/buscador/filter.png" alt="" height="30">
            <button class="botonBuscador" type="button">Buscar</button>
        </div>
        <div class="event-counter">
            @foreach ($events as $event)
                <div>
                    <x-event-component :event="$event" />
                </div>
            @endforeach
        </div>
    </div>

    <footer>
        <x-footer/>
    </footer>
</body>

</html>
