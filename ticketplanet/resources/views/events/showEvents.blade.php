@extends('layouts.app')

@section('title', 'Show Events')

@section('content')
    <div class="card-showEvent">
        <div class="img-showEvent">
            <img src="{{ asset('images/eventos/festival.jpg') }}" alt="" width="100%">
        </div>
        <div class="info-showEvent">
            <h2>{{ $evento->name }}</h2>

            <p>{{ $evento->description }}</p>

            <div class="ubicacion-showEvent">
                <div class="ubicacion-title-showEvent">
                    <h3>Ubicación</h3>
                    <img src="{{ asset('images/eventos/iconGoogleMaps.png') }}" alt="Icono de Ubicación" width="15"
                        height="20">
                </div>
                <p>{{ $evento->address }}</p>
            </div>

            <div class="sesions-showEvent">
                <h3>Sesiones:</h3>

                @if ($evento->sesiones && count($evento->sesiones) > 0)
                    <div class="select-wrapper">
                        <select id="dropdownSesiones" name="sesion">
                            <option value="" disabled selected>Selecciona un dia</option>
                            @foreach ($evento->sesiones as $sesion)
                                <option value="{{ $sesion->id }}">{{ $sesion->fecha }} - {{ $sesion->hora }}</option>
                            @endforeach
                        </select>
                    </div>

                    <ul>
                        @foreach ($evento->sesiones as $sesion)
                            <li>{{ $sesion->fecha }} - {{ $sesion->hora }}</li>
                        @endforeach
                    </ul>
                @else
                    <p>No hay sesiones disponibles.</p>
                @endif
            </div>
        </div>
    </div>
@endsection
