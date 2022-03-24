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
       return view('usuarios.geradorAcesso');
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
        $search = request('search');
        $codicao = request('codicao');
        $users = $use->listaUser('asc',$search);
        if ($codicao) {
            $editar = $use->edit($codicao);
            return view('usuarios.edit',compact('user','users','editar'));
        }else{
            return view('usuarios.index',compact('user','users'));
        }
    }
    public function filtroPesquisa($condicao,$id = null)
    {
        $user = Auth::user();
        $use = new User;
        $users = $use->listaUser($condicao,null);
        if ($id) {
            $editar = $use->edit($id);
            return view('usuarios.edit',compact('user','users','editar'));
        }else{
            return view('usuarios.index',compact('user','users'));
        }
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
            'name' => 'required|unique:users|max:20|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÓÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôóõûùúüÿñæœ 0-9_\-().]*$/',
            'senha'=>'required|max:20',
            'cargo'=>'max:100|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÓÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôóõûùúüÿñæœ 0-9_\-().]*$/',
            'nome__completo'=>'required',
            'email'=>'required|email|unique:users',
            'empresa'=>'required|min:1',
        ],[
            'nome__completo.required'=>'Campo não pode estar vazio!',
            'name.required'=>'Campo não pode estar vazio!',
            'name.regex'=>'Campo não pode conter caracteres especiais!',
            'name.unique'=>'Este usuario já está cadastrado.',
            'name.unique'=>'Este email já está cadastrado.',
            'name.max'=>'Campo não pode conter mais de 20 caracteres!',
            'senha.min'=>'A senha não pode conter menos de 6 caracteres!',
            'senha.required'=>'Campo não pode estar vazio!',
            'empresa.required'=>'Tomador não está cadastrado ou não foi encontrado!',
            'empresa.min'=>'Tomador não está cadastrado ou não foi encontrado!',
            'cargo.max'=>'Campo não pode conter mais de 100 caracteres!',
            'cargo.regex'=>'Campo não pode conter nenhum caracteres especiais!',
            
        ]);
        $user = new User;
        try {
            $users = $user->cadastro($dados);
            return redirect()->back()->withSuccess('Cadastro realizado com sucesso.');
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->withErrors(['false'=>'Não foi possível cadastrar.']);
        }
    }

   public function PreStore(Request $request)
   {
        $dados = $request->all();
        dd($dados);
   }
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
        $search = request('search');
        $users = $use->listaUser('asc',$search);
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
            'email'=>'required|email',
            'empresa'=>'required|min:1',
        ],[
            'nome__completo.required'=>'O campo não pode estar vazio!',
            'name.required'=>'O campo não pode estar vazio!',
            // 'name.regex'=>'O campo não pode ter caracteres especiais!',
            'name.max'=>'O campo não pode conter mas de 20 caracteres!',
            'senha.min'=>'A senha não pode conter menos de 6 caracteres!',
            'empresa.required'=>'O tomador não está cadastrado ou não foi encontrado!',
            'empresa.min'=>'O tomador não está cadastrado ou não foi encontrado!',
            'cargo.max'=>'O campo não pode conter mais de 100 caracteres!',
            // 'cargo.regex'=>'O campo não pode ter caracteres especiais!',
        ]);
        $user = new User;
        try {
            $users = $user->editar($dados,$id);
            return redirect()->back()->withSuccess('Atualizado com sucesso.');
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->withErrors(['false'=>'Não foi possível realizar a atualização.']);
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
            return redirect()->back()->withInput()->withErrors(['false'=>'Não foi possível deletar o registro.']);
        }
       
    }
}
