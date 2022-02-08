<?php

namespace App\Http\Controllers\Avuso;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PDF;
use App\Avuso;
use App\AvusoDescricao;
class ReceboTrabalhadorController extends Controller
{
    public function relatorio(Request $request)
    {
        $dados = $request->all();
        $request->validate([
            'trabalhador01' => 'required|max:100|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôõûùúüÿñæœ 0-9_\-().]*$/',
            'ano_inicial1'=>'required|max:10|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÓÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôóõûùúüÿñæœ 0-9_\-().]*$/',
            'ano_final1'=>'required|max:10|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÓÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôóõûùúüÿñæœ 0-9_\-().]*$/',
        ]);
        $avuso = new Avuso;
        $descricao = new AvusoDescricao;
        $avusos = $avuso->buscaTrabalhador(null,$dados['trabalhador01'],$dados['ano_inicial1'],$dados['ano_final1']);
        $listaavuso = $avuso->buscaTrabalhadorRecibo($dados['trabalhador01'],$dados['ano_inicial1'],$dados['ano_final1']);
        $pdf = PDF::loadView('rolReciboAvulso',compact('avusos','listaavuso'));
        return $pdf->setPaper('a4','potrait')->stream('Recibo Avulso.pdf');
    }
}
