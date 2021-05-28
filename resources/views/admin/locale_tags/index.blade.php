@php
    $route = 'locale_tag';
    $filters = ['search' => true, 'date'=> $locale_tags];     
@endphp

@extends('admin.layout.table_form')

@section('form')    
    
    @isset($locale_tag->group)

        <form class="admin-form locale_tag" id="locale_tags-form" action="{{route("tags_store")}}" autocomplete="off">

            {{ csrf_field()}}

            <ul class="menu-pestana">
                <li class="menu-pestana-item" data-name="texto">Texto</li>            
            </ul>
            <input id="nada" autocomplete="false" name="hidden" type="text" style="display:none;">
            <input id="id" type="hidden" name="id" value="{{isset($locale_tag->id) ? $locale_tag->id : ''}}"> 
            <div class="pestana" id="texto">
                <label for="texto">Texto:</label>
            <input type="text" id="name" name="name" value="{{isset($locale_tag->group) ? $locale_tag->group : ''}}" placeholder="¿En qué año fue 1 + 1?">
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

    @else 

    <button id="import-tags" data-url="{{route('tags_import')}}">Pulse aqui pa importar</button>

    @endif

@endsection

@section('table')
    
    <div id="table-table">
        <div class="cabeceras">
            <div class="cabecera">
                <span>Grupo</span>
                <div class="arrow-up"></div>
                <div class="arrow-down"></div>
            </div>
            <div class="cabecera">
                <span>Clave</span>
                <div class="arrow-up"></div>
                <div class="arrow-down"></div>
            </div>       
            <div></div>                     
        </div>
        <div class="datos swipe-element">
            @section('datos')        
                @foreach($locale_tags as $key=>$locale_tag)
                    <div class="fila swipe-front">                        
                        @if($agent->isMobile())
                            <div class="botones"></div>
                        @endif                        
                        <div class="casilla">{{$locale_tag->group}}</div>                                                                     
                        <div class="casilla">{{$locale_tag->key}}</div>                                                
                        @if($agent->isDesktop())
                        <div class="casilla botones"><button class="edit" data-url="{{route('tags_edit', ['group' => str_replace('/', '-' , $locale_tag->group) , 'key' => $locale_tag->key])}}"><svg xmlns="http://www.w3.org/2000/svg" height=50px widdiv=50px  viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-widdiv="2" stroke-linecap="round" stroke-linejoin="round" class="feadiver feadiver-edit"><path d="M20 14.66V20a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h5.34"></path><polygon points="18 2 22 6 12 16 8 16 8 12 18 2"></polygon></svg></button></div>
                        @endif                        
                        @if($agent->isMobile())
                            @if (($key % 10)==0)
                                <div class="casilla check" data-url="?page="></div>
                            @endif
                        @endif
                        @if($agent->isMobile())
                            <div class="botones"><button class="edit" data-url="{{route('tags_edit', ['group' => str_replace('/', '-' , $locale_tag->group) , 'key' => $locale_tag->key])}}"></button></div>
                        @endif
                    </div>              
                @endforeach              
            @show            
        </div>
    </div>  
    
    @if($agent->isDesktop())
        {{$locale_tags->links()}}
    @endif

    

@endsection 