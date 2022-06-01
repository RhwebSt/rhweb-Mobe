<?php

namespace App\Http\Controllers\CalculoFolha;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Empresa;
use App\Folhar;
use App\BaseCalculo;
use App\Trabalhador;
class Evento1200Controller extends Controller
{
    private $empresa,$folhar,$basecalculo,$tranalhador;
    function __construct()
    {
        $this->folhar = new Folhar;
        $this->basecalculo = new BaseCalculo;
        $this->empresa = new Empresa;
        $this->trabalhador = new Trabalhador;
    }
    public function index($competencia,$empresa)
    {
        $empresa = $this->empresa->where('id',$empresa)->first();
        $tranalhadores = $this->basecalculo->where([
            ['folhar_id',$competencia],
            ['tomador_id','!=',null]
        ])
        ->select('trabalhador_id')
        // ->with(['trabalhador:id,tscpf','trabalhador.categoria:trabalhador_id,cscategoria','tomador:id,tstipo,tscnpj'])
        ->get();
        $trabalhadorarray = [];
            foreach ($tranalhadores as $key => $trabalahdorid) {
                array_push($trabalhadorarray,$trabalahdorid->trabalhador_id);
            }
        $trabalhador = $this->trabalhador->whereIn('id',$trabalhadorarray)
        ->with('categoria:trabalhador_id,cscategoria')
        ->get();
        $basecalculo = $this->basecalculo->where([
            ['folhar_id',$competencia],
            ['tomador_id','!=',null]
        ])
        ->with(['trabalhador:id,tscpf','trabalhador.categoria:trabalhador_id,cscategoria','tomador:id,tstipo,tscnpj,tsmatricula'])
        ->get();
        // dd($basecalculo);
        $cd = '';
        $file_name = '1200.txt';
        foreach ($trabalhador as $key => $trabalhadores) {
            $cd .= 'INCLUIRS1200'."\r\n";
            $cd .= 'indRetif_4=1'."\r\n";
            $cd .= 'nrRecibo_5='."\r\n";
            $cd .= 'indApuracao_6=1'."\r\n";
            $cd .= 'perApur_7='.$competencia."\r\n";
            $cd .= 'tpAmb_8=1'."\r\n";
            $cd .= 'procEmi_9=1'."\r\n";
            $cd .= 'verProc_10=VER062.052021'."\r\n";
            $cd .= 'tpInsc_12=1'."\r\n";
            $cd .= 'nrInsc_13='.str_replace(array(".", ",", "-", "/"), "",$empresa->escnpj)."\r\n";
            $cd .= 'cpfTrab_15='.str_replace(array(".", ",", "-", "/"), "",$trabalhadores->tscpf)."\r\n";
            $cd .= 'indMV_18=1'."\r\n";
            foreach ($basecalculo as $key => $basecalculos) {
                if ($basecalculos->trabalhador_id === $trabalhadores->id) {
                    $cd.='INCLUIRREMUNOUTREMPR_150'."\r\n";
                    $cd.='tpInsc_109='.substr($basecalculos->tomador->tstipo,0,1)."\r\n";
                    $cd.='nrInsc_110='.str_replace(array(".", ",", "-", "/"), "",$basecalculos->tomador->tscnpj)."\r\n";
                    $cd.='codCateg_22='.substr($basecalculos->trabalhador->categoria[0]->cscategoria,0,3)."\r\n";
                    $cd.='vlrRemunOE_23='.$basecalculos->bivalorliquido."\r\n";
                    $cd.='SALVARREMUNOUTREMPR_150'."\r\n";
                }
            }
            $cd.='INCLUIRDMDEV_153'."\r\n";
            $cd.='ideDmDev_35='.$trabalhadores->tsmatricula."\r\n";
            $cd .= 'codCateg_112='.substr($trabalhadores->categoria[0]->cscategoria,0,3)."\r\n";                                                             
            $cd .= 'SALVARDMDEV_153'."\r\n";
            foreach ($basecalculo as $key => $basecalculos) {
                if ($basecalculos->trabalhador_id === $trabalhadores->id) {
                    $cd.='INCLUIRIDEESTABLOT_154'."\r\n";
                    $cd.='tpInsc_113=1'."\r\n";
                    $cd.='nrInsc_114='.str_replace(array(".", ",", "-", "/"), "",$empresa->escnpj)."\r\n";
                    $cd.='codLotacao_42='.$basecalculos->tomador->tsmatricula."\r\n";
                    $cd.='qtdDiasAv_42=01'."\r\n";
                    $cd .= 'SALVARIDEESTABLOT_154'."\r\n";
                    $cd.='INCLUIRREMUNPERAPUR_155'."\r\n";                                                         
                    $cd.='matricula_44='.$basecalculos->tomador->tsmatricula."\r\n";                                                           
                    $cd.='indSimples_45='."\r\n";                                                              
                    $cd.='grauExp_64=1'."\r\n";                                                                 
                    $cd.='SALVARREMUNPERAPUR_155'."\r\n";
                }
            }
          
        }
        $file = fopen( $file_name, "w" );
        fwrite($file, $cd);
        fclose($file);
        header("Content-Type: application/save");
        header("Content-Length:".filesize($file_name));
        header('Content-Disposition: attachment; filename="' . $file_name . '"');
        header("Content-Transfer-Encoding: binary");
        header('Expires: 0');
        header('Pragma: no-cache');
        echo $cd;
        exit;
        dd($competencia);

    }
}
