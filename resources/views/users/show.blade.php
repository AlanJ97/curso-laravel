@extends('layout')
@section('title',"Usuario {$user->id}") 
 @section('content')

 <h2>Usuario id {{$user->id}}</h2>           
 <p>Nombre del usuario :  {{$user->name}}</p>
<p>Correo electrónico del usuario : {{$user->email}}</p>           
 @endsection