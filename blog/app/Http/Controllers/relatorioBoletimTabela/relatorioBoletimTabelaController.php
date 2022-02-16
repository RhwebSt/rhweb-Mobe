<?php

namespace App\Http\Controllers\relatorioBoletimTabela;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PDF;
use App\Lancamentotabela;
use App\Trabalhador;
use App\Empresa;
class relatorioBoletimTabelaController extends Controller
{
    private $empresa;
    public function __construct()
    {
        $this->empresa = new Empresa;
    }
    public function fichaLancamentoTab($id)
    {
        $lancamentotabela = new Lancamentotabela;
        $trabalhador = new Trabalhador;
        $lancamentotabelas = $lancamentotabela->relatorioBoletimTabela($id);
       
        if (count($lancamentotabelas) === 0) {
            return redirect()->back()->withInput()->withErrors(['false'=>'Não foi porssivél gera relatório.']);
        }
        $empresa = $this->empresa->buscaUnidadeEmpresa($lancamentotabelas[0]->id);
        $dados = [];
        foreach ($lancamentotabelas as $key => $value) {
            array_push($dados,$value->trabalhador);
        }
        $trabalhadors = $trabalhador->relatorioBoletimTabela($dados);
        $pdf = PDF::loadView('relatorioBoletimTabela',compact('lancamentotabelas','empresa','trabalhadors'));
        return $pdf->setPaper('a4')->stream('boletim_n°'.$id.'.pdf');
        try {
          
           
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['false'=>'Não foi porssivél gera o relatório.']);
        }
    }
}
