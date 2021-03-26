@extends('admin.layout.master')

@section('content')
    <div class="atomosflex">
        <div id="atomosform" class="activo">
            <button type="button" id="expandir_tabla"></button>
            @yield('form')
        </div>   
        <div id="atomostable" class="inactivo">
            <button type="button" id="expandir_form"></button>
            <div id="table">
            @yield('table')
            </div>
        </div>
    </div>
@endsection