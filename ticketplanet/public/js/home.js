const botonFiltro = document.getElementById("boton");

botonFiltro.addEventListener('click', function(){
    const selector = document.getElementsByClassName("div_filtro");
    selector[0].style.display =  (selector[0].style.display === 'none' || selector[0].style.display === '') ? 'block' : 'none';
});