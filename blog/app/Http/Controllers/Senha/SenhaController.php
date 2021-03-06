<?php

namespace App\Http\Controllers\Senha;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Notifications\notificaEsqueceuSenha;
use App\User;
class SenhaController extends Controller
{
    private $user;
    public function __construct()
    {
        $this->user = new User;
    }
    public function index()
    {
        return view('login.esqueceuSenha');
    }
    public function store(Request $request)
    {
        $dados = $request->all();
        $dados['password'] = rand(100000, 999999);
        $use = $this->user->buscaUnidadeUser($dados['email']);
        // \App\Jobs\Email::dispatch($dados)->delay(now()->addSeconds(15)); 
        // $dados['password'] = rand(100000, 999999);
        $user = $this->user->editarSenharLogin($dados);
        if (!$user) {
            return redirect()->back()->withInput()->withErrors(['email'=>'Este email não está cadastrado.']);
        }
        // Mail::send(new \App\Mail\Email($dados)); 
        $use->notify(new notificaEsqueceuSenha($use,$dados['password']));
        return redirect()->back()->withInput()->withSuccess('Sua senha foi alterada, verifique seu email.'); 
    }
}
