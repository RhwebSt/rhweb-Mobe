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
        $tomador = base64_decode($tomador);
        $user = Auth::user();
        $tabelapreco = new TabelaPreco;  
        $tabelaprecos = $tabelapreco->buscaTabelaTomador($tomador,date('Y')); 
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
        $tabelapreco = new TabelaPreco;
        $request->validate([
            'ano' => 'required|max:4',
            'rubricas'=>'required|max:30',
            'descricao'=>'required|max:60|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÏÔÕÛÙÜŸÑÆŒa-zàáâãçéèêëîïôõûùüÿñæœ 0-9_\-%]*$/',
            'valor'=>'required',
            'valor__tomador'=>'required'
        ]);
        $tabelaprecos = $tabelapreco->verificaRublica($dados);
        if ($tabelaprecos) {
            return redirect()->back()->withInput()->withErrors(['descricao'=>'Essa rúbrica já esta cadastrada.']);; 
        }
        try {
            $tabelaprecos = $tabelapreco->cadastro($dados);
            if($tabelaprecos) {
                return redirect()->back()->withSuccess('Cadastro realizado com sucesso.'); 
            }
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
    public function edit($id,$tomador)
    {
        $id = base64_decode($id);
        $tomador = base64_decode($tomador);
        $user = Auth::user();
        $tabelapreco = new TabelaPreco;
        $tabelaprecos = $tabelapreco->buscaTabelaTomador($tomador,date('Y'));
        $tabelaprecos_editar = $tabelapreco->buscaTabelaPrecoEditar($id);
        return view('tomador.tabelapreco.edit',compact('tabelaprecos_editar','tabelaprecos','tomador','id','user'));
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

        $tabelapreco = new TabelaPreco;
        try {
            $tabelaprecos = $tabelapreco->editar($dados,$id);
            if($tabelaprecos) {
                return redirect()->back()->withSuccess('Atualizador com sucesso.'); 
            }
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->withErrors(['false'=>'Não foi porssível realizar a atualização.']);
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
        $tabelapreco = new TabelaPreco;
        try {
            $tabelaprecos = $tabelapreco->buscaUnidadeTabela($id);
            $excluir = $tabelapreco->deletar($id);
            return redirect()->back()->withSuccess('Deletado com sucesso.');
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['false'=>'Não foi possível deletar o registro.']);
        }
        
    }
    public function verificaTabelaPreco($tomador)
    {
        $tabelapreco = new TabelaPreco;
        $tabelaprecos = $tabelapreco->buscaTabelaTomador($tomador,date('Y'));
        if (count($tabelaprecos) > 0) {
            return response()->json(true);
        }else{
            return response()->json(false);
        }
    }
}
