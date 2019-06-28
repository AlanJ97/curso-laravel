@extends('layout')
@section('title',"Crear usuario") 
@section('content')
<h2>Crear nuevo usuario</h2>
          
@if ($errors -> any())
    <p>¡Hay errores!</p>
    <div class="alert alert-danger">
        <h6>Por favor corrige lo siguiente:</h6>
        {{-- <ul>
            @foreach ($errors->all() as $error)
                <li>
                    {{$error}}
                </li>     
            @endforeach
        </ul>     --}}
    </div>
    
@endif
<form action="{{url('usuarios/crear')}}" method="post">
    {!! csrf_field()!!}
    <label for="nombre">Nombre</label>
    <input type="text" name="name" id="name" value="{{old('name')}}">
    @if ($errors -> has('name'))
        <p>{{$errors -> first('name')}}</p>        
    @endif
    <br>
    <label for="email">Email</label>
    <input type="email" name="email" id="email" value="{{old('email')}}">
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