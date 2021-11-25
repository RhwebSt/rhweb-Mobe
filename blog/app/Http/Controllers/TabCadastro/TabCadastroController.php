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
        $user = Auth::user();
        $id = $dados['lancamento'];
        $lista = $lancamentorublica->listacadastro($dados['lancamento']);
        $validator = Validator::make($request->all(),[
            'nome__completo' => 'required',
            'matricula'=>'required|max:6',
            'licodigo'=>'required|min:4|unique:lancamentorublicas',
            'rubrica'=>'required',
            'quantidade'=>'required'
        ],[
            'nome__completo.required'=>'Campo não pode esta vazio!',
            'matricula.required'=>'Campo não pode esta vazio!',
            'matricula.max'=>'A matricula não pode ter mais de 4 caracteres!',
            'licodigo.required'=>'Campo não pode esta vazio!',
            'licodigo.min'=>'O codigo não pode conter menos do que 4 caracteres!',
            'licodigo.unique'=>'Este codigo já esta cadastrado!',
            'rubrica.required'=>'Campo não pode esta vazio!',
            'quantidade.required'=>'Campo não pode esta vazio!'
        ]);
        if ($validator->fails()) {
            return view('tabelaCadastro.index',compact('user','id','lista'))->withErrors($validator);
        }
        $lancamentorublicas = $lancamentorublica->cadastro($dados);
        if ($lancamentorublicas) {
            return view('tabelaCadastro.index',compact('user','id','lista'))->withErrors(['true'=>'cadastro realizado com sucesso!']);
        }else{
            return view('tabelaCadastro.index',compact('user','id','lista'))->withErrors(['false'=>'cadastro não  realizado com sucesso!']);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
