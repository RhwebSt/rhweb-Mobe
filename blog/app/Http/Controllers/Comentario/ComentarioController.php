<?php

namespace App\Http\Controllers\Comentario;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Notification;
use App\Notifications\notificacaoSugestao;

use App\Sugestao;
use App\Empresa;
class ComentarioController extends Controller
{
    private $sugestao,$empresa;
    public function __construct()
    {
        $this->sugestao = new Sugestao;
        $this->empresa = new Empresa;
    }
    public function store(Request $request)
    {
        $dados = $request->all();
        $user = auth()->user();
        $empresa = $this->empresa->where('id',$dados['empresa'])
        ->select('esnome')->first();
        // dd($dados);
        $sugestao =  $this->sugestao->cadastro($dados); 
        if ($sugestao) {
            Notification::route('mail', 'suporte@rhwebsistemasinteligentes.com.br')
            ->notify(new notificacaoSugestao($user,$empresa,$dados));
            return response()->json([
                'status'=>true,
                'msg'=>'Mensagem cadastrada com sucesso!'
            ]);
        }else{
            return response()->json([
                'status'=>false,
                'msg'=>'Mensagem não cadastrada.'
            ]);
        }
    }
}
