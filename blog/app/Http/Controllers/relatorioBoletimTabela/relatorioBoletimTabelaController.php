<?php

namespace App\Http\Controllers\relatorioBoletimTabela;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PDF;
use App\Lancamentotabela;
use App\Trabalhador;
class relatorioBoletimTabelaController extends Controller
{
    public function fichaLancamentoTab($id)
    {
        $lancamentotabela = new Lancamentotabela;
        $trabalhador = new Trabalhador;
        $lancamentotabelas = $lancamentotabela->relatorioBoletimTabela($id);
        if (count($lancamentotabelas) === 0) {
            return redirect()->back()->withInput()->withErrors(['false'=>'Não foi porssivél gera relatório.']);
        }
        $dados = [];
        foreach ($lancamentotabelas as $key => $value) {
            array_push($dados,$value->trabalhador);
        }
        $trabalhadors = $trabalhador->relatorioBoletimTabela($dados);
        $pdf = PDF::loadView('relatorioBoletimTabela',compact('lancamentotabelas','trabalhadors'));
        return $pdf->setPaper('a4')->stream('boletim_n°'.$id.'.pdf');
        try {
          
           
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['false'=>'Não foi porssivél gera o relatório.']);
        }
    }
}
