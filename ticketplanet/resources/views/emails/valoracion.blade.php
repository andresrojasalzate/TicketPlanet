<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Valoración Evento</title>
</head>
<body>

    <div class="img-showEvent">
        <img src="{{ asset('images/fotos-subidas/' . $evento->image) }}" alt="" width="300">
    </div>

    <p>Hola {{ $usuario->name }},</p>
    
    <p>Esperamos que hayas disfrutado del evento. Nos encantaría escuchar tu opinión sobre cómo fue tu experiencia. 
        <br>¿Puedes dedicarnos unos minutos para compartir tus comentarios?</p>
    
    <a href="{{ route('valoracion.form', ['eventoId' => $evento->id]) }}"><button>Valora a {{ $evento->name }}</button></a>
    
    <p>Saludos,<br>{{ config('app.name') }}</p>

    <img src="{{ asset('images/logo.jpg') }}" alt="logo" width="55">
    <img src="{{ asset('images/LogoNombre.png') }}" alt="logo con Nombre">
</body>
</html>