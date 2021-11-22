<?php

namespace App\Http\Controllers\Depedente;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Dependente;
class DepedenteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($depedente)
    {
        
        $id = $depedente;
        $depedente = new Dependente;
        $depedentes = $depedente->lista($id);
        // dd($depedentes);
        $user = Auth::user();
        return view('trabalhador.depedente.index',compact('depedentes','id','user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $user = Auth::user();
        return view('trabalhador.depedente.create',compact('id','user'));
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
        $id = $dados['trabalhador'];
        $depedente = new Dependente;
        $depedentes = $depedente->cadastro($dados);
       if($depedentes) {
            $condicao = 'cadastratrue';
        }else{
            $condicao = 'cadastrafalse';
        }
        return redirect()->route('depedente.mostrar.create',$id)->withInput()->withErrors([$condicao]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
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
        $depedente = new Dependente;
        $depedentes = $depedente->first($id);
        $user = Auth::user();
        return view('trabalhador.depedente.edit',compact('depedentes','id','user'));
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
        $depedente = new Dependente;
        $depedentes = $depedente->editar($dados,$id);
        if($depedentes) {
            $condicao = 'edittrue';
        }else{
            $condicao = 'editfalse';
        }
        return redirect()->route('depedente.edit',$id)->withInput()->withErrors([$condicao]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $depedente = new Dependente;
        $depedentes = $depedente->first($id);
        $trabalhador = $depedentes->trabalhador;
        $excluir = $depedente->deletar($id);
        if ($excluir) {
            $condicao = 'deletatrue';
        }else{
            $condicao = 'deletafalse';
        }
        
        return redirect()->route('depedente.mostrar.index',$trabalhador)->withInput()->withErrors([$condicao]);
    }
}
