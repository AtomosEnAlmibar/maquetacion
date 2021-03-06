@php
    $route = 'sliders';
    $filters = ['search' => true, 'date'=> $sliders]; 
@endphp

@extends('admin.layout.table_form')

@section('form')    
    
    <form class="admin-form slider" id="sliders-form" action="{{route("sliders_store")}}" autocomplete="off">

        {{ csrf_field()}}

        <ul class="menu-pestana">
            <li class="menu-pestana-item" data-name="nombre">Nombre</li>
            <li class="menu-pestana-item" data-name="entidad">Entidad</li>
        </ul>
        <input id="nada" autocomplete="false" name="hidden" type="text" style="display:none;">
        <input id="id" type="hidden" name="id" value="{{isset($slider->id) ? $slider->id : ''}}"> 
        <div class="pestana" id="nombre">
            <label for="name">Nombre:</label>
        <input type="text" id="name" name="name" value="{{isset($slider->name) ? $slider->name : ''}}" placeholder="¿En qué año fue 1 + 1?">
        </div>                               
        <div class="pestana inactivo" id="entidad">
            <label for="entity">Entidad:</label>
            <input type="text" id="entity" name="entity" value="{{isset($slider->entity) ? $slider->entity : ''}}" placeholder="¿En qué año fue 1 + 1?">                
        </div>
        <div class="modify-form">
            <div type="submit" value="Submit" id="enviar_form">            
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-save2-fill" viewBox="0 0 16 16">
                    <path d="M8.5 1.5A1.5 1.5 0 0 1 10 0h4a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h6c-.314.418-.5.937-.5 1.5v6h-2a.5.5 0 0 0-.354.854l2.5 2.5a.5.5 0 0 0 .708 0l2.5-2.5A.5.5 0 0 0 10.5 7.5h-2v-6z"/>
                </svg>
            </div>
            <div id="erase">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-plus-fill" viewBox="0 0 16 16">
                    <path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0zM9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1zM8.5 7v1.5H10a.5.5 0 0 1 0 1H8.5V11a.5.5 0 0 1-1 0V9.5H6a.5.5 0 0 1 0-1h1.5V7a.5.5 0 0 1 1 0z"/>
                </svg>
            </div>
        </div>        
    </form>            

@endsection

@section('table')
    
    <div id="table-table">
        <div class="cabeceras">
            <div class="cabecera">
                <span>Id</span>
                <div class="arrow-up"></div>
                <div class="arrow-down"></div>
            </div>
            <div class="cabecera">
                <span>Nombre</span>
                <div class="arrow-up"></div>
                <div class="arrow-down"></div>
            </div>
            <div class="cabecera">
                <span>Entidad</span>
                <div class="arrow-up"></div>
                <div class="arrow-down"></div>
            </div>
            <div class="cabecera">
                <span>Creado</span>
                <div class="arrow-up"></div>
                <div class="arrow-down"></div>
            </div>            
            <div></div>                     
        </div>
        <div class="datos swipe-element">
            @section('datos')        
                @foreach($sliders as $key=>$slider)
                    <div class="fila swipe-front">                        
                        @if($agent->isMobile())
                            <div class="botones"><button class="delete" data-url="{{route('sliders_destroy', ['slider' => $slider->id])}}"></button></div>
                        @endif
                        <div class="casilla">{{$slider->id}}</div>                        
                        <div class="casilla">{{$slider->name}}</div>
                        <div class="casilla">{{$slider->entity}}</div>
                        <div class="casilla">{{$slider->created_at}}</div>
                        @if($agent->isDesktop())
                        <div class="casilla botones"><button class="edit" data-url="{{route('sliders_show', ['slider' => $slider->id])}}"><svg xmlns="http://www.w3.org/2000/svg" height=50px widdiv=50px  viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-widdiv="2" stroke-linecap="round" stroke-linejoin="round" class="feadiver feadiver-edit"><path d="M20 14.66V20a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h5.34"></path><polygon points="18 2 22 6 12 16 8 16 8 12 18 2"></polygon></svg></button><button class="delete" data-url="{{route('sliders_destroy', ['slider' => $slider->id])}}"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 58.67" height=50px widdiv=50px><defs><style>.cls-1{fill:#35353d;}</style></defs><name>Asset 25</name><g id="Layer_2" data-name="Layer 2"><g id="Layer_1-2" data-name="Layer 1"><path class="cls-1" d="M61.33,5.33H48V2.67A2.66,2.66,0,0,0,45.33,0H18.67A2.66,2.66,0,0,0,16,2.67V5.33H2.67a2.67,2.67,0,0,0,0,5.34H8v40a8,8,0,0,0,8,8H48a8,8,0,0,0,8-8v-40h5.33a2.67,2.67,0,1,0,0-5.34ZM50.67,50.67A2.67,2.67,0,0,1,48,53.33H16a2.67,2.67,0,0,1-2.67-2.66v-40H50.67Z"/><path class="cls-1" d="M24,45.33a2.67,2.67,0,0,0,2.67-2.66V21.33a2.67,2.67,0,0,0-5.34,0V42.67A2.67,2.67,0,0,0,24,45.33Z"/><path class="cls-1" d="M40,45.33a2.67,2.67,0,0,0,2.67-2.66V21.33a2.67,2.67,0,0,0-5.34,0V42.67A2.67,2.67,0,0,0,40,45.33Z"/></g></g></svg></button></div>
                        @endif                        
                        @if($agent->isMobile())
                            @if (($key % 10)==0)
                                <div class="casilla check" data-url="?page="></div>
                            @endif
                        @endif
                        @if($agent->isMobile())
                            <div class="botones"><button class="edit" data-url="{{route('sliders_show', ['slider' => $slider->id])}}"></button></div>
                        @endif
                    </div>              
                @endforeach              
            @show            
        </div>
    </div>  
    
    @if($agent->isDesktop())
        {{$sliders->links()}}
    @endif

    

@endsection 