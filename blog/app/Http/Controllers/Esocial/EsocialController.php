<?php

namespace App\Http\Controllers\Esocial;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Tomador;
use App\Empresa;
use App\Trabalhador;
use App\Esocial;
use App\Notifications\notificacaoEsocial;

class EsocialController extends Controller
{
    private $tomador,$empresa,$trabalhador,$esocial;
    public function __construct()
    {
        $this->tomador = new Tomador;
        $this->empresa = new Empresa;
        $this->trabalhador = new Trabalhador;
        $this->esocial = new Esocial;
    }
    public function eventS1020($id)
    {
        $user = Auth::user();
        $id = base64_decode($id);
        $dados = [
            'nome'=>'',
            'codigo'=>'',
            'id'=>'',
            'ambiente'=>'',
            'status'=>'',
            'trabalhador'=>null,
            'tomador'=>$id
        ];
        // $tomador = $this->tomador->first($id);
        // $empresa = $this->empresa->buscaUnidadeEmpresa($user->empresa);
        $empresa = $this->empresa->where('id',$user->empresa_id)->with('endereco')->first(); 
        $tomador = $this->tomador->where('id',$id)->with('parametrosefip')->first();
        // dd($tomador);
        if (!$tomador->parametrosefip[0]->psfpas) {
            return redirect()->back()->withInput()->withErrors(['false'=>'Não foi possível encotrar o FPAS.']);
        }elseif (!$tomador->parametrosefip[0]->psfpasterceiros) {
            return redirect()->back()->withInput()->withErrors(['false'=>'Não foi possível encotrar o FPAS TERCEIRO.']);
        }
        $cd = 
        'cpfcnpjtransmissor='.str_replace(array(".", ",", "-", "/"), "",$empresa->escnpj)."\r\n".
        'cpfcnpjempregador='.str_replace(array(".", ",", "-", "/"), "",$empresa->escnpj)."\r\n".
        'idgrupoeventos=1'."\r\n".
        'versaomanual=S.01.00.00'."\r\n".
        'ambiente=1'."\r\n".
        'INCLUIRS1020'."\r\n".                                                                   
        'tpAmb_4=1'."\r\n".                                                                  
        'procEmi_5=1'."\r\n".                                                                   
        'verProc_6=1.0.0'."\r\n".                                                                
        'tpInsc_8=1'."\r\n".                                                                   
        'nrInsc_9='.substr(str_replace(array(".", ",", "-", "/"), "", $tomador->tscnpj),0,-6)."\r\n".                                                               
        'codLotacao_13='.$tomador->tsmatricula."\r\n".                                                           
        'iniValid_14='.date("Y-m")."\r\n".                                                         
        'fimValid_15='."\r\n".                                           
        'tpLotacao_17=09'."\r\n".                                                                
        'tpInsc_18=1'."\r\n".                                                                    
        'nrInsc_19='.str_replace(array(".", ",", "-", "/"), "", $tomador->tscnpj)."\r\n".                                                        
        'fpas_21='.str_replace(array(".", ",","(",")", "-", "/"), "",$tomador->parametrosefip[0]->psfpas)."\r\n".                                                                     
        'codTercs_22='.str_replace(array(".", ",","(",")", "-", "/"), "",$tomador->parametrosefip[0]->psfpasterceiros)."\r\n".                                                             
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
        $this->esocial->cadastro($dados);
        return redirect()->back();
    }
    public function eventS2300($id)
    {
        $user = Auth::user();
        $id = base64_decode($id);
        $dados = [
            'nome'=>'',
            'codigo'=>'',
            'id'=>'',
            'ambiente'=>0,
            'status'=>'',
            'trabalhador'=>$id,
            'tomador'=>null
        ];
        // $empresa = $this->empresa->buscaUnidadeEmpresa($user->empresa);
        // $trabalhador = $this->trabalhador->buscaUnidadeTrabalhador($id);
        // dd($trabalhador->nsraca[1],$empresa,$trabalhador);
        $empresa = $this->empresa->where('id',$user->empresa_id)->with('endereco')->first(); 
        $trabalhador = $this->trabalhador->where('id',$id)
        ->with(['documento','endereco','categoria','nascimento','bancario','depedente','epi'])->first();
        // dd($trabalhador);
            if (!$trabalhador->categoria[0]->cbo) {
                return redirect()->back()->withInput()->withErrors(['false'=>'Não foi possível encotrar o CBO.']);
            }elseif (!$trabalhador->categoria[0]->csadmissao) {
                return redirect()->back()->withInput()->withErrors(['false'=>'Não foi possível encotrar o a data de admissão.']);
            }elseif (!$trabalhador->categoria[0]->cscategoria) {
                return redirect()->back()->withInput()->withErrors(['false'=>'Não foi possível encotrar o a data de admissão.']);
            }
        $cd = 
        'cpfcnpjtransmissor='.str_replace(array(".", ",", "-", "/"), "",$empresa->escnpj)."\r\n".
        'cpfcnpjempregador='.str_replace(array(".", ",", "-", "/"), "",$empresa->escnpj)."\r\n".
        'idgrupoeventos=2'."\r\n".
        // 'versaomanual=2.5.00'."\r\n".
        'versaomanual=S.01.00.00'."\r\n".
        // 'versaomanual=1.0.0.0'."\r\n".
        'ambiente=1'."\r\n".
        'INCLUIRS2300'."\r\n".                                                                    
        'indRetif_4=1'."\r\n".                                                                    
        'nrRecibo_5='."\r\n".                                                                   
        'tpAmb_6=1'."\r\n".                                                                      
        'procEmi_7=1'."\r\n".                                                                    
        'verProc_8=1.00.00'."\r\n".                                                               
        'tpInsc_10=1'."\r\n".                                                                     
        'nrInsc_11='.substr(str_replace(array(".", ",", "-", "/"), "", $empresa->escnpj),0,-6)."\r\n".                                                           
        'cpfTrab_13='.str_replace(array(".", ",", "-", "/"), "", $trabalhador->tscpf)."\r\n".
        // 'nisTrab_14='.str_replace(array(".", ",", "-", "/"), "", $trabalhador->documento[0]->dspis)."\r\n".                                                         
        'nmTrab_15='.$trabalhador->tsnome."\r\n".                                     
        'sexo_16='.$trabalhador->tssexo[0]."\r\n".                                                                       
        'racaCor_17='.$trabalhador->nascimento[0]->nsraca[0]."\r\n".                                                                   
        'estCiv_18='.$trabalhador->nascimento[0]->nscivil[0]."\r\n".                                                                    
        'grauInstr_19='.$trabalhador->tsescolaridade[0].$trabalhador->tsescolaridade[1]."\r\n".                                                                  
        'dtNascto_22='.$trabalhador->nascimento[0]->nsnascimento."\r\n".                                                         
        'paisNascto_25='.substr(str_replace(array(".", ",", "-", "/"), "", $trabalhador->nascimento[0]->nsnacionalidade),0,3)."\r\n".                                                              
        'paisNac_26='.substr(str_replace(array(".", ",", "-", "/"), "", $trabalhador->nascimento[0]->nsnaturalidade),0,3)."\r\n".                                                              
        'tpLograd_60='.$empresa->endereco[0]->escomplemento[0]."\r\n".                                                                
        'dscLograd_61='.$empresa->endereco[0]->eslogradouro."\r\n".                                          
        'nrLograd_62='.$empresa->endereco[0]->esnum."\r\n".                                                          
        'complemento_63='."\r\n".                                                               
        'bairro_64='.$empresa->endereco[0]->esbairro."\r\n".                                                      
        'cep_65='.str_replace(array(".", ",", "-", "/"), "",$empresa->endereco[0]->escep)."\r\n".                                                               
        'codMunic_66='.$empresa->escodigomunicipio."\r\n".                                                           
        'UF_67='.$empresa->endereco[0]->esuf."\r\n".                                                                       
        'cadIni_164=N'."\r\n".       
        'codCateg_104='.substr(str_replace(array(".", ",", "-", "/"), "",$trabalhador->categoria[0]->cscategoria),0,3)."\r\n".  
        'dtInicio_105='.$trabalhador->categoria[0]->csadmissao."\r\n".                                                         
        'matricula_173='.$trabalhador->tsmatricula."\r\n". 
        // 'matricOrig_122='.$trabalhador->tsmatricula."\r\n".                                                          
        // 'categOrig_119='.substr(str_replace(array(".", ",", "-", "/"), "",$trabalhador->categoria[0]->cscategoria),0,3)."\r\n".                                                                                                       
        'natAtividade_106=1'."\r\n".                                                             
        'nmCargo_175='.$trabalhador->categoria[0]->cbo."\r\n".                             
        'CBOCargo_176='.substr($trabalhador->categoria[0]->cbo,0,6)."\r\n".                                                      
        'nmFuncao_177='.$trabalhador->categoria[0]->cbo."\r\n".                                   
        'CBOFuncao_178='.substr($trabalhador->categoria[0]->cbo,0,6)."\r\n".  
        // 'codCargo_109='.self::montastring($trabalhador->categoria[0]->cbo)[0].self::montastring($trabalhador->categoria[0]->cbo)[1]."\r\n".                             
        // 'CBOCargo_176='.self::montastring($trabalhador->categoria[0]->cbo)[0]."\r\n".                                                      
        // 'codFuncao_110='.self::montastring($trabalhador->categoria[0]->cbo)[0].self::montastring($trabalhador->categoria[0]->cbo)[1]."\r\n".                                   
        // 'CBOFuncao_178='.self::montastring($trabalhador->categoria[0]->cbo)[0]."\r\n".                                                          
        'SALVARS2300';
        $verificar =  $this->esocial->where('trabalhador_id',$id)->count();
        if (!$verificar) {
            $this->esocial->cadastro($dados);
        }
        $file_name = 'S2300_'.date("Ymd").'11475900170.txt';
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
        
        return redirect()->back()->withSuccess('Cadastro realizado com sucesso.'); 
    }
    public function update(Request $request,$id)
    {
        $dados = $request->all();
        $user = Auth::user();
        $user->notify(new notificacaoEsocial($dados));
        return response()->json('Cadastro realizado com sucesso.');
        // $id = base64_decode($id);
        // $dados['trabalhador']=$id;
        // $esocial =  $this->esocial->editar($dados,$id);
        // if ($esocial) {
        //     return response()->json('Cadastro realizado com sucesso.');
        // }
    }
    public function montastring($valor)
    {
        if (mb_strpos($valor, '-') !== false) {
            $valor = explode('-',$valor);
        }
       
        return $valor;
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
