@extends('layouts.app')

@section('title', "Tus sesiones") 
@section('meta_description', 'Listado de tus sesiones')

@section('content')
<h1 class="titulo-sessions-promotor">TUS SESIONES</h1>
<div class="mostar-sesiones-promotor">
@if ($sessions != null && !$sessions->isEmpty())
    @foreach ($sessions as $session)
        <x-mostrar-session-promotor :session="$session"/>
    @endforeach
@else
    <div class="eventos-no-encontrados">
        <p>No se han encotrado sesiones</p>
    </div>
@endif
</div>

<script src="{{ asset('js/sessionPromotor.js') }}"></script>
@endsection