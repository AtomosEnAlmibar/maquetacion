@extends('admin.layout.table_form')

@section('form')    
    <form class="admin-form client" id="faqs-form" action="{{route("clients_store")}}">

        {{ csrf_field()}}

        <input autocomplete="false" name="hidden" type="text" style="display:none;">
        <input id="id" type="hidden" name="id" value="{{isset($client->id) ? $client->id : ''}}">
        <ul class="menu-pestana">
            <li class="menu-pestana-item" data-name="nombre">Nombre</li>
            <li class="menu-pestana-item" data-name="email">Email</li>
            <li class="menu-pestana-item" data-name="telefono">Telefono</li>
            <li class="menu-pestana-item" data-name="contrasena">Contraseña</li>
        </ul>
        <div class="pestana" id="nombre">

            <label for="name">Nombre:</label>
            <input type="text" id="name" name="name" value="{{isset($client->name) ? $client->name : ''}}" placeholder="¿En qué año fue 1 + 1?">        
        </div>
        <div class="pestana inactivo" id="email">
            <label for="email">Email:</label>
            <input type="text" id="email" name="email" value="{{isset($client->email) ? $client->email : ''}}" placeholder="¿En qué año fue 1 + 1?">
        </div>
        <div class="pestana inactivo" id="telefono">
            <label for="phone">Teléfono:</label>
            <input type="text" id="phone" name="phone" value="{{isset($client->phone) ? $client->phone : ''}}" placeholder="¿En qué año fue 1 + 1?">            
        </div>
        <div class="pestana inactivo" id="contrasena">
            <label for="password">Contraseña:</label>
            <input type="text" id="password" name="password" value="{{isset($client->password) ? $client->password : ''}}" placeholder="¿En qué año fue 1 + 1?">
        </div>
        <div id ="submit">            
            <button type="submit" value="Submit" id="enviar_form"><b>Submit</b></button>            
            <div id="bg"></div>
        </div>        
    </form>    
@endsection

@section('table')
    
    <table>
        <tr>
            <th>Id</th>
            <th>Nombre</th>
            <th>Email</th>
            <th>Teléfono</th>
            <th>Contraseña</th>            
            <th>Direcciones</th>
            <th></th>                     
        </tr>
        @foreach($clients as $client)
            <tr>
                <td>{{$client->id}}</td>
                <td>{{$client->name}}</td>                
                <td>{{$client->email}}</td>                
                <td>{{$client->phone}}</td>
                <td>{{$client->password}}</td>                
                <td>
                    @foreach ($directions as $direction)    
                        @if ($direction->client_id == $client->id)
                            {{$direction->country->name}},
                            {{$direction->state}},
                            {{$direction->city}},
                            {{$direction->address}},
                            {{$direction->postal_code}}
                        @endif
                    @endforeach
                </td>
                <td class="botones"><button class="edit" data-url="{{route('clients_edit', ['client' => $client->id])}}"><svg xmlns="http://www.w3.org/2000/svg" height=50px width=50px  viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M20 14.66V20a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h5.34"></path><polygon points="18 2 22 6 12 16 8 16 8 12 18 2"></polygon></svg></button><button class="delete" data-url="{{route('clients_destroy', ['client' => $client->id])}}"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 58.67" height=50px width=50px><defs><style>.cls-1{fill:#35353d;}</style></defs><title>Asset 25</title><g id="Layer_2" data-name="Layer 2"><g id="Layer_1-2" data-name="Layer 1"><path class="cls-1" d="M61.33,5.33H48V2.67A2.66,2.66,0,0,0,45.33,0H18.67A2.66,2.66,0,0,0,16,2.67V5.33H2.67a2.67,2.67,0,0,0,0,5.34H8v40a8,8,0,0,0,8,8H48a8,8,0,0,0,8-8v-40h5.33a2.67,2.67,0,1,0,0-5.34ZM50.67,50.67A2.67,2.67,0,0,1,48,53.33H16a2.67,2.67,0,0,1-2.67-2.66v-40H50.67Z"/><path class="cls-1" d="M24,45.33a2.67,2.67,0,0,0,2.67-2.66V21.33a2.67,2.67,0,0,0-5.34,0V42.67A2.67,2.67,0,0,0,24,45.33Z"/><path class="cls-1" d="M40,45.33a2.67,2.67,0,0,0,2.67-2.66V21.33a2.67,2.67,0,0,0-5.34,0V42.67A2.67,2.67,0,0,0,40,45.33Z"/></g></g></svg></button></td>
            </tr>              
        @endforeach      
    </table>
    
@endsection 