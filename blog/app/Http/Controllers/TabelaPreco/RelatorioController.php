<?php

namespace App\Http\Controllers\TabelaPreco;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\TabelaPreco;
use App\Tomador;
use PDF;
class RelatorioController extends Controller
{
    public function relatorio($id)
    {
        $tabelapreco = new TabelaPreco;
        $tomador = new Tomador;
        $tomadores = $tomador->buscaNomeTomadorTabelaPreco($id);
        $tabelaprecos = $tabelapreco->buscaTabelaTomador($id);
        $pdf = PDF::loadView('relatorioTabpreco',compact('tabelaprecos','tomadores'));
        return $pdf->setPaper('a4')->stream('RELATÓRIO DA TABELA PRECO.pdf');
    }
}
