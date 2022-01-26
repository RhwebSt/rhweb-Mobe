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
    public function index()
    {
        $user = Auth::user();
        $valorrublica = new ValoresRublica;
        $numboletimtabela = $valorrublica->buscaUnidadeEmpresa($user->empresa);
        return view('cadastroCartaoPonto.index',compact('user','numboletimtabela'));
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
            return redirect()->route('cadastrocartaoponto.index')->withInput()->withErrors(['false'=>'Este boletim já foi cadastrador este hoje!']);
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
        $novodados = [
            $dados['domingo'],
            $dados['sabado'],
            $dados['diasuteis'],
            $dados['data'],
            $dados['liboletim'],
            $dados['tomador'],
            $dados['feriado']
        ];
        $listalancamentotabela = $lancamentotabela->buscaUnidadeLancamentoTab($dados['liboletim'],$dados['status']);
        if($listalancamentotabela){
            array_unshift($novodados, $listalancamentotabela->id);
            return redirect()->route('boletimcartaoponto.create',$novodados);
        }
        $lancamentotabelas = $lancamentotabela->cadastro($dados);
        $valorrublica->editarUnidadeNuCartaoPonto($user->empresa,$dados);
        array_unshift($novodados, $lancamentotabelas['id']);
        return redirect()->route('boletimcartaoponto.create',$novodados);
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
        dd($id);
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
            'matricula'=>'required|max:6',
            'num__trabalhador'=>'numeric',
            'num__trabalhador'=>'required',
            'data'=>'required'
        ],[
            'nome__completo.required'=>'Campo não pode esta vazio!',
            'matricula.required'=>'Campo não pode esta vazio!',
            'matricula.max'=>'A matricula não pode ter mais de 4 caracteris!',
            'num__trabalhador.required'=>'Campo não pode esta vazio!',
            'num__trabalhador.numeric'=>'O campo naõ pode conter letras',
            'liboletim.required'=>'Campo não pode esta vazio!',
            'liboletim.numeric'=>'O campo naõ pode conter letras',
            'data.required'=>'O campo não pode esta vazio!'
            
        ]);
        $lancamentotabela = new Lancamentotabela;
        $bolcartaoponto = new Bolcartaoponto;
        $lancamentotabelas = $lancamentotabela->editar($dados,$id);
        if ($lancamentotabelas) {
            $lista = $bolcartaoponto->listaCartaoPontoPaginacao($id,$dados['data']);
            $novodados = [
                $id,
                $dados['domingo'],
                $dados['sabado'],
                $dados['diasuteis'],
                $dados['data'],
                $dados['liboletim'],
                $dados['tomador'],
                $dados['feriado']
            ];
            return redirect()->route('boletimcartaoponto.create',$novodados);
        }else{
            return redirect()->route('tabcartaoponto.index')->withInput()->withErrors(['false'=>'Não foi porssivél atualizar.']);
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
            echo('Error ao deletar.');
        }
      
    }
  
}
