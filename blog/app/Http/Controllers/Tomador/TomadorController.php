<?php

namespace App\Http\Controllers\Tomador;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ValidacaoTomador;
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
use App\BaseCalculo;
class TomadorController extends Controller
{
    private $rublica,$tomador,$valorrublica,$taxa,$endereco,$bancario,
    $tabelapreco,$cartaoponto,$parametrosefip,$incidefolhar,$indicefatura,
    $comissionado,$retencaofatura,$bolcartaoponto,$lancamentorublica,$lancamentotabela
    ,$basecalculo;
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
        $this->basecalculo = new BaseCalculo;
    }
    public function index()
    {
        $user = auth()->user();
        $search = request('search');
        $condicao = request('codicao');
        $tomadors = $this->tomador 
        ->where(function($query) use ($search,$user){
          
            if ($search) {
                $query->orWhere([
                    ['tomadors.tsnome','like','%'.$search.'%'],
                    ['tomadors.empresa_search', $user->empresa]
                ])
                ->orWhere([
                    ['tomadors.tscnpj','like','%'.$search.'%'],
                    ['tomadors.empresa_search', $user->empresa]
                    ])
                ->orWhere([
                    ['tomadors.tsmatricula','like','%'.$search.'%'],
                    ['tomadors.empresa_id', $user->empresa]
                ]);
            }else{
                $query->where('empresa_id', $user->empresa_id);
            }   
        })
        ->orderBy('tsnome','asc') 
        ->orderBy('tsmatricula','asc')
        ->distinct()
        ->paginate(20);
        // dd($tomadors);
        if ($condicao) {
            $tomador = $this->tomador->first($condicao);
            return view('tomador.edit',compact('user','tomador','tomadors'));
        }else{
            $valorrublica_matricular = $this->valorrublica->buscaUnidadeEmpresa($user->empresa);
            return view('tomador.index',compact('user','valorrublica_matricular','tomadors'));
        }
    }
    public function ordem($ordem,$id = null,$search = null)
    {
        $user = Auth::user();
        $tomadors = $this->tomador->buscaListaTomadorPaginate($search,$ordem);
        if ($id) {
            $tomador = $this->tomador->first($id);
            return view('tomador.edit',compact('user','tomador','tomadors'));
        }else{
            $valorrublica_matricular = $this->valorrublica->buscaUnidadeEmpresa($user->empresa);
            return view('tomador.index',compact('user','valorrublica_matricular','tomadors'));
        }
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
    public function store(ValidacaoTomador $request)
    {
        $dados = $request->all(); 
        $user = Auth::user();
        
        if ($dados['banco']) {
            $request->validate(['banco'=>'regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÓÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôõóûùúüÿñæœ 0-9-.]*$/']);
        }
        if($dados['pix']){
            $request->validate(['pix'=>'regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÓÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôõóûùúüÿñæœ 0-9]*$/']);
        }
        if ($dados['nome__fantasia']) {
            $request->validate(['nome__fantasia'=>'regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÓÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôõóûùúüÿñæœ ]*$/']);
        }
        // $tomadores = $this->tomador->verificaCadastroCnpj($dados);
        $tomador = $this->tomador->where([
            ['tscnpj',$dados['cnpj']],
            ['empresa_id',$user->empresa_id]
        ])->count();
        
        if ($tomador) {
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
                        'empresa'=>$user->empresa_id,
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
                $this->valorrublica->editarMatricularTomador($dados,$user->empresa_id);

                return redirect()->back()->withSuccess('Cadastro realizado com sucesso.'); 
            }
            try {
        } catch (\Throwable $th) {
            // $cartaoponto = $this->cartaoponto->deletar($dados['tomador']);
            // $parametrosefips = $this->parametrosefip->deletar($dados['tomador']);
            // $indicefaturas = $this->indicefatura->deletar($dados['tomador']);
            // $taxas = $this->taxa->deletar($dados['tomador']);
            // $incidefolhars = $this->incidefolhar->deletar($dados['tomador']);
            // $this->endereco->deletarTomador($dados['tomador']);
            // $this->bancario->deletarTomador($dados['tomador']);
            // $this->tabelapreco->deletatomador($dados['tomador']);
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
        $id = base64_decode($id);
        $user = Auth::user();
        $search = request('search');
        // $tomador = $this->tomador->first($id);
        $tomador = $this->tomador->where('id',$id)
        ->with(['taxa','endereco','bancario','cartaoponto','parametrosefip','indicefatura','incidefolhar'])->first();
        $tomadors = $this->tomador 
        ->where(function($query) use ($search,$user){
            if ($search) {
                $query->orWhere([
                    ['tomadors.tsnome','like','%'.$search.'%'],
                    ['tomadors.empresa_search', $user->empresa]
                ])
                ->orWhere([
                    ['tomadors.tscnpj','like','%'.$search.'%'],
                    ['tomadors.empresa_search', $user->empresa]
                    ])
                ->orWhere([
                    ['tomadors.tsmatricula','like','%'.$search.'%'],
                    ['tomadors.empresa_id', $user->empresa]
                ]);
            }else{
                $query->where('empresa_id', $user->empresa_id);
            }   
        })
        ->orderBy('tsnome','asc') 
        ->orderBy('tsmatricula','asc')
        ->distinct()
        ->paginate(20);
        return view('tomador.edit',compact('user','tomador','tomadors'));
    }
   
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ValidacaoTomador $request, $id)
    {
        $dados = $request->all();
        if ($dados['banco']) {
            $request->validate(['banco'=>'regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÓÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôõóûùúüÿñæœ 0-9-.]*$/']);
        }
        if($dados['pix']){
            $request->validate(['pix'=>'regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÓÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôõóûùúüÿñæœ 0-9]*$/']);
        }
        if ($dados['nome__fantasia']) {
            $request->validate(['nome__fantasia'=>'regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÓÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôõóûùúüÿñæœ ]*$/']);
        }
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
            return redirect()->back()->withSuccess('Atualizado com sucesso.'); 
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
        
        $tomador = $this->basecalculo->verificaTomador($id);
        if ($tomador) {
            return redirect()->back()->withInput()->withErrors(['false'=>'Este tomador não pode ser deletador.']);
        }
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
