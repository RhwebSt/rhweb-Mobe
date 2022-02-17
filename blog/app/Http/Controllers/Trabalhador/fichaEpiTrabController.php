<?php

namespace App\Http\Controllers\Trabalhador;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Trabalhador;
use App\Empresa;
use App\Epi;
use PDF;
class fichaEpiTrabController extends Controller
{
    private $epi;
    public function __construct()
    {
        $this->epi = new Epi;
    }
    public function ficha($id)
    {
        $epi = $this->epi->buscalista($id);
        $id = base64_decode($id); 
        $trabalhador = new Trabalhador;
        $empresa = new Empresa;
        $trabalhadors = $trabalhador->buscaUnidadeTrabalhador($id);
        if ($trabalhadors) {
            $empresas = $empresa->buscaUnidadeEmpresa($trabalhadors->empresa);
            $pdf = PDF::loadView('fichaEpi',compact('trabalhadors','epi','empresas'));
            return $pdf->setPaper('a4')->stream('Ficha '.$trabalhadors->tsnome.'.pdf');
        }
    }
}
