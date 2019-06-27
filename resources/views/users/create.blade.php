@extends('layout')
@section('title',"Crear usuario") 
@section('content')
<h2>Crear nuevo usuario</h2>           
<form action="{{url('usuarios/crear')}}" method="post">
    {!! csrf_field()!!}
    <button type="submit">Agregar usuario</button>
</form>    
<p>
    {{-- <a href="{{url('/usuarios')}}">Regresar</a> --}}
    {{-- <a href="{{action('UserController@index')}}">Regresar</a> --}}
    <a href="{{route('users')}}">Regresar</a>
</p>
 @endsection