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
   
    private $empresa,$endereco,$valoresrublica;
    public function __construct()
    {
        $empresa = new Empresa;
        $endereco = new Endereco;
        $valoresrublica = new ValoresRublica;
    }
    public function index()
    {
        $user = Auth::user();
        $empresas = $this->empresa->first($user->empresa);
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
        try {
        $empresas = $this->empresa->cadastro($dados);
        if ($empresas) {
            // $dados['tomador'] = $empresas['id'];
            $dados['empresa'] = $empresas['id'];
            $enderecos = $this->endereco->cadastro($dados);
            $valoresrublicas = $this->valoresrublica->cadastro($dados);
        
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
    public function show($id)
    {
        $empresas = $this->empresa->first($id);
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
        try {
            $empresas = $this->empresa->editar($dados,$id);
            $enderecos = $this->endereco->editar($dados,$dados['endereco']); 
            $valoresrublicas = $this->valoresrublica->editar($dados,$id);
            return redirect()->back()->withSuccess('Atualizador com sucesso.'); 
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->withErrors(['false'=>'Não foi porssivél realizar a atualização.']);
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
        $campo = 'empresa';
        try {
            $enderecos = $this->endereco->first($id,$campo); 
            $exenderecos = $this->endereco->deletar($enderecos->eiid); 
            $valoresrublicas = $this->valoresrublica->deletar($enderecos->empresa); 
            if ($exenderecos &&  $valoresrublicas) {
                $empresas = $this->empresa->deletar($enderecos->empresa);
            }
            return redirect()->back()->withSuccess('Deletado com sucesso.');
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->withErrors(['false'=>'Não foi porssível deletar o registro.']);
        } 
    }
}
