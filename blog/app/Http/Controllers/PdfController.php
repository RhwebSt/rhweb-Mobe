<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Trabalhador;
use PDF;
class PdfController extends Controller
{
    public function rolnome()
    {
        $trabalhador = new Trabalhador;
        $trabalhadors = $trabalhador->roltrabalhado();
        $pdf = PDF::loadView('pdf',compact('trabalhadors'));
        return $pdf->setPaper('a4')->stream('relatorio.pdf');
    }
}
