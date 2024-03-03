<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Valoración Evento</title>
</head>
<body>
    <p>{{$event->name}}</p>
    <p>{{$session->date}}</p>
    <p>{{$session->time}}</p>     
    <a href="{{ route('events.mostrar', ['id' => $event->id]) }}"><button>{{ $event->name }}</button></a>
    
    <p>Saludos,<br>{{ config('app.name') }}</p>

    <img src="{{ asset('images/logo.jpg') }}" alt="logo" width="55">
    <img src="{{ asset('images/LogoNombre.png') }}" alt="logo con Nombre">
</body>
</html>