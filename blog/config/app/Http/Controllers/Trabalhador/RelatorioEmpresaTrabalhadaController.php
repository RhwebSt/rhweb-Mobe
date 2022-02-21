<?php

namespace App\Http\Controllers\Trabalhador;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Trabalhador;
use App\Empresa;
use PDF;
class RelatorioEmpresaTrabalhadaController extends Controller
{
    public function relatorioempresatrabalhada(Request $request)
    {
        $dados = $request->all();
        $trabalhador = new Trabalhador;
        $empresa = new Empresa;
        $trabalhadors = $trabalhador->buscaUnidadeTrabalhador($dados['trabalhador']);
        if ($trabalhadors) {
            $empresas = $empresa->buscaUnidadeEmpresa($trabalhadors->empresa);
            $pdf = PDF::loadView('relatorioEmpresasTrab',compact('trabalhadors','empresas'));
            return $pdf->setPaper('a4')->stream('Relatório de empresas trabalhada do trabalhador '.$trabalhadors->tsnome.'.pdf');
        }
    }
}
