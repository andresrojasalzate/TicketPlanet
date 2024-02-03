@extends('layouts.app')

@section('title', 'Home Promotor')

@section('content')
    <div class="btnHomePromotor">
        <button class="btnCrearEvent" onclick="window.location='{{ route('links.crearEvento') }}'">Crear evento</button>
        <button class="btnCrearEvent" onclick="window.location='{{ route('links.administrarEvents') }}'">Administrar evento</button>
        <button class="btnCrearEvent" onclick="window.location='{{ route('links.sessionEvents') }}'">Crear sesiones</button>
        <button class="btnCrearEvent" onclick="window.location='{{ route('sessions.promotor') }}'">Administrar sesiones</button>
        <!--<div class="btnCrearEvent">
            <a href="{{ route('links.crearEvento') }}">Crear evento</a>
        </div>

        <div class="btnAdministrarEvent">
            <a href="{{ route('links.administrarEvents') }}">Administrar evento</a>
        </div>

        <div class="btnListarSesionEvent">
            <a href="{{ route('links.sessionEvents') }}">Crear sesiones</a>
        </div>
        <div class="btnCrearEvent">
            <a href="{{ route('sessions.promotor') }}">Administrar sesiones</a>
        </div>-->
    </div>


@endsection
