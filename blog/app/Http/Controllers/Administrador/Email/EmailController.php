<?php

namespace App\Http\Controllers\Administrador\Email;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Administrador\Email\Validacao;
use Notification;
use App\Notifications\notificacaoManutencao;
use App\User;
class EmailController extends Controller
{
    private $usuarios;
    public function __construct()
    {
        $this->usuarios = new User;
    }
    public function index()
    {
        return view('administrador.mensagemEmail.MensagemEmail');
    }
    public function store(Validacao $request)
    {
        $dados = $request->all();
        try {
            $usuarios = $this->usuarios->select('email')->get();
            foreach ($usuarios as $key => $usuario) {
                if ($usuario->email) {
                    Notification::route('mail', $usuario->email)
                    ->notify(new notificacaoManutencao($dados));
                    
                }
            }
            return redirect()->back()->withSuccess('Email enviado com sucesso.'); 
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->withErrors(['false'=>'Alguns email não poderam ser enviado.']);
        }
    }
}
