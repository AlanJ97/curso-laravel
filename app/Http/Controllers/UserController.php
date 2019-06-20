<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        if(request()->has('empty')){
            $users = [];
        }else{
            $users = [
                'Alan',
                'Jesús',
                'Segundo',
                'Nava'
            ];
        }
      
        $title = "Listado de usuarios";
        return view('users.index')
            ->with('users',$users)
            ->with('title',$title);
    }   
    public function show($id){
        return view('users.show')
            ->with('id',$id);
        
    }   
    public function create(){
        return 'Creando al usuario';
    }
    
}
