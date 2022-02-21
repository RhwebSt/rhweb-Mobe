<?php

namespace App\Http\Controllers\CadastroCartaoPonto;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Lancamentotabela;
use App\Bolcartaoponto;
use App\Trabalhador;
use App\TabelaPreco;
use App\ValoresRublica;
use PDF;
class CadastroCartaoPontoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $valorrublica,$lancamentotabela;
    public function __construct()
    {
        $this->valorrublica = new ValoresRublica;
        $this->lancamentotabela = new Lancamentotabela;
    }
    public function index()
    {
        $user = Auth::user(); 
        $numboletimtabela = $this->valorrublica->buscaUnidadeEmpresa($user->empresa);
        $lancamentotabelas = $this->lancamentotabela->buscaListas('D','asc');
        return view('cadastroCartaoPonto.index',compact('user','numboletimtabela','lancamentotabelas'));
    }
    public function filtroPesquisaOrdem($condicao)
    {
        $user = Auth::user();
        $numboletimtabela = $this->valorrublica->buscaUnidadeEmpresa($user->empresa);
        $lancamentotabelas = $this->lancamentotabela->buscaListas('D',$condicao);
        return view('cadastroCartaoPonto.index',compact('user','numboletimtabela','lancamentotabelas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $lancamentotabela = new Lancamentotabela;
        $tabelapreco = new TabelaPreco;
        $bolcartaoponto = new Bolcartaoponto;
        $valorrublica = new ValoresRublica;
        $lancamentotabelas = $lancamentotabela->verificaBoletimDias($dados);
        $tabelaprecos = $tabelapreco->verificaTabelaPrecoAtual($dados['tomador'],date('Y'));
        
        if (count($tabelaprecos) < 5) {
            return redirect()->back()->withInput()->withErrors(['false'=>'Não foi encontrada todas as rubricas necessárias do ano '.date('Y').'!']);
        }
        if ($lancamentotabelas) { 
            return redirect()->back()->withInput()->withErrors(['false'=>'Este boletim já foi cadastrador este hoje!']);
        }
        $request->validate([
            'nome__completo' => 'required',
            'tomador'=>'required',
            'liboletim'=>'required|numeric',
            'matricula'=>'required|max:6',
            'num__trabalhador'=>'numeric',
            'num__trabalhador'=>'required',
            'data'=>'required'
        ],[
            'nome__completo.required'=>'Campo não pode esta vazio!',
            'tomador.required'=>'Campo não pode esta vazio!',
            'matricula.required'=>'Campo não pode esta vazio!',
            'matricula.max'=>'A matricula não pode ter mais de 4 caracteris!',
            'num__trabalhador.required'=>'Campo não pode esta vazio!',
            'num__trabalhador.numeric'=>'O campo naõ pode conter letras',
            'liboletim.required'=>'Campo não pode esta vazio!',
            'liboletim.numeric'=>'O campo naõ pode conter letras',
            'liboletim.exists'=>'O boletim ja ta cadastrado',
            'data.required'=>'O campo não pode esta vazio!'
            
        ]);
        // $novodados = [
        //     $dados['domingo'],
        //     $dados['sabado'],
        //     $dados['diasuteis'],
        //     $dados['data'],
        //     $dados['liboletim'],
        //     $dados['tomador'],
        //     $dados['feriado']
        // ];
        // $listalancamentotabela = $lancamentotabela->buscaUnidadeLancamentoTab($dados['liboletim'],$dados['status']);
        // if($listalancamentotabela){
        //     array_unshift($novodados, $listalancamentotabela->id);
        //     return redirect()->route('boletimcartaoponto.create',$novodados);
        // }
        $lancamentotabelas = $lancamentotabela->cadastro($dados);
        $valorrublica->editarUnidadeNuCartaoPonto($user->empresa,$dados);
        return redirect()->back()->withSuccess('Cadastro realizado com sucesso.');
        // array_unshift($novodados, $lancamentotabelas['id']);
        // return redirect()->route('boletimcartaoponto.create',$novodados);
        // return redirect()->route('cadastrocartaoponto.index')->withInput()->withErrors(['false'=>'Não foi possivél realiza o cadastro!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id,$tomador)
    {
      
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
        $valorrublica = new ValoresRublica;
        $lancamentotabela = new Lancamentotabela;
        $numboletimtabela = $valorrublica->buscaUnidadeEmpresa($user->empresa);
        $lancamentotabelas = $lancamentotabela->buscaListas('D','asc');
        $dados = $lancamentotabela->buscaUnidade($id);
        return view('cadastroCartaoPonto.edit',compact('user','dados','numboletimtabela','lancamentotabelas'));
    }
    public function filtroPesquisaOrdemEdit($id,$condicao)
    {
        $user = Auth::user();
        $valorrublica = new ValoresRublica;
        $lancamentotabela = new Lancamentotabela;
        $numboletimtabela = $valorrublica->buscaUnidadeEmpresa($user->empresa);
        $lancamentotabelas = $lancamentotabela->buscaListas('D',$condicao);
        $dados = $lancamentotabela->buscaUnidade($id);
        return view('cadastroCartaoPonto.edit',compact('user','dados','numboletimtabela','lancamentotabelas'));
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
            'nome__completo' => 'required',
            'num__trabalhador'=>'required',
            'data'=>'required',
            'feriado'=>'required',
            'liboletim'=>'required'
        ],[
            'nome__completo.required'=>'Campo não pode esta vazio!',
            'num__trabalhador.required'=>'Campo não pode esta vazio!',
            'liboletim.required'=>'Campo não pode esta vazio!',
            'data.required'=>'O campo não pode esta vazio!'
            
        ]);
        $lancamentotabela = new Lancamentotabela;
        $bolcartaoponto = new Bolcartaoponto;
        try {
            $lancamentotabelas = $lancamentotabela->editar($dados,$id);
            $lista = $bolcartaoponto->listaCartaoPontoPaginacao($id,$dados['data']);
            return redirect()->back()->withSuccess('Atualizador com sucesso.');
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->withErrors(['false'=>'Não foi porssível realizar a atualização.']);
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
        
        $bolcartaoponto = new Bolcartaoponto;
        $lancamentotabela = new Lancamentotabela;
        try {
            $bolcartaopontos = $bolcartaoponto->deletarLancamentoTabela($id);
            if ($bolcartaopontos) {
                $lancamentotabela->deletar($id);
                return redirect()->back()->withSuccess('Deletado com sucesso.'); 
            }
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->withErrors(['false'=>'Não foi porssível deletar o registro.']);
        }
      
    }
  
}
