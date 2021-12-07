<?php

namespace App\Http\Controllers\Empresa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Empresa;
use App\Endereco;
use App\ValoresRublica;
use App\User;
class EmpresaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        $empresa = new Empresa;
        $empresas = $empresa->first($user->empresa);
        return view('usuarios.empresa.index',compact('user'));
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
            'esnome'=>'required|max:100|unique:empresas',
            'escnpj'=>'required|max:100|unique:empresas|cnpj',
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
            'vt__trabalhador'=>'max:15',
            'va__trabalhador'=>'max:15',
            'nro__fatura'=>'max:15',
            'nro__reciboavulso'=>'max:15',
            'matric__trabalhador'=>'max:15',
            'nro__requisicao'=>'max:15',
            'nro__boletins'=>'max:15',
            'nro__folha'=>'max:15',
            'nro__cartaoponto'=>'max:15',
            'seq__esocial'=>'max:15',
            'cbo'=>'max:15'
        ],[
            'esnome.unique'=>'Esta empresa já ta cadastrada!',
            'escnpj.unique'=>'Este CNPJ já ta cadastro!'
        ]);
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
            return redirect()->route('listaempresa.create')->withInput()->withErrors([$condicao]);
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
    public function pesquisa($id)
    {
        $empresa = new Empresa;
        $empresas = $empresa->pesquisa($id);
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
        return redirect()->route('listaempresa.create')->withInput()->withErrors([$condicao]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // dd($id);
        $empresa = new Empresa;
        $endereco = new Endereco;
        $valoresrublica = new ValoresRublica;
        $user = new User;
        $campo = 'empresa';
        $users = $user->deleteempresa($id);
        $enderecos = $endereco->first($id,$campo);
        $exenderecos = $endereco->deletar($enderecos->eiid);
        $valoresrublicas = $valoresrublica->deletar($enderecos->empresa); 
        if ($exenderecos &&  $valoresrublicas && $users) {
            $empresas = $empresa->deletar($enderecos->empresa);
            $condicao = 'deletatrue';
        }else{
            $condicao = 'deletafalse';
        }
            return redirect()->route('listaempresa.create')->withInput()->withErrors([$condicao]); 
    }
}
