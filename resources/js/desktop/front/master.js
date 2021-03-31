const boton_expandir_menu=document.getElementById("expandir-menu");

boton_expandir_menu.addEventListener("click",()=> {
    boton_expandir_menu.parentElement.classList.toggle('encogido');
})