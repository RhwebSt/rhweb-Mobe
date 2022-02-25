<?php

namespace App\Http\Controllers\Rublica;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Rublica;
use PDF;
class relatorioRublicaController extends Controller
{
    public function relatorio()
    {
        $rubrica = new Rublica;
        try {
            $rubricas = $rubrica->listaGeral();
            if (count($rubricas) < 1) {
                return redirect()->back()->withInput()->withErrors(['false'=>'Não foi existe rubricas cadastradas.']);
            }
            $pdf = PDF::loadView('relatorioRubricas',compact('rubricas'));
            return $pdf->setPaper('a4')->stream('RELATÓRIO DE RUBRICAS.pdf');
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->withErrors(['false'=>'Não foi porssivél gera o relatório.']);
        }
    }
}
