<?php

namespace App\Http\Controllers\TabelaPreco;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\TabelaPreco;
use App\Tomador;
use App\Empresa;
use PDF;
class RelatorioController extends Controller
{
    private $tomador, $tabelapreco,$empresa;
    public function __construct()
    {
        $this->tomador = new Tomador;
        $this->tabelapreco = new TabelaPreco;
        $this->empresa = new Empresa;
    }
    public function relatorio($id)
    {
        
        $id = base64_decode($id);
            // $empresa = $empresa->buscaUnidadeEmpresa($user->empresa);
            // $tomadores = $tomador->buscaNomeTomadorTabelaPreco($id);
            // $tabelaprecos = $tabelapreco->listaUnidadeTomador($id); 
            $user = auth()->user();
            $empresas = $this->empresa->where('id',$user->empresa_id)->with('endereco')->first(); 
            $tomador = $this->tomador->where('id',$id)->with('tabelapreco')->get();
            if($tomador[0]->tabelapreco->count() == 0){
                return redirect()->back()->withInput()->withErrors(['tabelavazia'=>'Não possui nenhum cadastro na tabela de preço.']);
            }
            $pdf = PDF::loadView('relatorioTabpreco',compact('tomador','empresas'));
            return $pdf->setPaper('a4')->stream('RELATÓRIO DA TABELA PRECO.pdf');
            try {
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->withErrors(['false'=>'Não foi possível gerar o relatório.']);
        }
    }
    
}
