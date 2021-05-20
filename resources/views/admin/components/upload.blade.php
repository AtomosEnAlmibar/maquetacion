@if($type == "image" )
    <div class="image-info">
        <div class="thumbnail">
            <span class="text">No Image</span>
        </div>
        <div class="form">            
            <label for="title">Title</label>
            <input type="text" class="input" name="title">
            <label for="alt">Alt</label>
            <input type="text" class="input" name="alt">                    
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
