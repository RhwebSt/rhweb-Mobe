<?php

namespace App\Http\Controllers\Sefip;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Tomador;
use App\Empresa;
use App\Folhar;
use App\BaseCalculo;
use App\ValorCalculo;
use App\Trabalhador;
class SefipController extends Controller
{
    private $tomador,$empresa,$folhar,$valorcalculo,$basecalculo,$trabalhador;
    public function __construct()
    {
        $this->tomador = new Tomador;
        $this->empresa = new Empresa;
        $this->folhar = new Folhar;
        $this->valorcalculo = new ValorCalculo;
        $this->basecalculo = new BaseCalculo;
        $this->trabalhador = new Trabalhador;
    }
    public function geraTxt($tomador,$folhar,$empresa)
    {
       $user = auth()->user();
       $tomador = base64_decode($tomador);
       $folhar = base64_decode($folhar);
       $empresa = base64_decode($empresa);
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
       $sefip = $this->basecalculo->where([
           ['folhar_id',$folhar],
           ['tomador_id',$tomador]
        ])
        ->with(['folhar.empresa.endereco','tomador.endereco','tomador.parametrosefip'])
        ->first(); 
        $basecalculos =  $this->basecalculo->where([
            ['folhar_id',$folhar],
            ['tomador_id',$tomador]
         ])
         //->with(['trabalhador.endereco','trabalhador.documento','trabalhador.categoria','trabalhador.nascimento','trabalhador.valorcalculo'])
         ->get();
         $idtrabalhadores = [];
         foreach ($basecalculos as $key => $id) {
            array_push($idtrabalhadores,$id->trabalhador_id);
         }  
        
        $trabalhador = DB::table('trabalhadors')
            ->join('documentos', 'trabalhadors.id', '=', 'documentos.trabalhador_id')
            ->join('nascimentos', 'trabalhadors.id', '=', 'nascimentos.trabalhador_id')
            ->join('categorias', 'trabalhadors.id', '=', 'categorias.trabalhador_id')
            ->join('bancarios', 'trabalhadors.id', '=', 'bancarios.trabalhador_id')
            ->select(
                'trabalhadors.*', 
                'documentos.*', 
                'bancarios.*',
                'categorias.*',
                'nascimentos.*',
            )
            ->whereIn('trabalhadors.id',$idtrabalhadores)
            ->orderBy('documentos.dspis','ASC')
            ->get();
            // dd($idtrabalhadores, $trabalhador);
        //  dd($trabalhador);
         $file_name = 'SEFIP.RE';
         $cd = '00';
         for ($i=0; $i < 51 ; $i++) { 
             $cd .= ' ';
         }
         $cd .='11';
         $cnpj = str_replace(array(".", ",", "-", "/"), "",$sefip->folhar->empresa->escnpj);
         $cnpj = substr($cnpj,0,14);
         $cd .= $cnpj;
         $cnpj = strlen($cnpj);
         for ($i=0; $i < (14-$cnpj); $i++) { 
            $cd .= ' ';
         }
         $nome = strtr($sefip->folhar->empresa->esnome,$caracteres_sem_acento);
         $nome = substr($nome,0,30);
         $cd .= strtoupper($nome);
         $nome = strlen($nome);
         for ($i=0; $i < (30 - $nome); $i++) { 
            $cd .= ' ';
         }
         $responsavel = strtr($sefip->folhar->empresa->esresponsavel,$caracteres_sem_acento);
         $responsavel = substr($responsavel,0,20);
         $cd .= strtoupper($responsavel);
         $responsavel = strlen($responsavel);
         for ($i=0; $i < (20 - $responsavel); $i++) { 
            $cd .= ' ';
         }
         $rua = strtr($sefip->folhar->empresa->endereco[0]->eslogradouro,$caracteres_sem_acento);
         $rua = substr($rua,0,50);
         $cd .= strtoupper($rua);
         $rua = strlen($rua);
         
         for ($i=0; $i < (50 - $rua); $i++) { 
            $cd .= ' ';
         }

         $bairro = strtr($sefip->folhar->empresa->endereco[0]->esbairro,$caracteres_sem_acento);
         $bairro = substr($bairro,0,20);
         $cd .= strtoupper($bairro);
         $bairro = strlen($bairro);
         for ($i=0; $i < (20 - $bairro); $i++) { 
            $cd .= ' ';
         }
         $cep = str_replace(array(".", ",", "-", "/"), "",$sefip->folhar->empresa->endereco[0]->escep);
         $cep = substr($cep,0,8);
         $cd .= $cep;
         $cep = strlen($cep);
         for ($i=0; $i < (8-$cep); $i++) { 
            $cd .= ' ';
         }
         $cidade = substr($sefip->folhar->empresa->endereco[0]->esmunicipio,0,20);
         $cidade = strtr($cidade,$caracteres_sem_acento);
         $cd .= strtoupper($cidade);
         $cidade = strlen($cidade);
         for ($i=0; $i < (20 - $cidade); $i++) { 
            $cd .= ' ';
         }
         $uf = strtr($sefip->folhar->empresa->endereco[0]->esuf,$caracteres_sem_acento);
         $uf = substr($uf,0,2);
         $cd .= strtoupper($uf);
         $uf = strlen($uf);
         for ($i=0; $i < (2 - $uf); $i++) { 
            $cd .= ' ';
         }
         $telefone = str_replace(array(".", ",", "-", "/","(",")"," "), "",$sefip->folhar->empresa->estelefone);
         $tel =  $telefone;
         $cd .= substr($tel,0,2);
         $telefone = strlen($telefone);
         for ($i=0; $i < (12-$telefone); $i++) { 
            $cd .= '0';
         }
         $cd .= substr($tel,2,10);
         $email = substr($sefip->folhar->empresa->esemail,0,60);
         $cd .= strtoupper($email);
         $email = strlen($email);
         for ($i=0; $i < (60 - $email); $i++) { 
            $cd .= ' ';
         }
         $competencia = str_replace(array(".", ",", "-", "/"), "",$sefip->folhar->fscompetencia);
         $competencia = substr($competencia,0,6);
         $cd .= $competencia;
         $competencia = strlen($competencia);
         for ($i=0; $i < (6-$competencia); $i++) { 
            $cd .= ' ';
         }
         $rol = str_replace(array(".", ",", "-", "/"), "",$sefip->tomador->parametrosefip[0]->psresol);
         $rol = substr($rol,0,3);
         $cd .= $rol;
         $rol = strlen($rol);
         for ($i=0; $i < (3-$rol); $i++) { 
            $cd .= ' ';
         }
         $cd .= '1';
         for ($i=0; $i < 9; $i++) { 
            $cd .= ' ';
         }
         $cd .= '1';
         for ($i=0; $i < 15; $i++) { 
            $cd .= ' ';
         }
         $cd .= '1';
         $cnpj = str_replace(array(".", ",", "-", "/"), "",$sefip->folhar->empresa->escnpj);
         $cnpj = substr($cnpj,0,14);
         $cd .= $cnpj;
         $cnpj = strlen($cnpj);
         for ($i=0; $i < (14-$cnpj); $i++) { 
            $cd .= ' ';
         }
         for ($i=0; $i < 18; $i++) { 
            $cd .= ' ';
         }
         $cd .= "*"."\r\n";
         $cd .= '101';
        //  $cnpj = str_replace(array(".", ",", "-", "/"), "",$sefip->tomador->tscnpj);
        //  $cd .= $cnpj;
        //  $cnpj = strlen($cnpj);
        //  for ($i=0; $i < (14-$cnpj); $i++) { 
        //     $cd .= ' ';
        //  }
        $cnpj = str_replace(array(".", ",", "-", "/"), "",$sefip->folhar->empresa->escnpj);
        $cnpj = substr($cnpj,0,14);
        $cd .= $cnpj;
        $cnpj = strlen($cnpj);
        for ($i=0; $i < (14-$cnpj); $i++) { 
           $cd .= ' ';
        }
         for ($i=0; $i < 36; $i++) { 
            $cd .= '0';
         }
         $nome = strtr($sefip->tomador->tsnome,$caracteres_sem_acento);
        
         $nome = substr($nome,0,40);
         $cd .= strtoupper($nome);
         $nome = strlen($nome);
         for ($i=0; $i < (40 - $nome); $i++) { 
            $cd .= ' ';
         }
         $rua = strtr($sefip->tomador->endereco[0]->eslogradouro,$caracteres_sem_acento);
         $rua = str_replace(array(".", ",", "-", "/"), "",$rua);
         $rua = substr($rua,0,50);
         $cd .= strtoupper($rua);
         $rua = strlen($rua);
         
         for ($i=0; $i < (50 - $rua); $i++) { 
            $cd .= ' ';
         }
         $bairro = strtr($sefip->tomador->endereco[0]->esbairro,$caracteres_sem_acento);
         $bairro = substr($bairro,0,20);
         $cd .= strtoupper($bairro);
         $bairro = strlen($bairro);
         for ($i=0; $i < (20 - $bairro); $i++) { 
            $cd .= ' ';
         }
         $cep = str_replace(array(".", ",", "-", "/"), "",$sefip->tomador->endereco[0]->escep);
         $cep = substr($cep,0,8);
         $cd .= $cep;
         $cep = strlen($cep);
         for ($i=0; $i < (8-$cep); $i++) { 
            $cd .= ' ';
         }
         $cidade = strtr($sefip->tomador->endereco[0]->esmunicipio,$caracteres_sem_acento);
         $cidade = substr($cidade,0,20);
         $cd .= strtoupper($cidade);
         $cidade = strlen($cidade);
         for ($i=0; $i < (20 - $cidade); $i++) { 
            $cd .= ' ';
         }
         $uf = strtr($sefip->tomador->endereco[0]->esuf,$caracteres_sem_acento);
         $uf = substr($uf,0,2);
         $cd .= $uf;
         $uf = strlen($uf);
         for ($i=0; $i < (2 - $uf); $i++) { 
            $cd .= ' ';
         }
         $telefone = str_replace(array(".", ",", "-", "/","(",")"," "), "",$sefip->tomador->tstelefone);
         $telefone = substr($telefone,0,12);
         $cd .= $telefone;
         $telefone = strlen($telefone);
         for ($i=0; $i < (12-$telefone); $i++) { 
            $cd .= '0';
         }
         $cd .= 'N';
         $cnae = str_replace(array(".", ",", "-", "/"), "",$sefip->tomador->parametrosefip[0]->pscnae);
         $cnae = substr($cnae,0,7);
         $cd .= $cnae;
         $cnae = strlen($cnae);
         for ($i=0; $i < (7-$cnae); $i++) { 
            $cd .= ' ';
         }
         $cd .="P";
         $rat = str_replace(array(".", ",", "-", "/"), "",$sefip->tomador->parametrosefip[0]->psconfpas);
         $rat = substr($rat,0,3);
         $cd .= $rat;
         $rat = strlen($rat);
         for ($i=0; $i < (3-$rat); $i++) { 
            $cd .= '0';
         }
        //  $cd .='1';
         if ($sefip->tomador->tssimples === 'Sim') {
            $cd .= "1";
        }else{
            $cd.= "0";
        }
        $fpas = str_replace(array(".", ",", "-", "/"), "",$sefip->tomador->parametrosefip[0]->psfpas);
        $fpas = substr($fpas,0,3);
        $cd .= $fpas;
        $fpas = strlen($fpas);
        for ($i=0; $i < (3-$fpas); $i++) { 
           $cd .= ' ';
        }
        $pasterceiros = str_replace(array(".", ",", "-", "/"), "",$sefip->tomador->parametrosefip[0]->psfpasterceiros);
        $pasterceiros = substr($pasterceiros,0,4);
        $cd .= $pasterceiros;
        $pasterceiros = strlen($pasterceiros);
        for ($i=0; $i < (4-$pasterceiros); $i++) { 
           $cd .= ' ';
        }
        // $gtps = str_replace(array(".", ",", "-", "/"), "",$sefip->tomador->parametrosefip[0]->psgrps);
        // $cd .= $gtps;
        // $gtps = strlen($gtps);
        // for ($i=0; $i < (4-$gtps); $i++) { 
        //    $cd .= ' ';
        // }
        for ($i=0; $i < 9; $i++) { 
            $cd .= ' ';
         }
        for ($i=0; $i < 60; $i++) { 
            $cd .= '0';
         }
         for ($i=0; $i < 16; $i++) { 
            $cd .= ' ';
         }
         for ($i=0; $i < 45; $i++) { 
            $cd .= '0';
         }
         for ($i=0; $i < 4; $i++) { 
            $cd .= ' ';
         }

         $cd .= "*"."\r\n";
         $cd .= '201';
         $cnpj = str_replace(array(".", ",", "-", "/"), "",$sefip->folhar->empresa->escnpj);
         $cnpj = substr($cnpj,0,14);
         $cd .= $cnpj;
         $cnpj = strlen($cnpj);
         for ($i=0; $i < (14-$cnpj); $i++) { 
            $cd .= ' ';
         }
         $cd .='1';
         $cnpj = str_replace(array(".", ",", "-", "/"), "",$sefip->tomador->tscnpj);
         $cnpj = substr($cnpj,0,14);
         $cd .= $cnpj;
         $cnpj = strlen($cnpj);
         for ($i=0; $i < (14-$cnpj); $i++) { 
            $cd .= ' ';
         }
         for ($i=0; $i < 21; $i++) { 
            $cd .= '0';
         }
         $nome = strtr($sefip->tomador->tsnome,$caracteres_sem_acento);
        
         $nome = substr($nome,0,40);
         $cd .= strtoupper($nome);
         $nome = strlen($nome);
         for ($i=0; $i < (40 - $nome); $i++) { 
            $cd .= ' ';
         }
         $rua = strtr($sefip->tomador->endereco[0]->eslogradouro,$caracteres_sem_acento);
         $rua = str_replace(array(".", ",", "-", "/"), "",$rua);
         $rua = substr($rua,0,50);
         $cd .= strtoupper($rua);
         $rua = strlen($rua);
         
         for ($i=0; $i < (50 - $rua); $i++) { 
            $cd .= ' ';
         }
         $bairro = strtr($sefip->tomador->endereco[0]->esbairro,$caracteres_sem_acento);
         $bairro = substr($bairro,0,20);
         $cd .= strtoupper($bairro);
         $bairro = strlen($bairro);
         for ($i=0; $i < (20 - $bairro); $i++) { 
            $cd .= ' ';
         }
         
         
         $cep = str_replace(array(".", ",", "-", "/"), "",$sefip->tomador->endereco[0]->escep);
         $cep = substr($cep,0,8);
         $cd .= $cep;
         $cep = strlen($cep);
         for ($i=0; $i < (8-$cep); $i++) { 
            $cd .= ' ';
         }
         $cidade = strtr($sefip->tomador->endereco[0]->esmunicipio,$caracteres_sem_acento);
         $cidade = substr($cidade,0,20);
         $cd .= strtoupper($cidade);
         $cidade = strlen($cidade);
         for ($i=0; $i < (20 - $cidade); $i++) { 
            $cd .= ' ';
         }
         $uf = strtr($sefip->tomador->endereco[0]->esuf,$caracteres_sem_acento);
         $uf = substr($uf,0,2);
         $cd .= strtoupper($uf);
         $uf = strlen($uf);
         for ($i=0; $i < (2 - $uf); $i++) { 
            $cd .= ' ';
         }
         $gtps = str_replace(array(".", ",", "-", "/"), "",$sefip->tomador->parametrosefip[0]->psgrps);
         $gtps = substr($gtps,0,4);
         $cd .= $gtps;
         $gtps = strlen($gtps);
        for ($i=0; $i < (4-$gtps); $i++) { 
        $cd .= ' ';
        }
        for ($i=0; $i < 120; $i++) { 
            $cd .= '0';
         }
         for ($i=0; $i < 42; $i++) { 
            $cd .= ' ';
         }
         $cd .= "*"."\r\n";
         foreach ($trabalhador as $key => $trabalhadores) {
            $cd .= '301';
            $cnpj = str_replace(array(".", ",", "-", "/"), "",$sefip->folhar->empresa->escnpj);
            $cnpj = substr($cnpj,0,14);
            $cd .= $cnpj;
            $cnpj = strlen($cnpj);
            for ($i=0; $i < (14-$cnpj); $i++) { 
               $cd .= ' ';
            }
            $cd .='1';
            $cnpj = str_replace(array(".", ",", "-", "/"), "",$sefip->tomador->tscnpj);
            $cnpj = substr($cnpj,0,14);
            $cd .= $cnpj;
            $cnpj = strlen($cnpj);
            for ($i=0; $i < (14-$cnpj); $i++) { 
               $cd .= ' ';
            }
            $pis = str_replace(array(".", ",", "-", "/"), "",$trabalhadores->dspis);
            $pis = substr($pis,0,11);
            $cd .= $pis;
            $pis = strlen($pis);
            for ($i=0; $i < (11-$pis); $i++) { 
               $cd .= ' ';
            }
            // $admissao = date('d-m-Y',strtotime($trabalhadores->trabalhador->categoria[0]->csadmissao));
            // $admissao = str_replace(array(".", ",", "-", "/"), "",$admissao);
            // $cd .= $admissao;
            // $admissao = strlen($admissao);
            for ($i=0; $i < 8; $i++) { 
               $cd .= ' ';
            }
            // $categoria = substr($trabalhadores->trabalhador->categoria[0]->cscategoria,0,2);
            // $cd .= $categoria;
            // $categoria = strlen($categoria);
            // for ($i=0; $i < (2-$categoria); $i++) { 
            //    $cd .= ' ';
            // }
            $cd .= '02';
            $nome = strtr($trabalhadores->tsnome,$caracteres_sem_acento);
            $nome = substr($nome,0,70);
            $cd .= strtoupper($nome);
            $nome = strlen($nome);
            for ($i=0; $i < (70 - $nome); $i++) { 
               $cd .= ' ';
            }
            $matriculatrabalhador = substr(str_replace(array(".", ",", "-", "/"), "",$trabalhadores->tsmatricula),0,11);
            $matriculatrabalhador = substr($matriculatrabalhador,0,11);
            $matriculaquant = strlen($matriculatrabalhador);
            for ($i=0; $i < (11 - $matriculaquant); $i++) { 
               $cd .= '0';
            }
           
            $cd .= $matriculatrabalhador;
            $ctps = str_replace(array(".", ",", "-", "/"), "",$trabalhadores->dsctps);
            $ctps = substr($ctps,0,7);
            $ctpsquant = strlen($ctps);
            for ($i=0; $i < (7-$ctpsquant); $i++) { 
               $cd .= '0';
            }
            $cd .= $ctps;
            $serie = str_replace(array(".", ",", "-", "/"), "",$trabalhadores->dsserie);
            $serie = substr($serie,0,5);
            $seriequant = strlen($serie);
            for ($i=0; $i < (5-$seriequant); $i++) { 
               $cd .= '0';
            }
            $cd .= $serie;
            // if ($trabalhadores->trabalhador->categoria[0]->csafastamento) {
            //     $afastamento = str_replace(array(".", ",", "-", "/"), "",$trabalhadores->trabalhador->categoria[0]->csafastamento);
            //     $cd .= $afastamento;
            //     $afastamento = strlen($afastamento);
            //     for ($i=0; $i < (8-$afastamento); $i++) { 
            //        $cd .= '0';
            //     }
            // } else {
            //     for ($i=0; $i < 8; $i++) { 
            //         $cd .= '0';
            //      }
            // }
            
            $afastamento = str_replace(array(".", ",", "-", "/"), "",$trabalhadores->csafastamento);
            $afastamento = substr($afastamento,0,8);
            $cd .= $afastamento;
            $afastamento = strlen($afastamento);
            for ($i=0; $i < (8-$afastamento); $i++) { 
               $cd .= ' ';
            }
            $nascimento = str_replace(array(".", ",", "-", "/"), "",date('d-m-Y', strtotime($trabalhadores->nsnascimento)));
            $nascimento = substr($nascimento,0,8);
            $cd .= $nascimento;
            $nascimento = strlen($nascimento);
            for ($i=0; $i < (8-$nascimento); $i++) { 
               $cd .= ' ';
            }
            $cbo = substr($trabalhadores->cbo,0,5);
            $cbo = str_replace(array(".", ",", "-", "/"), "",$cbo);
            $cboquant = strlen($cbo);
            for ($i=0; $i < (5-$cboquant); $i++) { 
               $cd .= '0';
            }
            $cd .= $cbo;
           
            // foreach ($trabalhadores->trabalhador->valorcalculo as $key => $valorcalculo) {
            //     if ($valorcalculo->vicodigo == 1009) {
            //         $soma = $valorcalculo->vivencimento + $trabalhadores->biservicodsr;
            //     }
            // }
            $soma = 0;
            // foreach ($basecalculo as $key => $id) {
                
            //     if ($id->trabalhador_id == $trabalhadores->id) {
            //         $soma = $id->biinss;
            //     }
            // }
            $basecalculo =  $this->basecalculo->where([
                ['folhar_id',$folhar],
                ['tomador_id',$tomador],
                ['trabalhador_id',$trabalhadores->trabalhador_id]
             ])
             ->with(['trabalhador.valorcalculo'])
             ->first();
            //  if (!isset($basecalculo->biinss)) {
            //     dd($trabalhadores->tsnome,$basecalculo,$trabalhadores->id);
            //  }
            $soma = $basecalculo->biinss;
            $soma = (string)sprintf('%.2f',$soma);
            $soma = str_replace(array(".", ",", "-", "/"), "",$soma); 
            $soma = substr($soma,0,15);
            $somaquant = strlen($soma);
            for ($i=0; $i < (15-$somaquant); $i++) { 
               $cd .= '0';
            }
            $cd .= $soma;
           
            $soma = 0;
            foreach ($basecalculo->trabalhador->valorcalculo as $key => $valorcalculo) {
                if ($valorcalculo->vicodigo == 1010) {
                    $soma = $valorcalculo->vivencimento;
                }
            }
            $soma = (string)sprintf('%.2f',$soma);
            $soma = str_replace(array(".", ",", "-", "/"), "",$soma);
            $soma = substr($soma,0,15);
            $somaquant = strlen($soma);
            for ($i=0; $i < (15-$somaquant); $i++) { 
               $cd .= '0';
            }
            $cd .= $soma;
            for ($i=0; $i < 4; $i++) { 
                $cd .= ' ';
             }
             $soma = 0;
            foreach ($basecalculo->trabalhador->valorcalculo as $key => $valorcalculo) {
                if ($valorcalculo->vicodigo == 2001) {
                    $inssvalor = $valorcalculo->videscinto;
                }
            }
            foreach ($basecalculo->trabalhador->valorcalculo as $key => $valorcalculo) {
                if ($valorcalculo->vicodigo == 2002) {
                    $decimo = $valorcalculo->videscinto;
                }
            }
           
           
           
            $soma = $inssvalor + $decimo;
            $soma = (string)sprintf('%.2f',$soma);
            $soma = str_replace(array(".", ",", "-", "/"), "",$soma); 
            $soma = substr($soma,0,15);
            $somaquant = strlen($soma);
            for ($i=0; $i < (15-$somaquant); $i++) { 
               $cd .= '0';
            }
            $cd .= $soma;
            for ($i=0; $i < 15; $i++) { 
                $cd .= '0';
             }
             $soma = 0;
            foreach ($basecalculo->trabalhador->valorcalculo as $key => $valorcalculo) {
                if ($valorcalculo->vicodigo == 1010) {
                    $soma = $valorcalculo->vivencimento;
                }
            }
           
            $soma = (string)sprintf('%.2f',$soma);
            $soma = str_replace(array(".", ",", "-", "/"), "",$soma);
            $soma = substr($soma,0,15);
            $somaquant = strlen($soma);
            for ($i=0; $i < (15-$somaquant); $i++) { 
               $cd .= '0';
            }
            $cd .= $soma;
            for ($i=0; $i < 15; $i++) { 
                $cd .= '0';
             }
            for ($i=0; $i < 98; $i++) { 
                $cd .= ' ';
             }
            $cd .= "*"."\r\n";
         }
         $cd .= '90999999999999999999999999999999999999999999999999999';
         for ($i=0; $i < 306; $i++) { 
            $cd .= ' ';
         }
         $cd .= "*";
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
        // dd($sefip,$trabalhador);
       $empresa = $this->empresa->EmpresaSefip($empresa);
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
            $tomadores['rat'] = number_format((float)$tomador->psconfpas, 1, '', '.');
            $tomadores['rat'] = self::monta_string($tomadores['rat'],2);
        }else{
            $tomadores['rat'] = self::monta_string(' ',2);
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
       $cd .= $empresas['telefone'].$empresas['email'].$folhar['competencia'].$tomadores['recolimento'].'1'.self::monta_string(' ',9).'1'.self::monta_string(' ',15).'1'.$empresas['cnpj'].self::monta_string(' ',18)."*"."\r\n";


       $cd .= "101".$empresas['cnpj'].self::monta_zeros(35);
       $cd.=$tomadores['nome'].$tomadores['rua'].$tomadores['bairro'].$tomadores['cep'].$tomadores['cidade'].$tomadores['uf'];
       $cd.=$tomadores['telefone']."N".$tomadores['cnae']."P".$tomadores['rat']."0".$tomadores['simples'].$tomadores['fpas'].$tomadores['codterceiro'];
    //    $cd.= $tomadores['codgrps'];
       $cd .= '         000000000000000000000000000000000000000000000000000000000000                000000000000000000000000000000000000000000000    *'."\r\n";

       $cd.="201".$empresas['cnpj']."1".$tomadores['cnpj'].self::monta_zeros(20);
       $cd .= $tomadores['nome'].$tomadores['rua'].$tomadores['bairro'].$tomadores['cep'].$tomadores['cidade'].$tomadores['uf'];
       $cd.= $tomadores['codgrps'];
       $cd.='000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000                                          *'."\r\n";


      
        foreach ($folhas as $key => $folha_valor) {
            $cd .= "301".$empresas['cnpj']."1".$tomadores['cnpj'];
            if ($folha_valor->dspis) {
                $pistrabalhador = trim($folha_valor->dspis);
                $trabalhador['pis'] =  str_replace(array(".", ",", "-", "/"), "",self::monta_string($pistrabalhador,11));
                $cd .= $trabalhador['pis'];
            }
            if ($folha_valor->csadmissao) {
                // $admissaotrabalhador = explode('-',$folha_valor->csadmissao);
                // $trabalhador['admissao'] = $admissaotrabalhador[2].$admissaotrabalhador[1].$admissaotrabalhador[0];
                $cd .= '        ';
                $cd .= '02';
            }
            if ($folha_valor->tsnome) {
                $trabalhador['nome'] = strtoupper($folha_valor->tsnome);
                $trabalhador['nome'] = self::monta_string($trabalhador['nome'],70);
                $cd .= $trabalhador['nome'];
            }
            if ($folha_valor->tsmatricula) {
                $matriculatrabalhador = trim($folha_valor->tsmatricula);
                $trabalhador['matricula'] =  str_replace(array(".", ",", "-", "/"), "", self::monta_inteiro($matriculatrabalhador,11,'esquerda'));
                $cd .= $trabalhador['matricula'];
            }
            if ($folha_valor->dsctps) {
                $ctpstrabalhador = trim($folha_valor->dsctps);
                $trabalhador['ctps'] =  str_replace(array(".", ",", "-", "/"), "", self::monta_string($ctpstrabalhador,7));
                $cd .= $trabalhador['ctps'];
            }
            if ($folha_valor->dsserie) {
                $serietrabalhador = trim($folha_valor->dsserie);
                $trabalhador['serie'] =  str_replace(array(".", ",", "-", "/"), "",self::monta_inteiro($serietrabalhador,5,'esquerda'));
                $cd .=  $trabalhador['serie'];
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
                $trabalhador['cbo'] =  str_replace(array(".", ",", "-", "/"), "", self::monta_inteiro($cbotrabalhador,5,'esquerda'));
                $cd .= $trabalhador['cbo'];
            }
            
            $vlrsem13 = $this->valorcalculo->sefipInss($folha_valor->id,1009);
            if ($vlrsem13->vivencimento) {
                $vlrsem13trabalhador = trim($folha_valor->biservicodsr + $vlrsem13->vivencimento);
                
                $trabalhador['13sem'] =  str_replace(array(".", ",", "-", "/"), "", $vlrsem13trabalhador);
                $trabalhador['13sem'] = self::monta_inteiro($trabalhador['13sem'],15,'esquerda');
                $cd .= $trabalhador['13sem'];
            }
            $vlr13 = $this->valorcalculo->sefipInss($folha_valor->id,1010);
            if ($vlr13->vivencimento) {
                $vlr13trabalhador = trim($vlr13->vivencimento);
                $trabalhador['13sal'] =  str_replace(array(".", ",", "-", "/"), "", $vlr13trabalhador);
                $trabalhador['13sal'] = self::monta_inteiro($trabalhador['13sal'],15,'esquerda');
                $cd .= $trabalhador['13sal'];
                $cd .= self::monta_string(' ',4);
            }
            
            $inss = $this->valorcalculo->sefipInss($folha_valor->id,2001);
            $inss_sal13 = $this->valorcalculo->sefipInss($folha_valor->id,2002);
            if ($inss->videscinto) {
                $insstrabalhador = trim($inss->videscinto + $inss_sal13->videscinto);
                $trabalhador['inss'] =  str_replace(array(".", ",", "-", "/"), "", $insstrabalhador);
                $trabalhador['inss'] = self::monta_inteiro($trabalhador['inss'],15,'esquerda');
                $cd .= $trabalhador['inss'];
                $cd .= self::monta_zeros(14);
            }
            
            if ($vlr13->vivencimento) {
                $vlr13trabalhador = trim($vlr13->vivencimento);
                $trabalhador['13sal'] =  str_replace(array(".", ",", "-", "/"), "", $vlr13trabalhador);
                $trabalhador['13sal'] = self::monta_inteiro($trabalhador['13sal'],15,'esquerda');
                $cd .= $trabalhador['13sal'];
                $cd .= self::monta_zeros(14);
            }
            // if ($folha_valor->biservicodsr) {
            //     $baseinsstrabalhador = trim($folha_valor->biservicodsr);
            //     $trabalhador['base13'] =  str_replace(array(".", ",", "-", "/"), "", $baseinsstrabalhador);
            //     $cd .= self::monta_inteiro($trabalhador['base13'],13,'esquerda');
            // }
            
            // $inss_sal13 = $this->valorcalculo->sefipInss($folha_valor->id,2002);
            
            // if ($inss_sal13->videscinto) {
            //     $inss_sal13trabalhador = trim($inss_sal13->videscinto);
            //     $trabalhador['inss_13sal'] =  str_replace(array(".", ",", "-", "/"), "", $inss_sal13trabalhador);
            //     $trabalhador['inss_13sal'] = self::monta_inteiro($trabalhador['inss_13sal'],13,'esquerda');
            //     $cd .= $trabalhador['inss_13sal'];
            // }
            $cd .= self::monta_string(' ',98).'*'."\r\n";
        }
        // $cd .= self::monta_string(' ',25);
        
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
       try {
    } catch (\Throwable $th) {
        return redirect()->back()->withInput()->withErrors(['false'=>'Não foi possível gerar o relatório.']);
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
    public function monta_zeros($valor)
    {
        $novonome = '0';
        for ($i=0; $i < $valor; $i++) { 
            $novonome .= '0';
        }
        return $novonome;
    }
}
