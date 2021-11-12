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
Route::resource('/','User\\UserController')->names('user');
Route::resource('login','Login\\LoginController')->names('login');

Route::middleware(['admin'])->group(function () {
    Route::get('rolnome','PdfController@rolnome');
    Route::resource('depedente','Depedente\\DepedenteController')->only(['store', 'update', 'destroy','edit','show']);
    Route::resource('depedente.mostrar','Depedente\\DepedenteController')->only(['index', 'create']);
    Route::resource('home','Home\\HomeController')->names('home');
    Route::resource('rolnomealfabetica','Trabalhador\\RelatorioController')->only(['index']);
    Route::resource('usuariotrabalhador','UsuarioTrabalhador\\UsuarioTrabalhadorController')->names('usuariotrabalhador');
    Route::resource('irrf','Irrf\\IrrfController')->names('irrf');
    Route::resource('rublica','Rublica\\RublicaController')->names('rublica');
    Route::resource('inss','Inss\\InssController')->names('inss');
    Route::resource('tomador','Tomador\\TomadorController')->names('tomador');
    Route::resource('tabelapreco.mostrar','Tabelapreco\\TabelaPrecoController')->only(['index', 'create']);
    Route::resource('tabelapreco','Tabelapreco\\TabelaPrecoController')->only(['store', 'update', 'destroy','edit','show']);
    Route::resource('trabalhador','Trabalhador\\TrabalhadorController')->names('trabalhador');
    Route::resource('usuario','Usuario\\UsuarioController')->names('usuario');
    Route::resource('comisionado','Comisionario\\ComisionarioController')->names('comisionado');
});