
var cantidadEntradas = document.getElementById('cantidadEntradas');


cantidadEntradas.classList.add('true');

function verificarClase(){


if (miElemento.classList.contains('true')) {
  // Si tiene la clase 'true', muestra el elemento .alert
  alertElement.style.display = 'block';
} else {
  // Si no tiene la clase 'true', oculta el elemento .alert
  alertElement.style.display = 'none';
}
}