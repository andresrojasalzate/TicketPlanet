const botonFiltro = document.getElementsByClassName("imagenFiltrar");

botonFiltro[0].addEventListener('click', function(){
    const selector = document.getElementsByClassName("div_filtro");
    selector[0].style.display =  (selector[0].style.display === 'none' || selector[0].style.display === '') ? 'block' : 'none';
});