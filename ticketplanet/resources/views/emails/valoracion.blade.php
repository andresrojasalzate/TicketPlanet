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
    
    <p>Nos interesa tu punto de vista.<br>Trabajamos arduamente para asegurar una experiencia sin problemas. 
        Desde la compra de tus entradas hasta tu llegada al evento. Por eso, nos gustaría conocer tu experiencia.</p>
    
    <a href="{{ route('valoracion.form', ['eventoId' => $evento->id]) }}"><button>Valora a {{ $evento->name }}</button></a>
    
    <p>Saludos,<br>{{ config('app.name') }}</p>

    <img src="{{ asset('images/logo.jpg') }}" alt="logo" width="55">
    <img src="{{ asset('images/LogoNombre.png') }}" alt="logo con Nombre">
</body>
</html>