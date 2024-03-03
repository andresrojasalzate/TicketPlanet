document.addEventListener("DOMContentLoaded", function() {
    let tenMinutes = 60 * 10, // 10 minutos en segundos
        display = document.querySelector('#countdown');
    let eventRoute = display.dataset.eventRoute; // Obtener la URL de la ruta del evento desde el atributo de datos
    startCountdown(tenMinutes, display, eventRoute);
});

function startCountdown(duration, display, eventRoute) {
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
            window.location = eventRoute; // Redirigir al usuario a la página de eventos
        }
    }, 1000);
}
