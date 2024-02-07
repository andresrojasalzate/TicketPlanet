//Mostramos las sesiones disponibles despues de seleccionar una fecha en el desplegable
const dropdownSesiones = document.getElementById('dropdownSesiones');
const sessionTimes = document.querySelectorAll('.session-time');

dropdownSesiones.addEventListener('change', function () {
    const selectedDate = dropdownSesiones.options[dropdownSesiones.selectedIndex].getAttribute('data-date');

    sessionTimes.forEach(sessionTime => {
        const sessionDate = sessionTime.getAttribute('data-date');
        sessionTime.style.display = (sessionDate === selectedDate || selectedDate === null) ? 'block' : 'none';
    });
});

/*Actualizar el total de precio de las entradas seleccionadas */
const inputs = document.querySelectorAll('.ticket-container input');
const totalPriceSpan = document.getElementById('total-price');
const totalPriceInput = document.getElementById('total-price-input');
const buyButton = document.getElementById('buy-button');

inputs.forEach(function (input) {
    input.addEventListener('input', function () {
        calculateTotalPrice();
    });
});

function calculateTotalPrice() {
    let totalPrice = 0;
    inputs.forEach(function (input) {
        const quantity = parseFloat(input.value) || 0;
        const price = parseFloat(input.parentNode.querySelector('h3').innerText.split(', ')[1]);
        totalPrice += quantity * price;
    });
    totalPriceSpan.innerText = totalPrice.toFixed(2) + '€';
    totalPriceInput.value = totalPrice.toFixed(2);
}


function limitarLongitud(input) {
    // Eliminar caracteres no permitidos
    input.value = input.value.replace(/[^\d]/g, '');

    if (input.value.length > input.maxLength) {
        input.value = input.value.slice(0, input.maxLength);
    }
}

document.addEventListener('DOMContentLoaded', function () {
    const dropdownSesiones = document.getElementById('dropdownSesiones');
    const sessionTimes = document.querySelectorAll('.session-time');
    const cardShowTickets = document.querySelector('.card-showTickets');

    // Mostrar u ocultar el card-showTickets según sea necesario
    sessionTimes.forEach(sessionTime => {
        sessionTime.addEventListener('click', function () {
            // Mostrar el card-showTickets solo si la sesión se ha seleccionado
            cardShowTickets.style.display = 'block';
        });
    });

    dropdownSesiones.addEventListener('change', function () {
        const selectedDate = dropdownSesiones.options[dropdownSesiones.selectedIndex].getAttribute('data-date');

        sessionTimes.forEach(sessionTime => {
            const sessionDate = sessionTime.getAttribute('data-date');
            sessionTime.style.display = (sessionDate === selectedDate || selectedDate === null) ? 'block' : 'none';
        });

        // Ocultar el card-showTickets cuando se cambie la selección de la fecha
        cardShowTickets.style.display = 'none';
    });

});
