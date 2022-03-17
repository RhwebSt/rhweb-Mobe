<?php

namespace App\Http\Controllers\TabCartaoPonto;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Lancamentotabela;
use App\Lancamentorublica;
use App\ValoresRublica;
use App\Bolcartaoponto;
class TabCartaoPontoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $lancamentorublica,$valorrublica,$lancamentotabela,$bolcartaoponto;
    public function __construct()
    {
        $this->lancamentorublica = new Lancamentorublica;
        $this->valorrublica = new ValoresRublica;
        $this->lancamentotabela = new Lancamentotabela;
        $this->bolcartaoponto = new Bolcartaoponto;
    }
    public function index()
    {
        $search = request('search');
        $condicao = request('codicao');
        if ($search) {
            $lancamentotabelas = $this->lancamentotabela->pesquisaLista('M','asc',$search);
        }else{
            $lancamentotabelas = $this->lancamentotabela->buscaListas('M','asc');
        }
        $user = Auth::user();
        if ($condicao) {
            $numboletimtabela = $this->valorrublica->buscaUnidadeEmpresa($user->empresa);
            $dados = $this->lancamentotabela->buscaUnidade($condicao);
            return view('tabCartaoPonto.edit',compact('user','dados','numboletimtabela','lancamentotabelas'));
        }else{
            $numboletimtabela = $this->valorrublica->buscaUnidadeEmpresa($user->empresa);
            return view('tabCartaoPonto.index',compact('user','numboletimtabela','lancamentotabelas'));
        }
        
    }

    public function filtroPesquisaOrdem($condicao)
    {
        $user = Auth::user();
        $numboletimtabela = $this->valorrublica->buscaUnidadeEmpresa($user->empresa);
        $lancamentotabelas = $this->lancamentotabela->buscaListas('M',$condicao);
        return view('tabCartaoPonto.index',compact('user','numboletimtabela','lancamentotabelas'));
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
    
        $user = auth()->user();
        $novadata = explode('-',$dados['data']);
        $lancamentotabelas = $this->lancamentotabela->verificaBoletimMes($dados,$novadata); 
        
        if ($lancamentotabelas) {
            return redirect()->route('tabcartaoponto.index')->withInput()->withErrors(['false'=>'Este boletim já foi cadastrador este mês!']);
        }
        $request->validate([
            'nome__completo' => 'required',
            'liboletim'=>'required|numeric',
            'matricula'=>'required|max:6',
            'num__trabalhador'=>'numeric',
            'num__trabalhador'=>'required',
            'data'=>'required',
            'tomador'=>'required',
        ],[
            'nome__completo.required'=>'O campo não pode estar vazio!',
            'tomador.required'=>'O campo não pode estar vazio!',
            'matricula.required'=>'O campo não pode estar vazio!',
            'matricula.max'=>'A matricula não pode conter mais de 4 caracteres!',
            'num__trabalhador.required'=>'O campo não pode estar vazio!',
            'num__trabalhador.numeric'=>'O campo naõ pode conter letras',
            'liboletim.required'=>'O campo não pode estar vazio!',
            'liboletim.numeric'=>'O campo não pode conter letras',
            'liboletim.exists'=>'O boletim já está cadastrado',
            'data.required'=>'O campo não pode estar vazio!'
            
        ]);
        try {
            $lancamentotabelas = $this->lancamentotabela->cadastro($dados);
            $this->valorrublica->editarBoletimTabela($dados,$user->empresa);
        return redirect()->back()->withSuccess('Cadastro realizado com sucesso.');
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->withErrors(['false'=>'Não foi possível cadastrar.']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id,$status)
    {
        $lancamentotabelas = $this->lancamentotabela->buscaUnidadeLancamentoTab($id,$status);
        return response()->json($lancamentotabelas);
    }
    public function pesquisa($id,$status) 
    {
        $lancamentotabelas = $this->lancamentotabela->buscaListaLancamentoTab($id,$status);
        return response()->json($lancamentotabelas);
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
        
        $numboletimtabela = $this->valorrublica->buscaUnidadeEmpresa($user->empresa);
        $lancamentotabelas = $this->lancamentotabela->buscaListas('M','asc');
        $dados = $this->lancamentotabela->buscaUnidade($id);
        return view('tabCartaoPonto.edit',compact('user','dados','numboletimtabela','lancamentotabelas'));
    }
    public function filtroPesquisaOrdemEdit($id,$condicao)
    {
        $user = Auth::user();
        if ($id !== ' ') {
            $numboletimtabela = $this->valorrublica->buscaUnidadeEmpresa($user->empresa);
            $lancamentotabelas = $this->lancamentotabela->buscaListas('M',$condicao);
            $dados = $this->lancamentotabela->buscaUnidade($id);
            return view('tabCartaoPonto.edit',compact('user','dados','numboletimtabela','lancamentotabelas'));
        }else{
            return redirect()->route('ordem.tabela.cartao.ponto', [$condicao]);
        }
       
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
        
        $novadata = explode('-',$dados['data']); 
        $quantidadeTrabalhador = $this->lancamentorublica->verificaTrabalhador($dados,$novadata);
        if (count($quantidadeTrabalhador) > $dados['num__trabalhador']) {
            return redirect()->back()->withInput()->withErrors(['num__trabalhador'=>'Possui o número menor que a quantidade já cadastrada.']);
        }
    
        $request->validate([
            'nome__completo' => 'required',
            // 'matricula'=>'required|max:6',
            'num__trabalhador'=>'numeric',
            'num__trabalhador'=>'required', 
            'data'=>'required'
        ],[
            'nome__completo.required'=>'O campo não pode estar vazio!',
            // 'matricula.required'=>'O campo não pode estar vazio!',
            // 'matricula.max'=>'A matricula não pode ter mais de 4 caracteris!',
            'num__trabalhador.required'=>'O campo não pode estar vazio!',
            'num__trabalhador.numeric'=>'O campo não pode conter letras',
            'liboletim.required'=>'O campo não pode estar vazio!',
            'liboletim.numeric'=>'O campo não pode conter letras',
            'data.required'=>'O campo não pode estar vazio!'
            
        ]);
      
        try {
            $lancamentotabelas = $this->lancamentotabela->editar($dados,$id);
            $this->lancamentorublica->editarBoletim($dados,$id);
            $this->bolcartaoponto->editarBoletim($dados,$id);
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
            $this->lancamentorublica->deletar($id);
            $this->lancamentotabela->deletar($id);
            return redirect()->back()->withSuccess('Deletado com sucesso.');
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->withErrors(['false'=>'Não foi possível deletar o registro.']);
        }
    }
}
