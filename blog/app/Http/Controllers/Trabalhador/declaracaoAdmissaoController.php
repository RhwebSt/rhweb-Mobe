<?php

namespace App\Http\Controllers\Trabalhador;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Trabalhador;
use App\Empresa;
use PDF;
class declaracaoAdmissaoController extends Controller
{
    public function declarassaoadminssao($id)
    {
        $id = base64_decode($id);
        $trabalhador = new Trabalhador;
        $empresa = new Empresa;
        $trabalhadors = $trabalhador->buscaUnidadeTrabalhador($id);
        if ($trabalhadors) {
            $empresas = $empresa->buscaUnidadeEmpresa($trabalhadors->empresa);
            $pdf = PDF::loadView('declaracaoAdmissao',compact('trabalhadors','empresas'));
            return $pdf->setPaper('a4')->stream('Cracha '.$trabalhadors->tsnome.'.pdf');
        }
    }
   
}
