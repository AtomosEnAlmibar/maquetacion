const boton_enviar_form = document.getElementById("enviar_form");
const table = document.getElementById("table");
const forms = document.querySelectorAll(".admin-form");

boton_enviar_form.addEventListener("click", () => {
    event.preventDefault();
    
    forms.forEach(form => {        
        let data = new FormData(form);
        let url = form.action;                

        let sendPostRequest = async () => {

            try {
                await axios.post(url, data).then(response => {
                    form.id.value = response.data.id;
                    table.innerHTML = response.data.table;
                });
                 
            } catch (error) {
                console.error(error);
            }
        };

        sendPostRequest();

        console.log('1');
    })    
})