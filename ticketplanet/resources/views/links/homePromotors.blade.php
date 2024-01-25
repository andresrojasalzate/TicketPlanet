@extends('layouts.app')

@section('title', 'Home Promotor')

@section('content')
    <div class="btnCrear">
        <a href="{{ route('links.crearEvento') }}">Crear evento</a>
    </div>

    <div class="btnAdministrarEvento">
        <a href="{{ route('links.administrarEvents') }}">Administrar evento</a>
    </div>

    <div class="btnListarSesionEvento">
        <a href="{{ route('links.crearEvento') }}">Crear sesiones</a>
    </div>

@endsection
