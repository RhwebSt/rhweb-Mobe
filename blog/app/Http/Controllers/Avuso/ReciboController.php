<?php

namespace App\Http\Controllers\Avuso;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PDF;
use App\Avuso;
use App\AvusoDescricao;
class ReciboController extends Controller
{
    public function relatorio($id,$trabalhador)
    {
        $id = base64_decode($id);
        $trabalhador = base64_decode($trabalhador);
        $avuso = new Avuso;
        $descricao = new AvusoDescricao;
        $avusos = $avuso->buscaTrabalhador($id,$trabalhador);
        $descricoes = $descricao->listaRecibo($id);
        $pdf = PDF::loadView('comprovanteRecibAvulso',compact('avusos','descricoes'));
        return $pdf->setPaper('a4','potrait')->stream('Recibo Avulso.pdf');
    }
}
