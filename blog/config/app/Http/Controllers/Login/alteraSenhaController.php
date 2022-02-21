<?php

namespace App\Http\Controllers\Login;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\User;
class alteraSenhaController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('login.alteracaoSenha',compact('user'));
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
            'password2.same'=>'Os campos Confirme sua senha e Nova Senha devem corresponder'
        ]);
        $user->editarSenhar($dados);
        return redirect()->back()->withSuccess('Senha alterada com sucesso.');
    }
}
