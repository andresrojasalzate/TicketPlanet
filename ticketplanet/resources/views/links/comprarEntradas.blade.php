<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="shortcut icon" href="favicon/logoFavicon.ico" type="image/x-icon">
  <link rel="stylesheet" href="{{ asset('css/styleSASS.css') }}">
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
          <input class="nombreEntradasInput" type="text" name="name" id="nombre" value="{{old('name')}}">
          @error('name')
          <small style="color: red">{{ $message }}</small>
      @enderror

        </div>


      </div>

      <div class="entradasPrecioCantidad">

        <div class="entradasPrecio">

          <label for="precio">Precio</label>
          <input type="text" name="price" id="precio" value="{{old('price')}}" >
          @error('price')
          <small style="color: red">{{ $message }}</small>
      @enderror
  
        </div>
  
        <div class="entradasCantidad">
  
          <label for="cantidad">Cantidad Entradas</label>
          <input type="text" name="quantity" id="cantidadEntradas" value="{{old('quantity')}}">
          @error('quantity')
          <small style="color: red">{{ $message }}</small>
      @enderror
  
        </div>

      </div>

      <div class="entradasNominales">

        <label for="entradasNominales">Entradas Nominales</label>
        

      </div>
      <div class="entradasNominalesEleccion">

        <div class="eleccionSi">

          <input type="radio" name="nominal" value="true" {{ old('nominal') == 'true' ? 'checked' : '' }}>Si

        </div>

        <div class="eleccionNo">

          <input type="radio" name="nominal" value="false" {{ old('nominal') == 'false' ? 'checked' : '' }}>No

        </div>


      </div>
      @error('nominal')
      <small style="color: red;display: flex;justify-content: center;">{{ $message }}</small>
  @enderror
      <button class="btnCrearEvento"type="submit">Crear Entrada</button>

  </form>


  <footer>
    <x-footer/>
  </footer>
  <script></script>
</body>
</html>