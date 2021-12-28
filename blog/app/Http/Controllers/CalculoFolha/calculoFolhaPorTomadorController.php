<?php

namespace App\Http\Controllers\CalculoFolha;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Trabalhador;
use App\Empresa;
use App\Rublica;
use App\Lancamentorublica;
use App\Bolcartaoponto;
use App\Dependente;
use App\TabelaPreco;
use App\Inss;
use App\IncideFolhar;
use App\CartaoPonto;
use App\Irrf;
use PDF;
class calculoFolhaPorTomadorController extends Controller
{
    public function calculoFolhaPorTomador($trabalhador = null,$tomador = null,$datainicio,$datafinal)
    {
        $ano = explode('-',$datafinal);
        $funcionario = [];
        $trabalhado = new Trabalhador;
        $empresa = new Empresa;
        $rublica = new Rublica;
        $depedente = new Dependente;
        $bolcartaoponto = new Bolcartaoponto;
        $lancamentorublica = new Lancamentorublica;   
        $tabelapreco = new TabelaPreco;
        $inss = new Inss;
        $irrf = new Irrf;
        $indecefolha = new IncideFolhar;
        $cartaoponto = new CartaoPonto;
        $bolcartaopontos = $bolcartaoponto->buscaListaLancamentoBolcartao($tomador,$datainicio,$datafinal);
        foreach ($bolcartaopontos as $key => $trabalhador) {
            array_push($funcionario,$trabalhador->trabalhador);
        }
        $trabalhados = $trabalhado->listaTrabalhadorInt($funcionario);
        // dd($trabalhados,$bolcartaopontos);
        $pdf = PDF::loadView('comprovantePagDiatomador',compact('trabalhados'));
        return $pdf->setPaper('a4')->stream('RECIBO PAGAMENTO SALÁRIO.pdf');
        
    }
}
