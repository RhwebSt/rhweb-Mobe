<?php

namespace App\Http\Controllers\Tomador;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Tomador;
use App\Taxa;
use App\Endereco;
use App\Bancario;
use App\RetencaoFatura;
use App\CartaoPonto;
use App\Parametrosefip;
use App\TaxaTrabalhador;
use App\IncideFolhar;
use App\IndiceFatura;
use App\TabelaPreco;
use App\Bolcartaoponto;
use App\Lancamentorublica;
use App\Lancamentotabela;
use App\Comissionado;
use App\ValoresRublica;
use App\Rublica;
class TomadorController extends Controller
{
    private $rublica,$tomador,$valorrublica,$taxa,$endereco,$bancario,
    $tabelapreco,$cartaoponto,$parametrosefip,$incidefolhar,$indicefatura,
    $comissionado,$retencaofatura,$bolcartaoponto,$lancamentorublica,$lancamentotabela;
    public function __construct()
    {
        $this->rublica = new Rublica;
        $this->tomador = new Tomador;
        $this->valorrublica = new ValoresRublica;
        $this->taxa = new Taxa;
        $this->endereco = new Endereco;
        $this->bancario = new Bancario;
        $this->tabelapreco = new TabelaPreco;
        $this->cartaoponto = new CartaoPonto;
        $this->parametrosefip = new Parametrosefip;
        $this->incidefolhar = new IncideFolhar;
        $this->indicefatura = new IndiceFatura; 
        $this->comissionado = new Comissionado;
        $this->retencaofatura = new RetencaoFatura;
        $this->bolcartaoponto = new Bolcartaoponto;
        $this->lancamentorublica = new Lancamentorublica;
        $this->lancamentotabela = new Lancamentotabela;
    }
    public function index()
    {
        // $tomador = new Tomador;
        // $tomadors = $tomador->lista();
        $user = Auth::user();
        $valorrublica_matricular = $this->valorrublica->buscaUnidadeEmpresa($user->empresa);
        return view('tomador.index',compact('user','valorrublica_matricular'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        // return view('tomador.create',compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dados = $request->all(); 
        $user = Auth::user();
        $request->validate([
            'nome__completo' => 'required|max:100|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÓÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôõóûùúüÿñæœ 0-9_\-().]*$/',
            'nome__fantasia' => 'required|max:100|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÓÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôõóûùúüÿñæœ 0-9_\-().]*$/',
            'cnpj' => 'required|max:19|cnpj',
            'matricula'=>'required|max:10|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÓÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôõóûùúüÿñæœ 0-9_\-().]*$/',
            'simples'=>'required|max:10|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÓÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôõóûùúüÿñæœ 0-9_\-().]*$/',
            'telefone'=>'required|max:16',
            'cep'=>'required|max:16|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÓÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôõóûùúüÿñæœ 0-9_\-().]*$/',
            'logradouro'=>'required|max:50|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÓÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôõóûùúüÿñæœ 0-9_\-().]*$/',
            'numero'=>'required|max:10|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÓÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôõóûùúüÿñæœ 0-9_\-().]*$/',
            'bairro'=>'required:max:40|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÓÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôõóûùúüÿñæœ 0-9_\-().]*$/',
            'localidade'=>'required|max:30|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÓÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôõóûùúüÿñæœ 0-9_\-().]*$/',
            'uf'=>'required|max:2|uf|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÓÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôõóûùúüÿñæœ 0-9_\-().]*$/',
            'taxa_adm'=>'',
            'taxa__fed'=>'',
            'deflator'=>'|max:100',
            'das'=>'',
            'cod__fpas'=>'',
            // 'cod__fap'=>'',
            'cod__grps'=>'',
            'cod__recol'=>'',
            'cnae'=>'',
            'fap__aliquota'=>'',
            'rat__ajustado'=>'',
            'fpas__terceiros'=>'',
            'aliq__terceiros'=>'',
            'alimentacao'=>'',
            'transporte'=>'',
            'epi'=>'',
            'seguro__trabalhador'=>'',
            'folhartransporte'=>'',
            'folhartipotrans'=>'',
            'folharalim'=>'',
            'folhartipoalim'=>'',
            'dias_uteis'=>'required|max:5',
            'sabados'=>'max:5',
            'domingos'=>'max:5',
            // 'inss__empresa'=>'',
            // 'retencaoinss'=>'',
            // 'fgts__empresa'=>'',
            // 'retencaofgts'=>'',
            // 'valor_fatura'=>'',
            'banco'=>'max:100',
            'agencia'=>'max:4',
            'operacao'=>'max:3',
            'conta'=>'max:10',
            'pix'=>'max:255'
        ],[
            'nome__completo.required'=>'O campo é obrigatório.',
            'nome__completo.max'=>'O campo não pode ter mais de 100 caracteres.',
            'nome__completo.regex'=>'O campo não pode ter caracteres especiais.',
            'nome__fantasia.required'=>'O campo é obrigatório.',
            'nome__fantasia.max'=>'O campo não pode ter mais de 100 caracteres.',
            'nome__fantasia.regex'=>'O campo não pode ter caracteres especiais.',
            'cnpj.required'=>'O campo é obrigatório.',
            'cnpj.max'=>'O campo não pode ter mais de 19 caracteres.',
            'cnpj.cnpj'=>'Não e um CNPJ valido.',
            'matricula.required'=>'O campo é obrigatório.',
            'matricula.max'=>'O campo não pode ter mais de 10 caracteres.',
            'matricula.regex'=>'O campo não pode ter caracteres especiais.',
            'simples.required'=>'O campo é obrigatório.',
            'simples.max'=>'O campo não pode ter mais de 10 caracteres.',
            'simples.regex'=>'O campo não pode ter caracteres especiais.',
            'telefone.required'=>'O campo é obrigatório.',
            'telefone.max'=>'O campo não pode ter mais de 16 caracteres.',
            'cep.required'=>'O campo é obrigatório.',
            'cep.max'=>'O campo não pode ter mais de 16 caracteres.',
            'cep.regex'=>'O campo não pode ter caracteres especiais.',
            'logradouro.required'=>'O campo é obrigatório.',
            'logradouro.max'=>'O campo não pode ter mais de 50 caracteres.',
            'logradouro.regex'=>'O campo não pode ter caracteres especiais.',
            'numero.required'=>'O campo é obrigatório.',
            'numero.max'=>'O campo não pode ter mais de 10 caracteres.',
            'numero.regex'=>'O campo não pode ter caracteres especiais.',
            'bairro.required'=>'O campo é obrigatório.',
            'bairro.max'=>'O campo não pode ter mais de 40 caracteres.',
            'bairro.regex'=>'O campo não pode ter caracteres especiais.',
            'localidade.required'=>'O campo é obrigatório.',
            'localidade.max'=>'O campo não pode ter mais de 30 caracteres.',
            'localidade.regex'=>'O campo não pode ter caracteres especiais.',
            'uf.required'=>'O campo é obrigatório.',
            'uf.max'=>'O campo não pode ter mais de 2 caracteres.',
            'uf.regex'=>'O campo não pode ter caracteres especiais.',
            'uf.uf'=>'Esta sigla não esta correta.',
            'deflator.required'=>'O campo é obrigatório.',
            'deflator.max'=>'O campo não pode ter mais de 100 caracteres.',
            'taxa_adm.required'=>'O campo é obrigatório.',
            'taxa__fed.required'=>'O campo é obrigatório.',
            'das.required'=>'O campo é obrigatório.',
            'cod__fpas.required'=>'O campo é obrigatório.',
            'cod__fpas.required'=>'O campo é obrigatório.',
            'cod__grps.required'=>'O campo é obrigatório.',
            'cod__recol.required'=>'O campo é obrigatório.',
            'cnae.required'=>'O campo é obrigatório.',
            'fap__aliquota.required'=>'O campo é obrigatório.',
            'rat__ajustado.required'=>'O campo é obrigatório.',
            'fpas__terceiros.required'=>'O campo é obrigatório.',
            'aliq__terceiros.required'=>'O campo é obrigatório.',
            'alimentacao.required'=>'O campo é obrigatório.',
            'transporte.required'=>'O campo é obrigatório.',
            'epi.required'=>'O campo é obrigatório.',
            'seguro__trabalhador.required'=>'O campo é obrigatório.',
            'folhartransporte.required'=>'O campo é obrigatório.',
            'folhartipotrans.required'=>'O campo é obrigatório.',
            'folharalim.required'=>'O campo é obrigatório.',
            'folhartipoalim.required'=>'O campo é obrigatório.',
            'dias_uteis.required'=>'O campo é obrigatório.',
            'dias_uteis.max'=>'O campo não pode ter mais de 5 caracteres.',
            'sabados.max'=>'O campo não pode ter mais de 5 caracteres.',
            'domingos.max'=>'O campo não pode ter mais de 5 caracteres.',
            'banco.max'=>'O campo não pode ter mais de 100 caracteres.',
            'agencia.max'=>'O campo não pode ter mais de 4 caracteres.',
            'operacao.max'=>'O campo não pode ter mais de 3 caracteres.',
            'conta.max'=>'O campo não pode ter mais de 10 caracteres.',
            'pix.max'=>'O campo não pode ter mais de 225 caracteres.'
        ]
        );
        $tomadores = $this->tomador->verificaCadastroCnpj($dados);
        if ($tomadores) {
            return redirect()->back()->withErrors(['cnpj'=>'Este CNPJ já esta cadastrador.']);
        }
       
        $rublicas = $this->rublica->listaRublicaTabelaPreco(); 
        try {
            $tomadors = $this->tomador->cadastro($dados);
            if ($tomadors) {
                $dados['tomador'] = $tomadors['id'];
                foreach ($rublicas as $key => $rublica) {
                    $dadostabelapreco = [
                        'ano'=>date('Y'),
                        'rubricas'=>$rublica->rsrublica,
                        'descricao'=>$rublica->rsdescricao,
                        'valor'=>0,
                        'valor__tomador'=>0,
                        'empresa'=>$user->empresa,
                        'tomador'=>$tomadors['id']
                    ];
                    $this->tabelapreco->cadastro($dadostabelapreco);
                }
                $incidefolhars = $this->incidefolhar->cadastro($dados);
                $enderecos = $this->endereco->cadastro($dados); 
                $taxas = $this->taxa->cadastro($dados);
                $bancarios = $this->bancario->cadastro($dados);
                // $retencaofaturas = $retencaofatura->cadastro($dados);
                $cartaoponto = $this->cartaoponto->cadastro($dados);
                $parametrosefips = $this->parametrosefip->cadastro($dados);
                // $taxatrabalhador = $taxatrabalhador->cadastro($dados);
                $indicefaturas = $this->indicefatura->cadastro($dados);
                $this->valorrublica->editarMatricularTomador($dados,$user->empresa);

                return redirect()->back()->withSuccess('Cadastro realizado com sucesso.'); 
            }
        
        } catch (\Throwable $th) {
            $cartaoponto = $this->cartaoponto->deletar($dados['tomador']);
            $parametrosefips = $this->parametrosefip->deletar($dados['tomador']);
            $indicefaturas = $this->indicefatura->deletar($dados['tomador']);
            $taxas = $this->taxa->deletar($dados['tomador']);
            $incidefolhars = $this->incidefolhar->deletar($dados['tomador']);
            $this->endereco->deletarTomador($dados['tomador']);
            $this->bancario->deletarTomador($dados['tomador']);
            $this->tabelapreco->deletatomador($dados['tomador']);
            $this->tomador->deletar($dados['tomador']); 
            return redirect()->route('tomador.index')->withInput()->withErrors(['false'=>'Não foi prossível cadastrar.']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
       
        $tomadors = $this->tomador->first($id);
        return response()->json($tomadors);
    }
    public function pesquisa($id)
    {
        $tomadors = $this->tomador->pesquisa($id);
        return response()->json($tomadors);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }
   
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $dados = $request->all();
        $request->validate([
            'nome__completo' => 'required|max:100|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÓÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôõóûùúüÿñæœ 0-9_\-().]*$/',
            'nome__fantasia' => 'required|max:100|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÓÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôõóûùúüÿñæœ 0-9_\-().]*$/',
            'cnpj' => 'required|max:19|cnpj',
            'matricula'=>'required|max:10|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÓÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôõóûùúüÿñæœ 0-9_\-().]*$/',
            'simples'=>'required|max:10|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÓÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôõóûùúüÿñæœ 0-9_\-().]*$/',
            'telefone'=>'required|max:16',
            'cep'=>'required|max:16|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÓÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôõóûùúüÿñæœ 0-9_\-().]*$/',
            'logradouro'=>'required|max:50|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÓÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôõóûùúüÿñæœ 0-9_\-().]*$/',
            'numero'=>'required|max:10|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÓÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôõóûùúüÿñæœ 0-9_\-().]*$/',
            'bairro'=>'required:max:40|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÓÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôõóûùúüÿñæœ 0-9_\-().]*$/',
            'localidade'=>'required|max:30|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÓÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôõóûùúüÿñæœ 0-9_\-().]*$/',
            'uf'=>'required|max:2|uf|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÓÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôõóûùúüÿñæœ 0-9_\-().]*$/',
            'taxa_adm'=>'required',
            'taxa__fed'=>'required',
            'deflator'=>'required|max:100',
            'das'=>'required',
            'cod__fpas'=>'required',
            // 'cod__fap'=>'required',
            'cod__grps'=>'required',
            'cod__recol'=>'required',
            'cnae'=>'required',
            'fap__aliquota'=>'required',
            'rat__ajustado'=>'required',
            'fpas__terceiros'=>'required',
            'aliq__terceiros'=>'required',
            'alimentacao'=>'required',
            'transporte'=>'required',
            'epi'=>'required',
            'seguro__trabalhador'=>'required',
            'folhartransporte'=>'required',
            'folhartipotrans'=>'required',
            'folharalim'=>'required',
            'folhartipoalim'=>'required',
            'dias_uteis'=>'max:5',
            'sabados'=>'max:5',
            'domingos'=>'max:5',
            // 'inss__empresa'=>'required',
            // 'retencaoinss'=>'required',
            // 'fgts__empresa'=>'required',
            // 'retencaofgts'=>'required',
            // 'valor_fatura'=>'required',
            'banco'=>'max:100',
            'agencia'=>'max:4',
            'operacao'=>'max:3',
            'conta'=>'max:10',
            'pix'=>'max:255'
        ],
        [
            'nome__completo.required'=>'O campo é obrigatório.',
            'nome__completo.max'=>'O campo não pode ter mais de 100 caracteres.',
            'nome__completo.regex'=>'O campo não pode ter caracteres especiais.',
            'nome__fantasia.required'=>'O campo é obrigatório.',
            'nome__fantasia.max'=>'O campo não pode ter mais de 100 caracteres.',
            'nome__fantasia.regex'=>'O campo não pode ter caracteres especiais.',
            'cnpj.required'=>'O campo é obrigatório.',
            'cnpj.max'=>'O campo não pode ter mais de 19 caracteres.',
            'cnpj.cnpj'=>'Não e um CNPJ valido.',
            'matricula.required'=>'O campo é obrigatório.',
            'matricula.max'=>'O campo não pode ter mais de 10 caracteres.',
            'matricula.regex'=>'O campo não pode ter caracteres especiais.',
            'simples.required'=>'O campo é obrigatório.',
            'simples.max'=>'O campo não pode ter mais de 10 caracteres.',
            'simples.regex'=>'O campo não pode ter caracteres especiais.',
            'telefone.required'=>'O campo é obrigatório.',
            'telefone.max'=>'O campo não pode ter mais de 16 caracteres.',
            'cep.required'=>'O campo é obrigatório.',
            'cep.max'=>'O campo não pode ter mais de 16 caracteres.',
            'cep.regex'=>'O campo não pode ter caracteres especiais.',
            'logradouro.required'=>'O campo é obrigatório.',
            'logradouro.max'=>'O campo não pode ter mais de 50 caracteres.',
            'logradouro.regex'=>'O campo não pode ter caracteres especiais.',
            'numero.required'=>'O campo é obrigatório.',
            'numero.max'=>'O campo não pode ter mais de 10 caracteres.',
            'numero.regex'=>'O campo não pode ter caracteres especiais.',
            'bairro.required'=>'O campo é obrigatório.',
            'bairro.max'=>'O campo não pode ter mais de 40 caracteres.',
            'bairro.regex'=>'O campo não pode ter caracteres especiais.',
            'localidade.required'=>'O campo é obrigatório.',
            'localidade.max'=>'O campo não pode ter mais de 30 caracteres.',
            'localidade.regex'=>'O campo não pode ter caracteres especiais.',
            'uf.required'=>'O campo é obrigatório.',
            'uf.max'=>'O campo não pode ter mais de 2 caracteres.',
            'uf.regex'=>'O campo não pode ter caracteres especiais.',
            'uf.uf'=>'Esta sigla não esta correta.',
            'deflator.required'=>'O campo é obrigatório.',
            'deflator.max'=>'O campo não pode ter mais de 100 caracteres.',
            'taxa_adm.required'=>'O campo é obrigatório.',
            'taxa__fed.required'=>'O campo é obrigatório.',
            'das.required'=>'O campo é obrigatório.',
            'cod__fpas.required'=>'O campo é obrigatório.',
            'cod__fpas.required'=>'O campo é obrigatório.',
            'cod__grps.required'=>'O campo é obrigatório.',
            'cod__recol.required'=>'O campo é obrigatório.',
            'cnae.required'=>'O campo é obrigatório.',
            'fap__aliquota.required'=>'O campo é obrigatório.',
            'rat__ajustado.required'=>'O campo é obrigatório.',
            'fpas__terceiros.required'=>'O campo é obrigatório.',
            'aliq__terceiros.required'=>'O campo é obrigatório.',
            'alimentacao.required'=>'O campo é obrigatório.',
            'transporte.required'=>'O campo é obrigatório.',
            'epi.required'=>'O campo é obrigatório.',
            'seguro__trabalhador.required'=>'O campo é obrigatório.',
            'folhartransporte.required'=>'O campo é obrigatório.',
            'folhartipotrans.required'=>'O campo é obrigatório.',
            'folharalim.required'=>'O campo é obrigatório.',
            'folhartipoalim.required'=>'O campo é obrigatório.',
            'dias_uteis.max'=>'O campo não pode ter mais de 5 caracteres.',
            'sabados.max'=>'O campo não pode ter mais de 5 caracteres.',
            'domingos.max'=>'O campo não pode ter mais de 5 caracteres.',
            'banco.max'=>'O campo não pode ter mais de 100 caracteres.',
            'agencia.max'=>'O campo não pode ter mais de 4 caracteres.',
            'operacao.max'=>'O campo não pode ter mais de 3 caracteres.',
            'conta.max'=>'O campo não pode ter mais de 10 caracteres.',
            'pix.max'=>'O campo não pode ter mais de 225 caracteres.'
            
        ]
        );
     
      
        try {
            $tomadors = $this->tomador->editar($dados,$id);
            $enderecos = $this->endereco->editar($dados,$dados['endereco']); 
            $bancarios = $this->bancario->editar($dados,$dados['bancario']);
            // $retencaofaturas = $retencaofatura->editar($dados,$id);
            $cartaoponto = $this->cartaoponto->editar($dados,$id);
            $parametrosefips = $this->parametrosefip->editar($dados,$id);
            // $taxatrabalhador = $taxatrabalhador->editar($dados,$id);
            $indicefaturas = $this->indicefatura->editar($dados,$id);
            $incidefolhars = $this->incidefolhar->editar($dados,$id);
            $taxas = $this->taxa->editar($dados,$id);
            // dd($tomadors , $enderecos , $taxas
            // , $bancarios , $retencaofaturas , 
            // $cartaoponto , $parametrosefips , $indicefaturas);
            if ($tomadors && $enderecos && $taxas
            && $bancarios  && $incidefolhars &&
            $cartaoponto && $parametrosefips && $indicefaturas) {
                return redirect()->back()->withSuccess('Atualizador com sucesso.'); 
                
            }
        } catch (\Throwable $th) {
            return redirect()->route('tomador.index')->withInput()->withErrors(['false'=>'Não foi porssível atualizar os dados.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
      
        $user = auth()->user();
        $dados = ['matricula'=>''];
        $lancamentotabelas = $this->lancamentotabela->buscaTomador($id);
        
            foreach ($lancamentotabelas as $key => $value) {
                $bolcartaopontos = $this->bolcartaoponto->deletar($value->id);
                $lancamentorublicas = $this->lancamentorublica->deletar($value->id);
            }
            
            $campoendereco = 'tomador';
            $campobacario = 'tomador';
            $lancamentotabelas = $this->lancamentotabela->deletarTomador($id);
            $comissionados = $this->comissionado->deletaTomador($id);
            $bancarios = $this->bancario->first($id,$campobacario);
            $exbancarios = $this->bancario->deletar($bancarios->biid);
            $tabelaprecos = $this->tabelapreco->deletatomador($id);
            $enderecos = $this->endereco->first($id,$campoendereco); 
            $exenderecos = $this->endereco->deletar($enderecos->eiid); 
            // $retencaofaturas = $retencaofatura->deletar($id);
            $cartaoponto = $this->cartaoponto->deletar($id);
            $parametrosefips = $this->parametrosefip->deletar($id);
            // $taxatrabalhador = $taxatrabalhador->deletar($id);
            $indicefaturas = $this->indicefatura->deletar($id);
            $taxas = $this->taxa->deletar($id);
            $incidefolhars = $this->incidefolhar->deletar($id);
            $tomadors = $this->tomador->deletar($id); 
            $valorrublica_matricular = $this->valorrublica->buscaUnidadeEmpresa($user->empresa);
            if (isset($valorrublica_matricular->vimatriculartomador)) {
                $dados['matricula'] =  $valorrublica_matricular->vimatriculartomador - 1;
                $this->valorrublica->editarMatricularTomador($dados,$user->empresa);
            }
            return redirect()->back()->withSuccess('Deletado com sucesso.'); 
        try {
            
        } catch (\Throwable $th) {
            return redirect()->route('tomador.index')->withInput()->withErrors(['false'=>'Não foi porssível deletar o registro.']);
        }
    }
}
