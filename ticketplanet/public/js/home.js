const botonFiltro = document.getElementById("filtro");
const selector = document.getElementsByClassName("filtro-div");

botonFiltro.addEventListener('click', function(){
   
    selector[0].style.display =  (selector[0].style.display === 'none' || selector[0].style.display === '') ? 'block' : 'none';
});

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