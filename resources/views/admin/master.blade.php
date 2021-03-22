<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Atomos En Web</title>

        @include("admin.layout.styles")
        
    </head>
    <body>
        <div class="atomosflex">
            @yield('content')
        </div>
        
        @include("admin.layout.js")
    </body>    
</html>