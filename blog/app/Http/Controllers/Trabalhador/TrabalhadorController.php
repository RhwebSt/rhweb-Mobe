<?php

namespace App\Http\Controllers\Trabalhador;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Trabalhador;
use App\Endereco;
use App\Bancario;
use App\Nascimento;
use App\Categoria;
use App\Documento;
use App\Dependente;
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
        $user = Auth::user();
        return view('trabalhador.index',compact('trabalhadors','user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        return view('trabalhador.create',compact('user'));
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
            if ($enderecos &&  $bancarios && 
                $nascimentos && $categorias && $documentos) {
                    $condicao = 'cadastratrue';
                }else{
                    $condicao = 'cadastrafalse';
                }
                return redirect()->route('trabalhador.index')->withInput()->withErrors([$condicao]);  
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
        $trabalhador = new Trabalhador;
        $trabalhadors = $trabalhador->first($id);
        return response()->json($trabalhadors);
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
        $dados = $request->all();
        $trabalhador = new Trabalhador;
        $endereco = new Endereco;
        $bancario = new Bancario;
        $nascimento = new Nascimento;
        $categoria = new Categoria;
        $documento = new Documento;
        $trabalhadors = $trabalhador->editar($dados,$id);
        $enderecos = $endereco->editar($dados,$id); 
        $bancarios = $bancario->editar($dados,$id);
        $nascimentos = $nascimento->editar($dados,$id);
        $categorias = $categoria->editar($dados,$id);
        $documentos = $documento->editar($dados,$id);
        if ($trabalhadors && $enderecos &&  $bancarios && 
        $nascimentos && $categorias && $documentos) {
            $condicao = 'edittrue';
        }else{
            $condicao = 'editfalse';
        }
            return redirect()->route('trabalhador.index')->withInput()->withErrors([$condicao]); 
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $trabalhador = new Trabalhador;
        $endereco = new Endereco;
        $bancario = new Bancario;
        $nascimento = new Nascimento;
        $categoria = new Categoria;
        $documento = new Documento;
        $dependente = new Dependente;
        $dependentes = $dependente->deletar($id); 
        $enderecos = $endereco->deletar($id); 
        $bancarios = $bancario->deletar($id);
        $nascimentos = $nascimento->deletar($id);
        $categorias = $categoria->deletar($id);
        $documentos = $documento->deletar($id);
        if ($enderecos &&  $bancarios && $dependentes &&
        $nascimentos && $categorias && $documentos) {
            $trabalhadors = $trabalhador->deletar($id);
            $condicao = 'deletatrue';
        }else{
            $condicao = 'deletafalse';
        }
            return redirect()->route('trabalhador.index')->withInput()->withErrors([$condicao]); 
        
    }
}
