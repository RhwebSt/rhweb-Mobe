<?php

namespace App\Http\Controllers\BoletimCartaoPonto;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Lancamentotabela;
use App\Trabalhador;
use App\TabelaPreco;
use PDF;
class RelatorioCartaoPontoController extends Controller
{
    public function relatorioCartaoPonto($id,$domingo = null ,$sabado = null,$diasuteis,$data,$boletim,$tomador) 
    {
        
        $lancamentotabela = new Lancamentotabela;
        $trabalhador = new Trabalhador;
        $tabelapreco = new TabelaPreco; 
        $ano = explode('-',$data);
        $novodados = [
            $id,
            $domingo,
            $sabado,
            $diasuteis,
            $data,
            $boletim,
            $tomador,
        ];
        try {
         
            $tabelaprecos = $tabelapreco->buscaTabelaTomador($tomador,$ano[0]); 
            if (count($tabelaprecos) < 1) {
                return redirect()->back()->withInput()->withErrors(['false'=>'Não foi encontrada a tabela de preso deste tomador.']);
            }
            $lancamentotabelas = $lancamentotabela->relatoriocartaoponto($boletim); 
            $dados = [];
            foreach ($lancamentotabelas as $key => $value) {
                array_push($dados,$value->trabalhador);
            }
            $trabalhadors = $trabalhador->relatorioBoletimTabela($dados);
            $pdf = PDF::loadView('relatorioCartaoPonto',compact('lancamentotabelas','trabalhadors','tabelaprecos'));
            return $pdf->setPaper('a4','landscape')->stream('Relatório.pdf');
            
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->withErrors(['false'=>'Não foi porssivél gera o relatório.']);
        }
    }
}
