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
use PDF;
class FolhaAnaliticaController extends Controller
{
    public function calculoFolhaAnalitica($id)
    {
        
        $valorcalculo = new ValorCalculo;
        $folhar = new Folhar;
        $tabelhapreco = new TabelaPreco;
        $folhas = $folhar->buscaFolhaAnalitica($id);
        $tabelhaprecos = $tabelhapreco->tomadorFolhar($id);
       
        $total = 0; 
        $dados = [
            'nome'=>[],
            'matricula'=>[],
            'producao'=>[],
            'dsr'=>[],
            'ferias'=>[],
            'vt'=>[],
            'va'=>[],
            '13salario'=>[],
            'vencimento'=>[],
            'liquido'=>[],
            'seguro'=>[],
            'sindicato'=>[],
            'irrf'=>[],
            'inss'=>[],
            'inss_sobre_13'=>[],
            'total'=>[],
        ];
        $producao_codigo = [1000,1001,1002,1003,1004,1005,1006,1007];
        $producao = $valorcalculo->calculoFolhaAnaliticaProducao($id,$producao_codigo);
        
        $dsr_codigo = [1008];
        $dsr = $valorcalculo->calculoFolhaAnaliticaDsr($id,$dsr_codigo);

        $ferias_codigo = [1009];
        $ferias = $valorcalculo->calculoFolhaAnaliticaFerias($id,$ferias_codigo);

        $vt_codigo = [1012];
        $vt = $valorcalculo->calculoFolhaAnaliticaVT($id,$vt_codigo);

        $va_codigo = [1013];
        $va = $valorcalculo->calculoFolhaAnaliticaVA($id,$va_codigo);

        $salario13_codigo = [1010];
        $salario13 = $valorcalculo->calculoFolhaAnalitica13Salario($id,$salario13_codigo);

        $seguro_codigo = [1014];
        $seguro = $valorcalculo->calculoFolhaAnaliticaSeguro($id,$seguro_codigo);

        $sindicator_codigo = [1011];
        $sindicator = $valorcalculo->calculoFolhaAnaliticaSindicator($id,$sindicator_codigo);

        $adiantamento_codigo = [2003];
        $adiantamento = $valorcalculo->calculoFolhaAnaliticaAdiantamento($id,$adiantamento_codigo);
        $irrf_codigo = [2004];
        $irrf = $valorcalculo->calculoFolhaAnaliticaIrrf($id,$irrf_codigo);
        // dd($adiantamento);
        $inss_codigo = [2001];
        $inss = $valorcalculo->calculoFolhaAnaliticaInss($id,$inss_codigo);

        $inss_sobre13_codigo = [2002];
        $inss_sobre13 = $valorcalculo->calculoFolhaAnaliticaInssSobre13($id,$inss_sobre13_codigo);

        $vale_codigo = [0];
        $vale = $valorcalculo->calculoFolhaAnaliticaDesconto($id,$vale_codigo);
        // dd($vale,$producao);
        foreach ($producao as $p => $producoes) {
            array_push($dados['nome'],$producoes->tsnome);
            array_push($dados['matricula'],$producoes->tsmatricula);
            array_push($dados['producao'],$producoes->vencimento);
            array_push($dados['vencimento'],$producoes->bivalorvencimento);
            array_push($dados['liquido'],$producoes->bivalorliquido);
            array_push($dados['dsr'],$dsr[$p]->vencimento);
            array_push($dados['ferias'],$ferias[$p]->vencimento);
            array_push($dados['vt'],$vt[$p]->vencimento);
            array_push($dados['va'],$va[$p]->vencimento);
            array_push($dados['13salario'],$salario13[$p]->vencimento);
            array_push($dados['seguro'],$seguro[$p]->desconto);
            array_push($dados['sindicato'],$sindicator[$p]->desconto);
            array_push($dados['inss'],$inss[$p]->desconto);
            array_push($dados['irrf'],$irrf[$p]->desconto);
            array_push($dados['inss_sobre_13'],$inss_sobre13[$p]->desconto);
           
        }
        //dd($adiantamento,$dados,$producao,$dsr,$ferias,$vt,$va,$salario13);
        $pdf = PDF::loadView('folhaAnalitica',compact('dados','adiantamento','vale','producao','folhas'));
        return $pdf->setPaper('a4','landscape')->stream('CALCULO DA FOLHA ANALITICA.pdf');
    }
}
