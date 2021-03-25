const boton_enviar_form = document.getElementById("enviar_form");
const tabla = document.getElementById("atomostabla");
boton_enviar_form.addEventListener("click", () => {
    event.preventDefault();
    const formularios=document.querySelectorAll('.admin_form');
    formularios.forEach(formulario => {        
        let data = new FormData(document.getElementById(formulario.getAttribute("id")));
        let url = formulario.action;        
        let resp = axios.post(url, data);
        let sendPostRequest = async () => {

            try {
                await axios.post(url, data).then(resp => {
                    formulario.id.value = resp.data.id;
                    tabla.innerHTML = resp.data.tabla;
                });
                 
            } catch (error) {
                console.error(error);
            }
        };

        sendPostRequest();

        console.log('1');
    })    
})