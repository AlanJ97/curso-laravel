@extends('layout')
@section('title',"Editar usuario") 
@section('content')
<h2>Editar usuario</h2>
          
@if ($errors -> any())
    <p>¡Hay errores!</p>
    <div class="alert alert-danger">
        <h6>Por favor corrige lo siguiente:</h6>
        <ul>
            @foreach ($errors->all() as $error)
                <li>
                    {{$error}}
                </li>     
            @endforeach
        </ul>    
    </div>
    
@endif
<form action="{{url("usuarios/{$user->id}")}}" method="post">
    {{ method_field('PUT')}}
    {!! csrf_field()!!}
    <label for="nombre">Nombre</label>
    <input type="text" name="name" id="name" value="{{old('name',$user->name)}}">
    <br>
    <label for="email">Email</label>
    <input type="email" name="email" id="email" value="{{old('email',$user->email)}}">
    <br> 
    <label for="password">Contraseña</label>
    <input type="password" name="password" id="password">
    <br>
    <button type="submit">Actualizar usuario</button>
</form>    
<p>
    {{-- <a href="{{url('/usuarios')}}">Regresar</a> --}}
    {{-- <a href="{{action('UserController@index')}}">Regresar</a> --}}
    <a href="{{route('users')}}">Regresar</a>
</p>
 @endsection