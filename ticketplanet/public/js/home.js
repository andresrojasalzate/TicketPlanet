const botonFiltro = document.getElementById("filtro");

botonFiltro[0].addEventListener('click', function(){
    const selector = document.getElementsByClassName("div_filtro");
    selector[0].style.display =  (selector[0].style.display === 'none' || selector[0].style.display === '') ? 'block' : 'none';
});