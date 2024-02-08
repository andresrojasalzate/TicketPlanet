@extends('layouts.app')

@section('title', 'Crear Sesiones')

@section('content')


@if ($sessions != null && !$sessions->isEmpty())
    @foreach ($sessions as $session)
        <x-editar-session-promotor :session="$session"/>
    @endforeach
@else
    <div class="eventos-no-encontrados">
        <p>No se han encotrado sesiones</p>
    </div>
@endif


@endsection 