<?php

namespace App\Http\Controllers\Trabalhador;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Trabalhador;
use App\Endereco;
use App\Bancario;
use App\Nascimento;
use App\Categoria;
use App\Documento;
class TrabalhadorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $trabalhador = new Trabalhador;
        $trabalhadors = $trabalhador->lista();
        return view('trabalhador.index',compact('trabalhadors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('trabalhador.create');
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
        $trabalhador = new Trabalhador;
        $endereco = new Endereco;
        $bancario = new Bancario;
        $nascimento = new Nascimento;
        $categoria = new Categoria;
        $documento = new Documento;
        $trabalhadors = $trabalhador->cadastro($dados);
        if ($trabalhadors) {
            // dd($dados);
            $dados['trabalhador'] = $trabalhadors['id'];
            $enderecos = $endereco->cadastro($dados); 
            $bancarios = $bancario->cadastro($dados);
            $nascimentos = $nascimento->cadastro($dados);
            $categorias = $categoria->cadastro($dados);
            $documentos = $documento->cadastro($dados);
            return redirect()->route('trabalhador.create')->withInput()->withErrors([true]); 
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $trabalhador = new Trabalhador;
        $trabalhadors = $trabalhador->first($id);
        dd($trabalhadors);
        // return redirect()->route('trabalhador.edit');
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
