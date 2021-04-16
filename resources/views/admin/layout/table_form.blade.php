@extends('admin.layout.master')

@section('content')
    <div class="form-table">        
        <div id="atomostable" class="activo">
            <div id="expandir_form"></div>
            <div id="table">
                @yield('table')
            </div>
        </div>
        
        <div id="atomosform" class="inactivo">
            <div id="expandir_tabla"></div>
            @yield('form')
        </div>  
    </div>
@endsection