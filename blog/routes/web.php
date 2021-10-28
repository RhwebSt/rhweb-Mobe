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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::resource('/','user\\UserController')->names('user');
Route::resource('login','login\\LoginController')->names('login');
Route::resource('tomador','tomador\\TomadorController')->names('tomador');
Route::resource('trabalhador','trabalhador\\TrabalhadorController')->names('trabalhador');
Route::resource('home','home\\HomeController')->names('home');
Route::resource('usuario','usuario\\UsuarioController')->names('usuario');