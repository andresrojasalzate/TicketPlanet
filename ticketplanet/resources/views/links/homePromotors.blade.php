<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="favicon/logoFavicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/styleSASS.css') }}">
</head>

<body>
    <header>
        <x-header />
    </header>
    <div class="layoutHomePromotor">
      <a href="{{ route('links.crearEvento') }}">Crear evento</a>
    </div>

  <footer>
    <x-footer />
</footer>
</body>
</html>