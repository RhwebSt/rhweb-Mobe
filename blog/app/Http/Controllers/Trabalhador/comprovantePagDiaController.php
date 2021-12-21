<?php

namespace App\Http\Controllers\Trabalhador;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Trabalhador;
use App\Empresa;
use App\Rublica;
use App\Lancamentorublica;
use App\Bolcartaoponto;
use App\Dependente;
use App\TabelaPreco;
use PDF;
class comprovantePagDiaController extends Controller
{
    public function ComprovantePagDia(Request $request)
    {
        $dados = $request->all();
        $tomador = [];
        $trabalhador = new Trabalhador;
        $empresa = new Empresa;
        $rublica = new Rublica;
        $depedente = new Dependente;
        $bolcartaoponto = new Bolcartaoponto;
        $lancamentorublica = new Lancamentorublica;   
        $tabelapreco = new TabelaPreco;
        $bolcartaopontos = $bolcartaoponto->buscaListaRelatorioLancamentoBolcartao($dados);
       
        $tabelaprecos = $tabelapreco->buscaTabelaTomador($bolcartaopontos[0]->tomador); 
        $trabalhadors = $trabalhador->buscaUnidadeTrabalhador($dados['trabalhador']);
        $depedentes = $depedente->buscaQuantidadeDepedente($dados['trabalhador']);
        $lancamentorublicas = $lancamentorublica->buscaListaRelatorioLancamentoRublica($dados);
        $empresas = $empresa->buscaUnidadeEmpresa($trabalhadors->empresa);
        $rublicas = $rublica->buscaListaRublica(0);
        if ($trabalhadors) {
            $empresas = $empresa->buscaUnidadeEmpresa($trabalhadors->empresa);
            $pdf = PDF::loadView('comprovantePagDia',compact('trabalhadors','empresas','rublicas','dados','lancamentorublicas','bolcartaopontos','depedentes','tabelaprecos'));
            return $pdf->setPaper('a4')->stream('RECIBO PAGAMENTO SALÁRIO.pdf');
        }
        try {
            
        } catch (\Exception $e) {
            // $error = $e->getTrace();
            // dd($error[0]['args'][4]['rublicas'],$error); 
            $url = [
                'trabalhador'
            ];
            return redirect()->route('error.index',$url);
        }
    }
}
