@extends('admin.layout.master')

@section('content')
    <div class="atomosflex">
        <div id="atomosform" class="activo">
            @yield('form')
        </div>   
        <div id="atomostabla" class="inactivo"  id="tabla">
            @yield('table')
        </div>
    </div>
@endsection