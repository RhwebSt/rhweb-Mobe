<?php

namespace App\Http\Controllers\Tomador;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Tomador;
use App\Empresa;
use PDF;
class relatorioTomadorController extends Controller
{
    public function relatorioGeral()
    {
        $tomador = new Tomador;
        $empresa = new Empresa;
        $user = auth()->user();
        $tomadores = $tomador->relatorioGeral($user->empresa);
        $empresas = $empresa->buscaUnidadeEmpresa($user->empresa);
        $pdf = PDF::loadView('rolTomador',compact('empresas','tomadores'));
        return $pdf->setPaper('a4')->stream('RELATÓRIO DA TABELA PRECO.pdf');
    }
}
