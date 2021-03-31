const botones_expandir_faq=document.querySelectorAll('.expandir-faq');

botones_expandir_faq.forEach(boton => {
    boton.addEventListener("click",()=> {
        let descripcion=boton.parentElement.lastElementChild;
        descripcion.classList.toggle("inactivo"); 
        boton.classList.toggle('extendido');
        boton.childNodes[1].classList.toggle('active');
    })
})