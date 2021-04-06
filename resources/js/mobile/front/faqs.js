const faqs = document.querySelectorAll('.faq');
const botones_expandir_faq=document.querySelectorAll('.expandir-faq');

botones_expandir_faq.forEach(boton => {
    boton.addEventListener("click",()=> {
        let descripcion=boton.parentElement.lastElementChild;
        descripcion.classList.toggle("inactivo"); 
        boton.classList.toggle('extendido');
        boton.childNodes[1].classList.toggle('active');
        faqs.forEach(faq => {
            if (faq.lastElementChild.className=='description') {
                if (faq.id != descripcion.id) {
                    faq.lastElementChild.classList.toggle("inactivo");
                    faq.childNodes[3].classList.toggle("extendido");  
                    let boton = faq.childNodes[3];                    
                    boton.childNodes[1].classList.toggle('active');
                }                              
            }
        })        
    })
})