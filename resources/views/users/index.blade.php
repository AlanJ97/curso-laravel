@extends('layout')
   
@section('content')             
    <h2>Home usuarios</h2>
    <p>
    <a href="{{route('users.create')}}">Nuevo usuario</a>
    </p>
    @if (!empty($users))
    <ul>
        @foreach($users as $user)
        <li> {{$user->name}}, {{$user -> email}} </li>
        {{-- <a href="{{url('/usuarios/'.$user->id)}}">Ver detalles</a> --}}
        {{-- <a href="{{action('UserController@show',['id'=>$user->id])}}">Ver detalles</a> --}}
        <a href="{{route('users.show',$user)}}">Ver detalles</a>
        <a href="{{route('users.edit',$user)}}">Editar usuario</a>
        <form action="{{route('users.destroy',$user)}}" method="post">
            {{ csrf_field() }}
            {{ method_field('DELETE')}}
            <button type="submit">Eliminar</button>
        </form>
        @endforeach
         
    </ul>            
    @else
        <p>La lista no tiene ningun dato</p>
    @endif   
@endsection
{{-- @section('sidebar')
    @parent
    <h2>Barra lateral 2</h2>
@endsection --}}