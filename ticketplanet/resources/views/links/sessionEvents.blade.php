@extends('layouts.app')

@section('title', 'Crear Sesiones')

@section('content')

@if(Session::has('success'))
<div class="alert-success" id="success-alert">
{{ Session::get('success') }}
        <button type="button" class="cerrarFeedbackSuccess">
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
    <script src="{{ asset('js/FeedbackSesion.js') }}"></script>

@endsection