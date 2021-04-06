<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Atomos En Web</title>

        @include("front.layout.partials.styles")
        
    </head>
    <body>
        <div class="menu encogido">
            <div class="menu-item">Cosa 1</div>
            <div class="menu-item">Cosa 2</div>
            <div class="menu-item">Cosa 3</div>
            <div class="menu-item">Cosa 4</div>
            <div class="menu-item">Cosa 5</div>
            <button id="expandir-menu"><div class="line"></div></button>
        </div>
        <div class="atomosflex">                    
            @yield('content')
        </div>
                
        @include("front.layout.partials.js")
    </body>    
</html>