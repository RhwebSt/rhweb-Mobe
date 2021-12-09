<?php

namespace App\Http\Controllers\Trabalhador;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Trabalhador;
use App\Empresa;
use PDF;
class fichaEpiTrabController extends Controller
{
    public function ficha($id)
    {
        $trabalhador = new Trabalhador;
        $empresa = new Empresa;
        $trabalhadors = $trabalhador->buscaUnidadeTrabalhador($id);
        if ($trabalhadors) {
            $empresas = $empresa->buscaUnidadeEmpresa($trabalhadors->empresa);
            $pdf = PDF::loadView('fichaEpi',compact('trabalhadors','empresas'));
            return $pdf->setPaper('a4')->stream('Ficha '.$trabalhadors->tsnome.'.pdf');
        }
    }
}
