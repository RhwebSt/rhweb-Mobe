<?php

namespace App\Http\Controllers\Empresa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Empresa;
use App\Endereco;
class PerfilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        // $empresa = new Empresa;
        // $empresas = $empresa->first($user->empresa);
        return view('usuarios.empresa.perfil',compact('user'));
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
        //
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
            'esnome'=>'required|max:100',
            'escnpj'=>'required|max:100',
            'dataregistro'=>'required|max:30',
            'responsave'=>'required|max:30',
            'email'=>'required|max:100|email',
            'cnae__codigo'=>'required|max:10',
            'contribuicao__sindicato'=>'required|max:30',
            'telefone'=>'required|max:20|celular_com_ddd',
            'cod__municipio'=>'required|max:10',
            'cep'=>'required|max:16',
            'logradouro'=>'required|max:50',
            'numero'=>'required|max:10',
            'bairro'=>'required:max:40',
            'localidade'=>'required|max:30',
            'uf'=>'required|max:2|uf',
        ]);
        
        $empresa = new Empresa;
        $endereco = new Endereco;
        try {
            $empresas = $empresa->editar($dados,$id);
            $endereco = $endereco->editarEmpresa($dados,$id);
            return redirect()->back()->withSuccess('Atualizador com sucesso.');
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
        //
    }
    public function indexFoto()
    {
        $user = Auth::user();
        $empresa = new Empresa;
        $empresas = $empresa->buscaUnidadeEmpresa($user->empresa);
        // dd($empresas);
        return view('usuarios.empresa.alteracaoFoto',compact('user','empresas'));
    }
    public function editFoto(Request $request)
    {
        $dados = $request->all();
        $empresa = new Empresa;
        $empresas = $empresa->editarFoto($dados);
        return response()->json($empresas);
    }
}
