@extends('layouts.app')

@section('title', 'Compra')

@section('content')
    <div class="card-compra">
        <div id="countdown-container">
            <div id="countdown"></div>
        </div>
        <hr>
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
