@extends('admin.layout.table_form')

@section('form')    
    <form class="admin-form" id="users-form" action="{{route("users_store")}}">

        {{ csrf_field()}}

        <input id="nada" autocomplete="false" name="hidden" type="text" style="display:none;">
        <input id="id" type="hidden" name="id" value="{{isset($user->id) ? $user->id : ''}}">                
        <label for="name">Nombre:</label>
        <input type="text" id="name" name="name" value="{{isset($user->name) ? $user->name : ''}}" placeholder="¿En qué año fue 1 + 1?">
        <label for="name">Email:</label>
        <input type="text" id="email" name="email" value="{{isset($user->email) ? $user->email : ''}}" placeholder="¿En qué año fue 1 + 1?">
        <label for="password">Contraseña:</label>
        <input type="text" id="password" name="password" value="{{isset($user->password) ? $user->password : ''}}" placeholder="¿En qué año fue 1 + 1?">
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
            <th>Name</th>
            <th>Email</th>
            <th>Password</th>   
            <th></th>                     
        </tr>
        @foreach($users as $user)
            <tr>
                <td>{{$user->id}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->password}}</td>
                <td class="botones"><button class="edit" data-url="{{route('users_show', ['user' => $user->id])}}"><svg xmlns="http://www.w3.org/2000/svg" height=50px width=50px  viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M20 14.66V20a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h5.34"></path><polygon points="18 2 22 6 12 16 8 16 8 12 18 2"></polygon></svg></button><button class="delete" data-url="{{route('users_destroy', ['user' => $user->id])}}"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 58.67" height=50px width=50px><defs><style>.cls-1{fill:#35353d;}</style></defs><title>Asset 25</title><g id="Layer_2" data-name="Layer 2"><g id="Layer_1-2" data-name="Layer 1"><path class="cls-1" d="M61.33,5.33H48V2.67A2.66,2.66,0,0,0,45.33,0H18.67A2.66,2.66,0,0,0,16,2.67V5.33H2.67a2.67,2.67,0,0,0,0,5.34H8v40a8,8,0,0,0,8,8H48a8,8,0,0,0,8-8v-40h5.33a2.67,2.67,0,1,0,0-5.34ZM50.67,50.67A2.67,2.67,0,0,1,48,53.33H16a2.67,2.67,0,0,1-2.67-2.66v-40H50.67Z"/><path class="cls-1" d="M24,45.33a2.67,2.67,0,0,0,2.67-2.66V21.33a2.67,2.67,0,0,0-5.34,0V42.67A2.67,2.67,0,0,0,24,45.33Z"/><path class="cls-1" d="M40,45.33a2.67,2.67,0,0,0,2.67-2.66V21.33a2.67,2.67,0,0,0-5.34,0V42.67A2.67,2.67,0,0,0,40,45.33Z"/></g></g></svg></button></td>
            </tr>              
        @endforeach      
    </table>
    
@endsection 