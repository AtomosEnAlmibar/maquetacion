@extends('admin.layout.master')

@section('content')
    <div class="form-table">         
        @if(isset($filters))
                @include('admin.components.table_filters', $filters)
        @endif
        <div id="atomostable" class="activo">
            <div id="expandir_tabla" class="pestana"></div>
            <div id="table" class="contenido">
                @yield('table')
            </div>
        </div>
        
        <div id="atomosform" class="inactivo">
            <div id="expandir_form" class="pestana"></div>
            <div id="form" class="contenido">
                @yield('form')
            </div>
        </div>  
    </div>
@endsection