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
        $user = auth()->user();
        $trabalhadors = $trabalhador->roltrabalhado();  
        $empresas = $empresa->buscaUnidadeEmpresa($user->empresa);
       
        $pdf = PDF::loadView('pdf',compact('trabalhadors','empresas'));
        return $pdf->setPaper('a4')->stream('relatoria.pdf');
    }
}
