@if($agent->isDesktop())
    <script src="{{mix('desktop/front/js/app.js')}}"></script>
@endif

@if($agent->isMobile())
    <script src="{{mix('mobile/front/js/app.js')}}"></script>
@endif
