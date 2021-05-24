let imageStoreButton=document.getElementById("store-image");
let imageDeleteButton=document.getElementById("delete-image");

imageStoreButton.addEventListener("click",(e)=> {
    let imageForm = document.getElementById('image-form');
    let data = new FormData(imageForm);
    let url = imageForm.action;

    let sendImagePostRequest = async () => {

        try {
            axios.post(url, data).then(response => {                
                imageForm.reset();
                stopWait();
                showMessage('success', response.data.message);
              
            });
            
        } catch (error) {
            console.error(error);
        }
    };

    sendImagePostRequest();
});

imageDeleteButton.addEventListener("click",(e) => {
    let url = imageDeleteButton.dataset.route;    
    let imageForm = document.getElementById('image-form');
    let temporalId = document.getElementById('modal-image-temporal-id').value;
    let id = document.getElementById('modal-image-id').value;

    if(id){

        let sendImageDeleteRequest = async () => {

            try {
                
                axios.get(url, {
                    params: {
                      'image': id
                    }
                }).then(response => {
                    deleteThumbnail(response.data.imageId);
                    showMessage('success', response.data.message);
                });
                
            } catch (error) {
    
            }
        };
    
        sendImageDeleteRequest();

    }else{
        deleteThumbnail(temporalId);
    }
    
    imageForm.reset();
    stopWait();
});