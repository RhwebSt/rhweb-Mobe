<?php

namespace App\Http\Controllers\Pessoais;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PessoaisController extends Controller
{
    private $pessoais;
    public function __construct()
    {
        // $this->user = new User;
    }
    public function edit($id)
    {
        $user = Auth::user();
        // $dados = $this->user->edit($id);
        return view('usuarios.dadosPessoais.index',compact('user'));
    }
}
