@extends('layouts.app')

@section('title', "Tus sesiones") 

@section('content')
<h1 class="titulo-sessions-promotor">TUS SESIONES</h1>
<div class="mostar-sesiones-promotor">
@if ($events != null && !$events->isEmpty())
    @foreach ($events->sessions as $session)
        <x-mostrar-session-promotor :event = $event>
    @endforeach
@else
    <div class="eventos-no-encontrados">
        <p>No se han encotrado sesiones</p>
    </div>
@endif
</div>

<script src="{{ asset('js/sessionPromotor.js') }}"></script>
@endsection