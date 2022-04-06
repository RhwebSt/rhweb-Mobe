<?php

namespace App\Http\Controllers\Administrador\Rublica;

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
                return redirect()->back()->withInput()->withErrors(['false'=>'Não existe rúbricas cadastradas.']);
            }
            $pdf = PDF::loadView('relatorioRubricas',compact('rubricas'));
            return $pdf->setPaper('a4')->stream('RELATÓRIO DE RUBRICAS.pdf');
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->withErrors(['false'=>'Não foi possível gerar o relatório.']);
        }
    }
}
