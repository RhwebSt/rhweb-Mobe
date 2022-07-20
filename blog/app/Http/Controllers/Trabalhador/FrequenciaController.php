<?php

namespace App\Http\Controllers\Trabalhador;

use App\Http\Controllers\Controller;
use App\Trabalhador;
use Illuminate\Http\Request;
use PDF;
class FrequenciaController extends Controller
{
    private $trabalhador;
    public function __construct()
    {
        $this->trabalhador = new Trabalhador;
    }
    public function index($id)
    {
        $id = base64_decode($id);
        $trabalhador = $this->trabalhador->where('id',$id)
        ->with(['empresa:id,esnome,esfoto,escnpj,estelefone','empresa.endereco'])
        ->first();
        // dd($trabalhador);
        $pdf = PDF::loadView('controleFrequencia',compact('trabalhador'));
        return $pdf->setPaper('a4')->stream('Frequência.pdf');
    }
}
