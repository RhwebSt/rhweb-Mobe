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
        'cep'=>'',
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
        'afastamento'=>'',
        'nascimento'=>'',
        'cbo'=>'',
        'inss'=>'',
        '13sal'=>'',
        'base13'=>'',
        'inss_13sal'=>''
       ];
       if ($empresa->escnpj) {
           $cnpjempresa = trim($empresa->escnpj);
           $empresas['cnpj'] =  str_replace(array(".", ",", "-", "/"), "", $cnpjempresa);
       }
        if ($empresa->escep) {
            $cepempresa = trim($empresa->escep);
            $empresas['cep'] =  str_replace(array(".", ",", "-", "/"), "", $cepempresa);
        }
       if ($empresa->esnome) {
           $empresas['nome'] = strtoupper($empresa->esnome);
           $empresas['nome'] = self::monta_string($empresas['nome'],30);
       }
       if ($competencia->fscompetencia) {
            $competencia =  explode('-',$competencia->fscompetencia);
            $folhar['competencia'] = $competencia[1].$competencia[0];
            $folhar['competencia'] = self::monta_string($folhar['competencia'],6);
        }
       if ($empresa->eslogradouro) {
            $empresas['rua'] = strtoupper($empresa->eslogradouro);
            $empresas['rua'] = self::monta_string($empresas['rua'],50);
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
            $empresas['telefone'] = strtoupper(str_replace(array(".", ",","(",")", "-", "/"), "",$empresa->estelefone));
            $empresas['telefone'] = self::monta_string($empresas['telefone'],12);
        }
        if ($empresa->esemail) {
            $empresas['email'] = strtoupper($empresa->esemail);
            $empresas['email'] = self::monta_string($empresas['email'],60);
        }

        if ($tomador->escep) {
            $ceptomador = trim($tomador->escep);
            $tomadores['cep'] =  str_replace(array(".", ",", "-", "/"), "", $ceptomador);
        }
        if ($tomador->tscnpj) {
            $cnpjtomador = trim($tomador->tscnpj);
            $tomadores['cnpj'] =  str_replace(array(".", ",", "-", "/"), "", $cnpjtomador);
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
            $tomadores['cidade'] = strtoupper($tomador->esmunicipio);
            $tomadores['cidade'] = self::monta_string($tomadores['cidade'],20);
        }
        if ($tomador->tstelefone) {
            $tomadores['telefone'] = strtoupper(str_replace(array(".", ",","(",")", "-", "/"), "",$tomador->tstelefone));
            $tomadores['telefone'] = self::monta_string($tomadores['telefone'],12);
        }
        if ($tomador->pscnae) {
            $tomadores['cnae'] = strtoupper(str_replace(array(".", ",","(",")", "-", "/"), "",$tomador->pscnae));
            $tomadores['cnae'] = self::monta_string($tomadores['cnae'],7);
        }else{
            $tomadores['cnae'] = self::monta_string(' ',7);
        }
        if ($tomador->psconfpas) {
            $tomadores['rat'] = strtoupper(str_replace(array(".", ",","(",")", "-", "/"), "",$tomador->psconfpas));
            $tomadores['rat'] = self::monta_string($tomadores['rat'],7);
        }else{
            $tomadores['rat'] = self::monta_string(' ',7);
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
            $tomadores['fpas'] = self::monta_string(' ',7);
        }
        if ($tomador->psfpasterceiros) {
            $tomadores['codterceiro'] = strtoupper(str_replace(array(".", ",","(",")", "-", "/"), "",$tomador->psfpasterceiros));
            $tomadores['codterceiro'] = self::monta_string($tomadores['codterceiro'],3);
        }else{
            $tomadores['codterceiro'] = self::monta_string(' ',7);
        }
        if ($tomador->psgrps) {
            $tomadores['codgrps'] = strtoupper(str_replace(array(".", ",","(",")", "-", "/"), "",$tomador->psgrps));
            $tomadores['codgrps'] = self::monta_string($tomadores['codgrps'],3);
        }else{
            $tomadores['codgrps'] = self::monta_string(' ',7);
        }

        
       $file_name = 'dados.txt';
       $cd = '00                                                   11'.$empresas['cnpj'].$empresas['nome'];
       $cd.=$empresas['rua'].$empresas['bairro'].$empresas['cep'].$empresas['uf'];
       $cd .= $empresas['telefone'].$empresas['email'].$folhar['competencia'].self::monta_string(' ',29).$empresas['cnpj'].'11'.self::monta_string(' ',10)."*\n";
       $cd .= "101".$empresas['cnpj'].'00000000000000000000000000000000000';
       $cd.=$tomadores['nome'].$tomadores['rua'].$tomadores['bairro'].$tomadores['cep'].$tomadores['cidade'].$tomadores['uf'];
       $cd.=$tomadores['telefone']."N".$tomadores['cnae'].$tomadores['rat']."1".$tomadores['simples'].$tomadores['fpas'].$tomadores['codterceiro'];
       $cd.= $tomadores['codgrps'].self::monta_string(' ',119)."*"."\n";
       $cd.="201".$empresas['cnpj']."1".$tomadores['cnpj']."000000000000000000000";
       $cd .= $tomadores['nome'].$tomadores['rua'].$tomadores['bairro'].$tomadores['cep'].$tomadores['cidade'].$tomadores['uf'];
       $cd.= $tomadores['codgrps'].'0000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000*'."\n";
       $cd .= "301".$empresas['cnpj']."1".$tomadores['cnpj'];
        foreach ($folhas as $key => $folha_valor) {
            if ($folha_valor->dspis) {
                $pistrabalhador = trim($folha_valor->dspis);
                $trabalhador['pis'] =  str_replace(array(".", ",", "-", "/"), "", $pistrabalhador);
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
                $trabalhador['matricula'] =  str_replace(array(".", ",", "-", "/"), "", $matriculatrabalhador);
                $cd .= $trabalhador['matricula'];
            }
            if ($folha_valor->dsctps) {
                $ctpstrabalhador = trim($folha_valor->dsctps);
                $trabalhador['ctps'] =  str_replace(array(".", ",", "-", "/"), "", $ctpstrabalhador);
                $cd .= $trabalhador['ctps'];
            }
            if ($folha_valor->csafastamento) {
                $afastamentotrabalhador = explode('-',$folha_valor->csafastamento);
                $trabalhador['afastamento'] = $afastamentotrabalhador[2].$afastamentotrabalhador[1].$afastamentotrabalhador[0];
                $cd .= $trabalhador['afastamento'];
            }else{
                $cd .= self::monta_string(' ',8);
            }
            if ($folha_valor->nsnascimento) {
                $nastrabalhador = explode('-',$folha_valor->nsnascimento);
                $trabalhador['nascimento'] = $nastrabalhador[2].$nastrabalhador[1].$nastrabalhador[0];
                $cd .= $trabalhador['nascimento'];
            }
            if ($folha_valor->cbo) {
                $cbotrabalhador = explode('-',$folha_valor->cbo);
                $cbotrabalhador = trim($cbotrabalhador[0]);
                $trabalhador['cbo'] =  str_replace(array(".", ",", "-", "/"), "", $cbotrabalhador);
                $cd .= $trabalhador['cbo'];
            }
            $inss = $this->valorcalculo->sefipInss($folha_valor->id,2001);
            if ($inss->videscinto) {
                $insstrabalhador = trim($inss->videscinto);
                $trabalhador['inss'] =  str_replace(array(".", ",", "-", "/"), "", $insstrabalhador);
                $trabalhador['inss'] = self::monta_string($trabalhador['inss'],13);
                $cd .= $trabalhador['inss'];
            }
            $sal13 = $this->valorcalculo->sefipInss($folha_valor->id,1010);
            if ($sal13->videscinto) {
                $sal13trabalhador = trim($sal13->videscinto);
                $trabalhador['13sal'] =  str_replace(array(".", ",", "-", "/"), "", $sal13trabalhador);
                $trabalhador['13sal'] = self::monta_string($trabalhador['13sal'],13);
                $cd .= $trabalhador['13sal'];
                $cd .= self::monta_string(' ',4);
            }
            if ($folha_valor->biinss) {
                $baseinsstrabalhador = trim($folha_valor->biinss);
                $trabalhador['base13'] =  str_replace(array(".", ",", "-", "/"), "", $baseinsstrabalhador);
                $cd .= $trabalhador['base13'];
            }

            $inss_sal13 = $this->valorcalculo->sefipInss($folha_valor->id,2002);
            if ($inss_sal13->videscinto) {
                $inss_sal13trabalhador = trim($inss_sal13->videscinto);
                $trabalhador['inss_13sal'] =  str_replace(array(".", ",", "-", "/"), "", $inss_sal13trabalhador);
                // $trabalhador['inss_13sal'] = self::monta_string($trabalhador['inss_13sal']);
                $cd .= $trabalhador['inss_13sal'];
            }
        }
        $cd .= '00000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000*'."\n";
        $cd .= '9099999999999999999999999999999999999999999999999999999'."\n";
        $cd .= self::monta_string(' ',306)."*"; 
       $file = fopen( $file_name, "w" );
       fputs($file, $cd);
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
    // return response()->download(public_path().'/public/'.$file_name);
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
}
