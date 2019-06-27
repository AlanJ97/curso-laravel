@extends('layout')
@section('title',"Crear usuario") 
@section('content')
<h2>Crear nuevo usuario</h2>           
<form action="{{url('usuarios/crear')}}" method="post">
    {!! csrf_field()!!}
    <label for="nombre">Nombre</label>
    <input type="text" name="name" id="name">
    <br>
    <label for="email">Email</label>
    <input type="email" name="email" id="email">
    <br> 
    <label for="password">Contraseña</label>
    <input type="password" name="password" id="password">
    <br>
    <button type="submit">Agregar usuario</button>
</form>    
<p>
    {{-- <a href="{{url('/usuarios')}}">Regresar</a> --}}
    {{-- <a href="{{action('UserController@index')}}">Regresar</a> --}}
    <a href="{{route('users')}}">Regresar</a>
</p>
 @endsection