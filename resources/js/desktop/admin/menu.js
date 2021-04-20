import {createCK} from './ckeditor.js';
import {renderForm, renderTable} from './formTable.js';

const botonExpandirMenu=document.getElementById("expandir-menu");
const botonesExpandirSubmenu=document.querySelectorAll(".expandir-submenu");
const botonesMenu = document.querySelectorAll('.clickable');
const form = document.getElementById("faqs-form");    
const table =document.getElementById("table");

botonExpandirMenu.addEventListener("mouseenter",()=> {
    botonExpandirMenu.parentElement.classList.toggle('encogido');
})

botonesMenu.forEach(botonMenu => {
    
    botonMenu.addEventListener("click", () => {        

        let url = botonMenu.dataset.url;

        let sendGetRequest = async () => {
            try {
                await axios.get(url).then(response => {                    
                    form.innerHTML=response.data.form;
                    table.innerHTML = response.data.table;   
                    renderForm();
                    renderTable();                       
                    form.childNodes.forEach(child => {
                        if(child.id=="area_texto"){
                            createCK();
                        }
                    })   
                    
                    window.history.pushState('','',url);
                });                
            } catch (error) {
                console.error(error);            
            }
        }

        sendGetRequest();  
    });
})