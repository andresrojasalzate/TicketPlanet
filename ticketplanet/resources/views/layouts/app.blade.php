<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="favicon/logoFavicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <title>Document</title>
</head>

<body>
    <header>
        @include('components.header')
    </header>
    <div class="contenedorBuscador">
        <input class="buscador" type="search" placeholder="Buscar">
        <button class="btnBuscador" type="button">Buscar</button>
    </div>

    <footer>
        @include('components.footer')
    </footer>
</body>

</html>
