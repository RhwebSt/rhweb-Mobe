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
    private $empresa,$lancamentotabela,$trabalhador;
    public function __construct()
    {
        $this->empresa = new Empresa;
        $this->lancamentotabela = new Lancamentotabela;
        $this->trabalhador = new Trabalhador;
    }
    public function fichaLancamentoTab($id)
    {
       
        try {
            $lancamentotabelas = $this->lancamentotabela->relatorioBoletimTabela($id);
       
            if (count($lancamentotabelas) === 0) {
                return redirect()->back()->withInput()->withErrors(['false'=>'Não foi porssivél gera relatório.']);
            }
            $empresa = $this->empresa->buscaUnidadeEmpresa($lancamentotabelas[0]->id);
            $dados = [];
            foreach ($lancamentotabelas as $key => $value) {
                array_push($dados,$value->trabalhador);
            }
            $trabalhadors = $this->trabalhador->relatorioBoletimTabela($dados);
            $pdf = PDF::loadView('relatorioBoletimTabela',compact('lancamentotabelas','empresa','trabalhadors'));
            return $pdf->setPaper('a4')->stream('boletim_n°'.$id.'.pdf');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['false'=>'Não foi possível gerar o relatório.']);
        }
    }
}
