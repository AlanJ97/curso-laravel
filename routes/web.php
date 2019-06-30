<?php

Route::get('/', function () {
    return 'Home Course';
});

Route::get('/usuarios', 'UserController@index')
    ->name('users');

Route::get('/usuarios/{user}','UserController@show')
    ->where('user','[0-9]+')
    ->name('users.show');

Route::get('/usuarios/nuevo', 'UserController@create')
    ->name('users.create');
Route::get('usuarios/{user}/editar','UserController@edit')
    ->name('users.edit');
Route::put('/usuarios/{user}','UserController@update');
Route::post('/usuarios/crear','UserController@store');


Route::get('/saludo/{name}/{nickname?}', 'WelcomeUserController@index');

Route::delete('usuarios/{user}','UserController@destroy')
    ->name('users.destroy');