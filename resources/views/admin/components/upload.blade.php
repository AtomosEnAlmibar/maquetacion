@if($type == "image" )
    <div class="image-info">
        <div class="thumbnail">
        </div>
        <div class="form">
            <form>
                <label for="title">Title</label>
                <input type="text" class="input" name="title">
                <label for="alt">Alt</label>
                <input type="text" class="input" name="alt">
            </form>        
        </div>
    </div>        
    <div class="upload">      
        <!--<div class="container">
            @foreach ($files as $image)
                @if($image->language == $alias)
                    <div class="upload-thumb" data-label="{{$image->filename}}" style="background-image: url({{Storage::url($image->path)}})"></div>
                @endif
            @endforeach
        </div>
        <span class="upload-prompt">@lang('admin/upload.image')</span>
        <input class="upload-input" multiple type="file" name="images[{{$content}}.{{$alias}}]">-->
    </div>
@endif
