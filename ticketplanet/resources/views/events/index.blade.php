@extends('layouts.app')

@section('title', "Eventos") 

@section('content')

<div class="layout">
    <x-buscador/>

    <div class="event-counter">
        @foreach ($events as $event)
            <div>             
                <x-event-component :event="$event" />        
            </div>
        @endforeach
    </div>

    <div class="contenedor-pagination-menu">
        {{ $events->links()}} 
    </div>

</div>
<script src="{{ asset('js/home.js') }}"></script>
@endsection
