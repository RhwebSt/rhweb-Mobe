<?php

namespace App\Http\Controllers\Comisionario;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Comissionado\Validacao;
use Illuminate\Support\Facades\Auth;
use App\Comissionado;
class ComisionarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $search = request('search');
        $comissionado = new Comissionado;
        $comissionados = $comissionado->buscaListaComissionado($search);
        return view('comisionado.index',compact('user','comissionados'));
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
    public function store(Validacao $request)
    {
        $dados = $request->all();
        $comissionado = new Comissionado;
        try {
        $comissionados = $comissionado->verifica($dados);
        if ($comissionados) {
            return redirect()->back()->withInput()->withErrors(['false'=>'Estes dados já tão cadastrados.']);  
        }
        $comissionados = $comissionado->cadastro($dados);
        if ($comissionados) {
            return redirect()->back()->withSuccess('Cadastro realizado com sucesso.'); 
        }
       } catch (\Throwable $th) {
        return redirect()->back()->withInput()->withErrors(['false'=>'Não foi porssível realizar o cadastro.']);  
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
        $comissionado = new Comissionado;
        $comissionados = $comissionado->first($id);
        return response()->json($comissionados);
    }

    public function pesquisa()
    {
        $comissionado = new Comissionado;
        $comissionados = $comissionado->pesquisas();
        return response()->json($comissionados);
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
        $comissionado = new Comissionado;
        $comissionados = $comissionado->buscaListaComissionado();
        $dados = $comissionado->buscaUnidadeComissionado($id);
        return view('comisionado.edit',compact('comissionados','user','dados'));
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
            'nome__trabalhador' => 'required|max:100|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÏÍÔÕÛÙÜŸÑÆŒa-zàáâãçéèêëîíïôõûùüÿñæœ 0-9_\-()]*$/',
            'nome_tomador' => 'required|max:100|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÏÍÔÕÛÙÜŸÑÆŒa-zàáâãçéèêëîíïôõûùüÿñæœ 0-9_\-()]*$/',
            'tomador'=>'required|numeric',
            'trabalhador'=>'required|numeric',
            'indice'=>'required|max:6',
            'matricula__trab'=>'required|max:10|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÏÍÔÕÛÙÜŸÑÆŒa-zàáâãçéèêëîíïôõûùüÿñæœ 0-9_\-()]*$/',
        ]
        );
        $comissionado = new Comissionado;
        $comissionados = $comissionado->editar($dados,$id);
        if ($comissionados) {
            return redirect()->back()->withSuccess('Atualizador com sucesso.');  
        }else{
            return redirect()->back()->withInput()->withErrors(['false'=>'Não foi porssível atualizar o registro.']);  
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
        $comissionado = new Comissionado;
        try {
            $comissionados = $comissionado->deletar($id);
            return redirect()->back()->withSuccess('Deletado com sucesso.'); 
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['false'=>'Não foi porssível deletar o registro.']);
        }
    }
}
