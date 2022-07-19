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
        $trabalhadors = $this->trabalhador->where('id',$id)
        ->with(['empresa:id,esnome,esfoto,escnpj','empresa.endereco'])
        ->first();
        $pdf = PDF::loadView('controleFrequencia',compact('trabalhadors'));
        return $pdf->setPaper('a4')->stream('Frequência.pdf');
    }
}
