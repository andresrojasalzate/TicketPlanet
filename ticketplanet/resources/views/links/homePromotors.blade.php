@extends('layouts.app')

@section('title', 'Home Promotor')

@section('content')
@if(Session::has('success'))
<div class="alert-success" id="success-alert">
{{ Session::get('success') }}
        <button type="button" class="cerrarFeedback">
<span aria-hidden="true">&times;</span>
</button>
@endif

</div>
    <div class="btnHomePromotor">
        <button class="btnCrearEvent" onclick="window.location='{{ route('links.crearEvento') }}'">Crear evento</button>
        <button class="btnCrearEvent" onclick="window.location='{{ route('links.administrarEvents') }}'">Administrar evento</button>
        <button class="btnCrearEvent" onclick="window.location='{{ route('links.sessionEvents') }}'">Crear sesiones</button>
        <button class="btnCrearEvent" onclick="window.location='{{ route('sessions.promotor') }}'">Administrar sesiones</button>
    </div>

    <script src="{{ asset('js/homePromotor.js') }}"></script>
@endsection
