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
        $id = base64_decode($id);
        $trabalhador = new Trabalhador;
        $empresa = new Empresa;
        try {
            $trabalhadors = $trabalhador->buscaUnidadeTrabalhador($id);
            if ($trabalhadors) {
                $empresas = $empresa->buscaUnidadeEmpresa($trabalhadors->empresa);
                $pdf = PDF::loadView('declaracaoAfastamento',compact('trabalhadors','empresas'));
                return $pdf->setPaper('a4')->stream('Declaração de afastamento '.$trabalhadors->tsnome.'.pdf');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->withErrors(['false'=>'Não foi possível gerar o relatório.']);
        }
    }
}
