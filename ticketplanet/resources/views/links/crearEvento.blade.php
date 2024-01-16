<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="shortcut icon" href="favicon/logoFavicon.ico" type="image/x-icon">
  <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
  <header>
    <x-header/>
</header>
<div class="contenedorLayout">
  <form action="" method="post">
    @csrf
    <div class="div1">
      <div class="parte1formulario">

        <label for="title">Titulo</label>
        <input type="text" name="title" id="title">
      
        <label for="Categoria">Categoria</label>
        <input type="text" name="categoria" id="categoria">
    </div>
    

  <div class="parte2formulario">
    <div class="descripcionFormulario">

      <label for="Descripcion Esdeveniment">Descripcion Esdeveniment</label>
      <input class="descripcionFormularioInput" type="text" name="descripcioEsdeveniment" id="descripcioEsdeveniment">

    </div>
      
    
    <div class="videoFormulario">

      <label for="Video Promocional">Video Promocional</label>
      <input class="videoFormularioInput" type="url" name="videoPromocional" id="videoPromocional">

    </div>

    </div>

    <div class="parte3formulario">
      
      <label for="Imagen Principal de l'esdeveniment">Imagen principal de l'esdeveniment</label>
      <input type="file" name="imagenEsdeveniment" id="imagenEsdeveniment">
      
    </div>
    </div>
      
    <div class="div2">
      <div class="parte4formulario">

        <div class="nombreLocalFormulario">  

          <label for="Nombre del local">Nombre del Local</label>
          <input class="nombreLocalFormularioInput" type="text" name="nombreLocal" id="nombreLocal">

        </div>

        <div class="capacidadLocalFormulario">

          <label for="Capacidad del local">Capacidad del local</label>
          <input class="capacidadLocalFormularioInput" type="number" name="capacidadLocal" id="capacidadLocal">

        </div>

  
      </div>
      
    <div class="parte5formulario">
      <div class="provinciaFormulario">

        <label for="Provincia">Provincia</label>
        <input class="provinciaFormularioInput" type="text" name="provincia" id="provincia">

      </div>
    
      <div class="ciudadFormulario">

        <label for="Ciudad">Ciudad</label>
        <input class="ciudadFormularioInput" type="text" name="ciudad" id="ciudad">

      </div>

      <div class="codigoPostalFormulario">

        <label for="Codigo Postal">Codigo Postal</label>
        <input class="codigoPostalFormularioInput" type="number" name="codigoPostal" id="codigoPostal">
          
      </div>


    </div>
    
    <div class="parte6formulario">

      <div class="fechaCelebracionFormulario">

        <label for="Fecha celebracion">Fecha celebracion</label>
        <input class="fechaCelebracionFormularioInput" type="date" name="fechaCelebracion" id="fechaCelebracion">

      </div>

      <div class="horaCelebracionFormulario">

        <label for="Hora celebracion">Hora celebracion</label>
        <input class="horaCelebracionFormularioInput" type="time" name="horaCelebracion" id="horaCelebracion">

      </div>

      <div class="aforoMaximoFormulario">

        <label for="Aforo Maximo">Aforo Maximo</label>
        <input class="aforoMaximoFormularioInput" type="number" name="aforoMaximo" id="aforoMaximo">

      </div>
  


    </div>
    <button class="btnEntradas" type="submit">Entradas</button>
    </div>
      
    

    

  </form>
  <a href="{{ route('links.comprarEntradas') }}">Entradas</a>
</div>
<footer>
  <x-footer/>
</footer>
</body>
</html>