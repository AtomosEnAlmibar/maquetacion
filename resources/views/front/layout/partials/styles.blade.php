@if($agent->isDesktop())
    <link href="{{mix('desktop/front/css/app.css')}}" rel="stylesheet">
@endif

@if($agent->isMobile())
    <link href="{{mix('mobile/front/css/app.css')}}" rel="stylesheet">
@endif