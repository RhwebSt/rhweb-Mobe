<?php

namespace App\Http\Controllers\Trabalhador;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Trabalhador;
use App\Empresa;
use App\Rublica;
use App\Lancamentorublica;
use App\Bolcartaoponto;
use PDF;
class comprovantePagDiaController extends Controller
{
    public function ComprovantePagDia(Request $request)
    {
        $dados = $request->all();
        $mes = explode('-',$dados['ano_inicial']);
        $tomador = [];
        $trabalhador = new Trabalhador;
        $empresa = new Empresa;
        $rublica = new Rublica;
        $bolcartaoponto = new Bolcartaoponto;
        $lancamentorublica = new Lancamentorublica;
        $bolcartaopontos = $bolcartaoponto->buscaListaRelatorioLancamentoBolcartao($dados,$mes);
        $trabalhadors = $trabalhador->buscaUnidadeTrabalhador($dados['trabalhador']);
        $lancamentorublicas = $lancamentorublica->buscaListaRelatorioLancamentoRublica($dados,$mes);

        $empresas = $empresa->buscaUnidadeEmpresa($trabalhadors->empresa);
        $rublicas = $rublica->buscaUnidadeRublica('produção');
        if ($trabalhadors) {
            $empresas = $empresa->buscaUnidadeEmpresa($trabalhadors->empresa);
            $pdf = PDF::loadView('comprovantePagDia',compact('trabalhadors','empresas','rublicas','dados','lancamentorublicas','bolcartaopontos'));
            return $pdf->setPaper('a4')->stream('RECIBO PAGAMENTO SALÁRIO.pdf');
        }
        // try {
           
        // } catch (\Throwable $th) {
        //     echo('Não foi porssivél gerar o Recibo de pagamento de salálrio.');
        // }
    }
}
