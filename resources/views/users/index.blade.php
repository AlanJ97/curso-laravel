@extends('layout')
   
@section('content')             
    <h2>Home usuarios</h2>
    @if (!empty($users))
    <ul>
        @foreach($users as $user)
        <li> {{$user}} </li>
        @endforeach 
    </ul>            
    @else
        <p>La lista no tiene ningun dato</p>
    @endif   
@endsection
@section('sidebar')
    @parent
    <h2>Barra lateral 2</h2>
@endsection