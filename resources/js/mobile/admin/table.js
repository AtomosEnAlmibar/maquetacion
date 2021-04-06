const table = document.getElementById("table");
const botones_eliminar = document.querySelectorAll(".delete");

botones_eliminar.forEach(boton => {
    boton.addEventListener("click", () => {          
        
        let sendDeleteRequest = async () => {
            try {
                await axios.delete(boton.dataset.url).then(response => {
                    table.innerHTML=response.data.table;
                });
                console.log("tu madre")
            } catch (error) {
                console.error(error.response);
            }
        }

        sendDeleteRequest();
    })
})