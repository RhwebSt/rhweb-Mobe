<?php

namespace App\Http\Controllers\Trabalhador;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Trabalhador;
use App\Empresa;
use PDF;
class declaracaoAfastamentoController extends Controller
{
    public function declarassaoafastamento($id)
    {
        $trabalhador = new Trabalhador;
        $empresa = new Empresa;
        $trabalhadors = $trabalhador->buscaUnidadeTrabalhador($id);
        if ($trabalhadors) {
            $empresas = $empresa->buscaUnidadeEmpresa($trabalhadors->empresa);
            $pdf = PDF::loadView('declaracaoAfastamento',compact('trabalhadors','empresas'));
            return $pdf->setPaper('a4')->stream('Cracha '.$trabalhadors->tsnome.'.pdf');
        }
    }
}
