<?php

namespace App\Http\Controllers\TabCartaoPonto;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Lancamentotabela;
use App\Lancamentorublica;
class TabCartaoPontoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        return view('tabCartaoPonto.index',compact('user'));
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
            'liboletim'=>'required|numeric|unique:lancamentotabelas',
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
            'liboletim.exists'=>'O boletim ja ta cadastrado',
            'data.required'=>'O campo não pode esta vazio!'
            
        ]);
        $user = Auth::user(); 
        $lancamentotabela = new Lancamentotabela;
        $lancamentorublica = new Lancamentorublica;
        $listalancamentotabela = $lancamentotabela->listacomun($dados['num__boletim']);
        if (!$listalancamentotabela) {
            $lancamentotabelas = $lancamentotabela->cadastro($dados);
            $lista = $lancamentorublica->listacadastro($lancamentotabelas['id']);
            $id = $lancamentotabelas['id'];
            return view('tabelaCadastro.index',compact('user','id','lista'));
        }else if ($listalancamentotabela) {
            $lista = $lancamentorublica->listacadastro($listalancamentotabela->id);
            
            $id =$listalancamentotabela->id;
            return view('tabelaCadastro.index',compact('user','id','lista'));
        }
        $condicao = 'cadastrafalse';
        return redirect()->route('tabcartaoponto.index')->withInput()->withErrors([$condicao]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $lancamentotabela = new Lancamentotabela;
        $lancamentotabelas = $lancamentotabela->listacomun($id);
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
        $user = Auth::user();
        $lancamentotabela = new Lancamentotabela;
        $lancamentorublica = new Lancamentorublica;
        $lancamentotabelas = $lancamentotabela->editar($dados,$id);
        if ($lancamentotabelas) {
            $lista = $lancamentorublica->listacadastro($id);
            return view('tabelaCadastro.index',compact('user','id','lista'));
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
        $lancamentorublica = new Lancamentorublica;
        $lancamentotabela = new Lancamentotabela;
        $lancamentorublicas = $lancamentorublica->deletar($id);
        if ($lancamentorublicas) {
            $lancamentotabela->deletar($id);
            $condicao = 'deletatrue';
        }else{
            $condicao = 'deletafalse';
        }
        return redirect()->route('tabcartaoponto.index')->withInput()->withErrors([$condicao]);
    }
}
