const botonFiltro = document.getElementById("filtro");
const selector = document.getElementsByClassName("div_filtro");

botonFiltro.addEventListener('click', function(){
   
    selector[0].style.display =  (selector[0].style.display === 'none' || selector[0].style.display === '') ? 'block' : 'none';
});