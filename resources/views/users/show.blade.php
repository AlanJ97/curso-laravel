@extends('layout')
@section('title',"Usuario {$user->id}") 
@section('content')
<h2>Usuario id {{$user->id}}</h2>           
<p>Nombre del usuario :  {{$user->name}}</p>
<p>Correo electrónico del usuario : {{$user->email}}</p>     
<p>
    {{-- <a href="{{url('/usuarios')}}">Regresar</a> --}}
    {{-- <a href="{{action('UserController@index')}}">Regresar</a> --}}
    <a href="{{route('users')}}">Regresar</a>
</p>
 @endsection