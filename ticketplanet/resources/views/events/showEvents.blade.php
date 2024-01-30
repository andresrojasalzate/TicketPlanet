@extends('layouts.app')

@section('title', 'Show Events')

@section('content')
    <div class="card-margin">
        <div class="card-showEvent">
            <div class="img-showEvent">
                <img src="{{ asset('images/fotos-subidas/' . $evento->image) }}" alt="">

            </div>
            <div class="info-showEvent">
                <h2>{{ $evento->name }}</h2>

                <p>{{ $evento->description }}</p>
                <form method="POST" action="{{ route('enviar.correo.valoracion') }}">
                    @csrf
                    <input type="hidden" name="evento" value="{{ $eventoId }}">
                    <button type="submit">Enviar correo Valoración</button>
                </form>

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
                                <option value="" disabled selected>Selecciona un día...</option>
                                @foreach ($evento->sessions as $sesion)
                                    <option value="{{ $sesion->id }}" data-date="{{ $sesion->date }}">{{ $sesion->date }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <ul class="card-timeSesion">
                            @foreach ($evento->sessions as $sesion)
                                <li class="session-time" data-date="{{ $sesion->date }}" style="display: none;">
                                    {{ $sesion->time }}</li>
                            @endforeach
                        </ul>
                    @else
                        <p>No hay sesiones disponibles.</p>
                    @endif
                </div>
            </div>
        </div>
        <div class="card-showTickets">
            @foreach ($tickets as $ticket)
                <div class="ticket-container">
                    <h3>{{ $ticket->name }}, {{ $ticket->price }}€</h3>
                    <input type="number" name="cantidad_entradas[{{ $ticket->id }}]" value="0" min="0" max="9999" maxlength="4" oninput="limitarLongitud(this);">
                </div>
            @endforeach

            <div id="total-price-container">
                <img src="{{ asset('images/eventos/shop.png') }}" alt="">
                <p>Total: <span id="total-price">0€</span></p>
                <button id="buy-button">Comprar</button>
            </div>
            <hr>
        </div>
        
        
    </div>
    <script src="{{ asset('js/showEvent.js') }}"></script>
@endsection
