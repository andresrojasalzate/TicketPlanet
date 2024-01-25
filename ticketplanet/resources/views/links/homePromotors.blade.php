@extends('layouts.app')

@section('title', 'Home Promotor')

@section('content')
    <div class="btnHomePromotor">
        <div class="btnCrearEvent">
            <a href="{{ route('links.crearEvento') }}">Crear evento</a>
        </div>

        <div class="btnAdministrarEvent">
            <a href="{{ route('links.administrarEvents') }}">Administrar evento</a>
        </div>

        <div class="btnListarSesionEvent">
            <a href="{{ route('links.crearEvento') }}">Crear sesiones</a>
        </div>
    </div>


@endsection
