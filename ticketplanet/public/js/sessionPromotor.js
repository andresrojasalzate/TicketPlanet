
const imagenesMostrarAcciones = document.querySelectorAll('.imagen-mostar-acciones');

imagenesMostrarAcciones.forEach(imagen => {

    imagen.addEventListener('click', function() {
        
        const divBotones = this.closest('.show-session-promotor').querySelector('.buttons-sessions-promotor');
        
       if (divBotones.style.display === 'none' || divBotones.style.display === '') {
                divBotones.style.display = 'flex';
                this.src = "images/sesiones/arrow-bottom.png"; 
            } else {
                divBotones.style.display = 'none';
                this.src = "images/sesiones/arrow-right.png"; 
            }
    });
});

