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

  <form action="" method="post">
    <label for="title"></label>
    <input type="text" name="title" id="title" placeholder="Titulo evento">

    <label for="Categoria"></label>
    <input type="text" name="categoria" id="categoria" placeholder="Categoria evento">

    <label for="Provincia"></label>
    <input type="text" name="provincia" id="provincia">

    <label for="Ciutat"></label>
    <input type="text" name="ciutat" id="ciutat">

    <label for="Codi Postal"></label>
    <input type="number" name="codiPostal" id="codiPostal">

    <label for="Nom del local"></label>
    <input type="text" name="nomLocal" id="nomLocal">

    <label for="Capacitat del local"></label>
    <input type="number" name="capacitatLocal" id="capacitatLocal">

    <label for="Imatge Principal de l'esdeveniment"></label>
    <input type="file" name="imatgeEsdeveniment" id="imatgeEsdeveniment">

    <label for="Descripcio Esdeveniment"></label>
    <input type="text" name="descripcioEsdeveniment" id="descripcioEsdeveniment">

    <label for="Data celebracio"></label>
    <input type="date" name="dataCelebracio" id="dataCelebracio">

    <label for="Hora celebracio"></label>
    <input type="time" name="horaCelebracio" id="horaCelebracio">

    <label for="Aforament Maxin"></label>
    <input type="number" name="aforamentMaxim" id="aforamentMaxim">

    <label for="Video Promocional"></label>
    <input type="text" name="horaCelebracio" id="horaCelebracio">

    <button type="submit">Crear evento</button>
  </form>

<footer>
  <x-footer/>
</footer>
</body>
</html>