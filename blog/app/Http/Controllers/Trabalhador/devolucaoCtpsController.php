<?php

namespace App\Http\Controllers\Trabalhador;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Trabalhador;
use App\Empresa;
use PDF;
class devolucaoCtpsController extends Controller
{
    public function devolucaoctps($id)
    {
        $id = base64_decode($id);
        $trabalhador = new Trabalhador;
        $empresa = new Empresa;
        try {
            $trabalhadors = $trabalhador->buscaUnidadeTrabalhador($id);
            if ($trabalhadors) {
                $empresas = $empresa->buscaUnidadeEmpresa($trabalhadors->empresa);
                $pdf = PDF::loadView('devolucaoCtps',compact('trabalhadors','empresas'));
                return $pdf->setPaper('a4')->stream('Devolução Ctps do trabalhador '.$trabalhadors->tsnome.'.pdf');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->withErrors(['false'=>'Não foi porssivél gera o relatório.']);
        }
    }
}
