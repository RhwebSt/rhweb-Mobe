<?php

namespace App\Http\Controllers\Senha;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
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
        \App\Jobs\Email::dispatch($dados)->delay(now()->addSeconds(15));
        // $dados['password'] = rand(100000, 999999);
        // $user = $this->user->editarSenharLogin($dados);
        // if (!$user) {
        //     return redirect()->back()->withInput()->withErrors(['false'=>'Este email não esta cadastrador.']);
        // }
        // Mail::send(new \App\Mail\Email($dados));
        
        return redirect()->back();
    }
}
