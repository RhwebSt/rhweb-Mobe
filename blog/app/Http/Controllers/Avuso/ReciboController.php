<?php

namespace App\Http\Controllers\Avuso;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PDF;
use App\Avuso;
use App\AvusoDescricao;
class ReciboController extends Controller
{
    public function relatorio($id,$inicio,$final)
    {
        $id = base64_decode($id);
        $inicio = base64_decode($inicio);
        $final = base64_decode($final);
        // dd($id,$inicio);
        // $trabalhador = base64_decode($trabalhador);
        $avuso = new Avuso;
        $descricao = new AvusoDescricao;
        $avusos = $avuso->buscaTrabalhador($id,$inicio,$final);
        $descricoes = $descricao->listaRecibo($id);
        // dd($avusos);
        $pdf = PDF::loadView('comprovanteRecibAvulso',compact('avusos','descricoes'));
        return $pdf->setPaper('a4','potrait')->stream('Recibo Avulso.pdf');
    }
}
