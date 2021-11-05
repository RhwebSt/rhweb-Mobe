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
Route::resource('/','user\\UserController')->names('user');
Route::resource('login','login\\LoginController')->names('login');




Route::resource('depedente','depedente\\DepedenteController')->only(['store', 'update', 'destroy','edit','show']);
Route::resource('depedente.mostrar','depedente\\DepedenteController')->only(['index', 'create']);

Route::middleware(['admin'])->group(function () {
    Route::resource('home','home\\HomeController')->names('home');
    Route::resource('usuariotrabalhador','usuariotrabalhador\\UsuarioTrabalhadorController')->names('usuariotrabalhador');
    Route::resource('irrf','irrf\\IrrfController')->names('irrf');
    Route::resource('inss','inss\\InssController')->names('inss');
    Route::resource('tomador','tomador\\TomadorController')->names('tomador');
    Route::resource('tabelapreco.mostrar','tabelapreco\\TabelaPrecoController')->only(['index', 'create']);
    Route::resource('tabelapreco','tabelapreco\\TabelaPrecoController')->only(['store', 'update', 'destroy','edit','show']);
    Route::resource('trabalhador','trabalhador\\TrabalhadorController')->names('trabalhador');
    Route::resource('usuario','usuario\\UsuarioController')->names('usuario');
    Route::resource('comisionado','comisionario\\ComisionarioController')->names('comisionado');
});