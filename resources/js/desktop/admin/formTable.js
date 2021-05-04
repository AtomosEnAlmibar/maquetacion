import {showMessage} from './messages';

const table = document.getElementById("table");
const forms = document.querySelectorAll(".admin-form");
const botonesMenuPestana=document.querySelectorAll('.menu-pestana-item');
const pestanas=document.querySelectorAll('.pestana');
let dir= "asc";
document.querySelectorAll(".drop-zone__input").forEach((inputElement) => {
    const dropZoneElement = inputElement.closest(".drop-zone");

    dropZoneElement.addEventListener("click", (e) => {
        inputElement.click();
    });

    inputElement.addEventListener("change", (e) => {
        if (inputElement.files.length) {
        updateThumbnail(dropZoneElement, inputElement.files[0]);
        }
    });

    dropZoneElement.addEventListener("dragover", (e) => {
        e.preventDefault();
        dropZoneElement.classList.add("drop-zone--over");
    });

    ["dragleave", "dragend"].forEach((type) => {
        dropZoneElement.addEventListener(type, (e) => {
        dropZoneElement.classList.remove("drop-zone--over");
        });
    });

    dropZoneElement.addEventListener("drop", (e) => {
        e.preventDefault();

        if (e.dataTransfer.files.length) {
        inputElement.files = e.dataTransfer.files;
        updateThumbnail(dropZoneElement, e.dataTransfer.files[0]);
        }

        dropZoneElement.classList.remove("drop-zone--over");
    });
    });

    /**
     * Updates the thumbnail on a drop zone element.
     *
     * @param {HTMLElement} dropZoneElement
     * @param {File} file
     */
    function updateThumbnail(dropZoneElement, file) {
    let thumbnailElement = dropZoneElement.querySelector(".drop-zone__thumb");

    // First time - remove the prompt
    if (dropZoneElement.querySelector(".drop-zone__prompt")) {
        dropZoneElement.querySelector(".drop-zone__prompt").remove();
    }

    // First time - there is no thumbnail element, so lets create it
    if (!thumbnailElement) {
        thumbnailElement = document.createElement("div");
        thumbnailElement.classList.add("drop-zone__thumb");
        dropZoneElement.appendChild(thumbnailElement);
    }

    thumbnailElement.dataset.label = file.name;

    // Show thumbnail for image files
    if (file.type.startsWith("image/")) {
        const reader = new FileReader();

        reader.readAsDataURL(file);
        reader.onload = () => {
        thumbnailElement.style.backgroundImage = `url('${reader.result}')`;
        };
    } else {
        thumbnailElement.style.backgroundImage = null;
    }
}
  
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
    let botonResetForm = document.getElementById("erase");
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
                        showMessage('success', response.data.message);
                        renderTable();
                    });
                     
                } catch (error) {
                    console.error(error);
                }
            };
    
            sendPostRequest();
            
        })    

    })

    botonResetForm.addEventListener("click", (event) => {
        forms.forEach(form => {            
            form.reset();
            renderForm();
        })
    })
}

export let renderTable = () => {

    let tableHeader = document.querySelectorAll(".cabecera");
    let form = document.querySelector(".admin-form");
    let botonesEditar = document.querySelectorAll(".edit");
    let botonesEliminar = document.querySelectorAll(".delete");
    let dir= "asc";

    botonesEditar.forEach(boton => {
        boton.addEventListener("click", () => {        
            let sendGetRequest = async () => {
                try {
                    await axios.get(boton.dataset.url).then(response => {                                            
                        form.innerHTML=response.data.form;
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

    for (let x=0;x<tableHeader.length;x++){

        tableHeader[x].addEventListener("click",()=>{
            sortTable(x);
        })    
    }


}

let sortTable = (n) => {        
    let rows=document.querySelectorAll(".fila");
    let rowsArray=Array.prototype.slice.call(rows);
    let cell;    
    let column=[];        
    let arrowUp=document.querySelectorAll(".arrow-up");
    let arrowDown=document.querySelectorAll(".arrow-down");

    for(let x=0;x < rowsArray.length;x++) {
        cell = rowsArray[x].querySelectorAll(".casilla")[n];                                
        column.push(cell.innerHTML.toLowerCase());                                
    }                        

    if(dir=="asc") {
        for(let i = 0;i < rows.length;i++){
            let register = column[i];        
            let rowRegister = rowsArray[i];                          
            let j = i - 1;            
            
            while((j > -1) && (register < column[j])) {            
                column[j + 1] = column[j];
                rowsArray[j + 1] = rowsArray[j];
                j--;
            }
    
            column[j + 1] = register;
            rowsArray[j + 1] = rowRegister;
        }
        arrowUp[n].style.opacity=1;
        arrowDown[n].style.opacity=0.3;
        dir="des";
    } else if(dir == "des") {
        for(let i = 0;i < rows.length;i++){
            let register = column[i];        
            let rowRegister = rowsArray[i];                       
            let j = i - 1;            
            
            while((j > -1) && (register > column[j])) {            
                column[j + 1] = column[j];
                rowsArray[j + 1] = rowsArray[j];
                j--;
            }
    
            column[j + 1] = register;
            rowsArray[j + 1] = rowRegister;
        }
        arrowDown[n].style.opacity=1;
        arrowUp[n].style.opacity=0.3;
        dir="asc";
    }            

    for(let i = 0;i < rows.length;i++){
        rows[i].outerHTML=rowsArray[i].outerHTML;
    }       
}



renderForm();
renderTable();
cambiarPestana();