<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$title}}</title>
</head>
<body>
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
    
    
</body>
</html>