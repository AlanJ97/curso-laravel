<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        return 'Home usuarios';
    }   
    public function show($id){
        return 'Mostrando detalles del usuario : '.$id;
    }   
    public function create(){
        return 'Creando al usuario';
    }
    
}
