@extends('admin.layout.master')

@section('content')
    <div class="form-table">
        
        <div id="atomosform" class="activo">
            <div id="expandir_tabla"></div>
            @yield('form')
        </div>  

        <div id="atomostable" class="inactivo">
            <div id="expandir_form"></div>
            <div id="table">
                @yield('table')
            </div>
        </div>
    </div>
@endsection