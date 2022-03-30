<?php

namespace App\Http\Controllers\Esocial;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Tomador;
use App\Empresa;
use App\Trabalhador;
class EsocialController extends Controller
{
    private $tomador,$empresa,$trabalhador;
    public function __construct()
    {
        $this->tomador = new Tomador;
        $this->empresa = new Empresa;
        $this->trabalhador = new Trabalhador;
    }
    public function eventS1020($id)
    {
        $user = Auth::user();
        $id = base64_decode($id);
        $tomador = $this->tomador->first($id);
        $empresa = $this->empresa->buscaUnidadeEmpresa($user->empresa);
        $cd = 
        'cpfcnpjtransmissor='.str_replace(array(".", ",", "-", "/"), "",$empresa->escnpj)."\r\n".
        'cpfcnpjempregador='.str_replace(array(".", ",", "-", "/"), "",$empresa->escnpj)."\r\n".
        'idgrupoeventos=1'."\r\n".
        'versaomanual=2.5.00'."\r\n".
        'ambiente=2'."\r\n".
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
    public function eventS2300($id)
    {
        $user = Auth::user();
        $id = base64_decode($id);
        $empresa = $this->empresa->buscaUnidadeEmpresa($user->empresa);
        $trabalhador = $this->trabalhador->buscaUnidadeTrabalhador($id);
        dd($trabalhador->nsraca[1],$trabalhador);
        $cd = 
        'INCLUIRS2300'."\r\n".                                                                    
        'indRetif_4=1'."\r\n".                                                                    
        'nrRecibo_5='."\r\n".                                                                   
        'tpAmb_6=1'."\r\n".                                                                      
        'procEmi_7=1'."\r\n".                                                                    
        'verProc_8=1.0.0'."\r\n".                                                               
        'tpInsc_10=1'."\r\n".                                                                     
        'nrInsc_11='.substr(str_replace(array(".", ",", "-", "/"), "", $empresa->escnpj),0,-6)."\r\n".                                                           
        'cpfTrab_13='.substr(str_replace(array(".", ",", "-", "/"), "", $trabalhador->tscpf),0,-6)."\r\n".                                                         
        'nmTrab_15='."\r\n".                                     
        'sexo_16='.$trabalhador->tssexo[0]."\r\n".                                                                       
        'racaCor_17='.$trabalhador->nsraca[0].$trabalhador->nsraca[1]."\r\n".                                                                   
        'estCiv_18='.$trabalhador->nscivil[0]."\r\n".                                                                    
        'grauInstr_19='.$trabalhador->nsraca[0].$trabalhador->nsraca[1]."\r\n".                                                                  
        'dtNascto_22='.$trabalhador->nsnascimento."\r\n".                                                         
        'paisNascto_25='.$trabalhador->nsnacionalidade[0].$trabalhador->nsnacionalidade[1].$trabalhador->nsnacionalidade[2]."\r\n".                                                              
        // paisNac_26=105    (pais de nacionalidade apenas o codigo)                                                              
        // tpLograd_60=R   (Letra do valor do campo selecionado)                                                                
        // dscLograd_61=RUA NOSSA SRA APARECIDA  (rua do usuario)                                          
        // nrLograd_62=000493    (numero do endereco do usuario)                                                          
        // complemento_63=  (complemento)                                                               
        // bairro_64=JARDIM ELDORADO (bairro do usuario)                                                      
        // cep_65=88133400  ( cep do usuario)                                                               
        // codMunic_66=4211900  (codmunic do usuario)                                                           
        // UF_67=SC (uf do usuario)                                                                       
        // cadIni_164=N  (fixo)                                                                  
        // matricula_173=009147 (matricula do trabalhador)                                                           
        // codCateg_104=202 (codigo da categoria do trablhador)                                                               
        // dtInicio_105=2019-11-18   (data de admissao trabalhador)                                                      
        // natAtividade_106=1 (fixo)                                                             
        // nmCargo_175=783210 - Movimentador de mercadorias   (CBO + Descricao)                             
        // CBOCargo_176=783210       (CBO)                                                      
        // nmFuncao_177=783210 - Movimentador de mercadorias  (CBO + Descricao)                                   
        // CBOFuncao_178=783210     (CBO)                                                          
        // SALVARS2300                                                                     
        // ';
        // $file_name = 'S2300_'.date("Ymd").'11475900170.txt';
        // $file = fopen( $file_name, "w" );
        // fwrite($file, $cd);
        // fclose($file);
        // header("Content-Type: application/save");
        // header("Content-Length:".filesize($file_name));
        // header('Content-Disposition: attachment; filename="' . $file_name . '"');
        // header("Content-Transfer-Encoding: binary");
        // header('Expires: 0');
        // header('Pragma: no-cache');
        // echo $cd;
        // exit;
        // return redirect()->back();
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
