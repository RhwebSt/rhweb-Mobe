<?php

namespace App\Http\Controllers\Administrador\Usuario;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Empresa;
class UsuarioController extends Controller
{
    private $user,$empresa;
    public function __construct()
    {
        $this->user = new User;
        $this->empresa = new Empresa;
    }
    public function index()
    {
        $id = [];
        $search = request('search');
        $lista = $this->user->listaUserAdministrador('asc',$search);
        foreach ($lista as $key => $use) {
            array_push($id,$use->id);
        }
        $permissao = $this->user->permissaoSupAdmin($id);
        return view('administrador.usuarios.lista',compact('lista','permissao'));
    }

    public function ordem($ordem)
    {
        $id = [];
        $lista = $this->user->listaUserAdministrador($ordem,null);
        foreach ($lista as $key => $use) {
            array_push($id,$use->id);
        }
        $permissao = $this->user->permissaoSupAdmin($id);
        return view('administrador.usuarios.lista',compact('lista','permissao'));
    }
    public function create()
    {
        return view('administrador.usuarios.cadastrar');
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
            'name' => 'required|max:20|regex:/^[a-zA-Z0-9_\-]*$/',
            'senha'=>'max:20|required',
            'cargo'=>'max:100|regex:/^[a-zA-Z0-9_\-]*$/',
            'email'=>'required|email',
            'empresa'=>'required'
           
        ],[
            'name.required'=>'O campo não pode estar vazio!',
            'name.regex'=>'O campo não pode ter caracteres especiais!',
            'name.max'=>'O campo não pode conter mas de 20 caracteres!',
            'senha.min'=>'A senha não pode conter menos de 6 caracteres!',
            'cargo.max'=>'O campo não pode conter mais de 100 caracteres!',
            'cargo.regex'=>'O campo não pode ter caracteres especiais!',
            'empresa.required'=>'O campo não pode estar vazio!',
        ]);
    
        try {
            $this->user->cadastro($dados);
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
        //
    }
    public function pesquisa()
    { 
        $lista = $this->empresa->buscaEmpresaUsuario();
        return response()->json($lista);
    }
    public function edit($id)
    {
        $editar = $this->user->edit($id);
        return view('administrador.usuarios.editar',compact('editar'));
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
            'email'=>'required|email',
            'empresa'=>'required'
           
        ],[
            'name.required'=>'O campo não pode estar vazio!',
            // 'name.regex'=>'O campo não pode ter caracteres especiais!',
            'name.max'=>'O campo não pode conter mas de 20 caracteres!',
            'senha.min'=>'A senha não pode conter menos de 6 caracteres!',
            'cargo.max'=>'O campo não pode conter mais de 100 caracteres!',
            'empresa.required'=>'O campo não pode estar vazio!',
        ]);
        try {
            $users = $this->user->editar($dados,$id);
            return redirect()->back()->withSuccess('Atualizador com sucesso.'); 
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->withErrors(['false'=>'Não foi possivél realizar a atualização.']);
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
