@extends('admin.layout.master')

@section('content')
    <div class="form-table">         
        @if(isset($filters))
                @include('admin.components.table_filters', $filters)
        @endif
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