<?php

namespace App\Http\Controllers\Trabalhador;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Trabalhador;
use App\Empresa;
use App\Dependente;
use PDF;
class fichaRegistroTrabController extends Controller
{
    public function fichaRegistroTrabalhador($id)
    {
        $trabalhador = new Trabalhador;
        $empresa = new Empresa;
        $depedente = new Dependente;
        $trabalhadors = $trabalhador->buscaUnidadeTrabalhador($id);
        if ($trabalhadors) {
            $empresas = $empresa->buscaUnidadeEmpresa($trabalhadors->empresa); 
            $depedentes = $depedente->buscaListaDepedente($trabalhadors->id);
            $pdf = PDF::loadView('fichaRegistroTrab',compact('trabalhadors','empresas','depedentes'));
            return $pdf->setPaper('a4')->stream('ficha_'.$trabalhadors->tsnome.'.pdf');
        }
    }
}
