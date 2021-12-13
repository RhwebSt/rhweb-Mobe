<?php

namespace App\Http\Controllers\TabelaPreco;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\TabelaPreco;
class TabelaPrecoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id = null,$tomador)
    {
        $user = Auth::user();
        $tabelapreco = new TabelaPreco;
        $tabelaprecos = $tabelapreco->lista($id,$tomador);
        return view('tomador.tabelapreco.index',compact('id','user','tabelaprecos','tomador'));
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
            'ano' => 'required|max:4',
            'rubricas'=>'required|max:30',
            'descricao'=>'required|max:60|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÏÔÕÛÙÜŸÑÆŒa-zàáâãçéèêëîïôõûùüÿñæœ 0-9_\-%]*$/',
            'valor'=>'required',
            'valor__tomador'=>'required'
        ]);
        $tabelapreco = new TabelaPreco;
      
        $tabelaprecos = $tabelapreco->cadastro($dados);
        $novodados = [
            $tabelaprecos['id'],
            $dados['tomador']
        ];
        if($tabelaprecos) {
            $condicao = 'cadastratrue';
        }else{
            $condicao = 'cadastrafalse';
        }
        return redirect()->route('tabelapreco.index',$novodados)->withInput()->withErrors([$condicao]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id,$tomador)
    {
        
        $tabelapreco = new TabelaPreco;
        $tabelaprecos = $tabelapreco->buscaUnidadeTabela($id,$tomador);
        return response()->json($tabelaprecos);
    }
    public function pesquisa($id,$tomador)
    {
       
        $tabelapreco = new TabelaPreco;
        $tabelaprecos = $tabelapreco->buscaListaTabela($id,$tomador);
        return response()->json($tabelaprecos);
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
            'ano' => 'required|max:4',
            'rubricas'=>'required|max:30',
            'descricao'=>'required|max:60|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÏÔÕÛÙÜŸÑÆŒa-zàáâãçéèêëîïôõûùüÿñæœ 0-9_\-%]*$/',
            'valor'=>'required',
            'valor__tomador'=>'required'
        ]);
        $novodados = [
            $id,
            $dados['tomador']
        ];
        $tabelapreco = new TabelaPreco;
        $tabelaprecos = $tabelapreco->editar($dados,$id);
        if($tabelaprecos) {
            $condicao = 'edittrue';
        }else{
            $condicao = 'editfalse';
        }
        return redirect()->route('tabelapreco.index',$novodados)->withInput()->withErrors([$condicao]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tabelapreco = new TabelaPreco;
        $tabelaprecos = $tabelapreco->buscaUnidadeTabela($id);
        $excluir = $tabelapreco->deletar($id);
        $novodados = [
           $id,
           $tabelaprecos->tomador
        ];
        if ($excluir) {
            $condicao = 'deletatrue';
        }else{
            $condicao = 'deletafalse';
        }
        
        return redirect()->route('tabelapreco.index',$novodados)->withInput()->withErrors([$condicao]);
    }
}
