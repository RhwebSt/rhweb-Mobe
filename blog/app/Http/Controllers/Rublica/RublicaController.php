<?php

namespace App\Http\Controllers\Rublica;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Rublica;
class RublicaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $rublica = new Rublica;
        $rublicas = $rublica->lista();
        return view('rublica.index',compact('user','rublicas'));
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
        $rublica = new Rublica;
        $request->validate([
            'rubricas'=>'required|max:15',
            'descricao'=>'required|max:15|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÓÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôóõûùúüÿñæœ 0-9_\-().]*$/',
            'incidencia'=>'required'
        ],[
            'rubricas.required'=>'Campo não pode esta vazio.',
            'rubricas.max'=>'Campo não ter mais de 15 caracteres.',
            'descricao.required'=>'Campo não pode esta vazio.',
            'descricao.max'=>'Campo não ter mais de 15 caracteres.',
            'descricao.regex'=>'O campo tem um formato inválido.',
            'incidencia.required'=>'Campo não pode esta vazio.',
        ]);
        try {
          
            $rublicas = $rublica->cadastro($dados); 
            return redirect()->back()->withSuccess('Cadastro realizado com sucesso.'); 
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->withErrors(['false'=>'Não foi prossível cadastrar.']);
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
        $rublica = new Rublica;
        $rublicas = $rublica->buscaUnidadeRublica($id);
        return response()->json($rublicas);
    }
    public function pesquisa($id = null)
    {
        $rublica = new Rublica;
        $rublicas = $rublica->buscaListaRublica($id);
        return response()->json($rublicas);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $rublica = new Rublica;
        $user = Auth::user();
        $rublicas = $rublica->editarRublicas($id);
        $lista = $rublica->lista();
        return view('rublica.edit', compact('user','rublicas','lista'));
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
        $rublica = new Rublica;
        $request->validate([
            'rubricas'=>'required|max:15',
            'descricao'=>'required|max:15|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÓÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôóõûùúüÿñæœ 0-9_\-().]*$/',
            'incidencia'=>'required'
        ],[
            'rubricas.required'=>'Campo não pode esta vazio.',
            'rubricas.max'=>'Campo não ter mais de 15 caracteres.',
            'descricao.required'=>'Campo não pode esta vazio.',
            'descricao.max'=>'Campo não ter mais de 15 caracteres.',
            'descricao.regex'=>'O campo tem um formato inválido.',
            'incidencia.required'=>'Campo não pode esta vazio.',
        ]);
        try {
            $rublicas = $rublica->editar($dados,$id);
            return redirect()->route('rublica.index')->withSuccess('Atualizador com sucesso.'); 
        } catch (\Throwable $th) {
            return redirect()->route('rublica.index')->withInput()->withErrors(['false'=>'Não foi porssível atualizar os dados.']);
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
        $rublica = new Rublica;
        try {
            $rublicas = $rublica->deletar($id);
            return redirect()->back()->withSuccess('Deletado com sucesso.'); 
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['false'=>'Não foi porssível deletar o registro.']);
        }
    }
}
