<?php

namespace App\Http\Controllers\FolhaAnalitica;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Folhar;
use App\ValorCalculo;
use App\BaseCalculo;
use App\RelacaoDia;
use App\Empresa;
use App\TabelaPreco;
use App\Rublica;
use PDF;
class FolhaAnaliticaController extends Controller
{
    public function calculoFolhaAnalitica($id)
    {
        
        $valorcalculo = new ValorCalculo;
        $folhar = new Folhar;
        $tabelhapreco = new TabelaPreco;
        $rublica = new Rublica;
        try {
        $folhas = $folhar->buscaFolhaAnalitica($id);
       
        $rublicas = $rublica->listaGeral();
        $sim = [];
        $nao = [];
        $total = 0; 
        foreach ($rublicas as $key => $valor) {
            
            if ($valor->rsincidencia == 'Sim') {
                array_push($sim,$valor->rsrublica);
            }
            if ($valor->rsincidencia === 'Não') {
                array_push($nao,$valor->rsrublica);
            }
        } 
        $producao = $valorcalculo->calculoFolhaAnaliticaProducao($id,$sim);
        if (count($producao) < 1) {
            return redirect()->back()->withInput()->withErrors(['false'=>'Não foi possível gerar a PRODUÇÃO.']);
        }
        $dsr = $valorcalculo->calculoFolhaAnaliticaDsr($id,$nao);
        if (count($dsr) < 1) {
            return redirect()->back()->withInput()->withErrors(['false'=>'Não foi possível gerar o DSR 18,18%.']);
        }
        $ferias = $valorcalculo->calculoFolhaAnaliticaFerias($id,$nao);
        
        if (count($ferias) < 1) {
            return redirect()->back()->withInput()->withErrors(['false'=>'Não foi possível gerar Férias + 1/3.']);
        }
        $vt = $valorcalculo->calculoFolhaAnaliticaVT($id,$sim);
      
        $va = $valorcalculo->calculoFolhaAnaliticaVA($id,$sim);
        
    
        $salario13 = $valorcalculo->calculoFolhaAnalitica13Salario($id,$nao);
        if (count($salario13) < 1) {
            return redirect()->back()->withInput()->withErrors(['false'=>'Não foi possível gerar o 13° Salário.']);
        }
    
        $seguro = $valorcalculo->calculoFolhaAnaliticaSeguro($id,$nao);
        
      

        $sindicator = $valorcalculo->calculoFolhaAnaliticaSindicator($id,$nao);
        
        
    
        $adiantamento = $valorcalculo->calculoFolhaAnaliticaAdiantamento($id,$nao);
        
        $irrf = $valorcalculo->calculoFolhaAnaliticaIrrf($id,$nao);
        
        $inss = $valorcalculo->calculoFolhaAnaliticaInss($id,$nao);

        if (count($inss) < 1) {
            return redirect()->back()->withInput()->withErrors(['false'=>'Não foi possível gerar o INSS.']);
        }
    
        $inss_sobre13 = $valorcalculo->calculoFolhaAnaliticaInssSobre13($id,$nao);
        if (count($inss_sobre13) < 1) {
            return redirect()->back()->withInput()->withErrors(['false'=>'Não foi possível gerar o INSS sobre 13° Salário.']);
        }
        $vale = $valorcalculo->calculoFolhaAnaliticaDesconto($id,$sim);
        
        $pdf = PDF::loadView('folhaAnalitica',compact('sindicator','seguro','inss','inss_sobre13','irrf','salario13','vt','va','ferias','dsr','adiantamento','vale','producao','folhas'));
        return $pdf->setPaper('a4')->stream('CALCULO DA FOLHA ANALITICA.pdf');
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->withErrors(['false'=>'Não foi possível gera a folha.']);
        }
    }
}
