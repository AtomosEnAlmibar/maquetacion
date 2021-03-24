<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Atomos En Web</title>

        @include("admin.layout.partials.styles")
        
    </head>
    <body>        
        @yield('content')
                
        @include("admin.layout.partials.js")
    </body>    
</html>