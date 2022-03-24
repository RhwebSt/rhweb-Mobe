<?php

namespace App\Http\Controllers\Tomador;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Tomador;
use App\Lancamentorublica;
use App\Bolcartaoponto;
use App\TabelaPreco;
use App\Empresa;
use PDF;
class rolBoletimTomadorController extends Controller
{

    public function rolBoletim($id,$inicio,$final)
    {
        $empresa = new Empresa;
        $tomador = new Tomador;
        $tomadors = $tomador->tomadorBoletim($id);
        $lancamentorublica = new Lancamentorublica; 
        $bolcartaoponto = new Bolcartaoponto;
        $tabelapreco = new TabelaPreco;
        $user = auth()->user();
        $empresa = $empresa->buscaUnidadeEmpresa($user->empresa);
        try {
            $tabelaprecos = $tabelapreco->listaUnidadeTomador($id);
            if (count($tabelaprecos) < 1) {
                return redirect()->back()->withInput()->withErrors(['tabelavazia'=>'Não possui nenhum cadastro na tabela de preço.']);
            }
            $lancamentorublicas = $lancamentorublica->boletimTabela($id,$inicio,$final);
            $bolcartaopontos = $bolcartaoponto->boletimCartaoPonto($id,$inicio,$final);
            if (count($lancamentorublicas) === 0 && count($bolcartaopontos) === 0) {
                return redirect()->back()->withInput()->withErrors(['dadosvazia'=>'Não possui nenhum dado cadastrado.']);
            }
            
            $pdf = PDF::loadView('rolBoletimTomador',compact('empresa','inicio','final','tomadors','lancamentorublicas','bolcartaopontos','tabelaprecos'));
            return $pdf->setPaper('a4')->stream('BOLETIM TOMADOR.pdf');
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->withErrors(['false'=>'Não foi possível gerar o relatório.']);
        }
    }
}
