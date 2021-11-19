<?php

namespace App\Http\Controllers\BoletimCartaoPonto;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Bolcartaoponto;
class BoletimCartaoPontoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        return view('cadastroCartaoPonto.cadastracartaoponto',compact('user'));
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
        // dd($dados);
        $bolcartaoponto = new Bolcartaoponto;
        $bolcartaopontos = $bolcartaoponto->cadastro($dados);
        $lista = $bolcartaoponto->listacadastro($dados['lancamento']);
        $user = Auth::user();
        $id = $dados['lancamento'];
        // if ($lancamentorublicas) {
        //     $condicao = 'cadastratrue';
        // }else{
        //     $condicao = 'cadastrafalse';
        // } 
        return view('cadastroCartaoPonto.cadastracartaoponto',compact('user','id','lista'))  
        ->with([
            'domingo'=>$dados['domingo'],
            'sabado'=>$dados['sabado'],
            'diasuteis'=>$dados['diasuteis'],
            'data'=>$dados['data']
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $bolcartaoponto = new Bolcartaoponto;
        $bolcartaopontos = $bolcartaoponto->listafirst($id);
        return response()->json($bolcartaopontos);
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
        $user = Auth::user();
        $bolcartaoponto = new Bolcartaoponto;
        $bolcartaopontos = $bolcartaoponto->editar($dados,$id);
        if ($bolcartaopontos) {
            $lista = $bolcartaoponto->listacadastro($dados['lancamento']);
            $id = $dados['lancamento'];
            return view('cadastroCartaoPonto.cadastracartaoponto',compact('user','id','lista'))
            ->with([
                'domingo'=>$dados['domingo'],
                'sabado'=>$dados['sabado'],
                'diasuteis'=>$dados['diasuteis'],
                'data'=>$dados['data']
            ]);
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
        //
    }
}
