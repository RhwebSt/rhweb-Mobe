<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Notifications\notificaUser;
use App\User;
use App\Empresa;
use App\Pessoai;
use App\Endereco;
class UserController extends Controller
{
   private $user,$pessoais,$endereco;
   public function __construct()
   {
       $this->user = new User; 
       $this->pessoais = new Pessoai;
       $this->endereco = new Endereco;
   }
    public function index()
    {
       
    }

   
    public function create()
    {
        return view('administrador.usuarios.index');
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
  
    public function store(Request $request)
    {
        $dados = $request->all(); 
        
        $request->validate([
            'name' => 'required|max:20|regex:/^[a-zA-Z0-9_\-]*$/',
            'senha'=>'max:20',
            'email'=>'required|email',
        ],[
            
            'name.required'=>'O campo não pode estar vazio!',
            'name.regex'=>'O campo não pode ter caracteres especiais!',
            'name.max'=>'O campo não pode conter mas de 20 caracteres!',
            'senha.min'=>'A senha não pode conter menos de 6 caracteres!',
            // 'email.unique'=>'Este email já esta cadastrado!',
            'email.required'=>'O campo não pode estar vazio!',
            'email.email'=>'O campo não é um email valido!',
            
        ]);
        // $user = $this->user->verificaemail($dados);
        // if ($user) {
        //     return redirect()->back()->withInput()->withErrors(['email'=>'Este email já esta cadastrado!']);
        // }
        try {
            $use = $this->user->precadastro($dados);
            $dados['id'] = $use['id']; 
            $dados['user'] = $use['id'];
            $pessoais = $this->pessoais->cadastra($dados);
            $dados['pessoal'] = $pessoais['id'];
            $this->endereco->cadastro($dados);
            $use->notify(new notificaUser($use,$dados['senha']));
            // \App\Jobs\Email::dispatch($dados)->delay(now()->addSeconds(15));
            // Mail::send(new \App\Mail\Email($dados));
            return redirect()->back()->withSuccess('Cadastro realizado com sucesso.'); 
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->withErrors(['false'=>'Não foi possível realizar o cadastro.']);
        }
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

    
    public function edit($id)
    {
        return view('usuarios.edit',compact('id'));
    }
    
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
