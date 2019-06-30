@extends('layout')
   
@section('content')             
    <h2>Home usuarios</h2>
    <p>
    <a href="{{route('users.create')}}">Nuevo usuario</a>
    </p>

    @if ($users -> isNotEmpty())
    <thead class="thead-dark">
        <tr>
          <th scope="col">#</th>
          <th scope="col">Nombre</th>
          <th scope="col">Correo</th>
          <th scope="col">Acciones</th>
        </tr>
      </thead>
      <tbody>
          @foreach ($users as $user)
            <tr>
            <th scope="row">{{$user -> id}}</th>
                <td>{{$user -> name}}</td>
                <td>{{$user -> email}}</td>
                <td>
                      
                              
                                {{-- <a href="{{url('/usuarios/'.$user->id)}}">Ver detalles</a> --}}
                                {{-- <a href="{{action('UserController@show',['id'=>$user->id])}}">Ver detalles</a> --}}
                                <a href="{{route('users.show',$user)}}">Ver detalles</a>
                                <a href="{{route('users.edit',$user)}}">Editar usuario</a>
                                <form action="{{route('users.destroy',$user)}}" method="post">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE')}}
                                    <button type="submit">Eliminar</button>
                                </form>
                              
                                 
                           
                </td>
            </tr>
          @endforeach       
      </tbody>
    </table>
    
    <table class="table">
      <thead class="thead-light">
        <tr>
          <th scope="col">#</th>
          <th scope="col">First</th>
          <th scope="col">Last</th>
          <th scope="col">Handle</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <th scope="row">1</th>
          <td>Mark</td>
          <td>Otto</td>
          <td>@mdo</td>
        </tr>
        <tr>
          <th scope="row">2</th>
          <td>Jacob</td>
          <td>Thornton</td>
          <td>@fat</td>
        </tr>
        <tr>
          <th scope="row">3</th>
          <td>Larry</td>
          <td>the Bird</td>
          <td>@twitter</td>
        </tr>
      </tbody>
    </table>

    @else 
    <p>
        No hay usuarios registrados
    </p>
    @endif
    


    @if (!empty($users))
          
    @else
        <p>La lista no tiene ningun dato</p>
    @endif   
@endsection
{{-- @section('sidebar')
    @parent
    <h2>Barra lateral 2</h2>
@endsection --}}