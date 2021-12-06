<?php

namespace App\Http\Controllers\relatorioBoletimTabela;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PDF;
use App\Lancamentotabela;
use App\Trabalhador;
class relatorioBoletimTabelaController extends Controller
{
    public function ficha($id)
    {
        
        $lancamentotabela = new Lancamentotabela;
        $trabalhador = new Trabalhador;
        $lancamentotabelas = $lancamentotabela->relatorioboletimtabela($id);
        $dados = [];
        foreach ($lancamentotabelas as $key => $value) {
            array_push($dados,$value->trabalhador);
        }
        $trabalhadors = $trabalhador->relatorioboletim($dados);
        $pdf = PDF::loadView('relatorioBoletimTabela',compact('lancamentotabelas','trabalhadors'));
        return $pdf->setPaper('a4')->stream('boletim_n°'.$id.'.pdf');
    }
}
