<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
class UserController extends Controller
{
    public function index(){
        
        // $users = DB::table('users')->get();
        $users = User::all();
        $title = "Listado de usuarios";
        return view('users.index')
            ->with('users',$users)
            ->with('title',$title);
    }   
    public function show($id){
        $user = User::findOrFail($id);
        // if($user == null){
        //     return  response()->view('errors.404',[],404);
        // }
        return view('users.show')
            ->with('user',$user);
        
    }   
    public function create(){
        return 'Creando al usuario';
    }
    
}
