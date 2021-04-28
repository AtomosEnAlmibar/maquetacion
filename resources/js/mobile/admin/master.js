const botonExpandirForm =document.getElementById("expandir_form");
const botonExpandirTabla =document.getElementById("expandir_tabla");

let cosas = () =>
{
    let formulario = document.getElementById("atomosform");    
    let tabla = document.getElementById("atomostable");    
    if (formulario.className === 'activo')
    {
        formulario.classList.toggle("activo",false);
        formulario.classList.toggle("inactivo",true);                   
        tabla.classList.toggle("inactivo",false);
        tabla.classList.toggle("activo",true);

    } else {                

        formulario.classList.toggle("inactivo",false);
        formulario.classList.toggle("activo",true);                    
        tabla.classList.toggle("activo",false);
        tabla.classList.toggle("inactivo",true);                      
    }                            
}

botonExpandirForm.addEventListener("click", () => cosas());
botonExpandirTabla.addEventListener("click", () => cosas());