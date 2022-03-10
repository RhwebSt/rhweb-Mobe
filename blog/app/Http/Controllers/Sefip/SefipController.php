<?php

namespace App\Http\Controllers\Sefip;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Tomador;
use App\Empresa;
use App\Folhar;
use App\ValorCalculo;
class SefipController extends Controller
{
    private $tomador,$empresa,$folhar,$valorcalculo;
    public function __construct()
    {
        $this->tomador = new Tomador;
        $this->empresa = new Empresa;
        $this->folhar = new Folhar;
        $this->valorcalculo = new ValorCalculo;
    }
    public function geraTxt($tomador,$folhar)
    {
       $user = auth()->user();
       $tomador = base64_decode($tomador);
       $folhar = base64_decode($folhar);
       try {
       $empresa = $this->empresa->EmpresaSefip($user->empresa);
       $folhas = $this->folhar->buscaTrabalhadorLista($folhar,$tomador);
       $tomador = $this->tomador->first($tomador);
       if (count($folhas) < 1 || !$tomador) {
            return redirect()->back()->withInput()->withErrors(['false'=>'Não foi porssivél gera a Sefip.']);
       }
       $competencia = $this->folhar->buscaUnidadeFolhar($folhar);
       $folhar =[
           'competencia'=>''
       ];
       $empresas = [
        'cnpj'=>'',
        'nome'=>'',
        'contator'=>'',
        'cep'=>'',
        'cidade'=>'',
        'rua'=>'',
        'bairro'=>'',
        'uf'=>'',
        'telefone'=>'',
        'email'=>''
       ];
       $tomadores = [
           'cnpj'=>'',
           'nome'=>'',
           'cep'=>'',
           'rua'=>'',
           'cidade'=>'',
           'bairro'=>'',
           'uf'=>'',
           'telefone'=>'',
           'email'=>'',
           'cnae'=>'',
           'rat'=>'',
           'recolimento'=>'',
           'simples'=>'',
           'fpas'=>'',
           'codterceiro'=>'',
           'codgrps'=>'',
           'cbo'=>''
       ];
       $trabalhador =[
        'pis'=>'',
        'admissao'=>'',
        'nome'=>'',
        'matricula'=>'',
        'ctps'=>'',
        'serie'=>'',
        'afastamento'=>'',
        'nascimento'=>'',
        'cbo'=>'',
        'inss'=>'',
        '13sal'=>'',
        '13sem'=>'',
        'base13'=>'',
        'inss_13sal'=>''
       ];
       $caracteres_sem_acento = array(
        'Š'=>'S', 'š'=>'s', 'Ð'=>'Dj',''=>'Z', ''=>'z', 'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A',
        'Å'=>'A', 'Æ'=>'A', 'Ç'=>'C', 'È'=>'E', 'É'=>'E', 'Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I',
        'Ï'=>'I', 'Ñ'=>'N', 'Ń'=>'N', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O', 'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U', 'Ú'=>'U',
        'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y', 'Þ'=>'B', 'ß'=>'Ss','à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a',
        'å'=>'a', 'æ'=>'a', 'ç'=>'c', 'è'=>'e', 'é'=>'e', 'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i',
        'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'ń'=>'n', 'ò'=>'o', 'ó'=>'o', 'ô'=>'o', 'õ'=>'o', 'ö'=>'o', 'ø'=>'o', 'ù'=>'u',
        'ú'=>'u', 'û'=>'u', 'ü'=>'u', 'ý'=>'y', 'ý'=>'y', 'þ'=>'b', 'ÿ'=>'y', 'ƒ'=>'f',
        'ă'=>'a', 'î'=>'i', 'â'=>'a', 'ș'=>'s', 'ț'=>'t', 'Ă'=>'A', 'Î'=>'I', 'Â'=>'A', 'Ș'=>'S', 'Ț'=>'T',
        );
       if ($empresa->escnpj) {
           $cnpjempresa = trim($empresa->escnpj);
           $empresas['cnpj'] =  str_replace(array(".", ",", "-", "/"), "", self::monta_string($cnpjempresa,14));
       }
        if ($empresa->escep) {
            $cepempresa = trim($empresa->escep);
            $empresas['cep'] =  str_replace(array(".", ",", "-", "/"), "", self::monta_string($cepempresa,8));
        }
       if ($empresa->esnome) {
           $empresas['nome'] = strtoupper($empresa->esnome);
           $empresas['nome'] = self::monta_string($empresas['nome'],30);
       }
       if ($empresa->esresponsavel) {
        $empresas['contator'] = strtoupper($empresa->esresponsavel);
        $empresas['contator'] = self::monta_string($empresas['contator'],20);
       }
       if ($competencia->fscompetencia) {
            $competencia =  explode('-',$competencia->fscompetencia);
            $folhar['competencia'] = $competencia[0].$competencia[1];
            $folhar['competencia'] = self::monta_string($folhar['competencia'],6);
        }
       if ($empresa->eslogradouro) {
            $empresas['rua'] = strtoupper($empresa->eslogradouro);
            $empresas['rua'] = self::monta_string($empresas['rua'],50);
        }
        if ($empresa->esmunicipio) {
            $empresas['cidade'] = strtoupper(preg_replace("/[^a-zA-Z0-9]/", "",strtr($empresa->esmunicipio, $caracteres_sem_acento)));
            $empresas['cidade'] = self::monta_string($empresas['cidade'],20);
        }
        if ($empresa->esbairro) {
            $empresas['bairro'] = strtoupper($empresa->esbairro);
            $empresas['bairro'] = self::monta_string($empresas['bairro'],20);
        }
        if ($empresa->esuf) {
            $empresas['uf'] = strtoupper($empresa->esuf);
            $empresas['uf'] = self::monta_string($empresas['uf'],2);
        }
        if ($empresa->estelefone) {
            $empresas['telefone'] = strtoupper(str_replace(array(".", ",","(",")", "-", "/"), "",str_replace(" ","",$empresa->estelefone)));
            
            $empresas['telefone'] = self::monta_string($empresas['telefone'],12);
        }
        if ($empresa->esemail) {
            $empresas['email'] = strtoupper($empresa->esemail);
            $empresas['email'] = self::monta_string($empresas['email'],60);
        }


        if ($tomador->escep) {
            $ceptomador = trim($tomador->escep);
            $tomadores['cep'] =  str_replace(array(".", ",", "-", "/"), "",self::monta_string($ceptomador,8));
        }
        if ($tomador->tscnpj) {
            $cnpjtomador = trim($tomador->tscnpj);
            $tomadores['cnpj'] =  str_replace(array(".", ",", "-", "/"), "", self::monta_string($cnpjtomador,14));
        }
        if ($tomador->tsnome) {
            $tomadores['nome'] = strtoupper($tomador->tsnome);
            $tomadores['nome'] = self::monta_string($tomadores['nome'],40);
        }
        if ($tomador->eslogradouro) {
            $tomadores['rua'] = strtoupper($tomador->eslogradouro);
            $tomadores['rua'] = self::monta_string($tomadores['rua'],50);
        }
        if ($tomador->esbairro) {
            $tomadores['bairro'] = strtoupper($tomador->esbairro);
            $tomadores['bairro'] = self::monta_string($tomadores['bairro'],20);
        }
        if ($tomador->esuf) {
            $tomadores['uf'] = strtoupper($tomador->esuf);
            $tomadores['uf'] = self::monta_string($tomadores['uf'],2);
        }
        if ($tomador->esmunicipio) {
            $tomadores['cidade'] = strtoupper(preg_replace("/[^a-zA-Z0-9]/", "",strtr($tomador->esmunicipio, $caracteres_sem_acento)));
            $tomadores['cidade'] = self::monta_string($tomadores['cidade'],20);
        }
        if ($tomador->tstelefone) {
            $tomadores['telefone'] = strtoupper(str_replace(array(".", ",","(",")", "-", "/"), "",str_replace(" ","",$tomador->tstelefone)));
            $tomadores['telefone'] = self::monta_string($tomadores['telefone'],12);
        }
        if ($tomador->pscnae) {
            $tomadores['cnae'] = strtoupper(str_replace(array(".", ",","(",")", "-", "/"), "",$tomador->pscnae));
            $tomadores['cnae'] = self::monta_string($tomadores['cnae'],7);
        }else{
            $tomadores['cnae'] = self::monta_string(' ',7);
        }
        if ($tomador->psresol) {
            $tomadores['recolimento'] = strtoupper(str_replace(array(".", ",","(",")", "-", "/"), "",$tomador->psresol));
            $tomadores['recolimento'] = self::monta_string($tomadores['recolimento'],3);
        }else{
            $tomadores['recolimento'] = self::monta_string(' ',3);
        }
        if ($tomador->psconfpas) {
            $tomadores['rat'] = strtoupper(str_replace(array(".", ",","(",")", "-", "/"), "",$tomador->psconfpas));
            $tomadores['rat'] = self::monta_string($tomadores['rat'],8);
        }else{
            $tomadores['rat'] = self::monta_string(' ',8);
        }
        
        if ($tomador->tssimples === 'Sim') {
            $tomadores['simples'] = "1";
        }else{
            $tomadores['simples'] = "0";
        }
        if ($tomador->psfpas) {
            $tomadores['fpas'] = strtoupper(str_replace(array(".", ",","(",")", "-", "/"), "",$tomador->psfpas));
            $tomadores['fpas'] = self::monta_string($tomadores['fpas'],3);
        }else{
            $tomadores['fpas'] = self::monta_string(' ',3);
        }

        
        if ($tomador->psfpasterceiros) {
            $tomadores['codterceiro'] = strtoupper(str_replace(array(".", ",","(",")", "-", "/"), "",$tomador->psfpasterceiros));
            $tomadores['codterceiro'] = self::monta_string($tomadores['codterceiro'],4);
        }else{
            $tomadores['codterceiro'] = self::monta_string(' ',4);
        }
        
        if ($tomador->psgrps) {
            $tomadores['codgrps'] = strtoupper(str_replace(array(".", ",","(",")", "-", "/"), "",$tomador->psgrps));
            $tomadores['codgrps'] = self::monta_string($tomadores['codgrps'],4);
        }else{
            $tomadores['codgrps'] = self::monta_string(' ',4);
        }

    
       $file_name = 'SEFIP.RE';
       $cd = '00'.self::monta_string(' ',51).'11'.$empresas['cnpj'].$empresas['nome'].$empresas['contator'];
       $cd.=$empresas['rua'].$empresas['bairro'].$empresas['cep'].$empresas['cidade'].$empresas['uf'];
       $cd .= $empresas['telefone'].$empresas['email'].$folhar['competencia'].$tomadores['recolimento'].'1'.self::monta_string(' ',25).'1'.$empresas['cnpj'].self::monta_string(' ',18)."*"."\r\n";


       $cd .= "101".$empresas['cnpj'].self::monta_zeros(35);
       $cd.=$tomadores['nome'].$tomadores['rua'].$tomadores['bairro'].$tomadores['cep'].$tomadores['cidade'].$tomadores['uf'];
       $cd.=$tomadores['telefone']."N".$tomadores['cnae']."P".$tomadores['rat']."1".$tomadores['simples'].$tomadores['fpas'].$tomadores['codterceiro'];
       $cd.= $tomadores['codgrps'].self::monta_string(' ',124)."*"."\r\n";

       $cd.="201".$empresas['cnpj']."1".$tomadores['cnpj'].self::monta_zeros(20);
       $cd .= $tomadores['nome'].$tomadores['rua'].$tomadores['bairro'].$tomadores['cep'].$tomadores['cidade'].$tomadores['uf'];
       $cd.= $tomadores['codgrps'].self::monta_zeros(145).self::monta_string(' ',16).'*'."\r\n";


       $cd .= "301".$empresas['cnpj']."1".$tomadores['cnpj'];
        foreach ($folhas as $key => $folha_valor) {
            if ($folha_valor->dspis) {
                $pistrabalhador = trim($folha_valor->dspis);
                $trabalhador['pis'] =  str_replace(array(".", ",", "-", "/"), "",self::monta_string($pistrabalhador,11));
                $cd .= $trabalhador['pis'];
            }
            if ($folha_valor->csadmissao) {
                $admissaotrabalhador = explode('-',$folha_valor->csadmissao);
                $trabalhador['admissao'] = $admissaotrabalhador[2].$admissaotrabalhador[1].$admissaotrabalhador[0];
                $cd .= $trabalhador['admissao'];
                $cd .= '02';
            }
            if ($folha_valor->tsnome) {
                $trabalhador['nome'] = strtoupper($folha_valor->tsnome);
                $trabalhador['nome'] = self::monta_string($trabalhador['nome'],70);
                $cd .= $trabalhador['nome'];
            }
            if ($folha_valor->tsmatricula) {
                $matriculatrabalhador = trim($folha_valor->tsmatricula);
                $trabalhador['matricula'] =  str_replace(array(".", ",", "-", "/"), "", self::monta_string($matriculatrabalhador,11));
                $cd .= $trabalhador['matricula'];
            }
            if ($folha_valor->dsctps) {
                $ctpstrabalhador = trim($folha_valor->dsctps);
                $trabalhador['ctps'] =  str_replace(array(".", ",", "-", "/"), "", self::monta_string($ctpstrabalhador,7));
                $cd .= $trabalhador['ctps'];
            }
            if ($folha_valor->dsserie) {
                $serietrabalhador = trim($folha_valor->dsserie);
                $trabalhador['serie'] =  str_replace(array(".", ",", "-", "/"), "", self::monta_string($serietrabalhador,5));
                $cd .= $trabalhador['serie'];
            }
            if ($folha_valor->csafastamento) {
                $afastamentotrabalhador = explode('-',$folha_valor->csafastamento);
                $trabalhador['afastamento'] = $afastamentotrabalhador[2].$afastamentotrabalhador[1].$afastamentotrabalhador[0];
                $cd .= self::monta_string($trabalhador['afastamento'],8);
            }else{
                $cd .= self::monta_string(' ',8);
            }
            if ($folha_valor->nsnascimento) {
                $nastrabalhador = explode('-',$folha_valor->nsnascimento);
                $trabalhador['nascimento'] = $nastrabalhador[2].$nastrabalhador[1].$nastrabalhador[0];
                $cd .= self::monta_string($trabalhador['nascimento'],8);
            }else{
                $cd .= self::monta_string(' ',8);
            }
            if ($folha_valor->cbo) {
                $cbotrabalhador = explode('-',$folha_valor->cbo);
                $cbotrabalhador = trim($cbotrabalhador[0]);
                $trabalhador['cbo'] =  str_replace(array(".", ",", "-", "/"), "", self::monta_string($cbotrabalhador,5));
                $cd .= $trabalhador['cbo'];
            }
            
            $vlrsem13 = $this->valorcalculo->sefipInss($folha_valor->id,1009);
            if ($vlrsem13->vivencimento) {
                $vlrsem13trabalhador = trim($folha_valor->biservicodsr + $vlrsem13->vivencimento);
                $trabalhador['13sem'] =  str_replace(array(".", ",", "-", "/"), "", $vlrsem13trabalhador);
                $trabalhador['13sem'] = self::monta_string($trabalhador['13sem'],13);
                $cd .= $trabalhador['13sem'];
            }
            $vlr13 = $this->valorcalculo->sefipInss($folha_valor->id,1010);
            if ($vlr13->vivencimento) {
                $vlr13trabalhador = trim($vlr13->vivencimento);
                $trabalhador['13sal'] =  str_replace(array(".", ",", "-", "/"), "", $vlr13trabalhador);
                $trabalhador['13sal'] = self::monta_string($trabalhador['13sal'],13);
                $cd .= $trabalhador['13sal'];
                $cd .= self::monta_string(' ',4);
            }
            $inss = $this->valorcalculo->sefipInss($folha_valor->id,2001);
        
            if ($inss->videscinto) {
                $insstrabalhador = trim($inss->videscinto);
                $trabalhador['inss'] =  str_replace(array(".", ",", "-", "/"), "", $insstrabalhador);
                $trabalhador['inss'] = self::monta_string($trabalhador['inss'],13);
                $cd .= $trabalhador['inss'];
            }
            if ($folha_valor->biservicodsr) {
                $baseinsstrabalhador = trim($folha_valor->biservicodsr);
                $trabalhador['base13'] =  str_replace(array(".", ",", "-", "/"), "", $baseinsstrabalhador);
                $cd .= self::monta_string($trabalhador['base13'],13);
            }

            $inss_sal13 = $this->valorcalculo->sefipInss($folha_valor->id,2002);
            
            if ($inss_sal13->videscinto) {
                $inss_sal13trabalhador = trim($inss_sal13->videscinto);
                $trabalhador['inss_13sal'] =  str_replace(array(".", ",", "-", "/"), "", $inss_sal13trabalhador);
                $trabalhador['inss_13sal'] = self::monta_string($trabalhador['inss_13sal'],13);
                $cd .= $trabalhador['inss_13sal'];
            }
        }
        $cd .= self::monta_string(' ',25);
        $cd .= self::monta_zeros(97).'*'."\r\n";
        $cd .= '90999999999999999999999999999999999999999999999999999';
        $cd .= self::monta_string(' ',306)."*"; 
        
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
    } catch (\Throwable $th) {
        return redirect()->back()->withInput()->withErrors(['false'=>'Não foi porssivél gera o relatório.']);
    }
    
    }
    public function monta_string($nome,$quantidade)
    {
        $novonome = $nome;
        $nomeempresa = strlen($nome);
        if ($nomeempresa < $quantidade) {
            $contador = $quantidade - $nomeempresa;
            for ($i=0; $i < $contador ; $i++) { 
                $novonome .= ' ';
            }
        }
        return $novonome;
    }
    public function monta_zeros($valor)
    {
        $novonome = '0';
        for ($i=0; $i < $valor; $i++) { 
            $novonome .= '0';
        }
        return $novonome;
    }
}
