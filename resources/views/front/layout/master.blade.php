<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Atomos En Web</title>

        @include("front.layout.partials.styles")
        
    </head>
    <body>
        @include("front.components.menu-sidebar")    
        <div class="atomosflex">                    
            @yield('content')
        </div>
                
        @include("front.layout.partials.js")
    </body>    
</html>