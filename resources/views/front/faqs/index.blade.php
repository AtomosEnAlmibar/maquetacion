@extends('front.layout.master')

@section('content')    
    @foreach($faqs as $faq)   
        <div class="faq"  id="{{$faq->id}}">
            <div class="title">{{$faq->title}}</div>
            <button class="expandir-faq">
                <div class="linea"></div>                
            </button>            
            <div class="description inactivo" id="{{$faq->id}}"><span>{{$faq->description}}</span></div>                
        </div>             
    @endforeach    
@endsection
