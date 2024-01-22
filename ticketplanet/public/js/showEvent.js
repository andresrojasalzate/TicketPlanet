
const dropdownSesiones = document.getElementById('dropdownSesiones');
const sessionTimes = document.querySelectorAll('.session-time');

dropdownSesiones.addEventListener('change', function () {
    const selectedDate = dropdownSesiones.options[dropdownSesiones.selectedIndex].getAttribute('data-date');

    sessionTimes.forEach(sessionTime => {
        const sessionDate = sessionTime.getAttribute('data-date');
        sessionTime.style.display = (sessionDate === selectedDate || selectedDate === null) ? 'block' : 'none';
    });
});
