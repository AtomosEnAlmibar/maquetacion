<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Atomos En Web</title>

        @include("admin.layout.partials.styles")
        
    </head>
    <body>
        <div class="atomosflex">
            <div class="menu encogido">
                <div class="menu-item">                    
                    <div class="submenu-main clickable" data-url="{{route('faqs')}}">
                        <span>faqs</span>
                    <div class="line"></div>
                    </div>
                    <div class="submenu-item clickable" data-url="{{route('faq_categories')}}">
                        <span>Categorías</span>
                    </div>
                </div>
                <div class="menu-item">
                    <div class="submenu-main clickable" data-url="{{route('faqs')}}">
                        <span>faqs</span>
                    <div class="line"></div>
                    </div>
                    <div class="submenu-item clickable" data-url="{{route('faq_categories')}}">
                        <span>Categorías</span>
                    </div>
                </div>
                <div class="menu-item">Cosa 3</div>
                <div class="menu-item">Cosa 4</div>
                <div class="menu-item">Cosa 5</div>
                <button id="expandir-menu"><div class="line"></div></button>
            </div>        
            @yield('content')
        </div>
        @include("admin.layout.partials.js")
    </body>    
</html>