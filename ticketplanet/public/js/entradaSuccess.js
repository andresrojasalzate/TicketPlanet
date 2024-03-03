document.addEventListener('DOMContentLoaded', function() {
  let compraExito = document.querySelector('.compraExito');
  let compraFallido = document.querySelector('.compraFallido');
  let botonCerrarExito = document.querySelector('.cerrarFeedbackSuccess');
  let botonCerrar = document.querySelector('.cerrarFeedbackFallido');
  
  botonCerrarExito.addEventListener('click',function(){
    compraExito.style.display = 'none';
  });

  });