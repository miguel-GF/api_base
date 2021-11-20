<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => ['cors']], function () {
    
    Route::group(['prefix' => 'usuarios'], function() {
        Route::post('/login', 'UsuarioController@login');
    });
    
});

Route::group(['middleware' => ['cors', 'tkn']], function () {


    Route::group(['prefix' => 'calificaciones'], function() {
        Route::get('/listarCalificaciones', 'CalificacionController@listarCalificaciones');
    });

    //Pruebas
    Route::group(['prefix' => 'pruebas'], function() {
        Route::get('/prueba', 'TestController@show');
    });
    
});