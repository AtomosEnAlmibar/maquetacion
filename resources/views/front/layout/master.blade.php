<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Atomos En Web</title>

        @include("front.layout.partials.styles")
        
    </head>
    <body>
        <div class="menu">
            <div><b>Cosa 1</b></div>
            <div><b>Cosa 2</b></div>
            <div><b>Cosa 3</b></div>
            <div><b>Cosa 4</b></div>
            <div><b>Cosa 5</b></div>
            <button id="expandir-menu">Cosas</button>
        </div>
        <div class="atomosflex">                    
            @yield('content')
        </div>
                
        @include("front.layout.partials.js")
    </body>    
</html>