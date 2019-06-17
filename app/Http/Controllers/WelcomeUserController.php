<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WelcomeUserController extends Controller
{
    public function index($name,$nickname=null){
        if($nickname){
            return 'Tu nombre es : '.$name.' y tu apodo es '.$nickname;
        }else{
            return 'Tu nombre es '.$name;
        }
    }
}
