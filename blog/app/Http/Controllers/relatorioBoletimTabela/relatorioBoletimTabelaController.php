<?php

namespace App\Http\Controllers\relatorioBoletimTabela;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PDF;
use App\Lancamentotabela;
class relatorioBoletimTabelaController extends Controller
{
    public function ficha($id)
    {
        
        $lancamentotabela = new Lancamentotabela;
        $lancamentotabelas = $lancamentotabela->relatorioboletimtabela($id);
        $dados = [];
        foreach ($lancamentotabelas as $key => $value) {
            array_push($dados,$value->trabalhador);
        }
        // dd($dados);
        $pdf = PDF::loadView('relatorioBoletimTabela',compact('lancamentotabelas'));
        return $pdf->setPaper('a4')->stream('boletim_'.$id.'.pdf');
    }
}
