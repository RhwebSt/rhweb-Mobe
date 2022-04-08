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
use Carbon\Carbon;
use PDF;
class CadastroCartaoPontoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $valorrublica,$lancamentotabela,$tabelapreco,$bolcartaoponto;
    public function __construct()
    {
        $this->valorrublica = new ValoresRublica;
        $this->lancamentotabela = new Lancamentotabela;
        $this->tabelapreco = new TabelaPreco;
        $this->bolcartaoponto = new Bolcartaoponto;
    }
    public function index()
    {
        $search = request('search');
        $condicao = request('codicao');
        if ($search) {
            $lancamentotabelas = $this->lancamentotabela->pesquisaLista('D','asc',$search);
        }else{
            $lancamentotabelas = $this->lancamentotabela->buscaListas('D','asc');
        }
        $user = Auth::user(); 
        $numboletimtabela = $this->valorrublica->buscaUnidadeEmpresa($user->empresa);
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
        $today = Carbon::today();
        if (strtotime($dados['data']) > strtotime($today) ) {
            return redirect()->back()->withInput()->withErrors(['data'=>'Só é valida data atuais!']);
        }
        $lancamentotabelas = $this->lancamentotabela->verificaBoletimDias($dados);
        $tabelaprecos = $this->tabelapreco->verificaTabelaPrecoAtual($dados['tomador'],date('Y'));
        
        if (count($tabelaprecos) < 5) {
            return redirect()->back()->withInput()->withErrors(['false'=>'Não foi encontrada todas as rúbricas necessárias do ano '.date('Y').'!']);
        }
        if ($lancamentotabelas) { 
            return redirect()->back()->withInput()->withErrors(['false'=>'Este boletim já foi cadastrado hoje!']);
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
            'nome__completo.required'=>'O campo não pode estar vazio!',
            'tomador.required'=>'O campo não pode estar vazio!',
            'matricula.required'=>'O campo não pode estar vazio!',
            'matricula.max'=>'A matrícula não pode conter mais de 4 caracteres!',
            'num__trabalhador.required'=>'O campo não pode estar vazio!',
            'num__trabalhador.numeric'=>'O campo não pode conter letras',
            'liboletim.required'=>'O campo não pode estar vazio!',
            'liboletim.numeric'=>'O campo não pode conter letras',
            'liboletim.exists'=>'Este boletim ja está cadastrado',
            'data.required'=>'O campo não pode estar vazio!'
            
        ]);
        try {
            $lancamentotabelas = $this->lancamentotabela->cadastro($dados); 
            if ($lancamentotabelas) {
                $this->valorrublica->editarUnidadeNuCartaoPonto($user->empresa,$dados);
            }
            return redirect()->back()->withSuccess('Cadastro realizado com sucesso.');
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->withErrors(['false'=>'Não foi possível realizar o cadastro!']);
        }
      
        
        
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
        $numboletimtabela = $this->valorrublica->buscaUnidadeEmpresa($user->empresa);
        $lancamentotabelas = $this->lancamentotabela->buscaListas('D',$condicao);
        $dados = $this->lancamentotabela->buscaUnidade($id);
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
            'nome__completo.required'=>'O campo não pode estar vazio!',
            'num__trabalhador.required'=>'O campo não pode estar vazio!',
            'liboletim.required'=>'O campo não pode estar vazio!',
            'data.required'=>'O campo não pode estar vazio!'
            
        ]);
        try {
            $lancamentotabelas = $this->lancamentotabela->editar($dados,$id);
            $lista = $this->bolcartaoponto->listaCartaoPontoPaginacao($id,$dados['data']);
            return redirect()->back()->withSuccess('Atualizado com sucesso.');
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->withErrors(['false'=>'Não foi possível realizar a atualização.']);
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
        try {
            $bolcartaopontos = $this->bolcartaoponto->deletarLancamentoTabela($id);
            if ($bolcartaopontos) {
                $this->lancamentotabela->deletar($id);
                return redirect()->back()->withSuccess('Deletado com sucesso.'); 
            }
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->withErrors(['false'=>'Não foi possível deletar o registro.']);
        }
      
    }
  
}
