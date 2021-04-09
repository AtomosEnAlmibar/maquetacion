import {createCK} from './ckeditor.js';
import {renderForm, renderTable} from './form_table.js';

const botonExpandirMenu=document.getElementById("expandir-menu");
const botonesMenu = document.querySelectorAll('.clickable');
const form = document.getElementById("faqs-form");    
const table =document.getElementById("table");

botonExpandirMenu.addEventListener("mouseenter",()=> {
    botonExpandirMenu.parentElement.classList.toggle('encogido');
})

botonesMenu.forEach(botonMenu => {
    
    botonMenu.addEventListener("click", () => {        

        let sendGetRequest = async () => {
            try {
                await axios.get(botonMenu.dataset.url).then(response => {                    
                    form.innerHTML=response.data.form;
                    table.innerHTML = response.data.table;   
                    renderForm();
                    renderTable();                       
                    form.childNodes.forEach(child => {
                        if(child.id=="area_texto"){
                            createCK();
                        }
                    })                                                                 
                });                
            } catch (error) {
                console.error(error);            
            }
        }

        sendGetRequest();  
    });
})