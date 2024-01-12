<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
  <title>Document</title>
</head>
<body>
  <header>
    <x-header/>
</header>
<div class="contenedorLayout">
  <fieldset class="contenedorFormulario">
    <legend>Crear evento</legend>

  <form class="formulario" action="" method="post">
    @csrf
  <div class="formulario1">
    <label for="title">Titulo</label>
    <input type="text" name="title" id="title">

    <label for="Categoria">Categoria</label>
    <input type="text" name="categoria" id="categoria">

    <label for="Imatge Principal de l'esdeveniment">Imatge principal de l'esdeveniment</label>
    <input type="file" name="imatgeEsdeveniment" id="imatgeEsdeveniment">

    <label for="Descripcio Esdeveniment">Descripcio Esdeveniment</label>
    <input type="text" name="descripcioEsdeveniment" id="descripcioEsdeveniment">

  </div>
  <div class="formulario2">
    <label for="Provincia">Provincia</label>
    <input type="text" name="provincia" id="provincia">

    <label for="Ciutat">Ciutat</label>
    <input type="text" name="ciutat" id="ciutat">

    <label for="Codi Postal">Codi Postal</label>
    <input type="number" name="codiPostal" id="codiPostal">

  </div>
  <div class="formulario3">
    <label for="Nom del local">Nom del Local</label>
    <input type="text" name="nomLocal" id="nomLocal">

    <label for="Capacitat del local">Capacitat del local</label>
    <input type="number" name="capacitatLocal" id="capacitatLocal">

    <label for="Data celebracio">Data celebracio</label>
    <input type="date" name="dataCelebracio" id="dataCelebracio">

    <label for="Hora celebracio">Hora celebracio</label>
    <input type="time" name="horaCelebracio" id="horaCelebracio">

    <label for="Aforament Maxin">Aforament Maxim</label>
    <input type="number" name="aforamentMaxim" id="aforamentMaxim">

    <label for="Video Promocional">Video Promocional</label>
    <input type="url" name="horaCelebracio" id="horaCelebracio">

    <button type="submit">Crear evento</button>
  </div>
  </form>
</fieldset>

  <fieldset class="contenedorFormulario">
    <layout>Entradas</layout>

    <form class="formulario" action="" method="post">
      <div class="formulario1">
        <label for="title">Prueba</label>
        <input type="text" name="title" id="title">
    
      </div>
    </form>

  </fieldset>

</div>
<footer>
  <x-footer/>
</footer>
</body>
</html>