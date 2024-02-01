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
                        <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($evento->address) }}"
                            target="_blank">
                            <img src="{{ asset('images/eventos/iconGoogleMaps.png') }}" alt="Icono de Ubicación"
                                width="15" height="20">
                        </a>
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
                    <input type="number" name="cantidad_entradas[{{ $ticket->id }}]" value="0" min="0"
                        max="9999" maxlength="4" oninput="limitarLongitud(this);">
                </div>
            @endforeach

            <div id="total-price-container">
                <img src="{{ asset('images/eventos/shop.png') }}" alt="">
                <p>Total: <span id="total-price">0€</span></p>
                <button id="buy-button">Comprar</button>
            </div>

        </div>
        <hr>
        <div class="card-showComents">
            <h3>RESEÑAS:</h3>
            @if ($valoraciones)
                @if ($valoraciones->count() > 0)
                    @foreach ($valoraciones as $valoracion)
                        <div class="reseña">
                            <div class="reseñaCara">
                                <img src="{{ asset('images/valoracion/faces/' . $valoracion->caraSeleccionada . '.png') }}"
                                    width="90">
                            </div>
                            <div class="reseñaTexto">
                                <div class="reseñaComentario">
                                    <p><strong>{{ $valoracion->tituloComentario }}</strong></p>
                                    <p>{{ $valoracion->comentario }}</p>
                                </div>
                                <div class="reseñaNombre">
                                    <p><i>~ {{ $valoracion->nombre }}</i></p>
                                </div>
                            </div>
                            <div class="reseñaEstrellas">
                                @php
                                    $puntuacion = $valoracion->puntuacionSeleccionada;
                                    $numEstrellas = min($puntuacion, 5); // Limita el número de estrellas a 5
                                    $numEstrellasRestantes = max(0, 5 - $puntuacion); // Calcula las estrellas restantes
                                @endphp
                                @for ($i = 0; $i < $numEstrellas; $i++)
                                    <img src="{{ asset('images/valoracion/star/star1-4.png') }}" width="20"
                                        alt="Estrella">
                                @endfor
                                @for ($i = 0; $i < $numEstrellasRestantes; $i++)
                                    <img src="{{ asset('images/valoracion/star/starNegra.png') }}" width="20"
                                        alt="Estrella">
                                @endfor
                            </div>

                            <!-- Aquí puedes agregar la lógica para mostrar las estrellas -->
                        </div>
                    @endforeach
                @else
                    <p>No hay comentarios para este evento.</p>
                @endif
            @else
                <p>No hay comentarios para este evento.</p>
            @endif
        </div>


    </div>
    <script src="{{ asset('js/showEvent.js') }}"></script>
@endsection
