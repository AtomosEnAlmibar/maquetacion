@if($agent->isDesktop())
    <link href="{{mix('desktop/admin/css/app.css')}}" rel="stylesheet">
@endif

@if($agent->isMobile())
    <link href="{{mix('mobile/admin/css/app.css')}}" rel="stylesheet">
@endif