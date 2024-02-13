@extends('layouts.app')

@section('title', 'Compra')

@section('content')
    <div class="card-compra">
        <div id="countdown-container">
            <div id="countdown" data-event-route="{{ route('events.mostrar', ['id' => $evento->id]) }}"></div>
        </div>
        <hr>

        <!-- Formulario para realizar la compra -->
        <form method="POST" action="{{ route('compra.almacenar') }}">
            @csrf
            @if ($errors->any())
                <div class="mensaje-error">
                    @foreach ($errors->unique() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <div class="contenedor-compra">
                <div class="compra-datosUser">
                    <h2>Información del comprador:</h2>
                    <div class="datosUser-correo">
                        <label for="email">Correo electrónico:</label>
                        <input type="email" name="email" value="{{ old('email') }}" maxlength="60">
                    </div>

                    @if ($hayNoNominal)
                        <div class="datosUser-nombre">
                            <label for="comprador_name">Nombre:</label>
                            <input type="text" name="comprador_name" value="{{ old('user_name.0') }}"
                                requiredmaxlength="9">
                        </div>
                        <div class="datosUser-dni">
                            <label for="comprador_dni">DNI:</label>
                            <input type="text" name="comprador_dni" value="{{ old('dni.0') }}" required maxlength="9">
                        </div>
                        <div class="datosUser-telefono">
                            <label for="comprador_phone">Teléfono:</label>
                            <input type="tel" name="comprador_phone" value="{{ old('phone.0') }}" required
                                maxlength="9">
                        </div>
                    @endif

                    @foreach ($tickets as $ticket)
                        @if ($cantidadEntradas[$ticket->id] > 0)
                            <div>
                                @if ($ticket->nominal)
                                <br>
                                    <h3>Asistentes para {{ $ticket->name }}</h3>
                                    @for ($i = 0; $i < $cantidadEntradas[$ticket->id]; $i++)
                                        <div class="datosUser-nombre">
                                            <label for="user_name[]">Nombre:</label>
                                            <input type="text" name="user_name[]" value="{{ old('user_name.' . $i) }}"
                                                required maxlength="35">
                                        </div>
                                        <div class="datosUser-dni">
                                            <label for="dni[]">DNI:</label>
                                            <input type="text" name="dni[]" value="{{ old('dni.' . $i) }}" required
                                                maxlength="9">
                                        </div>
                                        <div class="datosUser-telefono">
                                            <label for="phone[]">Teléfono:</label>
                                            <input type="tel" name="phone[]" value="{{ old('phone.' . $i) }}" required
                                                maxlength="9">
                                        </div>
                                        <input type="hidden" name="ticket_id[]" value="{{ $ticket->id }}">
                                        <br>
                                    @endfor
                                @else
                                    <input type="hidden" name="tickets_noNomial[]" value="{{ $ticket->id }}">
                                    <input type="hidden" name="ticketNoNomial_quantity[{{ $ticket->id }}]"
                                        value="{{ $cantidadEntradas[$ticket->id] }}">
                                @endif
                            </div>
                            <!--Campos ocultos que se pasan para almacenar en la base de datos-->
                            <input type="hidden" name="selected_date" value="{{ $selectedDate }}">
                            <input type="hidden" name="selected_time" value="{{ $selectedTime }}">
                            <input type="hidden" name="ticket_name[]" value="{{ $ticket->name }}">
                            <input type="hidden" name="ticket_quantity[]" value="{{ $cantidadEntradas[$ticket->id] }}">
                            <input type="hidden" name="session_id" value="{{ $sesionId }}">
                            <!--<input type="hidden" name="ticket_id[]" value="{{ $ticket->id }}">-->
                        @endif

                    @endforeach
                </div>
                <div class="compra-infoEntradas">
                    <div class="contenedor-info">
                        <div class="infoEntradas-evento">
                            <h2> {{ $evento->name }}<h2>
                        </div>
                        <div>
                            <h4>Entradas:</h4>
                        </div>
                        @foreach ($tickets as $ticket)
                            @if ($cantidadEntradas[$ticket->id] > 0)
                                <div class="infoEntradas">
                                    <p class="entry-title">
                                        <span class="ticket-name">{{ $ticket->name }}</span>
                                        <span>{{ $cantidadEntradas[$ticket->id] }}</span>
                                    </p>
                                </div>
                                {{-- <div class="infoEntradas-cantidad">
                                <p>Cantidad seleccionada: </p>
                            </div> --}}
                                <!-- Añadir un campo ticket_quantity específico para cada tipo de entrada -->
                                <!--<input type="hidden" name="ticket_quantity[{{ $ticket->id }}]"
                                                value="{{ $cantidadEntradas[$ticket->id] }}">-->
                            @endif
                        @endforeach

                        <div class="infoEntradas-fecha">
                            <p>Fecha: {{ $selectedDate }}</p>
                        </div>
                        <div class="infoEntradas-hora">
                            <p>Hora: {{ $selectedTime }}</p>
                        </div>
                        <br>
                        <div class="infoEntradas-precioTotal">
                            <p>Precio Total: <strong>{{ $totalPrice }}€</strong></p>
                        </div>

                    </div>
                    <button type="submit" class="btn-comprar">Realizar Compra</button>
                </div>

            </div>
        </form>
    </div>

@endsection
@section('scripts')
    <script src="{{ asset('js/compra.js') }}"></script>
@endsection
