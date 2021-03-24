const boton_expandir_form =document.getElementById("expandir_form");
const boton_expandir_tabla =document.getElementById("expandir_tabla");

let cosas = () =>
{
    let formulario = document.getElementById("atomosform");
    var formhijos = formulario.children;
    let tabla = document.getElementById("atomostabla");
    var tabhijos = tabla.children;
    if (formulario.className === 'activo')
    {
        formulario.classList.toggle("activo",false);
        formulario.classList.toggle("inactivo",true);                   
        tabla.classList.toggle("inactivo",false);
        tabla.classList.toggle("activo",true);
        formhijos[1].style.display = "none"
        tabhijos[0].style.display = "none"
        formhijos[0].style.display = "flex"                    
        tabhijos[1].style.display = "table"
    } else {                

        formulario.classList.toggle("inactivo",false);
        formulario.classList.toggle("activo",true);                    
        tabla.classList.toggle("activo",false);
        tabla.classList.toggle("inactivo",true);   
        formhijos[0].style.display = "none"    
        tabhijos[1].style.display = "none"             
        formhijos[1].style.display = "flex"
        tabhijos[0].style.display = "flex"                    
    }                            
}

boton_expandir_form.addEventListener("click", () => cosas());
boton_expandir_tabla.addEventListener("click", () => cosas());