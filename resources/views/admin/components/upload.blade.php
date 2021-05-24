@if($type == "image" )
    <div class="image-info">
        <div class="thumbnail">
            <span class="text">No Image</span>
        </div>
        <div class="form">   
            <form class="image-form" action="{{route('store_image_seo')}}" autocomplete="off">

                {{ csrf_field() }}

                <input id="modal-image-id" type="hidden" name="imageId" class="input-highlight"  />                              
                <input id="modal-image-temporal-id" type="hidden" name="temporalId" class="input-highlight"  /> 
                <input id="modal-image-entity" type="hidden" name="entity" class="input-highlight"  />                              
                <input id="modal-image-content" type="hidden" name="content" class="input-highlight"  />                              
                <input id="modal-image-filename" type="hidden" name="filename" class="input-highlight"  />                              
                <input id="modal-image-language" type="hidden" name="language" class="input-highlight"  />                                                           
                <label for="title">Title</label>
                <input type="text" class="input" name="title">
                <label for="alt">Alt</label>
                <input type="text" class="input" name="alt"> 
                
                <div class="modify-form">
                    <div class ="submit">            
                        <button type="submit" value="Submit" class="enviar_form" id="store-image"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-save2-fill" viewBox="0 0 16 16">
                            <path d="M8.5 1.5A1.5 1.5 0 0 1 10 0h4a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h6c-.314.418-.5.937-.5 1.5v6h-2a.5.5 0 0 0-.354.854l2.5 2.5a.5.5 0 0 0 .708 0l2.5-2.5A.5.5 0 0 0 10.5 7.5h-2v-6z"/>
                        </svg></button>                        
                    </div>
                    <div class="erase">
                        <button class="new-form" data-route="{{route('delete_image')}}" id="delete-image"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-plus-fill" viewBox="0 0 16 16">
                            <path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0zM9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1zM8.5 7v1.5H10a.5.5 0 0 1 0 1H8.5V11a.5.5 0 0 1-1 0V9.5H6a.5.5 0 0 1 0-1h1.5V7a.5.5 0 0 1 1 0z"/>
                        </svg></button>
                    </div>
                </div>
            </form>                     
        </div>
    </div>        
    <div class="upload">      
        <div class="container">
            <div class="upload-file">
                <span>+</span>
                <input class="upload-input" multiple type="file" name="images[{{$content}}.{{$alias}}]">
            </div>            
            @foreach ($files as $image)
                @if($image->language == $alias)
                    <div class="upload-thumb" data-label="{{$image->filename}}" style="background-image: url({{Storage::url($image->path)}})"></div>
                @endif                    
            @endforeach
        </div>
        <span class="upload-prompt">@lang('admin/upload.image')</span>        
    </div>
@endif
