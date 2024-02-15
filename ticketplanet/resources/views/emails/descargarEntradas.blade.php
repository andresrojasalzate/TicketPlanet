<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Valoración Evento</title>
</head>
<body>
    <h1>DESCARGUE SUS ENTRADAS</h1>
    <p>Descargue las entradas del evento de mañana en el siguiente enlace:</p>     
    <a href="{{ route('entradas.descargar.pdf', ['pdf' => $pdf]) }}"><button>Entradas</button></a>
    
    <p>Saludos,<br>{{ config('app.name') }}</p>

    <img src="{{ asset('images/logo.jpg') }}" alt="logo" width="55">
    <img src="{{ asset('images/LogoNombre.png') }}" alt="logo con Nombre">
</body>
</html>