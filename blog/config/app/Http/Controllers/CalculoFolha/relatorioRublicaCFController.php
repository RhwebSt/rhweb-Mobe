<?php

namespace App\Http\Controllers\CalculoFolha;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Folhar;
use PDF;
class relatorioRublicaCFController extends Controller
{
    public function imprimir(Request $request)
    {
        $dados = $request->all();

        $folha = new Folhar;
        $folhas = $folha->buscaListaRublica($dados);
        // dd($folhas);
        $pdf = PDF::loadView('relatorioRubricaCF',compact('folhas'));
        return $pdf->setPaper('a4')->stream('RELATÓRIO RUBLICA CF.pdf');
    }
}
