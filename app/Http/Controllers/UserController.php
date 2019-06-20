<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        $users = [
            'Alan',
            'Jesús',
            'Segundo',
            'Nava'
        ];
        $title = "Listado de usuarios";
        return view('users')
            ->with('users',$users)
            ->with('title',$title);
    }   
    public function show($id){
        return 'Mostrando detalles del usuario : '.$id;
    }   
    public function create(){
        return 'Creando al usuario';
    }
    
}
