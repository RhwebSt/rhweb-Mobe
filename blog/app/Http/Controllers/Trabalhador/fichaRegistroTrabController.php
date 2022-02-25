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
        $id = base64_decode($id);
        $trabalhador = new Trabalhador;
        $empresa = new Empresa;
        $depedente = new Dependente;
        try {
            $trabalhadors = $trabalhador->buscaUnidadeTrabalhador($id);
            if ($trabalhadors) {
                $empresas = $empresa->buscaUnidadeEmpresa($trabalhadors->empresa); 
                $depedentes = $depedente->buscaListaDepedente($id); 
                $pdf = PDF::loadView('fichaRegistroTrab',compact('trabalhadors','empresas','depedentes'));
                return $pdf->setPaper('a4')->stream('ficha_'.$trabalhadors->tsnome.'.pdf');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->withErrors(['false'=>'Não foi porssivél gera a ficha de registro do trabalhador.']);
        }
    }
}
