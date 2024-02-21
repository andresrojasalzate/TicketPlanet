document.addEventListener('DOMContentLoaded', function() {
  var alertaExito = document.querySelector('.alert-success');
  var botonCerrar = alertaExito.querySelector('.cerrarFeedback');

  botonCerrar.addEventListener('click', function() {
    alertaExito.style.display = 'none';
  });

  setTimeout(function() {
    alertaExito.style.display = 'none';
  }, 3000);
});