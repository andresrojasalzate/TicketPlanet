@extends('layouts.app')

@section('title', 'Compra')

@section('content')
    <div class="card-compra">
        <div id="countdown-container">
            <div id="countdown"></div>
        </div>
        <hr>
        <!-- Formulario para realizar la compra -->

        <form method="POST" action="{{ route('compra.almacenar') }}">
            @csrf
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif


            <div class="contenedor-compra">
                <div class="compra-datosUser">
                    <h2>Introduce tus datos:</h2>
                    <div class="datosUser-correo">
                        <label for="email">Correo electrónico:</label>
                        <input type="email" name="email" value="{{ old('email') }}" maxlength="50">
                        @error('email')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    @foreach ($tickets as $ticket)
                        @if ($cantidadEntradas[$ticket->id] > 0)
                            <div>
                                @if ($ticket->nominal)
                                    <h3>Asistentes para {{ $ticket->name }}</h3>
                                    @for ($i = 0; $i < $cantidadEntradas[$ticket->id]; $i++)
                                        <div class="datosUser-nombre">
                                            <label for="user_name[]">Nombre:</label>
                                            <input type="text" name="user_name[]" value="{{ old('user_name.' . $i) }}" required
                                                maxlength="9">
                                            @error('user_name.' . $i)
                                                <span class="error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="datosUser-dni">
                                            <label for="dni[]">DNI:</label>
                                            <input type="text" name="dni[]" value="{{ old('dni.' . $i) }}" required
                                                maxlength="9">
                                            @error('dni.' . $i)
                                                <span class="error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="datosUser-telefono">
                                            <label for="phone[]">Teléfono:</label>
                                            <input type="tel" name="phone[]" value="{{ old('phone.' . $i) }}" required
                                                maxlength="9">
                                            @error('phone.' . $i)
                                                <span class="error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <br>
                                    @endfor
                                @else
                                    <!-- Mostrar campos de nombre, DNI y teléfono una vez (no nominales) -->
                                    <h3>Comprador para {{ $ticket->name }}</h3>
                                    <div class="datosUser-nombre">
                                        <label for="user_name[]">Nombre:</label>
                                        <input type="text" name="user_name[]" value="{{ old('user_name.0') }}" required
                                            maxlength="9">
                                        @error('user_name.0')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="datosUser-dni">
                                        <label for="dni[]">DNI:</label>
                                        <input type="text" name="dni[]" value="{{ old('dni.0') }}" required
                                            maxlength="9">
                                        @error('dni.0')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="datosUser-telefono">
                                        <label for="phone[]">Teléfono:</label>
                                        <input type="tel" name="phone[]" value="{{ old('phone.0') }}" required
                                            maxlength="9">
                                        @error('phone.0')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                @endif
                            </div>
                            <!--Campos ocultos que se pasan para almacenar en la base de datos-->
                            <input type="hidden" name="selected_date" value="{{ $selectedDate }}">
                            <input type="hidden" name="selected_time" value="{{ $selectedTime }}">
                            <input type="hidden" name="ticket_name[]" value="{{ $ticket->name }}">
                            <input type="hidden" name="ticket_quantity[]" value="{{ $cantidadEntradas[$ticket->id] }}">
                            <input type="hidden" name="session_id" value="{{ $sesionId }}">
                            <input type="hidden" name="ticket_id[]" value="{{ $ticket->id }}">
                        @endif

                    @endforeach
                </div>
                <div class="compra-infoEntradas">
                    <div class="infoEntradas-evento">
                        <h2> {{ $evento->name }}<h2>
                    </div>
                    @foreach ($tickets as $ticket)
                        @if ($cantidadEntradas[$ticket->id] > 0)
                            <div class="infoEntradas-titulo">
                                <p>Título entradas: {{ $ticket->name }}</p>
                            </div>
                            <div class="infoEntradas-cantidad">
                                <p>Cantidad seleccionada: {{ $cantidadEntradas[$ticket->id] }}</p>
                            </div>
                            <!-- Añadir un campo ticket_quantity específico para cada tipo de entrada -->
                            <input type="hidden" name="ticket_quantity[{{ $ticket->id }}]"
                                value="{{ $cantidadEntradas[$ticket->id] }}">
                        @endif
                    @endforeach

                    <div class="infoEntradas-fecha">
                        <p>Fecha: {{ $selectedDate }}</p>
                    </div>
                    <div class="infoEntradas-hora">
                        <p>Hora: {{ $selectedTime }}</p>
                    </div>

                    <div class="infoEntradas-precioTotal">
                        <p>Precio Total: <strong>{{ $totalPrice }}€</strong></p>
                    </div>

                    <button type="submit" class="btn-comprar">Realizar Compra</button>

                </div>
            </div>
        </form>
    </div>

@endsection
<script>
    // Función para iniciar el contador regresivo
    function startCountdown(duration, display) {
        let timer = duration,
            minutes, seconds;
        let interval = setInterval(function() {
            minutes = parseInt(timer / 60, 10);
            seconds = parseInt(timer % 60, 10);

            minutes = minutes < 10 ? "0" + minutes : minutes;
            seconds = seconds < 10 ? "0" + seconds : seconds;

            display.textContent = minutes + ":" + seconds;

            if (--timer < 0) {
                clearInterval(interval); // Detener el intervalo cuando el tiempo se agote
                window.location =
                    "{{ route('events.mostrar', ['id' => $evento->id]) }}"; // Redirigir al usuario a la página de eventos
            }
        }, 1000);
    }

    // Iniciar el contador regresivo cuando se carga la página
    document.addEventListener("DOMContentLoaded", function() {
        let tenMinutes = 60 * 10, // 10 minutos en segundos
            display = document.querySelector('#countdown');
        startCountdown(tenMinutes, display);
    });
</script>
