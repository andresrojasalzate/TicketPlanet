@extends('layouts.app')

@section('title', 'Eventos del Promotor')

@section('content')
    <div class="layout">
        @if ($events != null && !$events->isEmpty())
            <div class="event-counter">

                @foreach ($events as $event)
                    <div>
                        <x-event-promotor-component :event="$event" />
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


@endsection
