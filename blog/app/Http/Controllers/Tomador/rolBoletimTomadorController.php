<?php

namespace App\Http\Controllers\Tomador;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Tomador;
use App\Lancamentorublica;
use App\Bolcartaoponto;
use App\TabelaPreco;
use App\Empresa;
use App\Lancamentotabela;
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
        $lancamentotabela = new Lancamentotabela;
        $user = auth()->user();
        $b = [];
        $empresa = $empresa->buscaUnidadeEmpresa($user->empresa);
        
            $tabelaprecos = $tabelapreco->listaUnidadeTomador($id);
            if (count($tabelaprecos) < 1) {
                return redirect()->back()->withInput()->withErrors(['tabelavazia'=>'Não possui nenhum cadastro na tabela de preço.']);
            }
            $boletins = $lancamentotabela->boletimTomador($id,$inicio,$final);
            foreach ($boletins as $key => $boletim) {
                array_push($b,$boletim->id);
            }
            $bolcartaopontos = $bolcartaoponto->CartaoPonto($b);
            $lancamentorublicas = $lancamentorublica->boletimTabela($b);
            // dd($lancamentorublicas);
            // $bolcartaopontos = $bolcartaoponto->boletimCartaoPonto($id,$inicio,$final); 
            if (count($lancamentorublicas) === 0 && count($bolcartaopontos) === 0) {
                return redirect()->back()->withInput()->withErrors(['dadosvazia'=>'Não possui nenhum dado cadastrado.']);
            }
            
            $pdf = PDF::loadView('rolBoletimTomador',compact('empresa','inicio','final','tomadors','lancamentorublicas','bolcartaopontos','tabelaprecos','boletins'));
            return $pdf->setPaper('a4')->stream('BOLETIM TOMADOR.pdf');
            try {
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->withErrors(['false'=>'Não foi possível gerar o relatório.']);
        }
    }
}
