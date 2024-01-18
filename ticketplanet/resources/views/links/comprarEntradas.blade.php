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
    <x-header/>
  </header>

  <form action="{{ route('links.storeComprarEntradas') }}" method="post">
      @csrf
      <div class="contenedorNombreEntradas">

        <div class="nombreEntradas">

          <label for="nombre">Nombre</label>
          <input class="nombreEntradasInput" type="text" name="name" id="nombre">

        </div>


      </div>

      <div class="precioCantidadEntradas">

        <div class="precioEntradas">

          <label for="precio">Precio</label>
          <input class="precioEntradasInput" type="text" name="price" id="precio">
  
        </div>
  
        <div class="cantidadEntradas">
  
          <label for="cantidad">Cantidad Entradas</label>
          <input class="cantidadEntradasInput" type="text" name="quantity" id="cantidadEntradas">
  
        </div>

      </div>

      <div class="entradasNominales">

        <label for="entradasNominales">Entradas Nominales</label>

      </div>
      <div class="entradasNominalesEleccion">

        <div class="eleccionSi">

          <input type="radio" name="nominal" value="true">Si

        </div>

        <div class="eleccionNo">

          <input type="radio" name="nominal" value="false">No

        </div>
        

      </div>
      <button class="btnCrearEvento" type="submit">Crear Eventos</button>

  </form>

  <footer>
    <x-footer/>
  </footer>
</body>
</html>