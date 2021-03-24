const boton_enviar_form = document.getElementById("enviar_form");

boton_enviar_form.addEventListener("click", () => {
    event.preventDefault();
    const formularios=document.querySelectorAll('.admin_form');
    formularios.forEach(formulario => {        
        let data = new FormData(document.getElementById(formulario.id));
        let url = formulario.action;        
        let resp = axios.post(url, data);
        let sendPostRequest = async () => {
            try {
                let resp = await axios.post(url,data).then(resp => {
                    formulario.innerHTML=resp.data.formulario;
                });                
            } catch(err) {
                console.error(err);
            }
        }
    })    
})