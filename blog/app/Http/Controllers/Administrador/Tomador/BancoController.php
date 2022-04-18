<?php

namespace App\Http\Controllers\Administrador\Tomador;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BancoController extends Controller
{
    public function cadastroTxt(Request $request)
    {
        // $dados = $request->all();
        $file = $request->file('file');
        $dados = file($file);
        foreach($dados as $key=>$linha){
            if ($key === 0) {
                $linha = explode('  ',$linha);
                dd($linha,$key);
            }
        }
    }
}
