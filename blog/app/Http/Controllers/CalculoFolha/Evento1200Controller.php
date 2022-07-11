<?php

namespace App\Http\Controllers\CalculoFolha;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Empresa;
use App\Folhar;
use App\BaseCalculo;
use App\Trabalhador;
use App\Esocial;
use ZipArchive;
class Evento1200Controller extends Controller
{
    private $empresa,$folhar,$basecalculo,$trabalhador,$zip;
    function __construct()
    {
        $this->folhar = new Folhar;
        $this->basecalculo = new BaseCalculo;
        $this->empresa = new Empresa;
        $this->trabalhador = new Trabalhador;
        $this->zip = new ZipArchive;
        $this->esocial = new Esocial;
    }
    public function index($competencia)
    {
        $user = auth()->user();
        $folhar = $this->folhar->where('id',$competencia)->first();
        $empresa = $this->empresa->where('id',$user->empresa_id)->first();
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
        $novotrabalhadores = array_chunk($trabalhadorarray, 20, true);
        // dd($novotrabalhadores);
        $novapasta = rand(1000, 100000);
        
        if (count($novotrabalhadores) > 1) { 
            mkdir('storage/'.$novapasta);
        }
        $dados = [
            'nome'=>'S1200',
            'codigo'=>'',
            'id'=>'',
            'ambiente'=>0,
            'status'=>'',
            'prenome'=> 'Calculo da folhar',
            'inscricao'=>$folhar->fscodigo,
            'trabalhador'=>null,
            'tomador'=>null,
            'folhar'=>$folhar->id,
            'empresa'=>$user->empresa_id
        ];
        foreach ($novotrabalhadores as $i => $novoval) {
            $trabalhador = $this->trabalhador->whereIn('id',$novoval)
            ->with('categoria:trabalhador_id,cscategoria')
            ->get();
            $basecalculo = $this->basecalculo->where([
                ['folhar_id',$competencia],
                ['tomador_id','!=',null]
            ])
            ->with(['trabalhador:id,tscpf','trabalhador.categoria:trabalhador_id,cscategoria','tomador:id,tstipo,tscnpj,tsmatricula','valorcalculo:base_calculo_id,vicodigo,vireferencia,vivencimento,videscinto'])
            ->get();
            $cd = '';
            if (count($novotrabalhadores) > 1){
                $file_name = 'storage/'.$novapasta.'/S1200_'.$i.'.txt';
            }else{
                $file_name = 'S1200.txt';
            }
            $cd = 'cpfcnpjtransmissor='.str_replace(array(".", ",", "-", "/"), "",$empresa->escnpj)."\r\n".
                  'cpfcnpjempregador='.str_replace(array(".", ",", "-", "/"), "",$empresa->escnpj)."\r\n".
                  'idgrupoeventos=3'."\r\n".
                  'versaomanual=S.01.00.00'."\r\n".
                  'ambiente=1'."\r\n";
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
                foreach ($basecalculo as $key => $basecalculos) {
                    if ($basecalculos->trabalhador_id === $trabalhadores->id) {
                        foreach ($basecalculos->valorcalculo as $key => $valorcalculos) {
                            if ($valorcalculos->vivencimento || $valorcalculos->videscinto) {
                                $cd.='INCLUIRITENSREMUN_156'."\r\n";
                                $cd.='codRubr_47='.$valorcalculos->vicodigo."\r\n";
                                $cd.='ideTabRubr_48=1'."\r\n";
                                $cd.='qtdRubr_49='.$valorcalculos->vireferencia."\r\n";
                                $cd.='fatorRubr_50=001'."\r\n";
                                if ($valorcalculos->vivencimento) {
                                    $cd.='vrRubr_52='.$valorcalculos->vivencimento."\r\n";
                                }else{
                                    $cd.='vrRubr_52='.$valorcalculos->videscinto."\r\n";
                                }
                                $cd.='indApurIR_115=0'."\r\n";
                                $cd.='SALVARITENSREMUN_156'."\r\n";
                            }
                        }
                    }
                }
                $cd.='SALVARS1200'."\r\n";
            }
            $file = fopen( $file_name, "w" );
            fwrite($file, $cd);
            fclose($file);
           
          
          
        }
        if (count($novotrabalhadores) > 1){
            $novozip = rand(1000, 100000);
            $fileName = 'storage/'.$novozip.'.zip';
            $zipPath = public_path($fileName);
            if ($this->zip->open($zipPath, ZipArchive::CREATE) === true)
            {
            
                $files = File::files(public_path('storage/'.$novapasta));
            
                foreach ($files as $key => $value) {
                
                    // nome/diretorio do arquivo dentro do zip
                    $relativeNameInZipFile = basename($value);
                
                    // adicionar arquivo ao zip
                    $this->zip->addFile($value,$relativeNameInZipFile);
                }
                
                $this->zip->close();
            
            }
            $verificar =  $this->esocial->where([
                ['folhar_id',$folhar->id],
                ['escodigo','!=',50]
            ])->count();
            if (!$verificar) {
                $this->esocial->cadastro($dados);
            }
            return response()->download($zipPath);
        }else{
            $verificar =  $this->esocial->where([
                ['folhar_id',$folhar->id],
                ['escodigo','!=',50]
            ])->count();
            if (!$verificar) {
                $this->esocial->cadastro($dados);
            }
            header("Content-Type: application/save");
            header("Content-Length:".filesize($file_name));
            header('Content-Disposition: attachment; filename="' . $file_name . '"');
            header("Content-Transfer-Encoding: binary");
            header('Expires: 0');
            header('Pragma: no-cache');
            echo $cd;
            exit;
        }

    }
}
