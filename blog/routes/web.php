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
Route::get('error/servidor/{id}','Sevidor\\ErrosSevidorController@index')->name('error.index');
 
Route::group(['middleware' => ['permission:user','autenticacao']], function () {
    Route::get('relatorioboletimtabela/{id}','relatorioBoletimTabela\\relatorioBoletimTabelaController@fichaLancamentoTab');
   
   
    Route::get('listatabelapreco/{id}','TabelaPreco\\TabelaPrecoController@listaget')->name('listatabelapreco.lista');
    Route::get('boletimcartaoponto/{id}/{domingo}/{sabado}/{diasuteis}/{data}/{boletim}/{tomador}/{feriado}','BoletimCartaoPonto\\BoletimCartaoPontoController@create')->name('boletimcartaoponto.create');
    
    Route::get('boletimcartaoponto/{boletim}/{trabalhador}','BoletimCartaoPonto\\BoletimCartaoPontoController@show');
    
    Route::resource('boletimcartaoponto','BoletimCartaoPonto\\BoletimCartaoPontoController')->only(['store', 'update', 'destroy']);

    Route::resource('cadastrocartaoponto','CadastroCartaoPonto\\CadastroCartaoPontoController');

    Route::get('cadastro/cartao/ponto/{id}/{domingo}/{sabado}/{diasuteis}/{data}/{boletim}/{tomador}','BoletimCartaoPonto\\RelatorioCartaoPontoController@relatorioCartaoPonto')->name('cadastrocartaoponto.relatoriocartaoponto');

    Route::resource('tabcartaoponto','TabCartaoPonto\\TabCartaoPontoController')->names('tabcartaoponto');
    Route::get('tabela/cartao/ponto/{id}/{status}','TabCartaoPonto\\TabCartaoPontoController@show');
    Route::get('tabela/cartao/ponto/pesquisa/{id}/{status}','TabCartaoPonto\\TabCartaoPontoController@pesquisa');
    
    Route::get('tabcadastro/{quantidade}/{boletim}/{tomador}/{id}/{data}','TabCadastro\\TabCadastroController@create')->name('tabcadastro.create');
    Route::resource('tabcadastro','TabCadastro\\TabCadastroController')->only(['store', 'update', 'destroy','show']);
    Route::resource('logout','Login\\LoginController')->only(['create'])->names('logout');
    Route::resource('home','Home\\HomeController')->names('home');
   
    Route::get('comprovantepagamento','ComprovantePag\\ComprovantePagController@index');
    Route::get('comprovantepagamentodiaria','ComprovantePagDia\\ComprovantePagDiaController@index');
    Route::get('fatura','Fatura\\FaturaController@index');

    Route::get('tomador/pesquisa/{id}','Tomador\\TomadorController@pesquisa');
    Route::resource('tomador','Tomador\\TomadorController')->names('tomador');
    Route::post('comprovante/pagamento/dia','Tomador\\comprovantePagDia@ComprovantePagDia')->name('comprovante.pagamento.dia');


    Route::get('tabelapreco/{id?}/{tomador}','TabelaPreco\\TabelaPrecoController@index')->name('tabelapreco.index');
    Route::get('tabelapreco/pesquisa/{codigo}/{tomador}','TabelaPreco\\TabelaPrecoController@pesquisa')->name('tabelapreco.pesquisa');
    Route::get('tabelapreco/perfil/{codigo}/{tomador}','TabelaPreco\\TabelaPrecoController@show');
    Route::resource('tabelapreco','TabelaPreco\\TabelaPrecoController')->only(['store', 'update', 'destroy','edit']);



    Route::resource('trabalhador','Trabalhador\\TrabalhadorController')->names('trabalhador');
    Route::get('trabalhador/pesquisa/{id?}','Trabalhador\\TrabalhadorController@pesquisa');

    // Route::post('trabalhador/comprovante/pagamento/dia','Trabalhador\\comprovantePagDiaController@ComprovantePagDia')->name('trabalhador.comprovante.dia');

    Route::post('relatorio/empresa/trabalhada','Trabalhador\\RelatorioEmpresaTrabalhadaController@relatorioempresatrabalhada')->name('relatorio.empresa.trabalhada');
    Route::get('ficha/registro/trabalhador/{id}','Trabalhador\\fichaRegistroTrabController@fichaRegistroTrabalhador')->name('ficha.registro.trabalhador');
    Route::get('cracha/trabalhador/{id}','Trabalhador\\CrachaTrabalhadorController@cracha')->name('cracha.trabalhador');
    Route::get('declaracao/admissao/trabalhador/{id}','Trabalhador\\declaracaoAdmissaoController@declarassaoadminssao')->name('declaracao.admissao.trabalhador');
    Route::get('declaracao/afastamento/trabalhador/{id}','Trabalhador\\declaracaoAfastamentoController@declarassaoafastamento')->name('declaracao.afastamento.trabalhador');
    Route::get('devolucao/ctps/trabalhador/{id}','Trabalhador\\devolucaoCtpsController@devolucaoctps')->name('devolucao.ctps.trabalhador');
    Route::get('ficha/epi/trabalhador/{id}','Trabalhador\\fichaEpiTrabController@ficha')->name('ficha.epi.trabalhador');
    Route::get('trabalhadorolnome','Trabalhador\\PdfController@rolnome');


    Route::resource('comisionado','Comisionario\\ComisionarioController')->names('comisionado');
    Route::resource('depedente','Depedente\\DepedenteController')->only(['store', 'update', 'destroy','edit','show']);
    Route::resource('depedente.mostrar','Depedente\\DepedenteController')->only(['index', 'create']);
    Route::resource('listaempresa','Empresa\\EmpresaController')->only(['show','create']);

    Route::resource('empresa/perfil','Empresa\\PerfilController')->names('empresa.perfil');
    Route::get('empresa/pesquisa/{id}','Empresa\\EmpresaController@pesquisa');
    
    Route::get('calculo/folha','CalculoFolha\\calculoFolhaController@index')->name('calculo.folha.index');
    Route::post('cadastro/folha','CalculoFolha\\calculoFolhaController@store')->name('calculo.folha.store');
    Route::get('calculo/folha/tomador/{trabalhador?}/{tomador?}/{ano_inicial}/{ano_final}','CalculoFolha\\calculoFolhaPorTomadorController@calculoFolhaPorTomador')->name('calculo.folha.tomador');
    Route::get('calculo/folha/trabalhador/{trabalhador?}/{tomador?}/{ano_inicial}/{ano_final}','CalculoFolha\\calculoFolhaPorTrabalhadorController@calculoFolhaPorTrabalhador')->name('calculo.folha.trabalhador');
    Route::get('calculo/folha/geral/{ano_inicial}/{ano_final}','CalculoFolha\\calculoFolhaGeralController@calculoFolhaGeral')->name('calculo.folha.geral');
    
    Route::get('rublica/unic/{id}','Rublica\\RublicaController@unic');
    Route::group(['middleware' => ['permission:admin']], function () {
        Route::resource('user','User\\UserController')->names('user');
        Route::get('user/pesquisa/{id}','User\\UserController@pesquisa');
        Route::resource('irrf','Irrf\\IrrfController')->names('irrf');
        Route::resource('rublica','Rublica\\RublicaController')->names('rublica');
        Route::get('rublica/pesquisa/{id}','Rublica\\RublicaController@pesquisa');
        Route::resource('inss','Inss\\InssController')->names('inss');
        Route::resource('empresa','Empresa\\EmpresaController')->only(['store', 'update', 'destroy','edit','index'])->names('empresa');
       
    });
});
