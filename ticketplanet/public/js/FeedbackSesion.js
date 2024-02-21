document.addEventListener('DOMContentLoaded', function() {
  let alertaExito = document.querySelector('.alert-success');
  let botonCerrar = document.querySelector('.cerrarFeedbackSuccess');
  
  botonCerrar.addEventListener('click',function(){
    alertaExito.style.display = 'none';
  });
  
  setTimeout(function() {
    alertaExito.style.display = 'none';
  }, 3000);
  });