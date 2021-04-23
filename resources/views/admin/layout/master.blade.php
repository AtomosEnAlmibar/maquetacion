<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@lang('admin/faqs.parent_section')</title>

        @include("admin.layout.partials.styles")
        
    </head>
    <body>
        <div class="atomosflex">
            <ul class="menu encogido">
                <li class="menu-item">                    
                    <div class="submenu-main clickable" data-url="{{route('faqs')}}">
                        <span>faqs</span>                        
                        <div class="line expandir-submenu"></div>
                    </div> 
                    <div class="submenu">
                        <div class="submenu-item clickable" data-url="{{route('faq_categories')}}">
                            <span>Categorías</span>
                        </div>                        
                    </div>                                       
                </li>
                <li class="menu-item">
                    Cosa 2
                </li>
                <li class="menu-item">Cosa 3</li>
                <li class="menu-item">Cosa 4</li>
                <li class="menu-item">Cosa 5</li>
                <button id="expandir-menu"><div class="line"></div></button>
            </ul>
            @yield('content')
        </div>
        @include("admin.layout.partials.js")
    </body>    
</html>