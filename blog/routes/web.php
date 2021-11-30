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
Route::resource('/','Login\\LoginController')->only(['index'])->names('/');
Route::resource('login','Login\\LoginController')->only(['store'])->names('login');

Route::group(['middleware' => ['permission:user','autenticacao']], function () {
    Route::get('ficharegitrotrab/{id}','Trabalhador\\fichaRegistroTrabController@ficha');
    Route::get('relatorioboletimtabela/{id}','relatorioBoletimTabela\\relatorioBoletimTabelaController@ficha');
    Route::get('fichaepitrab/{id}','fichaEpi\\fichaEpiTrabController@ficha');
    Route::get('trabalhadorolnome','Trabalhador\\PdfController@rolnome');
    Route::get('listatabelapreco/{id}','TabelaPreco\\TabelaPrecoController@listaget');
    Route::resource('boletimcartaoponto','BoletimCartaoPonto\\BoletimCartaoPontoController')->names('boletimcartaoponto');
    Route::resource('cadastrocartaoponto','CadastroCartaoPonto\\CadastroCartaoPontoController')->names('cadastrocartaoponto');
    Route::resource('tabcartaoponto','TabCartaoPonto\\TabCartaoPontoController')->names('tabcartaoponto');
    Route::resource('tabcadastro','TabCadastro\\TabCadastroController')->names('tabcadastro');
    Route::resource('logout','Login\\LoginController')->only(['create'])->names('logout');
    Route::resource('home','Home\\HomeController')->names('home');
   
    Route::get('comprovantepagamento','ComprovantePag\\ComprovantePagController@index');
    Route::get('comprovantepagamentodiaria','ComprovantePagDia\\ComprovantePagDiaController@index');
    Route::get('fatura','Fatura\\FaturaController@index');
    Route::resource('tomador','Tomador\\TomadorController')->names('tomador');
    Route::resource('tabelapreco.mostrar','TabelaPreco\\TabelaPrecoController')->only(['index', 'create']);
    Route::resource('tabelapreco','TabelaPreco\\TabelaPrecoController')->only(['store', 'update', 'destroy','edit','show']);
    Route::resource('trabalhador','Trabalhador\\TrabalhadorController')->names('trabalhador');
    Route::resource('comisionado','Comisionario\\ComisionarioController')->names('comisionado');
    Route::resource('depedente','Depedente\\DepedenteController')->only(['store', 'update', 'destroy','edit','show']);
    Route::resource('depedente.mostrar','Depedente\\DepedenteController')->only(['index', 'create']);
    Route::resource('listaempresa','Empresa\\EmpresaController')->only(['show','create']);
    Route::get('rublica/unic/{id}','Rublica\\RublicaController@unic');
    Route::group(['middleware' => ['permission:admin']], function () {
        Route::resource('user','User\\UserController')->names('user');
        Route::resource('irrf','Irrf\\IrrfController')->names('irrf');
        Route::resource('rublica','Rublica\\RublicaController')->names('rublica');
        Route::resource('inss','Inss\\InssController')->names('inss');
        Route::resource('empresa','Empresa\\EmpresaController')->only(['store', 'update', 'destroy','edit','index'])->names('empresa');
    });
});
