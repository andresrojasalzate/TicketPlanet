const menuIcon = document.getElementById('menuIcon');
const dropdownContent = document.querySelector('.dropdown-content');

menuIcon.addEventListener('click', function () {
    // Alternar la visibilidad del menú desplegable al hacer clic en el icono
    dropdownContent.style.display = (dropdownContent.style.display === 'none' || dropdownContent
        .style.display === '') ? 'block' : 'none';

    // Bloquear el desplazamiento vertical al abrir el menú
    document.body.style.overflowY = (dropdownContent.style.display === 'none') ? 'auto' : 'hidden';
});

//cerrar el menú desplegable al hacer clic fuera de él
document.addEventListener('click', function (event) {
    if (!menuIcon.contains(event.target) && !dropdownContent.contains(event.target)) {
        dropdownContent.style.display = 'none';
       // Permitir el desplazamiento vertical al cerrar el menú
       document.body.style.overflowY = 'auto';
    }
});