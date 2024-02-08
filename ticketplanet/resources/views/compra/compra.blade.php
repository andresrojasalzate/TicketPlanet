@extends('layouts.app')

@section('title', 'Compra')

@section('content')
    <div class="card-compra">
        <div id="countdown-container">
            <div id="countdown"></div>
        </div>
        <hr>
        <div class="contenedor-compra">
            <div class="compra-datosUser">
                <h2>Introduce tus datos:</h2>
                <div class="datosUser-correo">
                    <label for="email">Correo electrónico:</label>
                    <input type="email" name="email[]" value="{{ old('email') }}" maxlength="50">
                </div>
                @foreach ($tickets as $ticket)
                    @if ($cantidadEntradas[$ticket->id] > 0)
                        <div>
                            @if ($ticket->nominal)
                                <h3>Asistentes para {{ $ticket->name }}</h3>
                                @for ($i = 0; $i < $cantidadEntradas[$ticket->id]; $i++)
                                    <div class="datosUser-nombre">
                                        <label for="nombre">Nombre:</label>
                                        <input type="text" name="nombre[]" value="{{ old('nombre') }}" required maxlength="9">
                                    </div>
                                    <div class="datosUser-dni">
                                        <label for="dni">DNI:</label>
                                        <input type="text" name="dni[]" value="{{ old('dni') }}" required maxlength="9">
                                    </div>
                                    <div class="datosUser-telefono">
                                        <label for="telefono">Teléfono:</label>
                                        <input type="tel" name="telefono[]" value="{{ old('telefono') }}" required maxlength="9">
                                    </div>
                                    <br>
                                @endfor
                            @else
                                <!-- Mostrar campos de nombre, DNI y teléfono una vez (no nominales) -->
                                <h3>Asistente para {{ $ticket->name }}</h3>
                                <div class="datosUser-nombre">
                                    <label for="nombre">Nombre:</label>
                                    <input type="text" name="nombre[]" value="{{ old('nombre') }}" required maxlength="9">
                                </div>
                                <div class="datosUser-dni">
                                    <label for="dni">DNI:</label>
                                    <input type="text" name="dni[]" value="{{ old('dni') }}" required maxlength="9">
                                </div>
                                <div class="datosUser-telefono">
                                    <label for="telefono">Teléfono:</label>
                                    <input type="tel" name="telefono[]" value="{{ old('telefono') }}" required maxlength="9">
                                </div>
                            @endif
                        </div>
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

            </div>
        </div>
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
