@extends('layouts.app')

@section('title', 'Show Events')

@section('content')
    <div class="card-showEvent">
        <img src="">
        <div class="info-showEvent">
            <h2>{{ $evento->titulo }}</h2>

            <p>{{ $evento->descripcion }}</p>
    
            <div class="ubicacion">
                <img src="{{ asset('images/icono-ubicacion.png') }}" alt="Icono de Ubicación" width="20" height="20">
                <span>{{ $evento->ubicacion }}</span>
            </div>
    
            <p>Sesiones:</p>
            <ul>
                {{-- @foreach($evento->sesiones as $sesion)
                    <li>{{ $sesion->fecha }} - {{ $sesion->hora }}</li>
                @endforeach --}}
            </ul>
    
            <div>
                <label for="dropdownSesiones">Selecciona una sesión:</label>
                <select id="dropdownSesiones" name="sesion">
                    {{-- @foreach($evento->sesiones as $sesion)
                        <option value="{{ $sesion->id }}">{{ $sesion->fecha }} - {{ $sesion->hora }}</option>
                    @endforeach --}}
                </select>
            </div>
        </div>
    </div>
@endsection
