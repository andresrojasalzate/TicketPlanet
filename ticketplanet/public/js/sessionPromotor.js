
const imagenesMostrarAcciones = document.querySelectorAll('.imagen-mostar-acciones');

imagenesMostrarAcciones.forEach(imagen => {

    imagen.addEventListener('click', function() {
        
        const divBotones = this.closest('.show-session-promotor').querySelector('.buttons-sessions-promotor');
        
       if (divBotones.style.display === 'none' || divBotones.style.display === '') {
                divBotones.style.display = 'flex';
                this.src = 'http://127.0.0.1:8000/images/sesiones/arrow-bottom.png'; // Cambiar la imagen a una flecha hacia abajo
            } else {
                divBotones.style.display = 'none';
                this.src = 'http://127.0.0.1:8000/images/sesiones/arrow-right.png'; // Cambiar la imagen a una flecha hacia la derecha
            }
    });
});

