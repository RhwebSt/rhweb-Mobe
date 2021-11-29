<?php

namespace App\Http\Controllers\TabCadastro;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Lancamentorublica;
class TabCadastroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        return view('tabelaCadastro.index',compact('user'));
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
        $lancamentorublica = new Lancamentorublica;
        $lista = $lancamentorublica->listacadastro($dados['lancamento']);
        $user = Auth::user();
        $id = $dados['lancamento'];
        $validator = Validator::make($request->all(), [
            'nome__completo' => 'required',
            'matricula'=>'required|max:4',
            'licodigo'=>'required|max:4|unique:lancamentorublicas',
            'rubrica'=>'required|max:60',
            'quantidade'=>'required'
        ],
            [
                'licodigo.unique'=>'O campo codigo já está sendo utilizado.',
                'licodigo.required'=>'O campo codigo é obrigatório.',
                'licodigo.max'=>'O campo codigo não pode ser superior a 4 caracteres.'
            ]
        );
        if ($validator->fails()) {
            return view('tabelaCadastro.index',compact('user','id','lista'))->withErrors($validator);
        }
        $condicao = '';
        $lancamentorublicas = $lancamentorublica->cadastro($dados);
        if ($lancamentorublicas) {
            $condicao = 'cadastratrue';
        }else{
            $condicao = 'cadastrafalse';
        }
        return view('tabelaCadastro.index',compact('user','id','lista'))->withErrors([$condicao]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $lancamentorublica = new Lancamentorublica;
        $lancamentorublicas = $lancamentorublica->listafirst($id);
        return response()->json($lancamentorublicas);
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
        $lancamentorublica = new Lancamentorublica;
        $lista = $lancamentorublica->listacadastro($dados['lancamento']);
        $user = Auth::user();
        $validator = Validator::make($request->all(), [
            'nome__completo' => 'required',
            'matricula'=>'required|max:4',
            'rubrica'=>'required|max:60',
            'quantidade'=>'required'
        ]);
        if ($validator->fails()) {
            return view('tabelaCadastro.index',compact('user','id','lista'))->withErrors($validator);
        }
        $condicao = '';
        $lancamentorublicas = $lancamentorublica->editar($dados,$id);
        $id = $dados['lancamento'];
        if ($lancamentorublicas) {
            $condicao = 'edittrue';
        }else{
            $condicao = 'editfalse';
        }
        return view('tabelaCadastro.index',compact('user','id','lista'))->withErrors([$condicao]);
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
        $lancamentorublicas = $lancamentorublica->listafirst($id);
        $delete = $id;
        if ($lancamentorublicas) {
            $id = $lancamentorublicas->lancamento;
        }
        $lista = $lancamentorublica->listacadastro($id);
        $user = Auth::user();
        $lancamentorublicas = $lancamentorublica->deletar($delete);
        if ($lancamentorublicas) {
            $condicao = 'deletatrue';
        }else{
            $condicao = 'deletafalse';
        }
        return view('tabelaCadastro.index',compact('user','id','lista'))->withErrors([$condicao]);
    }
}
