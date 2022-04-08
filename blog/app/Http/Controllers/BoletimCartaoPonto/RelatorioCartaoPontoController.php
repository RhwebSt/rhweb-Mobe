<?php

namespace App\Http\Controllers\BoletimCartaoPonto;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Lancamentotabela;
use App\Trabalhador;
use App\TabelaPreco;
use App\Empresa;
use PDF;
class RelatorioCartaoPontoController extends Controller
{
    private $lancamentotabela,$trabalhador,$tabelapreco,$empresa;
    public function __construct()
    {
        $this->lancamentotabela = new Lancamentotabela;
        $this->trabalhador = new Trabalhador;
        $this->tabelapreco = new TabelaPreco;
        $this->empresa = new Empresa; 
    }
    public function relatorioCartaoPonto($id,$domingo = null ,$sabado = null,$diasuteis,$data,$boletim,$tomador) 
    {
        $id =  base64_decode($id);
        $domingo = base64_decode($domingo);
        $sabado = base64_decode($sabado);
        $diasuteis = base64_decode($diasuteis);
        $data = base64_decode($data);
        $boletim = base64_decode($boletim);
        $tomador = base64_decode($tomador);
        $ano = explode('-',$data);
        try {
            $tabelaprecos = $this->tabelapreco->buscaTabelaTomador($tomador,$ano[0],null,'asc'); 
            if (count($tabelaprecos) < 1) {
                return redirect()->back()->withInput()->withErrors(['false'=>'Não foi encontrada a tabela de preço deste tomador.']);
            }
            $lancamentotabelas = $this->lancamentotabela->relatoriocartaoponto($boletim);
            $empresa = $this->empresa->buscaUnidadeEmpresa($lancamentotabelas[0]->empresa); 
            
            $dados = [];
            foreach ($lancamentotabelas as $key => $value) { 
                array_push($dados,$value->trabalhador);
            }
            $trabalhadors = $this->trabalhador->relatorioBoletimTabela($dados);
            $pdf = PDF::loadView('relatorioCartaoPonto',compact('lancamentotabelas','empresa','trabalhadors','tabelaprecos'));
            return $pdf->setPaper('a4','landscape')->stream('Relatório.pdf');
             
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->withErrors(['false'=>'Não foi possível gerar o relatório.']);
        }
    }
}
