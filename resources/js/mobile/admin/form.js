const form_faqs = document.getElementById("faqs-form");
const boton_enviar_form = document.getElementById("enviar_form");
const botones_editar = document.querySelectorAll(".edit");
const table = document.getElementById("table");
const forms = document.querySelectorAll(".admin-form");

boton_enviar_form.addEventListener("click", (event) => {
    event.preventDefault();
    
    forms.forEach(form => {        
        let data = new FormData(form);
        console.log(data);
        let url = form.action;                        
        let sendPostRequest = async () => {

            try {
                await axios.post(url, data).then(response => {
                    console.log(response);
                    form.id.value = response.data.id;
                    table.innerHTML = response.data.table;
                });
                 
            } catch (error) {
                console.error(error);
            }
        };

        sendPostRequest();
        
    })    
})

botones_editar.forEach(boton => {
    boton.addEventListener("click", () => {        
        let sendGetRequest = async () => {
            try {
                await axios.get(boton.dataset.url).then(response => {                    
                    form_faqs.innerHTML=response.data.form;
                });                
            } catch (error) {
                console.error(error);
            }
        }

        sendGetRequest();   
    })
})