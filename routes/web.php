<?php

Route::get('/', function () {
    return 'Home Course';
});

Route::get('/usuarios', function () {
    return 'Home usuarios';
});
Route::get('/usuarios/{id}', function ($id) {
    return 'Mostrando detalles del usuario : '.$id;
})->where('id','[0-9]+');
Route::get('/usuarios/nuevo', function () {
    return 'Creando al usuario : ';
});
Route::get('/saludo/{name}/{nickname?}', function ($name,$nickname=null) {
    if($nickname){
        return 'Tu nombre es : '.$name.' y tu apodo es '.$nickname;
    }else{
        return 'Tu nombre es '.$name;
    }
  
});