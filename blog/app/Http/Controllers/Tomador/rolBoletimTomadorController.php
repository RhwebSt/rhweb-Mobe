<?php

namespace App\Http\Controllers\Tomador;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Tomador;
use App\Lancamentorublica;
use App\Bolcartaoponto;
use App\TabelaPreco;
use PDF;
class rolBoletimTomadorController extends Controller
{
    public function rolBoletim($id,$inicio,$final)
    {
        $tomador = new Tomador;
        $tomadors = $tomador->tomadorBoletim($id);
        $lancamentorublica = new Lancamentorublica;
        $bolcartaoponto = new Bolcartaoponto;
        $tabelapreco = new TabelaPreco;
        $tabelaprecos = $tabelapreco->buscaTabelaTomador($id);
        $lancamentorublicas = $lancamentorublica->boletimTabela($id,$inicio,$final);
        $bolcartaopontos = $bolcartaoponto->boletimCartaoPonto($id,$inicio,$final);
        // dd($lancamentorublicas,$bolcartaopontos,$tabelaprecos,$tomadors);
        $pdf = PDF::loadView('rolBoletimTomador',compact('inicio','final','tomadors','lancamentorublicas','bolcartaopontos','tabelaprecos'));
        return $pdf->setPaper('a4')->stream('BOLETIM TOMADOR.pdf');
    }
}
