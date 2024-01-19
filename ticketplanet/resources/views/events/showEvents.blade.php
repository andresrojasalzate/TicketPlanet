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

                @if ($evento->sessions && count($evento->sessions) > 0)
                    <div class="select-wrapper">
                        <select id="dropdownSesiones" name="sesion">
                            <option value="" disabled selected>Selecciona un dia...</option>
                            @foreach ($evento->sessions as $sesion)
                                <option value="{{ $sesion->id }}">{{ $sesion->date }}</option>
                            @endforeach
                        </select>
                    </div>

                    <ul>
                        @foreach ($evento->sessions as $sesion)
                            <li>{{ $sesion->time }}</li>
                        @endforeach
                    </ul>
                @else
                    <p>No hay sesiones disponibles.</p>
                @endif
            </div>
        </div>
    </div>
@endsection
