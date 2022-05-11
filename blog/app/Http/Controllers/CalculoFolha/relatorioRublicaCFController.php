<?php

namespace App\Http\Controllers\CalculoFolha;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Folhar;
use PDF;
class relatorioRublicaCFController extends Controller
{
    private $folhar;
    public function __construct()
    {
        $this->folhar = new Folhar;
    }
    public function imprimir(Request $request)
    {
        $dados = $request->all();
        try {
            $folhas = $this->folhar->buscaListaRublica($dados);
            $pdf = PDF::loadView('relatorioRubricaCF',compact('folhas'));
            return $pdf->setPaper('a4')->stream('RELATÓRIO RUBLICA CF.pdf');
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->withErrors(['false'=>'Não foi possível gerar o relatório.']);
        }
       
    }
}
