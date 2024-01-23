const menuIcon = document.getElementById('menuIcon');
const dropdownContent = document.querySelector('.dropdown-content');

menuIcon.addEventListener('click', function () {
    // Alternar la visibilidad del menú desplegable al hacer clic en el icono
    dropdownContent.style.display = (dropdownContent.style.display === 'none' || dropdownContent
        .style.display === '') ? 'block' : 'none';

    // Alternar la clase que deshabilita la interacción y el scroll
    document.body.classList.toggle('disable-interaction');
});

// Opcional: cerrar el menú desplegable al hacer clic fuera de él
document.addEventListener('click', function (event) {
    if (!menuIcon.contains(event.target) && !dropdownContent.contains(event.target)) {
        dropdownContent.style.display = 'none';
        // Remover la clase que deshabilita la interacción y el scroll al cerrar el menú
        document.body.classList.remove('disable-interaction');
    }
});