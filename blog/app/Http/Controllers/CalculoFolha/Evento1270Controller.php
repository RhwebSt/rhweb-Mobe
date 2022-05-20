<?php

namespace App\Http\Controllers\CalculoFolha;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\BaseCalculo;
use PDF;
class Evento1270Controller extends Controller
{
    private $basecalculo;
    public function __construct()
    {
        $this->basecalculo = new BaseCalculo;
    }
    public function index($tomador,$folhar)
    {
        $tomador = base64_decode($tomador);
        $folhar = base64_decode($folhar);
        $relatorio = $this->basecalculo->where([
            ['tomador_id',$tomador],
            ['folhar_id',$folhar]
        ])
        ->with(['tomador:id,tsnome,tsmatricula,tscnpj,tstelefone','tomador.endereco','valorcalculo:base_calculo_id,vivencimento,vireferencia,videscinto,vicodigo,vsdescricao','folhar.empresa:id,esnome,escnpj,estelefone,esfoto','folhar.empresa.endereco'])
        ->get();
        // dd($relatorio);
        $pdf = PDF::loadView('relatorio1270',compact('relatorio'));
        return $pdf->setPaper('a4')->stream('Relatório1270.pdf');
    }
}
