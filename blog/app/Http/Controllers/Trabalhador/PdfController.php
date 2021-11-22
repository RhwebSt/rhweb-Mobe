<?php

namespace App\Http\Controllers\Trabalhador;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Trabalhador;
use App\Empresa;
use PDF;
class PdfController extends Controller
{
    public function rolnome()
    {
        $trabalhador = new Trabalhador;
        $empresa = new Empresa;
        $empresas = '';
        $trabalhadors = $trabalhador->roltrabalhado();
        if (isset($trabalhadors[0]->empresa)) {
            $empresas = $empresa->first($trabalhadors[0]->empresa);
        }
        $pdf = PDF::loadView('pdf',compact('trabalhadors','empresas'));
        return $pdf->setPaper('a4')->stream('relatoria.pdf');
    }
}
