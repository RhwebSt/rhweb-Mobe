<?php

namespace App\Http\Controllers\CalculoFolha;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\BaseCalculo;
use App\Rublica;
use App\Trabalhador;
use App\Folhar;
use App\ValorCalculo;
use App\RelacaoDia;
use App\Leis;
use PDF;
class calculoFolhaPorTomadorController extends Controller
{
    private $folhar,$valorcalculo,$relacaodia,$rublica,$leis,$trabalhador,$basecalculo;
    public function __construct()
    {
        $this->folhar = new Folhar;
        $this->valorcalculo = new ValorCalculo;
        $this->relacaodia = new RelacaoDia;
        $this->rublica = new Rublica;
        $this->leis = new Leis;
        $this->trabalhador = new Trabalhador;
        $this->basecalculo = new BaseCalculo;
    } 

    public function imprimirTomador($folhar,$tomador)
    {
        
        $folhar = base64_decode($folhar);
        $tomador = base64_decode($tomador);
        
            $rublicas = $this->rublica->listaGeral();
            $leis = $this->leis->categorias();
            $incide = [];
            $naoincide = [];
            foreach ($rublicas as $key => $rublica) {
                if ($rublica->rsincidencia === 'Sim') {
                    array_push($incide,$rublica->rsrublica);
                }
                if ($rublica->rsincidencia === 'Não') {
                    array_push($naoincide,$rublica->rsrublica);
                }
            }
            $folhas = $this->folhar->buscaTrabalhadorLista($folhar,$tomador);
            // dd($folhas,$folhar,$tomador);
            $basecalculo_id = [];
            foreach ($folhas as $key => $folhar) {
                array_push($basecalculo_id,$folhar->id); 
            }
            $valorcalculos = $this->valorcalculo->buscaImprimirTomador($basecalculo_id,$incide,$naoincide);
            $relacaodias = $this->relacaodia->buscaImprimir($basecalculo_id);
            $pdf = PDF::loadView('comprovantetomador',compact('folhas','leis','valorcalculos','relacaodias'));
            return $pdf->setPaper('a4')->stream('Cálculo folha Tomador.pdf');
            try {
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->withErrors(['false'=>'Não foi possível gerar o relatório.']);
        }
        
    }
    public function imprimirTrabalhador(Request $request)
    {
        $dados = $request->all();
            // $rublicas = $this->rublica->listaGeral();
            $trabalhador = $this->trabalhador->where([
                ['tsnome',$dados['trabalhador']],
                ['empresa_id',$dados['empresa']]
            ])
            ->first();
            $recibo = $this->basecalculo->where([
                ['folhar_id',$dados['folhar']],
                ['trabalhador_id',$trabalhador->id],
                ['tomador_id',$dados['tomador']]
            ])
            ->with(['trabalhador.documento','trabalhador.categoria','trabalhador.bancario','folhar.empresa','valorcalculo','relacaodia'])
            ->first();
            $leis = $this->leis->categorias();
            // $incide = [];
            // $naoincide = [];
            // foreach ($rublicas as $key => $rublica) {
            //     if ($rublica->rsincidencia === 'Sim') {
            //         array_push($incide,$rublica->rsrublica);
            //     }
            //     if ($rublica->rsincidencia === 'Não') {
            //         array_push($naoincide,$rublica->rsrublica);
            //     }
            // }
            // $folhar = $this->folhar->buscaTrabalhadorUnidade($dados['folhar'],$dados['trabalhador1'],$dados['tomador']);
            
            // $basecalculo_id = [];
            // array_push($basecalculo_id,$folhar->id);  
            // $valorcalculos = $this->valorcalculo->buscaImprimirTomador($basecalculo_id,$incide,$naoincide);
            
            // $relacaodias = $this->relacaodia->buscaImprimir($basecalculo_id);
            // $pdf = PDF::loadView('comprovantetrabalhador',compact('folhar','leis','valorcalculos','relacaodias'));
            $pdf = PDF::loadView('comprovantetrabalhador',compact('recibo','leis'));
            return $pdf->setPaper('a4')->stream('Cálculo folha trabalhador.pdf');
            try {
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->withErrors(['false'=>'Não foi possível gerar o relatório.']);
        }
    }
}
