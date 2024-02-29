@extends('layouts.app')

@section('title', 'Información Evento')

@section('content')
    <div class="card-margin">

        <div class="card-showEvent">
            <div class="img-showEvent">
                @if ($evento->image && is_array(json_decode($evento->image)))
                    <div class="btnPrevImg">
                        @if (count(json_decode($evento->image)) > 1)
                            <button class="prev-image" onclick="prevImage()">◀</button>
                        @endif
                    </div>

                    <div class="image-container">
                        @foreach (json_decode($evento->image) ?? [] as $imagen)
                            <img class="gallery-image" src="{{ asset('images/fotos-subidas/' . $imagen) }}"
                                alt="Imagen del evento" loading="lazy">
                        @endforeach
                    </div>

                    <div class="btnPrevImg">
                        @if (count(json_decode($evento->image)) > 1)
                            <button class="next-image" onclick="nextImage()">▶</button>
                        @endif
                    </div>
                @else
                <div class="image-container">
                    <img class="gallery-image" src="{{ asset('images/fotos-subidas/' . $evento->image) }}" alt=""
                        loading="lazy">
                </div>
                @endif
            </div>
            <div class="info-showEvent">
                <h2>{{ $evento->name }}</h2>

                <p>{{ $evento->description }}</p>
                {{-- <form method="POST" action="{{ route('enviar.correo.valoracion') }}">
                    @csrf
                    <input type="hidden" name="evento" value="{{ $eventoId }}">
                    <button type="submit">Enviar correo Valoración</button>
                </form> --}}

                <div class="ubicacion-showEvent">
                    <div class="ubicacion-title-showEvent">
                        <h3>Ubicación</h3>
                        <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($evento->address) }}"
                            target="_blank">
                            <img src="{{ asset('images/eventos/iconGoogleMaps.png') }}" alt="Icono de Ubicación"
                                loading="lazy">
                        </a>
                    </div>
                    <p>{{ $evento->address }}</p>
                </div>
                <form method="GET" action="{{ route('mostrar.compra', ['evento_id' => $eventoId]) }}">
                    @csrf
                    <div class="sesions-showEvent">
                        <h3>Sesiones:</h3>

                        @if ($evento->sessions && count($evento->sessions) > 0)
                            <div class="select-wrapper">
                                <select id="dropdownSesiones" name="sesion">
                                    <option value="" disabled selected>Selecciona un día...</option>
                                    @foreach ($evento->sessions()->sessionState()->get() as $sesion)
                                        <option name="date" value="{{ $sesion->id }}"
                                            data-date="{{ $sesion->date }}">
                                            {{ $sesion->date }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <ul class="card-timeSesion">
                                @foreach ($evento->sessions as $sesion)
                                    <li class="session-time" name="time" data-date="{{ $sesion->date }}"
                                        style="display: none;">
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
                    <input type="number" name="sold_tickets[{{ $ticket->id }}]" value="0" min="0"
                        max="9999" maxlength="4" oninput="limitarLongitud(this);">
                </div>
            @endforeach
            <div id="total-price-container">
                <img src="{{ asset('images/eventos/shop.png') }}" alt="" loading="lazy">
                <p>Total: <span id="total-price">0€</span></p>
                <input type="hidden" name="evento" value="{{ $eventoId }}">
                <input type="hidden" name="total_price" id="total-price-input" value="0">
                <button id="buy-button">Comprar</button>
            </div>
            </form>
        </div>
        <!--Mensaje de error si no se selecciona ninguna entrada para proceder con la compra-->
        @if (session('error'))
            <div class="mensaje-error">
                {{ session('error') }}
            </div>
        @endif
        <hr>
        <div class="card-showComents">
            <h3>RESEÑAS:</h3>
            @if ($valoraciones)
                @if ($valoraciones->count() > 0)
                    @foreach ($valoraciones as $valoracion)
                        <div class="reseña">
                            <div class="reseñaCara">
                                <img src="{{ asset('images/valoracion/faces/' . $valoracion->caraSeleccionada . '.png') }}"
                                    width="90" loading="lazy">
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
                                        alt="Estrella" loading="lazy">
                                @endfor
                                @for ($i = 0; $i < $numEstrellasRestantes; $i++)
                                    <img src="{{ asset('images/valoracion/star/starNegra.png') }}" width="20"
                                        alt="Estrella" loading="lazy">
                                @endfor
                            </div>
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
@endsection
@section('scripts')
    <script src="{{ asset('js/showEvent.js') }}"></script>
@endsection
