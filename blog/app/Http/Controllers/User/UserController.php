<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Empresa;
class UserController extends Controller
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
        $use = new User;
        $users = $use->listaUser();
        return view('usuarios.index',compact('user','users'));
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
            'name' => 'required|unique:users|max:20|regex:/^[a-zA-Z0-9_\-]*$/',
            'senha'=>'required|max:20',
            'cargo'=>'max:100|regex:/^[a-zA-Z0-9_\-]*$/',
            'nome__completo'=>'required',
            'empresa'=>'required|min:1',
        ],[
            'nome__completo.required'=>'Campo não pode esta vazio!',
            'name.required'=>'Campo não pode esta vazio!',
            'name.regex'=>'Campo não pode ter caracteres especiais!',
            'name.unique'=>'Este usuario já esta cadastrado.',
            'name.max'=>'Campo não pode ter mas de 20 caracteres!',
            'senha.min'=>'A senha não pode ter menos de 6 caracteris!',
            'senha.required'=>'Campo não pode esta vazio!',
            'empresa.required'=>'Tomador não ta cadastro ou não foi encontrado!',
            'empresa.min'=>'Tomador não ta cadastro ou não foi encontrado!',
            'cargo.max'=>'Campo não pode ter mais de 100 caracteres!',
            'cargo.regex'=>'Campo não pode ter caracteres especiais!',
            
        ]);
        $user = new User;
        try {
            $users = $user->cadastro($dados);
            return redirect()->back()->withSuccess('Cadastro realizado com sucesso.');
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
        $user = new User;
        $empresa = new Empresa;
        $empresas = $empresa->buscaUsuario($id);
        if ($empresas) {
            return response()->json($empresas);
        }else{
            $users = $user->buscaUnidadeUser($id);
            return response()->json($users);
        }
        
    }
    public function pesquisa($id)
    { 
        $user = new User;
        $users = $user->buscaListaUser($id);
        return response()->json($users);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $id = base64_decode($id);
        $user = Auth::user();
        $use = new User;
        $users = $use->listaUser(); 
        $editar = $use->edit($id); 
        return view('usuarios.edit',compact('user','users','editar'));
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
            'name' => 'required|max:20|regex:/^[a-zA-Z0-9_\-]*$/',
            'senha'=>'max:20',
            'cargo'=>'max:100|regex:/^[a-zA-Z0-9_\-]*$/',
            'nome__completo'=>'required',
            'empresa'=>'required|min:1',
        ],[
            'nome__completo.required'=>'Campo não pode esta vazio!',
            'name.required'=>'Campo não pode esta vazio!',
            // 'name.regex'=>'Campo não pode ter caracteres especiais!',
            'name.max'=>'Campo não pode ter mas de 20 caracteres!',
            'senha.min'=>'A senha não pode ter menos de 6 caracteris!',
            'empresa.required'=>'Tomador não ta cadastro ou não foi encontrado!',
            'empresa.min'=>'Tomador não ta cadastro ou não foi encontrado!',
            'cargo.max'=>'Campo não pode ter mais de 100 caracteres!',
            // 'cargo.regex'=>'Campo não pode ter caracteres especiais!',
        ]);
        $user = new User;
        try {
            $users = $user->editar($dados,$id);
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
        $user = new User;
        try {
            $users = $user->deletar($id);
            return redirect()->back()->withSuccess('Deletado com sucesso.');
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->withErrors(['false'=>'Não foi porssível deletar o registro.']);
        }
       
    }
}
