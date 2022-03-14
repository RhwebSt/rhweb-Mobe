<?php

namespace App\Http\Controllers\TabelaPreco;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\TabelaPreco;
use App\Tomador;
use App\Empresa;
use PDF;
class RelatorioController extends Controller
{
    public function relatorio($id)
    {
        $tabelapreco = new TabelaPreco;
        $tomador = new Tomador;
        try {
            $tomadores = $tomador->buscaNomeTomadorTabelaPreco($id);
            $tabelaprecos = $tabelapreco->listaUnidadeTomador($id);
        
            if(!isset($tabelaprecos[0]->id)){
                return redirect()->back()->withInput()->withErrors(['tabelavazia'=>'Não possui nenhum cadastro na tabela de preço.']);
            }
            $pdf = PDF::loadView('relatorioTabpreco',compact('tabelaprecos','tomadores'));
            return $pdf->setPaper('a4')->stream('RELATÓRIO DA TABELA PRECO.pdf');
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->withErrors(['false'=>'Não foi possível gerar o relatório.']);
        }
    }
    
}
