const table = document.getElementById("table");
const forms = document.querySelectorAll(".admin-form");

export let renderForm = () => {    
    
    let botonEnviarForm = document.getElementById("enviar_form");

    botonEnviarForm.addEventListener("click", (event) => {
        event.preventDefault();
        
        forms.forEach(form => {        
            let data = new FormData(form);  
            
            if( ckeditors != 'null'){

                Object.entries(ckeditors).forEach(([key, value]) => {
                    data.append(key, value.getData());
                });
            }
            let url = form.action;                        
            let sendPostRequest = async () => {
    
                try {
                    await axios.post(url, data).then(response => {
                        form.id.value = response.data.id;
                        table.innerHTML = response.data.table;
                        renderTable();
                    });
                     
                } catch (error) {
                    console.error(error);
                }
            };
    
            sendPostRequest();
            
        })    
    })
}

export let renderTable = () => {

    let formFaqs = document.getElementById("faqs-form");
    let botonesEditar = document.querySelectorAll(".edit");
    let botonesEliminar = document.querySelectorAll(".delete");
    
    botonesEditar.forEach(boton => {
        boton.addEventListener("click", () => {        
            let sendGetRequest = async () => {
                try {
                    await axios.get(boton.dataset.url).then(response => {                    
                        formFaqs.innerHTML=response.data.form;
                        renderForm();                                               
                    });                
                } catch (error) {
                    console.error(error);
                }
            }
    
            sendGetRequest();   
        })
    })

    botonesEliminar.forEach(boton => {
        boton.addEventListener("click", () => {          
            
            let sendDeleteRequest = async () => {
                try {
                    await axios.delete(boton.dataset.url).then(response => {
                        table.innerHTML=response.data.table;
                        renderTable();
                    });                    
                } catch (error) {
                    console.error(error.response);
                }
            }    
            sendDeleteRequest();
        })
    })
}

renderForm();
renderTable();