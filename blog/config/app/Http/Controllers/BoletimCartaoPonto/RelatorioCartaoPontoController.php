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
        $id =  base64_decode($id);
        $domingo = base64_decode($domingo);
        $sabado = base64_decode($sabado);
        $diasuteis = base64_decode($diasuteis);
        $data = base64_decode($data);
        $boletim = base64_decode($boletim);
        $tomador = base64_decode($tomador);
        $lancamentotabela = new Lancamentotabela;
        $trabalhador = new Trabalhador;
        $tabelapreco = new TabelaPreco; 
        $ano = explode('-',$data);
      
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
