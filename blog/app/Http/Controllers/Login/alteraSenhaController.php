<?php

namespace App\Http\Controllers\Login;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Empresa;
class alteraSenhaController extends Controller
{
    private $user,$empresa;
    public function __construct()
    {
        $this->user = new User;
        $this->empresa = new Empresa;
    }
    public function index()
    {
        $user = Auth::user();
        $empresa = $this->empresa->where('id',$user->empresa_id)->first();
        return view('login.alteracaoSenha',compact('user','empresa'));
    }
    public function store(Request $request)
    {
        $dados = $request->all();
        $user = new User;
        if (!Hash::check($dados['password'],Auth::user()->password)){
            return redirect()->back()->withErrors(['password' => 'Senha atual está incorreta'])->withInput();
        }
        $request->validate([
            'password1'   => ["required"],
            'password2' => 'required|same:password1'
        ],
        [
            'password2.same'=>'Os campos "Confirme sua senha" e "Nova senha" devem serem iguais.'
        ]);
        $user->editarSenhar($dados);
        return redirect()->back()->withSuccess('Senha alterada com sucesso.');
    }
}
