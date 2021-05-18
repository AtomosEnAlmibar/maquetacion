let renderUpload = () => {    

    let inputElements = document.querySelectorAll(".upload-input");    

    inputElements.forEach(inputElement => {
    
        let uploadElement = inputElement.closest(".upload");
      
        uploadElement.addEventListener("click", (e) => {            
            inputElement.click();
        });
      
        inputElement.addEventListener("change", (e) => {
            if (inputElement.files.length) {                
                updateThumbnail(uploadElement, inputElement.files);                             
            }
        });
      
        uploadElement.addEventListener("dragover", (e) => {
            e.preventDefault();
            uploadElement.classList.add("upload-over");
        });
      
        ["dragleave", "dragend"].forEach((type) => {
            uploadElement.addEventListener(type, (e) => {
                uploadElement.classList.remove("upload-over");
            });
        });
      
        uploadElement.addEventListener("drop", (e) => {
            e.preventDefault();
        
            if (e.dataTransfer.files.length) {
                    inputElement.files = e.dataTransfer.files;
                    updateThumbnail(uploadElement, e.dataTransfer.files[0]);
            }
        
            uploadElement.classList.remove("upload-over");
        });
    });
      
    function updateThumbnail(uploadElement, files) {
    
        let thumbnailElement = uploadElement.querySelector(".upload-thumb");
        let thumbnails = uploadElement.querySelectorAll(".upload-thumb");
      
        if (uploadElement.querySelector(".upload-prompt")) {
            uploadElement.querySelector(".upload-prompt").remove();
        }        
        
        thumbnails.forEach(thumbnail => {
            thumbnail.remove();
        });

        for (let i = 0; i < files.length; i++) {            
            thumbnailElement = document.createElement("div");            
            thumbnailElement.classList.add("upload-thumb");
            document.querySelector(".container").appendChild(thumbnailElement);
          
            thumbnailElement.dataset.label = files[i].name;
          
            if (files[i].type.startsWith("image/")) {
                let reader = new FileReader();
            
                reader.readAsDataURL(files[i]);
        
                reader.onload = () => {
                    thumbnailElement.style.backgroundImage = `url('${reader.result}')`;
                };
            } else {
                thumbnailElement.style.backgroundImage = null;
            }
        }        

    }
}

renderUpload();