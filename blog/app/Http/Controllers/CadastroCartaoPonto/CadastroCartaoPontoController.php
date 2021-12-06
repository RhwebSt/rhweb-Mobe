<?php

namespace App\Http\Controllers\CadastroCartaoPonto;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Lancamentotabela;
use App\Bolcartaoponto;
use App\Trabalhador;
use App\TabelaPreco;
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
        return view('cadastroCartaoPonto.index',compact('user'));
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
        
        $request->validate([
            'nome__completo' => 'required',
            'tomador'=>'required',
            'liboletim'=>'required|numeric|unique:lancamentotabelas',
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
        ];
        $lancamentotabela = new Lancamentotabela;
        $bolcartaoponto = new Bolcartaoponto;
        $listalancamentotabela = $lancamentotabela->listacomun($dados['liboletim'],$dados['status']);
        if (!$listalancamentotabela) {
            $lancamentotabelas = $lancamentotabela->cadastro($dados);
            array_unshift($novodados, $lancamentotabelas['id']);
            return redirect()->route('boletimcartaoponto.create',$novodados);
           
        }else if($listalancamentotabela){
            array_unshift($novodados, $listalancamentotabela->id);
            return redirect()->route('boletimcartaoponto.create',$novodados);
           
        }
        $condicao = 'cadastrafalse';
        return redirect()->route('cadastrocartaoponto.index')->withInput()->withErrors([$condicao]);
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
    public function relatoriocartaoponto($id,$tomador)
    {
        
        $lancamentotabela = new Lancamentotabela;
        $trabalhador = new Trabalhador;
        $tabelapreco = new TabelaPreco; 
        $tabelaprecos = $tabelapreco->lista($tomador);
        
        $lancamentotabelas = $lancamentotabela->relatoriocartaoponto($id);
        $dados = [];
        foreach ($lancamentotabelas as $key => $value) {
            array_push($dados,$value->trabalhador);
        }
        $trabalhadors = $trabalhador->relatorioboletim($dados);
        $pdf = PDF::loadView('relatorioCartaoPonto',compact('lancamentotabelas','trabalhadors','tabelaprecos'));
        return $pdf->setPaper('a4','landscape')->stream('relatório.pdf');
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
            $lista = $bolcartaoponto->listacadastro($id);
            $novodados = [
                $id,
                $dados['domingo'],
                $dados['sabado'],
                $dados['diasuteis'],
                $dados['data'],
                $dados['liboletim'],
                $dados['tomador']
                
            ];
            return redirect()->route('boletimcartaoponto.create',$novodados);
        }else{
            $condicao = 'editfalse';
            return redirect()->route('tabcartaoponto.index')->withInput()->withErrors([$condicao]);
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
        $bolcartaopontos = $bolcartaoponto->deletar($id);
        if ($bolcartaopontos) {
            $lancamentotabela->deletar($id);
            $condicao = 'deletatrue';
        }else{
            $condicao = 'deletafalse';
        }
        return redirect()->route('cadastrocartaoponto.index')->withInput()->withErrors([$condicao]);
    }
  
}
