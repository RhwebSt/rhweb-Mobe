<?php

namespace App\Http\Controllers\Esocial;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Tomador;
class EsocialController extends Controller
{
    private $tomador;
    public function __construct()
    {
        $this->tomador = new Tomador;
    }
    public function eventS1020($id)
    {
        
        $id = base64_decode($id);
        $tomador = $this->tomador->first($id);
        $cd = 
        'INCLUIRS1020'."\r\n".                                                                   
        'tpAmb_4=1'."\r\n".                                                                  
        'procEmi_5=1'."\r\n".                                                                   
        'verProc_6=1.0.0'."\r\n".                                                                
        'tpInsc_8=1'."\r\n".                                                                   
        'nrInsc_9='.substr(str_replace(array(".", ",", "-", "/"), "", $tomador->tscnpj),0,-6)."\r\n".                                                               
        'codLotacao_13='.self::monta_inteiro($tomador->tsmatricula,6,'esquerda')."\r\n".                                                           
        'iniValid_14='.date("Ym")."\r\n".                                                         
        'fimValid_15='."\r\n".                                           
        'tpLotacao_17=09'."\r\n".                                                                
        'tpInsc_18=1'."\r\n".                                                                    
        'nrInsc_19='.str_replace(array(".", ",", "-", "/"), "", $tomador->tscnpj)."\r\n".                                                        
        'fpas_21='.str_replace(array(".", ",","(",")", "-", "/"), "",$tomador->psfpas)."\r\n".                                                                     
        'codTercs_22='.str_replace(array(".", ",","(",")", "-", "/"), "",$tomador->psfpasterceiros)."\r\n".                                                             
        'SALVARS1020';
        $file_name = 'S1020_'.date("Ymd").'11475900170.txt';
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
        return redirect()->back();
    }
    public function monta_inteiro($nome,$quantidade,$status)
    {
        if ($status === 'esquerda') {
            $novonome = '';
            $nomeempresa = strlen($nome);
            if ($nomeempresa < $quantidade) {
                $contador = $quantidade - $nomeempresa;
                for ($i=0; $i < $contador ; $i++) { 
                    $novonome .= '0';
                }
                $novonome .=$nome;
            }
        }else{
            $novonome = $nome;
            $nomeempresa = strlen($nome);
            if ($nomeempresa < $quantidade) {
                $contador = $quantidade - $nomeempresa;
                for ($i=0; $i < $contador ; $i++) { 
                    $novonome .= '0';
                }
            }
        }
        return $novonome;
    }
}
