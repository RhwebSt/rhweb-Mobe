<?php

namespace App\Http\Controllers\FolhaAnalitica;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Folhar;
use App\BaseCalculo;
use App\ValorCalculo;
use App\TabelaPreco;
use App\Rublica;
use PDF;
class FolhaAnaliticaTomadorController extends Controller
{
    private $basecalculo,$folhar;
    public function __construct()
    {
        $this->basecalculo = new BaseCalculo;
        $this->folhar = new Folhar;
    }
    public function calculoFolhaAnalitica($id,$tomador)
    {
        
       
        $folhar = $this->basecalculo->where([
            ['folhar_id',$id],
            ['tomador_id',$tomador]
        ])
        ->with(['valorcalculo','tomador:id,tsnome','trabalhador:id,tsnome,tsmatricula','folhar.empresa:id,esnome'])
        ->get();
        // dd($folhar);
        // $folhas = $folhar->buscaFolhaAnaliticaTomador($id,$tomador);
      
        // $rublicas = $rublica->listaGeral();
        // $sim = [];
        // $nao = [];
        // $total = 0; 
        // foreach ($rublicas as $key => $valor) { 
            
        //     if ($valor->rsincidencia == 'Sim') {
        //         array_push($sim,$valor->rsrublica);
        //     }
        //     if ($valor->rsincidencia === 'Não') {
        //         array_push($nao,$valor->rsrublica);
        //     }
        // } 
        // $producao = $valorcalculo->calculoFolhaAnaliticaProducao($id,$sim,$tomador);
        // if (count($producao) < 1) {
        //     return redirect()->back()->withInput()->withErrors(['false'=>'Não foi possível gerar a PRODUÇÃO.']);
        // }
        // $dsr = $valorcalculo->calculoFolhaAnaliticaDsr($id,$nao,$tomador);
        // if (count($dsr) < 1) {
        //     return redirect()->back()->withInput()->withErrors(['false'=>'Não foi possível gerar o DSR 18,18%.']);
        // }
       
        // $ferias = $valorcalculo->calculoFolhaAnaliticaFerias($id,$nao,$tomador);
        
        // if (count($ferias) < 1) {
        //     return redirect()->back()->withInput()->withErrors(['false'=>'Não foi possível gerar Férias + 1/3.']);
        // }
        // $vt = $valorcalculo->calculoFolhaAnaliticaVT($id,$sim,$tomador);
      
        // $va = $valorcalculo->calculoFolhaAnaliticaVA($id,$sim,$tomador);
        
    
        // $salario13 = $valorcalculo->calculoFolhaAnalitica13Salario($id,$nao,$tomador);
        // if (count($salario13) < 1) {
        //     return redirect()->back()->withInput()->withErrors(['false'=>'Não foi possível gerar o 13° Salário.']);
        // }
    
        // $seguro = $valorcalculo->calculoFolhaAnaliticaSeguro($id,$nao,$tomador);
        
      

        // $sindicator = $valorcalculo->calculoFolhaAnaliticaSindicator($id,$nao,$tomador);
        
        
    
        // $adiantamento = $valorcalculo->calculoFolhaAnaliticaAdiantamento($id,$nao,$tomador);
        
        // $irrf = $valorcalculo->calculoFolhaAnaliticaIrrf($id,$nao,$tomador);
        
        // $inss = $valorcalculo->calculoFolhaAnaliticaInss($id,$nao,$tomador);
    
        // if (count($inss) < 1) {
        //     return redirect()->back()->withInput()->withErrors(['false'=>'Não foi possível gerar o INSS.']);
        // }
    
        // $inss_sobre13 = $valorcalculo->calculoFolhaAnaliticaInssSobre13($id,$nao,$tomador);
        // if (count($inss_sobre13) < 1) {
        //     return redirect()->back()->withInput()->withErrors(['false'=>'Não foi possível gerar o INSS sobre 13° Salário.']);
        // }
        // $vale = $valorcalculo->calculoFolhaAnaliticaDesconto($id,$sim,$tomador);
        
        $pdf = PDF::loadView('folhaAnaliticaTomador',compact('folhar'));
        return $pdf->setPaper('a4','landscape')->stream('CALCULO DA FOLHA ANALITICA TOMADOR.pdf');
        try {    
    } catch (\Throwable $th) { 
            return redirect()->back()->withInput()->withErrors(['false'=>'Não foi possível gerar a folha.']);
        }
    }
}
