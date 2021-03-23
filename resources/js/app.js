const { default: axios } = require('axios');

require('./bootstrap');

const boton_enviar_form = document.getElementById("enviar_form");
const boton_expandir_form =document.getElementById("expandir_form");
const boton_expandir_tabla =document.getElementById("expandir_tabla");

boton_enviar_form.addEventListener("click", () => {
    event.preventDefault();
    const formularios=document.querySelectorAll('.admin_form');
    formularios.forEach(formulario => {
        const id_formulario=formulario.id;
        const datos_formulario = new FormData(formulario);
        const url = form.action;
        const resp = axios.post(url, data);
        const sendPostRequest = async () => {
            try {
                const resp = await axios.post(url,data);
            } catch(err) {
                console.error(err);
            }
        }
    })    
})

boton_expandir_form.addEventListener("click", () => cosas());
boton_expandir_tabla.addEventListener("click", () => cosas());

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

