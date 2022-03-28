<?php

namespace App\Http\Controllers\Comentario;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Sugestao;
class ComentarioController extends Controller
{
    private $sugestao;
    public function __construct()
    {
        $this->sugestao = new Sugestao;
    }
    public function store(Request $request)
    {
        $dados = $request->all();
        $sugestao =  $this->sugestao->cadastro($dados);
        if ($sugestao) {
            return response()->json([
                'status'=>true,
                'msg'=>'Mensagem cadastrada com sucesso!'
            ]);
        }else{
            return response()->json([
                'status'=>false,
                'msg'=>'Não foi possível efetuar o cadastro.'
            ]);
        }
    }
}
