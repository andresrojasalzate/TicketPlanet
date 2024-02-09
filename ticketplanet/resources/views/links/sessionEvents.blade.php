<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="favicon/logoFavicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/styleSASS.css') }}">
    <title>@yield('title')</title>
</head>

<body>
    <header>
        <x-header/>
    </header>

@if(Session::has('success'))
<div class="alert-success" id="success-alert">
{{ Session::get('success') }}
        <button type="button" class="cerrarFeedback">
<span aria-hidden="true">&times;</span>
</button>
@endif
</div>

    <div class="layout">
        @if ($events != null && !$events->isEmpty())
            <div class="event-counter">

                @foreach ($events as $event)
                    <div>
                        <x-event-promotor-component-session :event="$event" />
                    </div>
                @endforeach
            </div>

            <div class="contenedor-pagination-menu">
                {{ $events->links() }}
            </div>
        @else
            <div class="eventos-no-encontrados">
                <p>No se han encotrado eventos</p>
            </div>
        @endif
    </div>
    <script src="{{ asset('js/evento.js') }}"></script>
<footer>
        <x-footer/>
    </footer>
</body>

</html>