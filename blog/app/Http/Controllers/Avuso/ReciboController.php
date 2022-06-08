<?php

namespace App\Http\Controllers\Avuso;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PDF;
use App\Avuso;
use App\AvusoDescricao;
class ReciboController extends Controller
{
    private $avuso,$descricao;
    public function __construct()
    {
        $this->avuso = new Avuso;
        $this->descricao = new AvusoDescricao; 
    }
    public function relatorio($id,$inicio,$final)
    {
        $id = base64_decode($id);
        $inicio = base64_decode($inicio);
        $final = base64_decode($final);
       try {
        $avusos = $this->avuso->buscaTrabalhador($id,$inicio,$final);
        $descricoes = $this->descricao->listaRecibo($id);
        $pdf = PDF::loadView('comprovanteRecibAvulso',compact('avusos','descricoes'));
        return $pdf->setPaper('a4','potrait')->stream('Recibo Avulso.pdf');
       } catch (\Throwable $th) {
        return redirect()->back()->withInput()->withErrors(['false'=>'Não foi possível gerar o relatório.']);
       }
       
    }
}
