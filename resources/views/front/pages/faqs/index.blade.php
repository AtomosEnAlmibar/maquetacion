@extends('front.layout.master')

@section('content')    
    @foreach($faqs as $faq)   
        <div class="faq"  id="{{$faq->id}}">
            <div class="title">{!!isset($faq->locale['title']) ? $faq->locale['title'] : "" !!}</div>
            <button class="expandir-faq">
                <div class="linea"></div>                
            </button> 
            <div class="info inactivo">
                <div class="description" ><span>{!!isset($faq->locale['description']) ? $faq->locale['description'] : "" !!}</span></div>                                    
                <div class="gallery">
                    @foreach($faqs as $faq)
                        @isset($faq->image_featured_desktop->path)
                            <img class="thumbnail-single" src="{{Storage::url($faq->image_featured_desktop->path)}}" alt="{{$faq->image_featured_desktop->alt}}" title="{{$faq->image_featured_desktop->title}}"/>
                        @endif
                        @isset($faq->image_grid_desktop)
                            @foreach ($faq->image_grid_desktop as $image)
                                <img class="thumbnail-grid" src="{{Storage::url($image->path)}}"/> 
                            @endforeach
                        @endif
                    @endforeach
                </div>                
            </div>            
        </div>             
    @endforeach    
@endsection
