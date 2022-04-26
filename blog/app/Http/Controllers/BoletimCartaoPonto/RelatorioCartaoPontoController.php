<?php

namespace App\Http\Controllers\BoletimCartaoPonto;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Lancamentotabela;
use App\Bolcartaoponto;
use App\Trabalhador;
use App\TabelaPreco;
use App\Empresa;
use App\Tomador;
use PDF;
class RelatorioCartaoPontoController extends Controller
{
    private $lancamento,$bolcartaoponto,$trabalhador,$tabelapreco,$empresa,$tomador;
    public function __construct()
    {   $this->tomador = new Tomador;
        $this->lancamento = new Lancamentotabela;
        $this->trabalhador = new Trabalhador;
        $this->tabelapreco = new TabelaPreco;
        $this->empresa = new Empresa; 
        $this->bolcartaoponto = new Bolcartaoponto;
    }
    public function relatorioCartaoPonto($id,$domingo = null ,$sabado = null,$diasuteis,$data,$boletim,$tomador) 
    {
        $id =  base64_decode($id);
        $domingo = base64_decode($domingo);
        $sabado = base64_decode($sabado);
        $diasuteis = base64_decode($diasuteis);
        $data = base64_decode($data);
        $boletim = base64_decode($boletim);
        $tomador = base64_decode($tomador);
        $ano = explode('-',$data);
        $user = auth()->user();
        $lancamentotabelas = $this->lancamento->where('id',$id)
        ->with(['bolcartaoponto','tomador'])->get();
        $bolcartaoponto = $this->bolcartaoponto->where('lancamentotabela_id',$id)
        ->with('trabalhador')->get();
        // dd($lancamentotabelas,$bolcartaoponto,$id);
            // $tabelaprecos = $this->tabelapreco->buscaTabelaTomador($tomador,$ano[0],null,'asc'); 
            $empresas = $this->empresa->where('id',$user->empresa_id)->with('endereco')->first(); 
            
            $tomador = $this->tomador->where('id',$tomador)->with('tabelapreco')->first();
           
            if ($tomador->tabelapreco->count() == 0) {
                return redirect()->back()->withInput()->withErrors(['false'=>'Não foi encontrada a tabela de preço deste tomador.']);
            }
            
            // $lancamentotabelas = $this->lancamentotabela->relatoriocartaoponto($boletim);
           
            // $empresa = $this->empresa->buscaUnidadeEmpresa($lancamentotabelas[0]->empresa); 
            
            // $dados = [];
            // foreach ($lancamentotabelas as $key => $value) { 
            //     array_push($dados,$value->trabalhador);
            // }
            // $trabalhadors = $this->trabalhador->relatorioBoletimTabela($dados);
            $pdf = PDF::loadView('relatorioCartaoPonto',compact('lancamentotabelas','empresa','bolcartaoponto'));
            return $pdf->setPaper('a4','landscape')->stream('Relatório.pdf');
            try {
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->withErrors(['false'=>'Não foi possível gerar o relatório.']);
        }
    }
}
