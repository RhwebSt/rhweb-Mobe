<?php

namespace App\Http\Controllers\BoletimCartaoPonto;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
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
        $bolcartaoponto = new Bolcartaoponto;
        $lista = $bolcartaoponto->listacadastro($dados['lancamento']);
        $user = Auth::user();
        $id = $dados['lancamento'];
        $validator = Validator::make($request->all(), [
            'nome__completo' => 'required',
            'matricula'=>'required|min:4',

        ],[
            'nome__completo.required'=>'O campo não pode esta vazio!',
            'matricula.required'=>'O campo não pode esta vazio!',
            'matricula.min'=>'O campo não pode ter menos de 4 caracteres'
        ]);
        if ($validator->fails()) {
            return view('cadastroCartaoPonto.cadastracartaoponto',compact('user','id','lista'))  
            ->with([
                'domingo'=>$dados['domingo'],
                'sabado'=>$dados['sabado'],
                'diasuteis'=>$dados['diasuteis'],
                'data'=>$dados['data']
            ])->withErrors($validator);
        }
        $bolcartaopontos = $bolcartaoponto->cadastro($dados);
        return view('cadastroCartaoPonto.cadastracartaoponto',compact('user','id','lista'))  
        ->with([
            'domingo'=>$dados['domingo'],
            'sabado'=>$dados['sabado'],
            'diasuteis'=>$dados['diasuteis'],
            'data'=>$dados['data']
        ])->withErrors(['true'=>'Cadastro realisado com sucesso!']);
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
        $lista = $bolcartaoponto->listacadastro($dados['lancamento']);
     
        $validator = Validator::make($request->all(), [
            'nome__completo' => 'required',
            'matricula'=>'required|min:4',

        ],[
            'nome__completo.required'=>'O campo não pode esta vazio!',
            'matricula.required'=>'O campo não pode esta vazio!',
            'matricula.min'=>'O campo não pode ter menos de 4 caracteres'
        ]);
        if ($validator->fails()) {
            $id = $dados['lancamento'];
            return view('cadastroCartaoPonto.cadastracartaoponto',compact('user','id','lista'))  
            ->with([
                'domingo'=>$dados['domingo'],
                'sabado'=>$dados['sabado'],
                'diasuteis'=>$dados['diasuteis'],
                'data'=>$dados['data']
            ])->withErrors($validator);
        }
        $bolcartaopontos = $bolcartaoponto->editar($dados,$id);
        if ($bolcartaopontos) {
            $id = $dados['lancamento'];
            return view('cadastroCartaoPonto.cadastracartaoponto',compact('user','id','lista'))
            ->with([
                'domingo'=>$dados['domingo'],
                'sabado'=>$dados['sabado'],
                'diasuteis'=>$dados['diasuteis'],
                'data'=>$dados['data']
            ])->withErrors(['true'=>'Atualizado com sucesso!']);
        }else{
            return view('cadastroCartaoPonto.cadastracartaoponto',compact('user','id','lista'))
            ->with([
                'domingo'=>$dados['domingo'],
                'sabado'=>$dados['sabado'],
                'diasuteis'=>$dados['diasuteis'],
                'data'=>$dados['data']
            ])->withErrors(['false'=>'Não foi porssível atualizar os dados!']);
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
