document.addEventListener('DOMContentLoaded', function() {
let alertaFallido = document.querySelector('.alert-danger');
let botonCerrarFallido = document.querySelector('.cerrarFeedbackFallido');

botonCerrarFallido.addEventListener('click',function(){
  alertaFallido.style.display = 'none';

});

setTimeout(function() {
  alertaFallido.style.display = 'none';
}, 3000);
});

