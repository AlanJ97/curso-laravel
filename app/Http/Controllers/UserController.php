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
    public function show(User  $user){
        // $user = User::findOrFail($id);
        // if($user == null){
        //     return  response()->view('errors.404',[],404);
        // }
        return view('users.show')
            ->with('user',$user);
        
    }   
    public function create(){
        return view('users.create');
    }
    public function store(){

        $data = request()->validate([
            'name'=>'required',  
            'email'=>['required','email','unique:users,email'],  
            'password'=>'required'          
        ],[
            'name.required'=>'El campo nombre es obligatorio'
        ]);
        
        User::create([
            'name'=>$data['name'],
            'email'=>$data['email'],
            'password'=>bcrypt($data['password'])    
        ]);
        return redirect()->route('users');
    }
    public function edit(User $user){
            return view('users.edit',['user' => $user]);
    }
    public function update(User $user){
        $data = request()->validate([
            'name'=>'required',
            'email'=>'required|email',
            'password'=>'required',
        ]);
        if($data['password']!=null){
            $data['password'] = bcrypt($data['password']);
        }else{
            unset($data['password']);
        }
       
        $user->update($data);
        return redirect()->route('users.show',['user'=>$user]);
    }
}
