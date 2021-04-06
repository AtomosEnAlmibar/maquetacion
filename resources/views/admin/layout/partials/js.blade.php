@if($agent->isDesktop())
    <script src="{{mix('desktop/admin/js/app.js')}}"></script>
@endif

@if($agent->isMobile())
    <script src="{{mix('mobile/admin/js/app.js')}}"></script>
@endif
