<?php

namespace App\Http\Controllers\fichaEpi;

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
        try {
            $trabalhadors = $trabalhador->buscaUnidadeTrabalhador($id);
            if ($trabalhadors) {
                $empresas = $empresa->first($trabalhadors->empresa);
                $pdf = PDF::loadView('fichaEpi',compact('trabalhadors','empresas'));
                return $pdf->setPaper('a4')->stream('Ficha '.$trabalhadors->tsnome.'.pdf');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->withErrors(['false'=>'Não foi possível gerar a ficha de EPI.']);
        }
    }
}
