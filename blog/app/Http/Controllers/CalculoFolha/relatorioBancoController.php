<?php

namespace App\Http\Controllers\CalculoFolha;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Folhar;
use PDF;
class relatorioBancoController extends Controller
{
    public function imprimirBanco(Request $request)
    {

        $dados = $request->all();
        $folhar = new Folhar;
            $folhars = $folhar->buscaListaBancos($dados['folharbanco'],$dados['banco'],$dados['empresabanco']);
            if (count($folhars) < 1) {
                $banco = explode('-',$dados['banco']);
                return redirect()->back()->withInput()->withErrors(['false'=>'Não há registro cadastrado do '.$banco[1].'.']);
            }
            $pdf = PDF::loadView('relatorioBanco',compact('folhars'));
            return $pdf->setPaper('a4')->stream('RELATÓRIO BANCÁRIO MENSAL.pdf');
            try {
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->withErrors(['false'=>'Não foi possível gerar o relatório.']);
        }
    }
}
