<?php

namespace App\Http\Controllers\UsuarioTrabalhador;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Empresa;
use App\Endereco;
use App\ValoresRublica;
class UsuarioTrabalhadorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $empresa = new Empresa;
        $empresas = $empresa->first($user->empresa);
        return view('usuarios.trabalhador.index',compact('user'));
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
        $empresa = new Empresa;
        $endereco = new Endereco;
        $valoresrublica = new ValoresRublica;
        $empresas = $empresa->cadastro($dados);
        if ($empresas) {
            // $dados['tomador'] = $empresas['id'];
            $dados['empresa'] = $empresas['id'];
            $enderecos = $endereco->cadastro($dados);
            $valoresrublicas = $valoresrublica->cadastro($dados);
            if ($enderecos && $valoresrublicas) {
                $condicao = 'cadastratrue';
            }else{
                $condicao = 'cadastrafalse';
            }
            return redirect()->route('usuariotrabalhador.index')->withInput()->withErrors([$condicao]);
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
        $empresa = new Empresa;
        $empresas = $empresa->first($id);
        return response()->json($empresas);
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
        $empresa = new Empresa;
        $endereco = new Endereco;
        $valoresrublica = new ValoresRublica;
        $empresas = $empresa->editar($dados,$id);
        $enderecos = $endereco->editar($dados,$dados['endereco']); 
        $valoresrublicas = $valoresrublica->editar($dados,$id);
        if ($empresas && $enderecos && $valoresrublicas) {
            $condicao = 'edittrue';
        }else{
            $condicao = 'editfalse';
        }
        return redirect()->route('usuariotrabalhador.index')->withInput()->withErrors([$condicao]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $empresa = new Empresa;
        $endereco = new Endereco;
        $valoresrublica = new ValoresRublica;
        $campo = 'empresa';
        $enderecos = $endereco->first($id,$campo); 
        $exenderecos = $endereco->deletar($enderecos->eiid); 
        $valoresrublicas = $valoresrublica->deletar($enderecos->empresa); 
        if ($exenderecos &&  $valoresrublicas) {
            $empresas = $empresa->deletar($enderecos->empresa);
            $condicao = 'deletatrue';
        }else{
            $condicao = 'deletafalse';
        }
            return redirect()->route('usuariotrabalhador.index')->withInput()->withErrors([$condicao]); 
    }
}
