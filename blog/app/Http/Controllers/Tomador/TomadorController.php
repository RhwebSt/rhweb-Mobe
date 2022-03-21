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
        $tomadors = $this->tomador->buscaListaTomadorPaginate(); 
        // dd($tomadors);
        $user = Auth::user();
        $valorrublica_matricular = $this->valorrublica->buscaUnidadeEmpresa($user->empresa);
        return view('tomador.index',compact('user','valorrublica_matricular','tomadors'));
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
            'nome__completo.required'=>'Este campo é obrigatório.',
            'nome__completo.max'=>'O campo não pode conter mais de 100 caracteres.',
            'nome__completo.regex'=>'O campo não pode conter caracteres especiais.',
            'nome__fantasia.required'=>'Este campo é obrigatório.',
            'nome__fantasia.max'=>'O campo não pode conter mais de 100 caracteres.',
            'nome__fantasia.regex'=>'O campo não pode conter caracteres especiais.',
            'cnpj.required'=>'Este campo é obrigatório.',
            'cnpj.max'=>'O campo não pode conter mais de 19 caracteres.',
            'cnpj.cnpj'=>'Não é um CNPJ valido.',
            'matricula.required'=>'Este campo é obrigatório.',
            'matricula.max'=>'O campo não pode conter mais de 10 caracteres.',
            'matricula.regex'=>'O campo não pode conter caracteres especiais.',
            'simples.required'=>'Este campo é obrigatório.',
            'simples.max'=>'O campo não pode conter mais de 10 caracteres.',
            'simples.regex'=>'O campo não pode conter caracteres especiais.',
            'telefone.required'=>'Este campo é obrigatório.',
            'telefone.max'=>'O campo não pode conter mais de 16 caracteres.',
            'cep.required'=>'Este campo é obrigatório.',
            'cep.max'=>'O campo não pode conter mais de 16 caracteres.',
            'cep.regex'=>'O campo não pode conter caracteres especiais.',
            'logradouro.required'=>'Este campo é obrigatório.',
            'logradouro.max'=>'O campo não pode conter mais de 50 caracteres.',
            'logradouro.regex'=>'O campo não pode conter caracteres especiais.',
            'numero.required'=>'Este campo é obrigatório.',
            'numero.max'=>'O campo não pode conter mais de 10 caracteres.',
            'numero.regex'=>'O campo não pode conter caracteres especiais.',
            'bairro.required'=>'Este campo é obrigatório.',
            'bairro.max'=>'O campo não pode conter mais de 40 caracteres.',
            'bairro.regex'=>'O campo não pode conter caracteres especiais.',
            'localidade.required'=>'Este campo é obrigatório.',
            'localidade.max'=>'O campo não pode conter mais de 30 caracteres.',
            'localidade.regex'=>'O campo não pode conter caracteres especiais.',
            'uf.required'=>'Este campo é obrigatório.',
            'uf.max'=>'O campo não pode conter mais de 2 caracteres.',
            'uf.regex'=>'O campo não pode conter caracteres especiais.',
            'uf.uf'=>'Esta sigla não está correta.',
            'deflator.required'=>'Este campo é obrigatório.',
            'deflator.max'=>'O campo não pode conter mais de 100 caracteres.',
            'taxa_adm.required'=>'Este campo é obrigatório.',
            'taxa__fed.required'=>'Este campo é obrigatório.',
            'das.required'=>'Este campo é obrigatório.',
            'cod__fpas.required'=>'Este campo é obrigatório.',
            'cod__fpas.required'=>'Este campo é obrigatório.',
            'cod__grps.required'=>'Este campo é obrigatório.',
            'cod__recol.required'=>'Este campo é obrigatório.',
            'cnae.required'=>'Este campo é obrigatório.',
            'fap__aliquota.required'=>'Este campo é obrigatório.',
            'rat__ajustado.required'=>'Este campo é obrigatório.',
            'fpas__terceiros.required'=>'Este campo é obrigatório.',
            'aliq__terceiros.required'=>'Este campo é obrigatório.',
            'alimentacao.required'=>'Este campo é obrigatório.',
            'transporte.required'=>'Este campo é obrigatório.',
            'epi.required'=>'Este campo é obrigatório.',
            'seguro__trabalhador.required'=>'Este campo é obrigatório.',
            'folhartransporte.required'=>'Este campo é obrigatório.',
            'folhartipotrans.required'=>'Este campo é obrigatório.',
            'folharalim.required'=>'Este campo é obrigatório.',
            'folhartipoalim.required'=>'Este campo é obrigatório.',
            'dias_uteis.required'=>'Este campo é obrigatório.',
            'dias_uteis.max'=>'O campo não pode conter mais de 5 caracteres.',
            'sabados.max'=>'O campo não pode conter mais de 5 caracteres.',
            'domingos.max'=>'O campo não pode conter mais de 5 caracteres.',
            'banco.max'=>'O campo não pode conter mais de 100 caracteres.',
            'agencia.max'=>'O campo não pode conter mais de 4 caracteres.',
            'operacao.max'=>'O campo não pode conter mais de 3 caracteres.',
            'conta.max'=>'O campo não pode conter mais de 10 caracteres.',
            'pix.max'=>'O campo não pode conter mais de 225 caracteres.'
        ]
        );
        $tomadores = $this->tomador->verificaCadastroCnpj($dados);
        if ($tomadores) {
            return redirect()->back()->withErrors(['cnpj'=>'Este CNPJ já está cadastrado.']);
        }
       
        $rublicas = $this->rublica->listaRublicaTabelaPreco(); 
        
            $tomadors = $this->tomador->cadastro($dados);
            if ($tomadors) {
                $dados['tomador'] = $tomadors['id'];
                foreach ($rublicas as $key => $rublica) {
                    $dadostabelapreco = [
                        'ano'=>date('Y'),
                        'rubricas'=>$rublica->rsrublica,
                        'descricao'=>$rublica->rsdescricao,
                        'status'=>'',
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
            try {
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
            return redirect()->route('tomador.index')->withInput()->withErrors(['false'=>'Não foi possível cadastrar.']);
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
        $user = Auth::user();
        $tomador = $this->tomador->first($id);
        // dd($tomador);
        $tomadors = $this->tomador->buscaListaTomadorPaginate();
        return view('tomador.edit',compact('user','tomador','tomadors'));
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
        // dd($dados);
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
            'nome__completo.required'=>'Este campo é obrigatório.',
            'nome__completo.max'=>'O campo não pode conter mais de 100 caracteres.',
            'nome__completo.regex'=>'O campo não pode conter caracteres especiais.',
            'nome__fantasia.required'=>'Este campo é obrigatório.',
            'nome__fantasia.max'=>'O campo não pode conter mais de 100 caracteres.',
            'nome__fantasia.regex'=>'O campo não pode conter caracteres especiais.',
            'cnpj.required'=>'Este campo é obrigatório.',
            'cnpj.max'=>'O campo não pode conter mais de 19 caracteres.',
            'cnpj.cnpj'=>'Não e um CNPJ valido.',
            'matricula.required'=>'Este campo é obrigatório.',
            'matricula.max'=>'O campo não pode conter mais de 10 caracteres.',
            'matricula.regex'=>'O campo não pode conter caracteres especiais.',
            'simples.required'=>'Este campo é obrigatório.',
            'simples.max'=>'O campo não pode conter mais de 10 caracteres.',
            'simples.regex'=>'O campo não pode conter caracteres especiais.',
            'telefone.required'=>'Este campo é obrigatório.',
            'telefone.max'=>'O campo não pode conter mais de 16 caracteres.',
            'cep.required'=>'Este campo é obrigatório.',
            'cep.max'=>'O campo não pode conter mais de 16 caracteres.',
            'cep.regex'=>'O campo não pode conter caracteres especiais.',
            'logradouro.required'=>'Este campo é obrigatório.',
            'logradouro.max'=>'O campo não pode conter mais de 50 caracteres.',
            'logradouro.regex'=>'O campo não pode conter caracteres especiais.',
            'numero.required'=>'Este campo é obrigatório.',
            'numero.max'=>'O campo não pode conter mais de 10 caracteres.',
            'numero.regex'=>'O campo não pode conter caracteres especiais.',
            'bairro.required'=>'Este campo é obrigatório.',
            'bairro.max'=>'O campo não pode conter mais de 40 caracteres.',
            'bairro.regex'=>'O campo não pode conter caracteres especiais.',
            'localidade.required'=>'Este campo é obrigatório.',
            'localidade.max'=>'O campo não pode conter mais de 30 caracteres.',
            'localidade.regex'=>'O campo não pode conter caracteres especiais.',
            'uf.required'=>'Este campo é obrigatório.',
            'uf.max'=>'O campo não pode conter mais de 2 caracteres.',
            'uf.regex'=>'O campo não pode conter caracteres especiais.',
            'uf.uf'=>'Esta sigla não esta correta.',
            'deflator.required'=>'Este campo é obrigatório.',
            'deflator.max'=>'O campo não pode conter mais de 100 caracteres.',
            'taxa_adm.required'=>'Este campo é obrigatório.',
            'taxa__fed.required'=>'Este campo é obrigatório.',
            'das.required'=>'Este campo é obrigatório.',
            'cod__fpas.required'=>'Este campo é obrigatório.',
            'cod__fpas.required'=>'Este campo é obrigatório.',
            'cod__grps.required'=>'Este campo é obrigatório.',
            'cod__recol.required'=>'Este campo é obrigatório.',
            'cnae.required'=>'Este campo é obrigatório.',
            'fap__aliquota.required'=>'Este campo é obrigatório.',
            'rat__ajustado.required'=>'Este campo é obrigatório.',
            'fpas__terceiros.required'=>'Este campo é obrigatório.',
            'aliq__terceiros.required'=>'Este campo é obrigatório.',
            'alimentacao.required'=>'Este campo é obrigatório.',
            'transporte.required'=>'Este campo é obrigatório.',
            'epi.required'=>'Este campo é obrigatório.',
            'seguro__trabalhador.required'=>'Este campo é obrigatório.',
            'folhartransporte.required'=>'Este campo é obrigatório.',
            'folhartipotrans.required'=>'Este campo é obrigatório.',
            'folharalim.required'=>'Este campo é obrigatório.',
            'folhartipoalim.required'=>'Este campo é obrigatório.',
            'dias_uteis.max'=>'O campo não pode conter mais de 5 caracteres.',
            'sabados.max'=>'O campo não pode conter mais de 5 caracteres.',
            'domingos.max'=>'O campo não pode conter mais de 5 caracteres.',
            'banco.max'=>'O campo não pode conter mais de 100 caracteres.',
            'agencia.max'=>'O campo não pode conter mais de 4 caracteres.',
            'operacao.max'=>'O campo não pode conter mais de 3 caracteres.',
            'conta.max'=>'O campo não pode conter mais de 10 caracteres.',
            'pix.max'=>'O campo não pode conter mais de 225 caracteres.'
            
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
            // , $bancarios , 
            // $cartaoponto , $parametrosefips , $indicefaturas);
            if ($tomadors && $enderecos && $taxas
            && $bancarios  && $incidefolhars &&
            $cartaoponto && $parametrosefips && $indicefaturas) {
                return redirect()->back()->withSuccess('Atualizado com sucesso.'); 
                
            }
            
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->withErrors(['false'=>'Não foi possível atualizar os dados.']);
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
            $exbancarios = $this->bancario->deletarTomador($id);
            $tabelaprecos = $this->tabelapreco->deletatomador($id);
            $exenderecos = $this->endereco->deletarTomador($id); 
            $cartaoponto = $this->cartaoponto->deletar($id);
            $parametrosefips = $this->parametrosefip->deletar($id);
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
            return redirect()->back()->withInput()->withErrors(['false'=>'Não foi possível deletar o registro.']);
        }
    }
}
