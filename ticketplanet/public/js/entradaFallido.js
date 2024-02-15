document.addEventListener('DOMContentLoaded', function() {
  let compraFallido = document.querySelector('.compraFallido');
  let botonCerrar = document.querySelector('.cerrarFeedbackFallido');
  
  botonCerrar.addEventListener('click',function(){
    compraFallido.style.display = 'none';
  });
  
  // setTimeout(function() {
  //   compraExito.style.display = 'none';
  // }, 3000);
  });