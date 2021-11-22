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
    public function index($tabelapreco)
    {
        $id = $tabelapreco;
        $user = Auth::user();
        return view('tomador.tabelapreco.index',compact('id','user'));
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
        $id = $dados['tomador'];
        $tabelaprecos = $tabelapreco->cadastro($dados);
        if($tabelaprecos) {
            $condicao = 'cadastratrue';
        }else{
            $condicao = 'cadastrafalse';
        }
        return redirect()->route('tabelapreco.mostrar.index',$id)->withInput()->withErrors([$condicao]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tabelapreco = new TabelaPreco;
        $tabelaprecos = $tabelapreco->first($id);
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
        $tabelapreco = new TabelaPreco;
        $tabelaprecos = $tabelapreco->editar($dados,$id);
        if($tabelaprecos) {
            $condicao = 'edittrue';
        }else{
            $condicao = 'editfalse';
        }
        return redirect()->route('tabelapreco.mostrar.index',$id)->withInput()->withErrors([$condicao]);
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
        $tabelaprecos = $tabelapreco->first($id);
        $excluir = $tabelapreco->deletar($id);
        $id = $tabelaprecos->tomador;
        if ($excluir) {
            $condicao = 'deletatrue';
        }else{
            $condicao = 'deletafalse';
        }
        
        return redirect()->route('tabelapreco.mostrar.index',$id)->withInput()->withErrors([$condicao]);
    }
}
