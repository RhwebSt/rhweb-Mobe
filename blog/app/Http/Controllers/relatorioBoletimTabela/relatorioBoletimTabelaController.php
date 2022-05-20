<?php

namespace App\Http\Controllers\relatorioBoletimTabela;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
       $id = base64_decode($id);
       $user = auth()->user();
    //    $empresas = $this->empresa->where('id',$user->empresa_id)->with('endereco')->first(); 
       $lancamentotabelas = $this->lancamentotabela->where('id',$id)->with(['lancamentorublica','tomador','empresa:id,esnome,escnpj,estelefone,esfoto','empresa.endereco'])->first(); 
       
       $trabalhadores = DB::table('trabalhadors')
       ->join('lancamentorublicas', 'trabalhadors.id', '=', 'lancamentorublicas.trabalhador_id')
       ->select('trabalhadors.tsnome','trabalhadors.id','trabalhadors.tsmatricula')
       ->where('lancamentorublicas.lancamentotabela_id', $id)
       ->distinct()
       ->get();
            // $lancamentotabelas = $this->lancamentotabela->relatorioBoletimTabela($id);

       
        //     if (count($lancamentotabelas) === 0) {
        //         return redirect()->back()->withInput()->withErrors(['false'=>'Não foi porssivél gera relatório.']);
        //     }
        //     $empresa = $this->empresa->buscaUnidadeEmpresa($lancamentotabelas[0]->id);
        //     $dados = [];
        //     foreach ($lancamentotabelas as $key => $value) {
        //         array_push($dados,$value->trabalhador);
        //     }
        //     $trabalhadors = $this->trabalhador->relatorioBoletimTabela($dados);
            $pdf = PDF::loadView('relatorioBoletimTabela',compact('lancamentotabelas','trabalhadores'));
            return $pdf->setPaper('a4')->stream('boletim_n°'.$id.'.pdf');
        //     try {
        // } catch (\Exception $e) {
        //     return redirect()->back()->withInput()->withErrors(['false'=>'Não foi possível gerar o relatório.']);
        // }
    }
}
