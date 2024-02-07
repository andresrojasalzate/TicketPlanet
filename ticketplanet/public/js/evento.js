document.addEventListener('DOMContentLoaded', function() {
  var alertaExito = document.querySelector('.alert-success');
  var botonCerrar = alertaExito.querySelector('.cerrarFeedbackSuccess');

  botonCerrar.addEventListener('click', function() {
    alertaExito.style.display = 'none';
  });

  setTimeout(function() {
    alertaExito.style.display = 'none';
  }, 3000);
});