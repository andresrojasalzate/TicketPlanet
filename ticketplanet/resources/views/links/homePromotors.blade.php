@extends('layouts.app')

@section('title', 'Home Promotor')

@section('content')
    <div class="btnHomePromotor">
        <button class="btnCrearEvent" onclick="window.location='{{ route('links.crearEvento') }}'">Crear evento</button>
        <button class="btnCrearEvent" onclick="window.location='{{ route('links.administrarEvents') }}'">Administrar evento</button>
        <button class="btnCrearEvent" onclick="window.location='{{ route('links.sessionEvents') }}'">Crear sesiones</button>
        <button class="btnCrearEvent" onclick="window.location='{{ route('sessions.promotor') }}'">Administrar sesiones</button>
    </div>


@endsection
