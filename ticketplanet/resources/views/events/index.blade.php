@extends('layouts.app')

@section('title', "Eventos") 

@section('content')

<div class="layout">
   
    <x-buscador :categories="$categories"/>
    @if(($textoIntroducido !== null || $categoriFiltrada !== null) && ($events !== null && !$events->isEmpty()))
        <div class="resultado-busqueda">
            <p>Eventos encontrados para: 
            {{$textoIntroducido}}
                @if($textoIntroducido !== null && $categoriFiltrada !==  null)
                <span>y</span>
                @endif
            {{$categoriFiltrada}}
            </p>
        </div>
    @endif

    @if($events != null && !$events->isEmpty())
        <div class="event-counter">
            
            @foreach ($events as $event)             
                <x-event-component :event="$event" />        
            @endforeach
        </div>

        <div class="contenedor-pagination-menu">
            {{ $events->links()}} 
        </div>
    @else
        <div class="eventos-no-encontrados">
            <p>No se han encotrado eventos</p>
        </div>    
    @endif

</div>
<script src="{{ asset('js/home.js') }}"></script>
@endsection
