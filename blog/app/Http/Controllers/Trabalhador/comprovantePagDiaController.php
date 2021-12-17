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
        $depedente = new Dependente;
        $bolcartaoponto = new Bolcartaoponto;
        $lancamentorublica = new Lancamentorublica; 
        try {
            $bolcartaopontos = $bolcartaoponto->buscaListaRelatorioLancamentoBolcartao($dados,$mes);
            $trabalhadors = $trabalhador->buscaUnidadeTrabalhador($dados['trabalhador']);
            $depedentes = $depedente->buscaQuantidadeDepedente($dados['trabalhador'],'filho');
            $lancamentorublicas = $lancamentorublica->buscaListaRelatorioLancamentoRublica($dados,$mes);
            $empresas = $empresa->buscaUnidadeEmpresa($trabalhadors->empresa);
            $rublicas = $rublica->buscaUnidadeRublica('produção');
            if ($trabalhadors) {
                $empresas = $empresa->buscaUnidadeEmpresa($trabalhadors->empresa);
                $pdf = PDF::loadView('comprovantePagDia',compact('trabalhadors','empresas','rublicas','dados','lancamentorublicas','bolcartaopontos','depedentes'));
                return $pdf->setPaper('a4')->stream('RECIBO PAGAMENTO SALÁRIO.pdf');
            }
        } catch (\Exception $e) {
            $error = $e->getTrace();
            dd($error[0]['args'][4]['rublicas'],$error);
            
        }
    }
}
