<?php

namespace App\Http\Controllers\FolhaAnalitica;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Folhar;
use App\ValorCalculo;
use App\BaseCalculo;
use App\RelacaoDia;
use App\Empresa;
use PDF;
class FolhaAnaliticaController extends Controller
{
    public function calculoFolhaAnalitica($id)
    {
        $valorcalculo = new ValorCalculo;
        $folhar = new Folhar;
        $folhas = $folhar->buscaFolhaAnalitica($id);
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
            'adiantamento'=>[],
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
        // $irrf_codigo = [2003];
        // $irrf = $valorcalculo->calculoFolhaAnaliticaIrrf($id,$irrf_codigo);
        // dd($irrf);
        $inss_codigo = [2001];
        $inss = $valorcalculo->calculoFolhaAnaliticaIrrf($id,$inss_codigo);
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
            if (isset($adiantamento[$p]->desconto)) {
                array_push($dados['adiantamento'],$adiantamento[$p]->desconto);
            }
        }
        // dd($adiantamento,$dados,$producao,$dsr,$ferias,$vt,$va,$salario13);
        $pdf = PDF::loadView('folhaAnalitica',compact('dados','folhas'));
        return $pdf->setPaper('a4','landscape')->stream('CALCULO DA FOLHA ANALITICA.pdf');
    }
}
