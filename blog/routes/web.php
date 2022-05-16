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
Route::resource('/','Home\\HomeController')->only(['index'])->names('/');
Route::resource('login','Login\\LoginController')->names('login');
Route::resource('administrador/login','Administrador\\Login\\LoginController')->names('login.administrador');
Route::get('usuario/cadastro','User\\UserController@index');
Route::resource('cadastro/empresa','Empresa\\EmpresaController')->only(['store'])->names('cadastro.empresa');
Route::resource('user','User\\UserController')->names('user'); 
// Route::post('usuario/cadastro','User\\UserController@PreStore')->name('usuario.pre.cadastro');
Route::get('email',function()
{
    $user = new stdClass();
    $user->name = 'José Luis';
    $user->email = 'ljrri66@gmail.com';
    // return new App\Mail\Email($user);
    
});

Route::post('verifica/senha','Senha\\SenhaController@store')->name('verifica.senha');
Route::get('esqueci/senha','Senha\\SenhaController@index')->name('esqueci.senha.index');
Route::get('error/servidor/{id}','Sevidor\\ErrosSevidorController@index')->name('error.index');


Route::group(['middleware' => 'autenticacao'], function () {
    Route::get('relatorio/boletim/tabela/{id}','relatorioBoletimTabela\\relatorioBoletimTabelaController@fichaLancamentoTab')->name('relatorio.boletim.tabela');
    Route::get('listatabelapreco/{id}','TabelaPreco\\TabelaPrecoController@listaget')->name('listatabelapreco.lista');
    Route::get('boletimcartaoponto/{id}/{domingo}/{sabado}/{diasuteis}/{data}/{boletim}/{tomador}/{feriado}','BoletimCartaoPonto\\BoletimCartaoPontoController@create')->name('boletimcartaoponto.create');
    
    Route::get('boletim/cartao/ponto/{boletim}/{trabalhador}/{data}','BoletimCartaoPonto\\BoletimCartaoPontoController@show');
    
    Route::resource('boletimcartaoponto','BoletimCartaoPonto\\BoletimCartaoPontoController')->only(['store', 'update', 'destroy']);

    Route::resource('cadastrocartaoponto','CadastroCartaoPonto\\CadastroCartaoPontoController');
    Route::get('ordem/cadastro/cartao/ponto/{condicao?}/{ordem}','CadastroCartaoPonto\\CadastroCartaoPontoController@filtroPesquisaOrdem')->name('ordem.cadastro.cartao.ponto');
    Route::get('edit/ordem/cadastro/cartao/ponto/{id?}/{condicao}','CadastroCartaoPonto\\CadastroCartaoPontoController@filtroPesquisaOrdemEdit')->name('edit.ordem.cadastro.cartao.ponto');

    Route::get('cadastro/cartao/ponto/{id}/{domingo}/{sabado}/{diasuteis}/{data}/{boletim}/{tomador}','BoletimCartaoPonto\\RelatorioCartaoPontoController@relatorioCartaoPonto')->name('cadastrocartaoponto.relatoriocartaoponto');

    Route::resource('tabcartaoponto','TabCartaoPonto\\TabCartaoPontoController')->names('tabcartaoponto');
    Route::get('tabela/cartao/ponto/unidade/{id}/{status}','TabCartaoPonto\\TabCartaoPontoController@show');
    Route::get('tabela/cartao/ponto/pesquisa/{id}/{status}','TabCartaoPonto\\TabCartaoPontoController@pesquisa');
    Route::get('ordem/tabela/cartao/ponto/{condicao}','TabCartaoPonto\\TabCartaoPontoController@filtroPesquisaOrdem')->name('ordem.tabela.cartao.ponto');
    Route::get('edit/ordem/tabela/cartao/ponto/{id?}/{condicao}','TabCartaoPonto\\TabCartaoPontoController@filtroPesquisaOrdemEdit')->name('edit.ordem.tabela.cartao.ponto');
    

    Route::get('boletim/tabela/cadastro/{quantidade}/{boletim}/{tomador}/{id}/{data}','TabCadastro\\TabCadastroController@create')->name('boletim.tabela.create');

    Route::get('boletim/tabela/edita/{quantidade}/{boletim}/{tomador}/{lancamento}/{id}/{data}','TabCadastro\\TabCadastroController@edit')->name('boletim.tabela.edit');
    Route::get('boletim/ordem/tabela/{quantidade}/{boletim}/{tomador}/{id}/{trabalhador?}/{data}/{ordem}','TabCadastro\\TabCadastroController@ordem')->name('boletim.tabela.ordem');
    Route::resource('tabcadastro','TabCadastro\\TabCadastroController')->only(['store', 'update', 'destroy','show'])->names('boletim.tabela');
    Route::get('logout','Login\\LoginController@logout')->name('logout');
    
    Route::post('altera/editer','Login\\alteraSenhaController@store')->name('altera.store');
    Route::resource('home','Home\\HomeController')->names('home'); 
    
    Route::get('comprovantepagamento','ComprovantePag\\ComprovantePagController@index');
    Route::get('comprovantepagamentodiaria','ComprovantePagDia\\ComprovantePagDiaController@index');
    Route::get('fatura','Fatura\\FaturaController@index');
    Route::post('fatura/gera','Fatura\\FaturaController@store')->name('fatura.gera');
    Route::delete('fatura/deleta/{id}','Fatura\\FaturaController@destroy')->name('fatura.deleta'); 
    Route::get('relatorio/fatura/{tomador}/{inicio}/{final}','Fatura\\FaturaController@relatorio')->name('fatura.relatorio');
    Route::post('filtro/pesquisa/fatura','Fatura\\FaturaController@filtroPesquisa')->name('filtro.pesquisa.fatura');
    Route::get('ordem/filtro/fatura/{condicao}','Fatura\\FaturaController@filtroPesquisaOrdem')->name('filtro.ordem.fatura');

    Route::get('tomador/pesquisa/{id}','Tomador\\TomadorController@pesquisa');
    Route::resource('tomador','Tomador\\TomadorController')->names('tomador');
    Route::get('ordem/tomador/{ordem}/{id?}/{search?}','Tomador\\TomadorController@ordem')->name('ordem.tomador');
    Route::post('comprovante/pagamento/dia','Tomador\\comprovantePagDia@ComprovantePagDia')->name('comprovante.pagamento.dia');
    Route::get('boletim/tomador/{tomador}/{inicio}/{final}','Tomador\\rolBoletimTomadorController@rolBoletim')->name('boletim.tomador');
    Route::get('relatorio/geral/tomador','Tomador\\relatorioTomadorController@relatorioGeral')->name('relatorio.geral.tomador');


    Route::get('tabelapreco/{id?}/{tomador}','TabelaPreco\\TabelaPrecoController@index')->name('tabelapreco.index');
    Route::get('tabelapreco/pesquisa/{codigo}/{tomador}','TabelaPreco\\TabelaPrecoController@pesquisa')->name('tabelapreco.pesquisa');
    Route::get('tabelapreco/perfil/{codigo}/{tomador}','TabelaPreco\\TabelaPrecoController@show');
    Route::get('tabela/preco/editar/{id}/{tomador}','TabelaPreco\\TabelaPrecoController@edit')->name('tabela.preco.editar');
    Route::resource('tabelapreco','TabelaPreco\\TabelaPrecoController')->only(['store', 'update', 'destroy']);
    Route::get('verifica/tabela/preco/{tomador}','TabelaPreco\\TabelaPrecoController@verificaTabelaPreco'); 
    Route::get('tabela/preco/atualizar','TabelaPreco\\TabelaPrecoController@AtualizarTabelaPreco');

    Route::get('relatorio/tabela/preco/{id}','TabelaPreco\\RelatorioController@relatorio')->name('tabela.preco.relatorio');
    Route::get('ordem/tabela/preco/{id?}/{tomador}/{condicao}','TabelaPreco\\TabelaPrecoController@ordem')->name('ordem.tabela.preco');


    Route::resource('trabalhador','Trabalhador\\TrabalhadorController')->names('trabalhador');
    Route::get('ordem/trabalhador/{ordem}/{id?}/{search?}','Trabalhador\\TrabalhadorController@ordem')->name('ordem.trabalhador');
    Route::resource('epi','Trabalhador\\EpiController')->only(['store', 'update', 'index','create','show','edit']);
    Route::get('epi/deleta/{id}','Trabalhador\\EpiController@destroy')->name('epi.deleta');
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
    Route::get('pesquisa/comisionado','Comisionario\\ComisionarioController@pesquisa')->name('comisionado.pesquisa');
    Route::resource('depedente','Depedente\\DepedenteController')->only(['store', 'update', 'destroy','edit','show']);
    Route::resource('depedente.mostrar','Depedente\\DepedenteController')->only(['index', 'create']);
    

    
    
    
    Route::get('calculo/folha','CalculoFolha\\calculoFolhaController@index')->name('calculo.folha.index');
    Route::post('cadastro/folha','CalculoFolha\\calculoFolhaController@store')->name('calculo.folha.store');
    Route::post('tomador/filtra/calculo/folha','CalculoFolha\\calculoFolhaController@filtroPesquisaTomador')->name('calculo.folha.tomador.filtro');
    // Route::get('tomador/filtra/folha/calculo/{codicao}/{tomador}/{inicio}/{final}','CalculoFolha\\calculoFolhaController@filtroPesquisaTomadorOrdem')->name('filtra.folha.tomador.calculo');

    Route::post('geral/filtra/calculo/folha','CalculoFolha\\calculoFolhaController@filtroPesquisaGeral')->name('calculo.folha.geral.filtro');
    Route::get('filtra/folha/calculo/{codicao}','CalculoFolha\\calculoFolhaController@filtroPesquisaOrdem')->name('filtra.folha.calculo');

    Route::get('calculo/folha/tomador/{trabalhador?}/{tomador?}/{ano_inicial}/{ano_final}','CalculoFolha\\calculoFolhaPorTomadorController@calculoFolhaPorTomador')->name('calculo.folha.tomador');
    Route::get('calculo/folha/trabalhador/{trabalhador?}/{tomador?}/{ano_inicial}/{ano_final}','CalculoFolha\\calculoFolhaPorTrabalhadorController@calculoFolhaPorTrabalhador')->name('calculo.folha.trabalhador');
    Route::post('imprimir/calculo/folha/trabalhador','CalculoFolha\\calculoFolhaPorTrabalhadorController@imprimirTrabalhador')->name('calculo.folha.trabalhador.imprimir');
 
    Route::get('imprimir/calculo/folha/tomador/{folhar}/{tomador}','CalculoFolha\\calculoFolhaPorTomadorController@imprimirTomador')->name('calculo.folha.tomador.imprimir');
    Route::post('imprimir/calculo/folha/tomador/trabalhador','CalculoFolha\\calculoFolhaPorTomadorController@imprimirTrabalhador')->name('calculo.folha.tomador.trabalhador.imprimir');
    Route::get('calculo/folha/geral/{ano_inicial}/{ano_final}/{competencia}','CalculoFolha\\calculoFolhaGeralController@calculoFolhaGeral')->name('calculo.folha.geral');
    Route::get('calculo/folha/imprimir/{id}','CalculoFolha\\calculoFolhaGeralController@imprimirFolhar')->name('calculo.folha.imprimir');
    Route::get('deleta/calculo/folha/geral/{id}','CalculoFolha\\calculoFolhaGeralController@destroy')->name('calculo.folha.deletar');

    Route::get('analitica/calculo/folha/{id}','FolhaAnalitica\\FolhaAnaliticaController@calculoFolhaAnalitica')->name('calculo.folha.analitica');
    Route::get('tomador/analitica/calculo/folha/{id}/{tomador}','FolhaAnalitica\\FolhaAnaliticaTomadorController@calculoFolhaAnalitica')->name('tomador.calculo.folha.analitica');

    Route::post('imprimir/calculo/folha/banco','CalculoFolha\\relatorioBancoController@imprimirBanco')->name('calculo.folha.banco.imprimir');
    Route::post('imprimir/calculo/folha/rublica','CalculoFolha\\relatorioRublicaCFController@imprimir')->name('calculo.folha.rublica.imprimir');

    
    
    Route::get('rublica/unic/{id}','Rublica\\RublicaController@unic');

    Route::resource('descontos','Descontos\\DescontosController')->names('descontos');
    Route::get('descontos/ordem/{ordem}/{id?}','Descontos\\DescontosController@ordem')->name('desconto.ordem');
    Route::get('relatorio/descontos/{inicio}/{final}','Descontos\\relatorioController@index')->name('descontos.relatorio.index');
    Route::post('trabalhador/relatorio/descontos','Descontos\\relatorioController@reltatorioTrabalhador')->name('descontos.relatorio.trabalhador');

    Route::resource('avuso','Avuso\\AvusoController')->names('avuso'); 
    Route::get('avuso/pesquisa/{id}','Avuso\\AvusoController@pesquisa')->name('avuso.pesquisa');
    Route::post('filtra/pesquisa/avuso','Avuso\\AvusoController@filtroPesquisa')->name('filtra.pesquisa.avuso');
    Route::get('filtra/ordem/avuso/{condicao}','Avuso\\AvusoController@filtroPesquisaOrdem')->name('filtra.ordem.avuso');

    Route::get('avuso/relatorio/{id}/{inicio}/{final}','Avuso\\ReciboController@relatorio')->name('recibo.avulso');

    Route::get('gera/txt/sefip/{tomador}/{folha}/{empresa}','Sefip\\SefipController@geraTxt')->name('gera.txt.sefip');
    Route::post('recibo/avulso/trabalhador','Avuso\\ReceboTrabalhadorController@relatorio')->name('recibo.avulso.trabalhador');
    Route::get('esocial/tomador/{id}','Esocial\\EsocialController@eventS1020')->name('esocial.tomador');
    Route::get('esocial/trabalhador/{id}','Esocial\\EsocialController@eventS2300')->name('esocial.trabalhador');
    Route::put('trabalhador/esocial/{id}','Esocial\\EsocialController@update')->name('esocial.trabalhador.update');
    Route::get('administrador/pesquisa/cbo','Administrador\\Cbo\\CboController@pesquisa')->name('administrador.cbo.pesquisa');
    Route::get('administrador/pesquisa/categoria','Administrador\\Categoria\\CategoriaController@pesquisa')->name('administrador.categoria.pesquisa');
    Route::resource('administrador/categoria','Administrador\\Categoria\\CategoriaController')->names('administrador.categoria');
    Route::get('rublica/pesquisa/{id}','Administrador\\Rublica\\RublicaController@pesquisa');
    Route::group(['middleware' => ['permission:admin']], function () {  
        Route::get('permissao/{id}/{permissao}/{condicao}','Permissao\\PermissaoController@permissao')->name('permissao');
        Route::post('comentario','Comentario\\ComentarioController@store')->name('comentario'); 
        // Route::resource('usuario','UsuarioSindicato\\UsuarioSindicatoController')->only(['store', 'update', 'destroy','edit','index'])->names('usuario'); 
        Route::resource('empresa','Empresa\\EmpresaController')->only(['store', 'update', 'destroy','edit','index'])->names('empresa');  
        Route::resource('empresa/lista','Empresa\\EmpresaController')->only(['show','create']);
        Route::resource('empresa/perfil','Empresa\\PerfilController')->names('empresa.perfil');
        Route::get('empresa/pesquisa/{id}','Empresa\\EmpresaController@pesquisa');
        
        Route::post('foto/editer','Empresa\\PerfilController@editFoto')->name('foto.editer');

        Route::get('altera/senha','Login\\alteraSenhaController@index')->name('altera.index');

        Route::resource('usuario','Usuario\\UsuarioController')->names('usuario');
        Route::get('usuario/pesquisa/admin','Usuario\\UsuarioController@pesquisa')->name('usuario.pesquisa.admin');
        
        Route::resource('perfil','Perfil\\PerfilController')->names('perfil'); 

        Route::get('usuario/ordem/admin/{ordem}/{id?}','Usuario\\UsuarioController@ordem')->name('usuario.ordem.admin');

        Route::get('user/pesquisa/{id}','User\\UserController@pesquisa');
        Route::get('empresa/ordem/{ordem}/{id?}/{search?}','Empresa\\EmpresaController@ordem')->name('ordem.empresa');
       
    });
    Route::group(['middleware' => ['permission:Super Admin']], function () {
        
        Route::resource('inss','Administrador\\Inss\\InssController')->names('inss');
        Route::get('ordem/inss/{ano?}','Administrador\\Inss\\InssController@ordem')->name('inss.ordem');
        Route::resource('irrf','Administrador\\Irrf\\IrrfController')->names('irrf');
        Route::get('ordem/irrf/{ano?}','Administrador\\Irrf\\IrrfController@ordem')->name('irrf.ordem');
        Route::resource('rublica','Administrador\\Rublica\\RublicaController')->names('rublica');
        Route::get('relatorio/rublica','Administrador\\Rublica\\relatorioRublicaController@relatorio')->name('relatorio.rublica');
        
        Route::get('ordem/rublica/{ordem}/{id?}','Administrador\\Rublica\\RublicaController@ordem')->name('ordem.rublica');
        Route::get('administrador/logout','Administrador\\Login\\LoginController@logout')->name('logout.administrador');
        
        Route::get('administrador','Administrador\\AdministradorController@index')->name('administrador');

        Route::resource('administrador/usuarios','Administrador\\Usuario\\UsuarioController')->names('administrador.usuarios');
        Route::get('pesquisa/usuario','Administrador\\Usuario\\UsuarioController@pesquisa')->name('usuario.pesquisa');
        Route::get('ordem/usuario/{ordem}','Administrador\\Usuario\\UsuarioController@ordem')->name('usuario.ordem');
        Route::resource('administrador/trabalhador','Administrador\\Trabalhador\\HistoricaController')->names('administrador.trabalhador.historico');
        Route::resource('administrador/cbo','Administrador\\Cbo\\CboController')->names('administrador.cbo');
        
        Route::get('administrador/ordem/cbo/{ordem}/{id?}','Administrador\\Cbo\\CboController@ordem')->name('administrador.cbo.ordem');
       
        
        Route::get('administrador/ordem/categoria/{ordem}/{id?}','Administrador\\Categoria\\CategoriaController@ordem')->name('administrador.categoria.ordem');

        Route::post('administrador/cadastro/texto','Administrador\\Tomador\\BancoController@cadastroTxt');
        
        Route::post('administrador/cadastro/texto/trabalhador','Administrador\\Trabalhador\\BancoController@cadastroTxt');
    });
    
});
