const table = document.getElementById("table");
const tableHeader = document.querySelectorAll(".cabecera");
const forms = document.querySelectorAll(".admin-form");
const botonesMenuPestana=document.querySelectorAll('.menu-pestana-item');
const pestanas=document.querySelectorAll('.pestana');

let cambiarPestana = () => {
    botonesMenuPestana.forEach(boton=>{        
        boton.addEventListener("click",()=>{
            pestanas.forEach(pestana=>{
                pestana.classList.add("inactivo");

                if (pestana.id==boton.dataset.name) {                    
                    pestana.classList.remove("inactivo");
                }
            })
        })
    })
}

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

function sortTable(n) {
    var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
    table = document.getElementById("table-table");
    switching = true;    
    dir = "asc"; 
    while (switching) {      
        switching = false;
        rows = document.querySelectorAll(".fila");
        for (i = 1; i < (rows.length - 1); i++) {
        
        shouldSwitch = false;        
        x = rows[i].querySelectorAll(".columna")[n];
        y = rows[i + 1].querySelectorAll(".columna")[n];
        if (dir == "asc") {
            if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
            
            shouldSwitch= true;
            break;
            }
        } else if (dir == "desc") {
            if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
            //if so, mark as a switch and break the loop:
            shouldSwitch = true;
            break;
            }
        }
        }
        if (shouldSwitch) {
        /*If a switch has been marked, make the switch
        and mark that a switch has been done:*/
        rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
        switching = true;
        //Each time a switch is done, increase this count by 1:
        switchcount ++;      
        } else {
        /*If no switching has been done AND the direction is "asc",
        set the direction to "desc" and run the while loop again.*/
        if (switchcount == 0 && dir == "asc") {
            dir = "desc";
            switching = true;
        }
        }
    }
}

for(let i=0;i<tableHeader.length;i++){
    
    tableHeader[i].addEventListener("click",()=>{
        sortTable(i);
    })
}

renderForm();
renderTable();
cambiarPestana();