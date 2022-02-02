<?php

namespace App\Http\Controllers\CalculoFolha;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Trabalhador;
use App\Tomador;
use App\Empresa;
use App\Rublica;
use App\Lancamentorublica;
use App\Bolcartaoponto;
use App\Dependente;
use App\TabelaPreco;
use App\Inss;
use App\IncideFolhar;
use App\CartaoPonto;
use App\Irrf;
use App\ValorCalculo;
use App\ValoresRublica;
use App\Folhar;
use App\BaseCalculo;
use App\RelacaoDia;
use App\Descontos;
use PDF;
class calculoFolhaGeralController extends Controller
{
    public function calculoFolhaGeral($datainicio,$datafinal)
    {
        $folhar = new Folhar;
      
        $folhas = $folhar->verificaFolhar($datainicio,$datafinal);
        
        // if ($folhas) {
        //     return redirect()->route('calculo.folha.index')->withInput()->withErrors(['false'=>'Esta data e o número da folha já estão cadastrados.']);
        // }
        $ano = explode('-',$datafinal);
        $user = auth()->user();
         
        $dias = [];
        $trabalhado_cal_folha = [];
        $tomador_cal_folha = [];
        $tabelapreco_codigo = [];
        $numerofolhar = 0;
        $trabalhado = new Trabalhador;
        $empresa = new Empresa;
        $rublica = new Rublica;
        $depedente = new Dependente;
        $bolcartaoponto = new Bolcartaoponto;
        $lancamentorublica = new Lancamentorublica;   
        $tabelapreco = new TabelaPreco;
        $inss = new Inss;
        $irrf = new Irrf;
        $indecefolha = new IncideFolhar;
        $cartaoponto = new CartaoPonto;
        $tomador = new Tomador;
        $valoresrublica = new ValoresRublica;
        $basecalculo = new BaseCalculo;
        $valorcalculo = new ValorCalculo;
        $relacaodia = new RelacaoDia;
        $insslista = $inss->buscaUnidadeInss($ano[0]);
        $irrflista = $irrf->buscaListaIrrf($ano[0]);
        
        if (count($insslista) < 1) {
            return redirect()->back()->withErrors(['false'=>'O inss '.$ano[0].' não esta cadastrado. Entre em contator com suporte.']);
        }elseif (count($irrflista) < 1) {
            return redirect()->back()->withErrors(['false'=>'O irrf '.$ano[0].' não esta cadastrado. Entre em contator com suporte.']);
        }

        $rublicas = $rublica->buscaListaRublica(0);
        foreach ($rublicas as $key => $rublicas_valor) {
            if (!in_array($rublicas_valor->tsrubrica,$tabelapreco_codigo)) {
                array_push($tabelapreco_codigo,$rublicas_valor->rsrublica);
            }
        }
        $tomadores = $tomador->buscaListaTomador($user->empresa);
        $quantidadetomador = count($tomadores);
        foreach ($tomadores as $t => $tomador_id) {
            if (!in_array($tomador_id->id,$tomador_cal_folha)) {
                array_push($tomador_cal_folha,$tomador_id->id);
            }
            $funcionario = [];
            $cartaoponto_diarias = [
                'campos'=>[
                    'id'=>[],
                    'dia' => [],
                    'valor' => [],
                    'horas' => [],
                    'codigo'=>[],
                    'descricao' => []
                ],
                'horasNormais'=>[
                    'quantidade'=> 0,
                    'valor'=> 0
                ],
                'diariaNormais'=>[
                    'quantidade'=> 0,
                    'valor'=> 0
                ],
                'hora extra 50%'=>[
                    'quantidade'=> 0,
                    'valor'=> 0
                ],
                'hora extra 100%'=>[
                    'quantidade'=> 0,
                    'valor'=> 0
                ],
                'adicional noturno'=>[
                    'quantidade'=> 0,
                    'valor'=> 0
                ],
                'gratificação'=>[
                    'quantidade'=> 0,
                    'valor'=> 0
                ],
                'adiantamento'=>[
                    'quantidade'=> 0,
                    'valor'=> 0
                ]
            ];
            $boletim_tabela = [
                'campos'=>[
                    'id'=>[],
                    'dia' => [],
                    'rubrica' => [],
                    'valor' => [],
                    'quantidade' => [],
                    'codigo' => [],
                    'descricao' => []
                ],
                'horasNormais'=>[
                    'codigos'=>[],
                    'rublicas'=>[],
                    'quantidade'=> [],
                    'id'=>[],
                    'valor'=> []
                ],
                'diariaNormais'=>[
                    'codigos'=>[],
                    'rublicas'=>[],
                    'quantidade'=> [],
                    'id'=>[],
                    'valor'=> []
                ],
                'hora extra 50%'=>[
                    'codigos'=>[],
                    'rublicas'=>[],
                    'quantidade'=> [],
                    'id'=>[],
                    'valor'=> []
                ],
                'hora extra 100%'=>[
                    'codigos'=>[],
                    'rublicas'=>[],
                    'quantidade'=> [],
                    'id'=>[],
                    'valor'=> []
                ],
                'adicional noturno'=>[
                    'codigos'=>[],
                    'rublicas'=>[],
                    'quantidade'=> [],
                    'id'=>[],
                    'valor'=> []
                ],
                'gratificação'=>[
                    'codigos'=>[],
                    'rublicas'=>[],
                    'quantidade'=> [],
                    'id'=>[],
                    'valor'=> []
                ],
                'adiantamento'=>[
                    'codigos'=>[],
                    'rublicas'=>[],
                    'quantidade'=> [],
                    'valor'=> [],
                    'id'=>[],
                ],
                'producao'=>[
                    'codigos'=>[],
                    'rublicas'=>[],
                    'quantidade'=> [],
                    'valor'=> [],
                    'id'=>[],
                ],
                'salario'=>[
                    'id'=>[],
                    'valor'=>[]
                ],
                'dsr1818'=>[
                    'valor'=>[],
                    'codigos'=>[],
                    'quantidade'=> [],
                    'rublicas'=>[],
                    'valor'=> [],
                    'id'=>[],
                ],
                'serviso_dsr'=>[
                    'id'=>[],
                    'valor'=>[]
                ],
                'decimo_ter'=>[
                    'valor'=>[],
                    'codigos'=>[],
                    'quantidade'=> [],
                    'rublicas'=>[],
                    'valor'=> [],
                    'id'=>[],
                ],
                'ferias_decimoter'=>[
                    'valor'=>[],
                    'codigos'=>[],
                    'quantidade'=> [],
                    'rublicas'=>[],
                    'valor'=> [],
                    'id'=>[]
                ],
                'sindicator'=>[
                    'valor'=>[],
                    'codigos'=>[],
                    'quantidade'=> [],
                    'rublicas'=>[],
                    'valor'=> [],
                    'id'=>[]
                ],
                'seguro'=>[
                    'valor'=>[],
                    'codigos'=>[],
                    'quantidade'=> [],
                    'rublicas'=>[],
                    'valor'=> [],
                    'id'=>[]
                ],
                'valor_inss'=>[
                    'id'=>[],
                    'valor'=>[]
                ],
                'base_inss'=>[
                    'id'=>[],
                    'valor'=>[]
                ],
                'base_fgts'=>[
                    'id'=>[],
                    'valor'=>[]
                ],
                'fgts_mes'=>[
                    'id'=>[],
                    'valor'=>[]
                ],
                'base_irrf'=>[
                    'id'=>[],
                    'valor'=>[],
                ],
                'inss_sobre_ter'=>[
                    'valor'=>[],
                    'codigos'=>[],
                    'quantidade'=> [],
                    'rublicas'=>[],
                    'valor'=> [],
                    'id'=>[]
                ],
                'inss'=>[
                    'id'=>[],
                    'valorbase'=>[],
                    'rublicas'=>[],
                    'codigos'=>[],
                    'indece'=>[],
                    'resultadoinss'=>[]
                ],
                'vt'=>[
                    'id'=>[],
                    'valor'=>[],
                    'rublicas'=>[],
                    'codigos'=>[],
                    'quantidade'=>[]
                ],
                'va'=>[
                    'id'=>[],
                    'valor'=>[],
                    'rublicas'=>[],
                    'codigos'=>[],
                    'quantidade'=>[]
                ],
                'irrf'=>[
                    'id'=>[],
                    'valorbase'=>[],
                    'indece'=>[],
                    'resultadoinss'=>[]
                ],
                'vencimento'=>[
                    'id'=>[],
                    'valor'=>[],
                ],
                'desconto'=>[
                    'id'=>[],
                    'valor'=>[],
                ],
                'novodesconto'=>[
                    'id'=>[],
                    'valor'=>[]
                ],
                'relacaoproducaodia'=>[
                    'id'=>[],
                    'valor'=>[],
                    'dia'=>[],
                ]
                
            ];
            $dadosTrabalhador = [
                'id'=>[],
                'tomador_cartao_ponto_horas'=> 0,
                'total_vencimento'=>0,
                'tomador_cartao_ponto_quantidade'=>[],
                'tomador_cartao_ponto_vt'=>[],
                'tomador_cartao_ponto_va'=>[],
                'rublicas'=>[],
                'codigos'=>[]
            ];
            $valorfinal = [];
            $bolcartaopontos = $bolcartaoponto->buscaListaLancamentoBolcartao($tomador_id->id,$datainicio,$datafinal);
            $lancamentorublicas = $lancamentorublica->buscaListaLancamentoRublica($tomador_id->id,$datainicio,$datafinal);
            
            foreach ($bolcartaopontos as $key => $trabalhador) {
                array_push($funcionario,$trabalhador->trabalhador);
                array_push($trabalhado_cal_folha,$trabalhador->trabalhador);
            }
            foreach ($lancamentorublicas as $key => $trabalhador) {
                array_push($funcionario,$trabalhador->trabalhador);
                array_push($trabalhado_cal_folha,$trabalhador->trabalhador);
            }
            
            $trabalhadores = $trabalhado->listaTrabalhadorInt($funcionario);
            $tabelaprecos = $tabelapreco->buscaUnidadeTabelaRelatorio($tomador_id->id);
            $cartaopontos = $cartaoponto->buscaUnidadeTomador($tomador_id->id);
            $indecefolhas = $indecefolha->buscaUnidade_va_vt($tomador_id->id);
            $depedentes = $depedente->buscaListaDepedenteInt($funcionario);
            $sindicator = $empresa->buscaContribuicaoSidicato($user->empresa);
            $rublicas = $rublica->buscaListaRublica(0);
            
            foreach ($tabelaprecos as $key => $tabelapreco_valor) {
                if (!in_array($tabelapreco_valor->tsrubrica,$tabelapreco_codigo)) {
                    array_push($tabelapreco_codigo,$tabelapreco_valor->tsrubrica);
                }
            }
        
            foreach ($bolcartaopontos as $key => $bolcartaoponto_valor) {
                if ($bolcartaoponto_valor->created_at) {
                    $dia = explode('-',$bolcartaoponto_valor->created_at);
                    $dia = explode('-',$bolcartaoponto_valor->created_at);
                    $dia = explode(' ',$dia[2]);
                    foreach ($tabelaprecos as $key => $tabelapreco) {
                        if($tabelapreco->tsdescricao == 'hora extra 50%' && $bolcartaoponto_valor->bshoraex){
                            array_push($cartaoponto_diarias['campos']['codigo'],$tabelapreco->tsrubrica);
                            array_push($cartaoponto_diarias['campos']['id'],$bolcartaoponto_valor->trabalhador);
                            array_push($cartaoponto_diarias['campos']['dia'],$dia[0]);
                            array_push($cartaoponto_diarias['campos']['valor'],self::calculardia($bolcartaoponto_valor->bshoraex,$tabelapreco->tsvalor));
                            array_push($cartaoponto_diarias['campos']['descricao'],$tabelapreco->tsdescricao);
                            array_push($cartaoponto_diarias['campos']['horas'],self::calcularhoras($bolcartaoponto_valor->bshoraex));
                        }else if($tabelapreco->tsdescricao == 'hora extra 100%' && $bolcartaoponto_valor->bshoraexcem){
                            array_push($cartaoponto_diarias['campos']['codigo'],$tabelapreco->tsrubrica);
                            array_push($cartaoponto_diarias['campos']['id'],$bolcartaoponto_valor->trabalhador);
                            array_push($cartaoponto_diarias['campos']['dia'],$dia[0]);
                            array_push($cartaoponto_diarias['campos']['valor'],self::calculardia($bolcartaoponto_valor->bshoraexcem,$tabelapreco->tsvalor));
                            array_push($cartaoponto_diarias['campos']['descricao'],$tabelapreco->tsdescricao);
                            array_push($cartaoponto_diarias['campos']['horas'],self::calcularhoras($bolcartaoponto_valor->bshoraexcem));
                        }else if($tabelapreco->tsdescricao == 'hora normal' && $bolcartaoponto_valor->horas_normais){
                            array_push($cartaoponto_diarias['campos']['codigo'],$tabelapreco->tsrubrica);
                            array_push($cartaoponto_diarias['campos']['id'],$bolcartaoponto_valor->trabalhador);
                            array_push($cartaoponto_diarias['campos']['dia'],$dia[0]);
                            array_push($cartaoponto_diarias['campos']['valor'],self::calculardia($bolcartaoponto_valor->horas_normais,$tabelapreco->tsvalor));
                            array_push($cartaoponto_diarias['campos']['descricao'],$tabelapreco->tsdescricao);
                            array_push($cartaoponto_diarias['campos']['horas'],self::calcularhoras($bolcartaoponto_valor->horas_normais));
                        }else if($tabelapreco->tsdescricao == 'adicional noturno' && $bolcartaoponto_valor->bsadinortuno){
                            array_push($cartaoponto_diarias['campos']['codigo'],$tabelapreco->tsrubrica);
                            array_push($cartaoponto_diarias['campos']['id'],$bolcartaoponto_valor->trabalhador);
                            array_push($cartaoponto_diarias['campos']['dia'],$dia[0]);
                            array_push($cartaoponto_diarias['campos']['valor'],self::calculardia($bolcartaoponto_valor->bsadinortuno,$tabelapreco->tsvalor));
                            array_push($cartaoponto_diarias['campos']['descricao'],$tabelapreco->tsdescricao);
                            array_push($cartaoponto_diarias['campos']['horas'],self::calcularhoras($bolcartaoponto_valor->bsadinortuno));
                        }
                        // elseif ($tabelapreco->tsdescricao == 'adiantamento' && $tabelapreco->tsvalor) {
                        //     array_push($cartaoponto_diarias['campos']['codigo'],$tabelapreco->tsrubrica);
                        //     array_push($cartaoponto_diarias['campos']['valor'],$tabelapreco->tsvalor);
                        //     array_push($cartaoponto_diarias['campos']['descricao'],$tabelapreco->tsdescricao);
                        //     array_push($cartaoponto_diarias['campos']['horas'],1);
                        //     array_push($cartaoponto_diarias['campos']['dia'],$dia[0]);
                        //     array_push($cartaoponto_diarias['campos']['id'],$bolcartaoponto_valor->trabalhador);
                        //     // $total_desconto =  $boletim_tabela['adiantamento']['valor'];
                        // }
                    }
                }
            }
            
                foreach ($lancamentorublicas as $key => $lancamentorublica_valor) {
                    foreach ($tabelaprecos as $key => $tabelapreco) {
                        if ($lancamentorublica_valor->lsdescricao === $tabelapreco->tsdescricao) {
                            $dia = explode('-',$lancamentorublica_valor->created_at);
                            $dia = explode('-',$lancamentorublica_valor->created_at);
                            $dia = explode(' ',$dia[2]);
                            array_push($boletim_tabela['campos']['id'],$lancamentorublica_valor->trabalhador);
                            array_push($boletim_tabela['campos']['dia'],$dia[0]);
                            $vencimento =  self::calculovalores($lancamentorublica_valor->lsquantidade,$lancamentorublica_valor->lfvalor);
                            array_push($boletim_tabela['campos']['valor'], $vencimento);
                            array_push($boletim_tabela['campos']['rubrica'], $lancamentorublica_valor->lshistorico);
                            array_push($boletim_tabela['campos']['quantidade'], self::calcularhoras($lancamentorublica_valor->lsquantidade));
                            array_push($boletim_tabela['campos']['codigo'], $tabelapreco->tsrubrica);
                            array_push($boletim_tabela['campos']['descricao'], $tabelapreco->tsdescricao);
                        }
                    }
                }
            
            foreach ($trabalhadores as $i => $trabalhadores_id) {
                $boletim_valor = 0;
                foreach ($boletim_tabela['campos']['rubrica'] as $key => $boletim_tabelas) {
                    if ($boletim_tabelas === 'hora normal' && $boletim_tabela['campos']['id'][$key] === $trabalhadores_id->id) {
                        if (in_array($boletim_tabela['campos']['id'][$key],$boletim_tabela['horasNormais']['id']) && array_key_exists($key,$cartaoponto_diarias['campos']['valor'])) {
                            $boletim_tabela['horasNormais']['valor'][$i] += $cartaoponto_diarias['campos']['valor'][$key];
                            $boletim_tabela['horasNormais']['quantidade'][$i] += $cartaoponto_diarias['campos']['horas'][$key];
                        }else{
                            array_push($boletim_tabela['horasNormais']['quantidade'],$boletim_tabela['campos']['quantidade'][$key]);
                            array_push($boletim_tabela['horasNormais']['valor'],$boletim_tabela['campos']['valor'][$key]);
                            array_push($boletim_tabela['horasNormais']['id'],$boletim_tabela['campos']['id'][$key]);
                            array_push($boletim_tabela['horasNormais']['codigos'],$boletim_tabela['campos']['codigo'][$key]);
                            array_push($boletim_tabela['horasNormais']['rublicas'],$boletim_tabela['campos']['rubrica'][$key]);
                        }
                      
                    }elseif ($boletim_tabelas === 'hora extra 50%' && $boletim_tabela['campos']['id'][$key] === $trabalhadores_id->id) {
                       
                        if (in_array($boletim_tabela['campos']['id'][$key],$boletim_tabela['hora extra 50%']['id']) && array_key_exists($key,$cartaoponto_diarias['campos']['valor'])) {
                            $boletim_tabela['hora extra 50%']['valor'][$i] += $cartaoponto_diarias['campos']['valor'][$key];
                            $boletim_tabela['hora extra 50%']['quantidade'][$i] += $cartaoponto_diarias['campos']['horas'][$key];
                        }else{
                            array_push($boletim_tabela['hora extra 50%']['quantidade'],$boletim_tabela['campos']['quantidade'][$key]);
                            array_push($boletim_tabela['hora extra 50%']['valor'],$boletim_tabela['campos']['valor'][$key]);
                            array_push($boletim_tabela['hora extra 50%']['id'],$boletim_tabela['campos']['id'][$key]);
                            array_push($boletim_tabela['hora extra 50%']['codigos'],$boletim_tabela['campos']['codigo'][$key]);
                            array_push($boletim_tabela['hora extra 50%']['rublicas'],$boletim_tabela['campos']['rubrica'][$key]);
                        }
                    }elseif ($boletim_tabelas === 'hora extra 100%' && $boletim_tabela['campos']['id'][$key] === $trabalhadores_id->id) {
                        if (in_array($boletim_tabela['campos']['id'][$key],$boletim_tabela['hora extra 100%']['id']) && array_key_exists($key,$cartaoponto_diarias['campos']['valor'])) {
                            $boletim_tabela['hora extra 100%']['valor'][$i] += $cartaoponto_diarias['campos']['valor'][$key];
                            $boletim_tabela['hora extra 100%']['quantidade'][$i] += $cartaoponto_diarias['campos']['horas'][$key];
                        }else{
                            array_push($boletim_tabela['hora extra 100%']['quantidade'],$boletim_tabela['campos']['quantidade'][$key]);
                            array_push($boletim_tabela['hora extra 100%']['valor'],$boletim_tabela['campos']['valor'][$key]);
                            array_push($boletim_tabela['hora extra 100%']['id'],$boletim_tabela['campos']['id'][$key]);
                            array_push($boletim_tabela['hora extra 100%']['codigos'],$boletim_tabela['campos']['codigo'][$key]);
                            array_push($boletim_tabela['hora extra 100%']['rublicas'],$boletim_tabela['campos']['rubrica'][$key]);
                        }
                    }elseif($boletim_tabelas === 'adicional noturno' && $boletim_tabela['campos']['id'][$key] === $trabalhadores_id->id){
                        if (in_array($boletim_tabela['campos']['id'][$key],$boletim_tabela['adicional noturno']['id']) && array_key_exists($key,$cartaoponto_diarias['campos']['valor'])) {
                            $boletim_tabela['adicional noturno']['valor'][$i] += $cartaoponto_diarias['campos']['valor'][$key];
                            $boletim_tabela['adicional noturno']['quantidade'][$i] += $cartaoponto_diarias['campos']['horas'][$key];
                        }else{
                            array_push($boletim_tabela['adicional noturno']['quantidade'],$boletim_tabela['campos']['quantidade'][$key]);
                            array_push($boletim_tabela['adicional noturno']['valor'],$boletim_tabela['campos']['valor'][$key]);
                            array_push($boletim_tabela['adicional noturno']['id'],$boletim_tabela['campos']['id'][$key]);
                        }
                    }elseif ($boletim_tabelas === 'diaria normal' && $boletim_tabela['campos']['id'][$key] === $trabalhadores_id->id) {
                        if (in_array($boletim_tabela['campos']['id'][$key],$boletim_tabela['diariaNormais']['id']) && array_key_exists($key,$cartaoponto_diarias['campos']['valor'])) {
                            $boletim_tabela['diariaNormais']['valor'][$i] += $cartaoponto_diarias['campos']['valor'][$key];
                            $boletim_tabela['diariaNormais']['quantidade'][$i] += $cartaoponto_diarias['campos']['horas'][$key];
                        }else{
                            array_push($boletim_tabela['diariaNormais']['quantidade'],$boletim_tabela['campos']['quantidade'][$key]);
                            array_push($boletim_tabela['diariaNormais']['valor'],$boletim_tabela['campos']['valor'][$key]);
                            array_push($boletim_tabela['diariaNormais']['id'],$boletim_tabela['campos']['id'][$key]);
                            array_push($boletim_tabela['diariaNormais']['codigos'],$boletim_tabela['campos']['codigo'][$key]);
                            array_push($boletim_tabela['diariaNormais']['rublicas'],$boletim_tabela['campos']['rubrica'][$key]);
                        }
                    }elseif ($boletim_tabelas === 'gratificação' && $boletim_tabela['campos']['id'][$key] === $trabalhadores_id->id) {
                        if (in_array($boletim_tabela['campos']['id'][$key],$boletim_tabela['gratificação']['id']) && array_key_exists($key,$cartaoponto_diarias['campos']['valor'])) {
                            $boletim_tabela['gratificação']['valor'][$i] += $cartaoponto_diarias['campos']['valor'][$key];
                            $boletim_tabela['gratificação']['quantidade'][$i] += $cartaoponto_diarias['campos']['horas'][$key];
                        }else{
                            array_push($boletim_tabela['gratificação']['quantidade'],$boletim_tabela['campos']['quantidade'][$key]);
                            array_push($boletim_tabela['gratificação']['valor'],$boletim_tabela['campos']['valor'][$key]);
                            array_push($boletim_tabela['gratificação']['id'],$boletim_tabela['campos']['id'][$key]);
                            array_push($boletim_tabela['gratificação']['codigos'],$boletim_tabela['campos']['codigo'][$key]);
                            array_push($boletim_tabela['gratificação']['rublicas'],$boletim_tabela['campos']['rubrica'][$key]);
                            
                        }
                    }elseif($boletim_tabela['campos']['id'][$key] === $trabalhadores_id->id){
                            if (in_array($boletim_tabela['campos']['id'][$key],$boletim_tabela['producao']['id']) && array_key_exists($key,$cartaoponto_diarias['campos']['valor'])) {
                                $boletim_tabela['producao']['valor'][$i] += $boletim_tabela['campos']['valor'][$key];
                                $boletim_tabela['producao']['quantidade'][$i] += $boletim_tabela['campos']['quantidade'][$key];
                            }else{
                                array_push($boletim_tabela['producao']['quantidade'],$boletim_tabela['campos']['quantidade'][$key]);
                                array_push($boletim_tabela['producao']['valor'],$boletim_tabela['campos']['valor'][$key]);
                                array_push($boletim_tabela['producao']['id'],$boletim_tabela['campos']['id'][$key]);
                                array_push($boletim_tabela['producao']['codigos'],'1006');
                                array_push($boletim_tabela['producao']['rublicas'],'produção');
                            }
                          
                    }
                }
            }
        
            foreach ($trabalhadores as $i => $trabalhadores_id) {
                foreach ($cartaoponto_diarias['campos']['descricao'] as $key => $cartaopontos_descricao) {
                    if ($cartaopontos_descricao === 'hora normal' && $cartaoponto_diarias['campos']['id'][$key] === $trabalhadores_id->id) {
                        if (array_key_exists($i,$boletim_tabela['horasNormais']['valor'])) {
                            $boletim_tabela['horasNormais']['valor'][$i] += $cartaoponto_diarias['campos']['valor'][$key];
                            $boletim_tabela['horasNormais']['quantidade'][$i] += $cartaoponto_diarias['campos']['horas'][$key];
                        }else{
                            array_push($boletim_tabela['horasNormais']['quantidade'],$cartaoponto_diarias['campos']['horas'][$key]);
                            array_push($boletim_tabela['horasNormais']['valor'],$cartaoponto_diarias['campos']['valor'][$key]);
                            array_push($boletim_tabela['horasNormais']['id'],$cartaoponto_diarias['campos']['id'][$key]);
                            array_push($boletim_tabela['horasNormais']['codigos'],$cartaoponto_diarias['campos']['codigo'][$key]);
                            array_push($boletim_tabela['horasNormais']['rublicas'],$cartaoponto_diarias['campos']['descricao'][$key]);
                        }
                    }elseif ($cartaopontos_descricao === 'hora extra 100%' && $cartaoponto_diarias['campos']['id'][$key] === $trabalhadores_id->id) {
                        if (array_key_exists($i,$boletim_tabela['hora extra 100%']['valor'])) {
                            $boletim_tabela['hora extra 100%']['valor'][$i] += $cartaoponto_diarias['campos']['valor'][$key];
                            $boletim_tabela['hora extra 100%']['quantidade'][$i] += $cartaoponto_diarias['campos']['horas'][$key];
                        }else{
                            array_push($boletim_tabela['hora extra 100%']['quantidade'],$cartaoponto_diarias['campos']['horas'][$key]);
                            array_push($boletim_tabela['hora extra 100%']['valor'],$cartaoponto_diarias['campos']['valor'][$key]);
                            array_push($boletim_tabela['hora extra 100%']['id'],$cartaoponto_diarias['campos']['id'][$key]);
                            array_push($boletim_tabela['hora extra 100%']['codigos'],$cartaoponto_diarias['campos']['codigo'][$key]);
                            array_push($boletim_tabela['hora extra 100%']['rublicas'],$cartaoponto_diarias['campos']['descricao'][$key]);
                        }
                    }elseif ($cartaopontos_descricao === 'hora extra 50%' && $cartaoponto_diarias['campos']['id'][$key] === $trabalhadores_id->id) {
                        if (array_key_exists($i,$boletim_tabela['hora extra 50%']['valor'])) {
                            $boletim_tabela['hora extra 50%']['valor'][$i] += $cartaoponto_diarias['campos']['valor'][$key];
                            $boletim_tabela['hora extra 50%']['quantidade'][$i] += $cartaoponto_diarias['campos']['horas'][$key];
                        }else{
                            array_push($boletim_tabela['hora extra 50%']['quantidade'],$cartaoponto_diarias['campos']['horas'][$key]);
                            array_push($boletim_tabela['hora extra 50%']['valor'],$cartaoponto_diarias['campos']['valor'][$key]);
                            array_push($boletim_tabela['hora extra 50%']['id'],$cartaoponto_diarias['campos']['id'][$key]);
                            array_push($boletim_tabela['hora extra 50%']['codigos'],$cartaoponto_diarias['campos']['codigo'][$key]);
                            array_push($boletim_tabela['hora extra 50%']['rublicas'],$cartaoponto_diarias['campos']['descricao'][$key]);
                        }
                    }elseif ($cartaopontos_descricao === 'adicional noturno' && $cartaoponto_diarias['campos']['id'][$key] === $trabalhadores_id->id) {
                        if (array_key_exists($i,$boletim_tabela['adicional noturno']['valor'])) {
                            $boletim_tabela['adicional noturno']['valor'][$i] += $cartaoponto_diarias['campos']['valor'][$key];
                            $boletim_tabela['adicional noturno']['quantidade'][$i] += $cartaoponto_diarias['campos']['horas'][$key];
                        }else{
                            array_push($boletim_tabela['adicional noturno']['quantidade'],$cartaoponto_diarias['campos']['horas'][$key]);
                            array_push($boletim_tabela['adicional noturno']['valor'],$cartaoponto_diarias['campos']['valor'][$key]);
                            array_push($boletim_tabela['adicional noturno']['id'],$cartaoponto_diarias['campos']['id'][$key]);
                            array_push($boletim_tabela['adicional noturno']['codigos'],$cartaoponto_diarias['campos']['codigo'][$key]);
                            array_push($boletim_tabela['adicional noturno']['rublicas'],$cartaoponto_diarias['campos']['descricao'][$key]);
                        }
                    }elseif ($cartaopontos_descricao === 'gratificação' && $cartaoponto_diarias['campos']['id'][$key] === $trabalhadores_id->id) {
                        if (array_key_exists($i,$boletim_tabela['gratificação']['valor'])) {
                            $boletim_tabela['gratificação']['valor'][$i] += $cartaoponto_diarias['campos']['valor'][$key];
                            $boletim_tabela['gratificação']['quantidade'][$i] += $cartaoponto_diarias['campos']['horas'][$key];
                        }else{
                            array_push($boletim_tabela['gratificação']['quantidade'],$cartaoponto_diarias['campos']['horas'][$key]);
                            array_push($boletim_tabela['gratificação']['valor'],$cartaoponto_diarias['campos']['valor'][$key]);
                            array_push($boletim_tabela['gratificação']['id'],$cartaoponto_diarias['campos']['id'][$key]);
                            array_push($boletim_tabela['gratificação']['codigos'],$cartaoponto_diarias['campos']['codigo'][$key]);
                            array_push($boletim_tabela['gratificação']['rublicas'],$cartaoponto_diarias['campos']['descricao'][$key]);
                        }
                    }
                    // elseif ($cartaopontos_descricao === 'adiantamento' && $cartaoponto_diarias['campos']['id'][$key] === $trabalhadores_id->id) {
                       
                    //     if (in_array($cartaoponto_diarias['campos']['id'][$key],$boletim_tabela['adiantamento']['id'])) {
                    //         $boletim_tabela['adiantamento']['valor'][$i] += $cartaoponto_diarias['campos']['valor'][$key];
                    //         $boletim_tabela['adiantamento']['quantidade'][$i] += $cartaoponto_diarias['campos']['horas'][$key];
                    //     }else{
                    //         array_push($boletim_tabela['adiantamento']['quantidade'],$cartaoponto_diarias['campos']['horas'][$key]);
                    //         array_push($boletim_tabela['adiantamento']['valor'],$cartaoponto_diarias['campos']['valor'][$key]);
                    //         array_push($boletim_tabela['adiantamento']['id'],$cartaoponto_diarias['campos']['id'][$key]);
                    //         array_push($boletim_tabela['adiantamento']['codigos'],$cartaoponto_diarias['campos']['codigo'][$key]);
                    //         array_push($boletim_tabela['adiantamento']['rublicas'],$cartaoponto_diarias['campos']['descricao'][$key]);
                    //     }
                    // }
                }
            }
            if (isset($cartaopontos->csdiasuteis)) {
                $tomador_cartao_ponto_horas = self::calculardia($cartaopontos->csdiasuteis,null);
                foreach ($trabalhadores as $z => $trabalhador) {
                    $horasnormais = $boletim_tabela['horasNormais']['quantidade'][$z];
                    if (isset($boletim_tabela['diariaNormais']['quantidade'][$z])) {
                        $diarianormal = $boletim_tabela['diariaNormais']['quantidade'][$z];
                    }else{
                        $diarianormal = 0;
                    }
                    
                    $resultado = $horasnormais/$tomador_cartao_ponto_horas + $diarianormal;
                    array_push($boletim_tabela['vt']['quantidade'],$resultado);
                    array_push($boletim_tabela['vt']['id'],$trabalhador->id);
                    array_push($boletim_tabela['va']['quantidade'],$resultado);
                    array_push($boletim_tabela['va']['id'],$trabalhador->id);
                    if (isset($indecefolhas->instransporte)) {
                        array_push($boletim_tabela['vt']['rublicas'],'Vale transporte');
                        array_push($boletim_tabela['vt']['codigos'],'1012');
                        $resultadovt = $indecefolhas->instransporte * ceil($resultado);
                        array_push($boletim_tabela['vt']['valor'],$resultadovt);
                        array_push($boletim_tabela['vencimento']['valor'],$resultadovt);
                    }
                    if (isset($indecefolhas->insalimentacao)) {
                        array_push($boletim_tabela['va']['rublicas'],'Vale alimentação');
                        array_push($boletim_tabela['va']['codigos'],'1013');
                        $resultadova = $indecefolhas->insalimentacao * ceil($resultado);
                        array_push($boletim_tabela['va']['valor'],$resultadova);
                        $boletim_tabela['vencimento']['valor'][$z] += $resultadova;
                    }
                }
            }
            // if (isset($cartaopontos->csdiasuteis)) {
            //     $dadosTrabalhador['tomador_cartao_ponto_horas'] += self::calculardia($cartaopontos->csdiasuteis,null);
            // }else{
            //     $dadosTrabalhador['tomador_cartao_ponto_horas'] += self::calculardia('00:00',null);
            // }
            
            // if ($dadosTrabalhador['tomador_cartao_ponto_horas'] > 0) {
            //     foreach ($boletim_tabela['horasNormais']['id'] as $key => $id) {
            //         array_push($dadosTrabalhador['id'],$id);
            //         if (isset($boletim_tabela['horasNormais']['quantidade'][$key]) && isset($boletim_tabela['diariaNormais']['quantidade'][$key])) {
            //             array_push($dadosTrabalhador['tomador_cartao_ponto_quantidade'],$boletim_tabela['horasNormais']['quantidade'][$key] /  ceil($dadosTrabalhador['tomador_cartao_ponto_horas']) + $boletim_tabela['diariaNormais']['quantidade'][$key]);
            //         }else if (isset($boletim_tabela['horasNormais']['quantidade'][$key]) && !isset($boletim_tabela['diariaNormais']['quantidade'][$key])) {
            //             array_push($dadosTrabalhador['tomador_cartao_ponto_quantidade'],$boletim_tabela['horasNormais']['quantidade'][$key] /  ceil($dadosTrabalhador['tomador_cartao_ponto_horas']) + 0);
            //         }else{
            //             array_push($dadosTrabalhador['tomador_cartao_ponto_quantidade'],ceil($dadosTrabalhador['tomador_cartao_ponto_horas']) + $boletim_tabela['diariaNormais']['quantidade'][$key]);
            //         }
            //     }
            // }
            // if (isset($indecefolhas->instransporte)) {
            //     $tomador_incide_folha = $indecefolhas->instransporte;
            //     array_push($dadosTrabalhador['rublicas'],'Vale transporte');
            //     array_push($dadosTrabalhador['codigos'],'1012');
            // }else{
            //     $tomador_incide_folha = 0;
            // }
            // foreach ($dadosTrabalhador['tomador_cartao_ponto_quantidade'] as $key => $quantidade) {
            //     array_push($dadosTrabalhador['tomador_cartao_ponto_vt'],$tomador_incide_folha * ceil($quantidade));
            //     array_push($boletim_tabela['vencimento']['valor'],$dadosTrabalhador['tomador_cartao_ponto_vt'][$key]);
                
            // }

            // if (isset($indecefolhas->insalimentacao)) {
            //     $tomador_incide_folha = $indecefolhas->insalimentacao;
            //     array_push($dadosTrabalhador['rublicas'],'Vale alimentação');
            //     array_push($dadosTrabalhador['codigos'],'1013');
            // }else{
            //     $tomador_incide_folha = 0;
            // }
           
            // foreach ($dadosTrabalhador['tomador_cartao_ponto_quantidade'] as $key => $quantidade) {
            //     array_push($dadosTrabalhador['tomador_cartao_ponto_va'],$tomador_incide_folha * ceil($quantidade));
            //     $boletim_tabela['vencimento']['valor'][$key] += $dadosTrabalhador['tomador_cartao_ponto_va'][$key];
                
            // }

            foreach ($trabalhadores as $key => $trabalhador_id) {
                $salario = 0;
                foreach ($boletim_tabela['horasNormais']['id'] as $i => $boletim_tabela_id) {
                    if ($boletim_tabela_id === $trabalhador_id->trabalhador) {
                        $salario += $boletim_tabela['horasNormais']['valor'][$i];
                    }
                }
                foreach ($boletim_tabela['hora extra 50%']['id'] as $i => $boletim_tabela_ex50_id) {
                    if ($boletim_tabela_ex50_id === $trabalhador_id->trabalhador) {
                        $salario += $boletim_tabela['hora extra 50%']['valor'][$i];
                    }
                }
                foreach ($boletim_tabela['hora extra 100%']['id'] as $i => $boletim_tabela_ex100_id) {
                    if ($boletim_tabela_ex100_id === $trabalhador_id->trabalhador) {
                        $salario += $boletim_tabela['hora extra 100%']['valor'][$i];
                    }
                }
                foreach ($boletim_tabela['diariaNormais']['id'] as $i => $boletim_tabela_diariaNormais_id) {
                    if ($boletim_tabela_diariaNormais_id === $trabalhador_id->trabalhador) {
                        $salario += $boletim_tabela['diariaNormais']['valor'][$i];
                    }
                }
                // foreach ($boletim_tabela['adiantamento']['id'] as $i => $boletim_tabela_adiantamento_id) {
                //     if ($boletim_tabela_adiantamento_id === $trabalhador_id->trabalhador) {
                //         $salario += $boletim_tabela['adiantamento']['valor'][$i];
                //     }
                // }
                foreach ($boletim_tabela['producao']['id'] as $i => $boletim_tabela_producao_id) {
                    if ($boletim_tabela_producao_id === $trabalhador_id->trabalhador) {
                        $salario += $boletim_tabela['producao']['valor'][$i];
                    }
                }
                array_push($boletim_tabela['salario']['valor'],$salario);
                array_push($boletim_tabela['salario']['id'],$trabalhador_id->trabalhador);
            }
            foreach ($boletim_tabela['salario']['valor'] as $key => $valor_salario) {
                array_push($boletim_tabela['dsr1818']['valor'],self::calculoPocentagem($valor_salario,18.18));
                array_push($boletim_tabela['dsr1818']['id'],$boletim_tabela['salario']['id'][$key]);
                array_push($boletim_tabela['dsr1818']['codigos'],'1008');
                array_push($boletim_tabela['dsr1818']['rublicas'],'DSR 18,18%');
                array_push($boletim_tabela['dsr1818']['quantidade'],18.18);
                
                
                if (array_key_exists($key,$boletim_tabela['vencimento']['valor'])) {
                    $boletim_tabela['vencimento']['valor'][$key] += $boletim_tabela['dsr1818']['valor'][$key] + $valor_salario;
                }else{
                    array_push($boletim_tabela['vencimento']['valor'],$boletim_tabela['dsr1818']['valor'][$key] + $valor_salario);
                }
               
    
                $serviso_dsr = $boletim_tabela['dsr1818']['valor'][$key] + $valor_salario;
                array_push($boletim_tabela['serviso_dsr']['valor'],$serviso_dsr);
                array_push($boletim_tabela['serviso_dsr']['id'],$boletim_tabela['salario']['id'][$key]);
            }
            foreach ($boletim_tabela['serviso_dsr']['valor'] as $key => $serviso_dsr_valor) {
                array_push($boletim_tabela['decimo_ter']['valor'],self::calculoPocentagem($serviso_dsr_valor,8.34));
                $boletim_tabela['vencimento']['valor'][$key] += $boletim_tabela['decimo_ter']['valor'][$key];
    
                array_push($boletim_tabela['decimo_ter']['id'],$boletim_tabela['serviso_dsr']['id'][$key]);
                array_push($boletim_tabela['decimo_ter']['codigos'],'1010');
                array_push($boletim_tabela['decimo_ter']['rublicas'],'13º Salário');
                array_push($boletim_tabela['decimo_ter']['quantidade'],8.34);

                array_push($boletim_tabela['ferias_decimoter']['valor'],self::calculoPocentagem($serviso_dsr_valor,11.12));
                array_push($boletim_tabela['ferias_decimoter']['id'],$boletim_tabela['serviso_dsr']['id'][$key]);
                array_push($boletim_tabela['ferias_decimoter']['codigos'],'1009');
                array_push($boletim_tabela['ferias_decimoter']['rublicas'],'Ferias + 1/3');
                array_push($boletim_tabela['ferias_decimoter']['quantidade'],11.12);
    
                $boletim_tabela['vencimento']['valor'][$key] += $boletim_tabela['ferias_decimoter']['valor'][$key];
    
                $valor_inss = $boletim_tabela['ferias_decimoter']['valor'][$key] + $serviso_dsr_valor;
                array_push($boletim_tabela['valor_inss']['valor'],$valor_inss);
                array_push($boletim_tabela['valor_inss']['id'],$boletim_tabela['serviso_dsr']['id'][$key]);
                $base_inss = $boletim_tabela['ferias_decimoter']['valor'][$key] + $serviso_dsr_valor;
                array_push($boletim_tabela['base_inss']['valor'],$base_inss);
                array_push($boletim_tabela['base_inss']['id'],$boletim_tabela['serviso_dsr']['id'][$key]);
                $base_fgts = $boletim_tabela['decimo_ter']['valor'][$key] + $boletim_tabela['ferias_decimoter']['valor'][$key] + $serviso_dsr_valor;
                array_push($boletim_tabela['base_fgts']['valor'],$base_fgts);
                array_push($boletim_tabela['base_fgts']['id'],$boletim_tabela['serviso_dsr']['id'][$key]);
                $fgts_mes = $boletim_tabela['base_fgts']['valor'][$key] * 0.08;
                array_push($boletim_tabela['fgts_mes']['valor'],$fgts_mes);
                array_push($boletim_tabela['fgts_mes']['id'],$boletim_tabela['serviso_dsr']['id'][$key]);
            }
            // foreach ($depedentes as $key => $depedentes_valor) {
            //     $base_irrf = str_replace(',','.',$irrflista[0]->irdepedente) * $depedentes_valor->depedentes;
            //     array_push($boletim_tabela['base_irrf']['valor'],$base_irrf);
            //     array_push($boletim_tabela['base_irrf']['id'],$depedentes_valor->trabalhador);
            // }

            // foreach ($boletim_tabela['valor_inss']['valor'] as $i => $valor_inss) {
            //     $resultadoinss = 0;
            //     array_push($boletim_tabela['inss']['id'],$boletim_tabela['valor_inss']['id'][$i]);
            //     foreach ($insslista as $key => $inss) {
            //         $novoinss =  str_replace(".","",$inss->isvalorfinal);
            //         $novoinss =  str_replace(',','.',$novoinss);
            //         $novoinss = (float) $novoinss;
            //         if (!in_array($novoinss, $valorfinal)) {
            //             array_push($valorfinal,$novoinss);
            //         }
                    
            //         if ($valor_inss <= $valorfinal[$key] && $key === 0) {
            //             array_push($boletim_tabela['inss']['valorbase'],$inss->isvalorfinal);
            //             array_push($boletim_tabela['inss']['indece'],$inss->isindece);
            //             $resultadoinss = $valor_inss * ((float)str_replace(',','.',$inss->isindece)/100);
            //             array_push($boletim_tabela['inss']['resultadoinss'],$resultadoinss);
            //             array_push($boletim_tabela['inss']['codigos'],'2001');
            //             array_push($boletim_tabela['inss']['rublicas'],'INSS');
                        
            //             break;
            //         }elseif ($valor_inss > $valorfinal[0] && $valor_inss <= $valorfinal[$key] && $key === 1) {
            //             array_push($boletim_tabela['inss']['valorbase'],$inss->isvalorfinal);
            //             array_push($boletim_tabela['inss']['indece'],$inss->isindece);
            //             $resultadoinss = $valor_inss - $valorfinal[0];
            //             $resultadoinss = $resultadoinss * ((float)str_replace(',','.',$inss->isindece)/100);
            //             $resultadoinss = $resultadoinss + ((float)str_replace(',','.',$insslista[0]->isreducao));
            //             array_push($boletim_tabela['inss']['resultadoinss'],$resultadoinss);
            //             array_push($boletim_tabela['inss']['codigos'],'2001');
            //             array_push($boletim_tabela['inss']['rublicas'],'INSS');
            //           break;
            //         }elseif ($valor_inss <= $valorfinal[$key] && $key === 2) {
            //             array_push($boletim_tabela['inss']['valorbase'],$inss->isvalorfinal);
            //             array_push($boletim_tabela['inss']['indece'],$inss->isindece);
            //             $resultadoinss = $valor_inss - $valorfinal[1];
            //             $resultadoinss = $resultadoinss * ((float)str_replace(',','.',$inss->isindece)/100);
            //             $resultadoinss = $resultadoinss + ((float)str_replace(',','.',$insslista[1]->isreducao));
            //             array_push($boletim_tabela['inss']['resultadoinss'],$resultadoinss);
            //             array_push($boletim_tabela['inss']['codigos'],'2001');
            //             array_push($boletim_tabela['inss']['rublicas'],'INSS');
            //           break;
            //         }elseif ($valor_inss <= $valorfinal[$key] && $key === 3) {
            //             array_push($boletim_tabela['inss']['valorbase'],$inss->isvalorfinal);
            //             array_push($boletim_tabela['inss']['indece'],$inss->isindece);
            //             $resultadoinss = $valor_inss - $valorfinal[2];
            //             $resultadoinss = $resultadoinss * ((float)str_replace(',','.',$inss->isindece)/100);
            //             $resultadoinss = $resultadoinss + ((float)str_replace(',','.',$insslista[2]->isreducao));
            //             array_push($boletim_tabela['inss']['resultadoinss'],$resultadoinss);
            //             array_push($boletim_tabela['inss']['codigos'],'2001');
            //             array_push($boletim_tabela['inss']['rublicas'],'INSS');
            //           break;
            //         }
            //     }
            //     array_push($boletim_tabela['desconto']['valor'],$resultadoinss);
            //     array_push($boletim_tabela['desconto']['id'],$boletim_tabela['valor_inss']['id'][$i]);
            // }
            // foreach ($boletim_tabela['base_irrf']['valor'] as $key => $base_irrf_valor) {
            //     $boletim_tabela['base_irrf']['valor'][$key] = $boletim_tabela['base_fgts']['valor'][$key]- $boletim_tabela['inss']['resultadoinss'][$key] - $boletim_tabela['base_irrf']['valor'][$key];
        
            //     if ($boletim_tabela['base_irrf']['valor'][$key] < 0) {
            //         $boletim_tabela['base_irrf']['valor'][$key] = 0;
            //     }
            // }
            // foreach ($irrflista as $key => $irrf) {
            //     $novoirrf =  str_replace(".","",$irrf->irsvalorfinal);
            //     $novoirrf =  str_replace(',','.',$novoirrf);
            //     $novoirrf = (float) $novoirrf;
            //     if (!in_array($novoirrf, $valor_final_irrf)) {
            //         array_push($valor_final_irrf,$novoirrf);
            //     }
            // }
    
            // foreach ($boletim_tabela['base_irrf']['valor'] as $i => $base_irrf_valor) {
            //     $resultado = 0;
            //     array_push($boletim_tabela['irrf']['id'],$boletim_tabela['base_irrf']['id'][$i]);
            //     foreach ($irrflista as $e => $irrf) {
            //         if ($base_irrf_valor < $valor_final_irrf[0] && $i === $e) {
            //             array_push($boletim_tabela['irrf']['valorbase'],0);
            //             array_push($boletim_tabela['irrf']['indece'],0);
            //             array_push($boletim_tabela['irrf']['resultadoinss'],0);
            //         }elseif ($base_irrf_valor > $valor_final_irrf[0] && $e === 0 && $i === $e && $base_irrf_valor < $valor_final_irrf[1]) {
            //             array_push($boletim_tabela['irrf']['valorbase'],$irrf->irsvalorfinal);
            //             array_push($boletim_tabela['irrf']['indece'],$irrf->irsindece);
            //             $resultado = $base_irrf_valor * ((float)str_replace(',','.',$irrf->irsindece)/100);
            //             array_push($boletim_tabela['irrf']['resultadoinss'],$resultado);
            //             break;
            //         }elseif ($base_irrf_valor > $valor_final_irrf[1] && $e === 1 && $i === $e && $base_irrf_valor < $valor_final_irrf[2]) {
            //             array_push($boletim_tabela['irrf']['valorbase'],$irrf->irsvalorfinal);
            //             array_push($boletim_tabela['irrf']['indece'],$irrf->irsindece);
            //             $resultado = $base_irrf_valor * ((float)str_replace(',','.',$irrf->irsindece)/100);
            //             array_push($boletim_tabela['irrf']['resultadoinss'],$resultado);
            //             break;
            //         }elseif ($base_irrf_valor > $valor_final_irrf[2] && $e === 2 && $i === $e && $base_irrf_valor < $valor_final_irrf[3]) {
            //             array_push($boletim_tabela['irrf']['valorbase'],$irrf->irsvalorfinal);
            //             array_push($boletim_tabela['irrf']['indece'],$irrf->irsindece);
            //             $resultado = $base_irrf_valor * ((float)str_replace(',','.',$irrf->irsindece)/100);
            //             array_push($boletim_tabela['irrf']['resultadoinss'],$resultado);
            //             break;
            //         }elseif ($base_irrf_valor > $valor_final_irrf[3] && $e === 3 && $i === $e) {
            //             array_push($boletim_tabela['irrf']['valorbase'],$irrf->irsvalorfinal);
            //             array_push($boletim_tabela['irrf']['indece'],$irrf->irsindece);
            //             $resultado = $base_irrf_valor * ((float)str_replace(',','.',$irrf->irsindece)/100);
            //             array_push($boletim_tabela['irrf']['resultadoinss'],$resultado);
            //             break;
            //         }
            //     }
            //     array_push($boletim_tabela['desconto']['valor'],$resultado);
            //     array_push($boletim_tabela['desconto']['id'],$boletim_tabela['valor_inss']['id'][$i]);
            // }
            
            
            foreach ($boletim_tabela['decimo_ter']['valor'] as $key => $decimo_ter_valor) {
                $inss_sobre_ter = $decimo_ter_valor * 0.075;
                array_push($boletim_tabela['inss_sobre_ter']['valor'],$inss_sobre_ter);
                array_push($boletim_tabela['inss_sobre_ter']['codigos'],'2002');
                array_push($boletim_tabela['inss_sobre_ter']['rublicas'],'INSS Sobre 13º Salário');
                array_push($boletim_tabela['inss_sobre_ter']['quantidade'],7.5);
                array_push($boletim_tabela['inss_sobre_ter']['id'],$boletim_tabela['decimo_ter']['id'][$key]);
                // $boletim_tabela['desconto']['valor'][$key] += $inss_sobre_ter;
                array_push($boletim_tabela['desconto']['valor'],$inss_sobre_ter);
                array_push($boletim_tabela['desconto']['id'],$boletim_tabela['inss_sobre_ter']['id'][$key]);
            }
            // dd($boletim_tabela);
            foreach ($trabalhadores as $i => $trabalhadores_id) {
                $desconto = 0;
                // if ($sindicator->escondicaosindicato) {
                //     $sindicato = str_replace(".","",$sindicator->escondicaosindicato);
                //     $sindicato = str_replace(',','.',$sindicato);
                //     $sindicato = (float) $sindicato;
                //     array_push($boletim_tabela['sindicator']['valor'],$sindicato);
                //     array_push($boletim_tabela['sindicator']['codigos'],'1011');
                //     array_push($boletim_tabela['sindicator']['quantidade'],1);
                //     array_push($boletim_tabela['sindicator']['rublicas'],'Sindicator');
                //     array_push($boletim_tabela['sindicator']['id'],$trabalhadores_id->trabalhador);
                // }
                // $desconto = $sindicato;
                // if ($sindicator->esseguro) {
                //     $seguro = str_replace(".","",$sindicator->esseguro);
                //     $seguro = str_replace(',','.',$seguro);
                //     $seguro = (float) $seguro;
                //     array_push($boletim_tabela['seguro']['valor'],$seguro);
                //     array_push($boletim_tabela['seguro']['codigos'],'1014');
                //     array_push($boletim_tabela['seguro']['quantidade'],1);
                //     array_push($boletim_tabela['seguro']['rublicas'],'Seguro');
                //     array_push($boletim_tabela['seguro']['id'],$trabalhadores_id->trabalhador);
                // }
                // $desconto += $seguro;
                foreach ($boletim_tabela['desconto']['id'] as $i => $desconto_id) {
                    if ($desconto_id === $trabalhadores_id->trabalhador) {
                        $desconto += $boletim_tabela['desconto']['valor'][$i];
                    }
                }
                // foreach ($boletim_tabela['adiantamento']['id'] as $i => $adiantamento_id) {
                //     if ($adiantamento_id === $trabalhadores_id->trabalhador) {
                //         $desconto += $boletim_tabela['adiantamento']['valor'][$i];
                //     }
                // }
                array_push($boletim_tabela['novodesconto']['id'],$trabalhadores_id->id);
                array_push($boletim_tabela['novodesconto']['valor'],$desconto);
            }
            //    dd($boletim_tabela,$trabalhadores);
            foreach ($trabalhadores as $key => $trabalhador) {
                $novodepedentes = 0;
                foreach ($depedentes as $d => $depedente) {
                    if ($trabalhador->id === $depedente->trabalhador) {
                        $novodepedentes = $depedente->depedentes;
                    }
                }
                $basecalculos = $basecalculo->cadastro($boletim_tabela,$novodepedentes,$tomador_id->id,null,$key,$datafinal);
                if ($basecalculos['id']) {
                    foreach ($boletim_tabela['horasNormais']['id'] as $key => $horasNormais_valor) {
                        if ($horasNormais_valor === $trabalhador->id) {
                            $valorcalculo->cadastroHorasnormais($boletim_tabela,$basecalculos['id'],$trabalhador->id,$key,$datafinal);
                        }
                    }
                    foreach ($boletim_tabela['hora extra 50%']['id'] as $key => $horasex_50_valor) {
                        if ($horasex_50_valor === $trabalhador->id) {
                            $valorcalculo->cadastroHorasEx50($boletim_tabela,$basecalculos['id'],$trabalhador->id,$key,$datafinal);
                        }
                    }
                    foreach ($boletim_tabela['hora extra 100%']['id'] as $key => $horasex_100_valor) {
                        if ($horasex_100_valor === $trabalhador->id) {
                            $valorcalculo->cadastroHorasEx100($boletim_tabela,$basecalculos['id'],$trabalhador->id,$key,$datafinal);
                        }
                    }
                    foreach ($boletim_tabela['diariaNormais']['id'] as $key => $diariaNormais_valor) {
                        if($diariaNormais_valor === $trabalhador->id) {
                            $valorcalculo->cadastrodiariaNormais($boletim_tabela,$basecalculos['id'],$trabalhador->id,$key,$datafinal);
                        }
                    }
                   
                    foreach ($boletim_tabela['gratificação']['id'] as $key => $gratificacao_valor) {
                        if($gratificacao_valor === $trabalhador->id) {
                            $valorcalculo->cadastroGratificacao($boletim_tabela,$basecalculos['id'],$trabalhador->id,$key,$datafinal);
                        }
                    }
                    // if (array_key_exists($key,$boletim_tabela['adiantamento']['id'])) {
                    //     $valorcalculo->cadastraAdiantamento($boletim_tabela,$basecalculos['id'],$trabalhador->id,$key,$datafinal);
                        
                    // }
                    
                    foreach ($boletim_tabela['producao']['id'] as $key => $producao_valor) {
                        if($producao_valor === $trabalhador->id) {
                            $valorcalculo->cadastroProducao($boletim_tabela,$basecalculos['id'],$trabalhador->id,$key,$datafinal);
                        }
                    }
                    
                    foreach ($boletim_tabela['dsr1818']['id'] as $key => $dsr1818_valor) {
                        if($dsr1818_valor === $trabalhador->id) {
                            $valorcalculo->cadastrodsr1818($boletim_tabela,$basecalculos['id'],$trabalhador->id,$key,$datafinal);
                        }
                    }
                   
                    foreach ($boletim_tabela['ferias_decimoter']['id'] as $key => $ferias_decimoter_valor) {
                        if($ferias_decimoter_valor === $trabalhador->id) {
                            $valorcalculo->cadastraFeriasDecimoter($boletim_tabela,$basecalculos['id'],$trabalhador->id,$key,$datafinal);
                        }
                    }
                    if (array_key_exists($key,$boletim_tabela['decimo_ter']['id'])) {
                        
                    }
                    foreach ($boletim_tabela['decimo_ter']['id'] as $key => $decimoter_valor) {
                        if($decimoter_valor === $trabalhador->id) {
                            $valorcalculo->cadastraDecimoTer($boletim_tabela,$basecalculos['id'],$trabalhador->id,$key,$datafinal);
                        }
                    }
                   
                    foreach ($boletim_tabela['inss_sobre_ter']['id'] as $key => $inss_sobre_ter_valor) {
                        if($inss_sobre_ter_valor === $trabalhador->id) {
                            $valorcalculo->cadastrainssSobreTer($boletim_tabela,$basecalculos['id'],$trabalhador->id,$key,$datafinal);
                        }
                    }
                   
                    // foreach ($boletim_tabela['inss']['id'] as $key => $inss_valor) {
                    //     if($inss_valor === $trabalhador->id) {
                    //         $valorcalculo->cadastraInss($boletim_tabela,$basecalculos['id'],$trabalhador->id,$key,$datafinal);
                    //     }
                    // }
                    
                    foreach ($boletim_tabela['sindicator']['id'] as $key => $sindicator_valor) {
                        if($sindicator_valor === $trabalhador->id) {
                            $valorcalculo->cadastroSindicator($boletim_tabela,$basecalculos['id'],$trabalhador->id,$key,$datafinal);
                        }
                    }
                    
                    foreach ($boletim_tabela['seguro']['id'] as $key => $seguro_valor) {
                        if($seguro_valor === $trabalhador->id) {
                            $valorcalculo->cadastroSeguro($boletim_tabela,$basecalculos['id'],$trabalhador->id,$key,$datafinal);
                        }
                    }
                   
                    foreach ($boletim_tabela['vt']['id'] as $key => $vt_valor) {
                        if($vt_valor === $trabalhador->id) {
                            $valorcalculo->cadastroVT($boletim_tabela,$basecalculos['id'],$trabalhador->id,$key,$datafinal);
                        }
                    }
                    
                    foreach ($boletim_tabela['va']['id'] as $key => $va_valor) {
                        if($va_valor === $trabalhador->id) {
                            $valorcalculo->cadastroVA($boletim_tabela,$basecalculos['id'],$trabalhador->id,$key,$datafinal);
                        }
                    }
                    for ($i=1; $i <=31 ; $i++) { 
                        $vencimento = 0;
                        $valorboletim = 0;
                        $novodia = 0;
                        $resultador = 0;
                        foreach ($boletim_tabela['campos']['dia'] as $key => $boletimtabelas) {
                            if ((int)$boletimtabelas === $i && $trabalhador->id == $boletim_tabela['campos']['id'][$key]) {
                                 $valorboletim += $boletim_tabela['campos']['valor'][$key];
                                $novodia = $boletimtabelas;
                            }
                        }

                        foreach ($cartaoponto_diarias['campos']['dia'] as $key => $cartaopontodiarias) {
                            if ((int)$cartaopontodiarias === $i && $trabalhador->id == $cartaoponto_diarias['campos']['id'][$key]) {
                                $vencimento += $cartaoponto_diarias['campos']['valor'][$key];
                                $novodia = $cartaopontodiarias;
                            }
                        }
                        
                        $resultador = $valorboletim + $vencimento;
                        if ($resultador) {
                            $relacaodia->cadastro($novodia,$resultador,$basecalculos['id'],$trabalhador->id,$datafinal);
                        }
                    }
                }
            }
             
            if (($quantidadetomador - 1) === $t) {
                $calculofolhar = self::calculoFolhar($trabalhado_cal_folha,$tomador_cal_folha,$tabelapreco_codigo,$datainicio,$datafinal);
                return redirect()->route('calculo.folha.index')->withSuccess('Cadastro realizado com sucesso.');
                if ($calculofolhar) {
                    return redirect()->route('calculo.folha.index')->withSuccess('Cadastro realizado com sucesso.');
                }
            }
            // dd($boletim_tabela,$cartaoponto_diarias,$trabalhadores);
        }
       
        
    }
    public function calculoFolhar($trabalhador,$tomador,$tabelapreco_codigo,$datainicio,$datafinal)
    {
        
        $basecalculo = new BaseCalculo;
        $valorcalculo = new ValorCalculo;
        $empresa = new Empresa;
        $relacaodia = new RelacaoDia;
        $valoresrublica = new ValoresRublica;
        $folhar = new Folhar;
        $irrf = new Irrf;
        $inss = new Inss;
        $desconto = new Descontos;
        $user = auth()->user();
        $ano = explode('-',$datafinal);
        $irrflista = $irrf->buscaListaIrrf($ano[0]);
        $insslista = $inss->buscaUnidadeInss($ano[0]);
        $dados_folhar = [
            'codigo'=>'',
            'inicio'=>$datainicio,
            'final'=>$datafinal
        ];
    
        $descontos = $desconto->buscaRelatorioTrabalhador($trabalhador,$datainicio,$datafinal);
        $basecalculos_15 = $basecalculo->boletimBusca($trabalhador,$datainicio,$datafinal);
        $sindicator = $empresa->buscaContribuicaoSidicato($user->empresa);
        $valor_final_irrf = [];
        $folhas = $folhar->buscaUltimaoRegistroFolhar($user->empresa);
        if ($folhas) {
            $dados_folhar['codigo'] = $folhas->fscodigo + 1;
            $folhas = $folhar->cadastro($dados_folhar,$user->empresa);
        }else{
            $valoresrublicas = $valoresrublica->buscaUnidadeEmpresa($user->empresa);
            if (empty($valoresrublicas->vsnroflha)) {
                $numerofolhar = 1;
                $dados_folhar['codigo'] = $numerofolhar;
                $valoresrublica->editarUnidadeNuFolhar($user->empresa,$numerofolhar);
                $folhas = $folhar->cadastro($dados_folhar,$user->empresa);
            }else{
                $dados_folhar['codigo'] = $valoresrublicas->vsnroflha + 1;
                $folhas = $folhar->cadastro($dados_folhar,$user->empresa);
            }
        } 
        $basecalculo->editerFk($tomador,$datafinal,$folhas['id']);
        $basecalculos = $basecalculo->calculoLista($trabalhador,$datafinal);
        // dd($basecalculos);
        $inss_valores = $valorcalculo->buscaInss($trabalhador,$datafinal);
        $inss13_valores = $valorcalculo->buscaInss13($trabalhador,$datafinal);
        // dd($inss_valores,$inss13_valores,$basecalculos);
        foreach ($basecalculos as $i => $basecalculo) {
            $valorbase = 0;
            $indece = 0;
            // $resultadoinss = 0;
            $valorfinal = [];
            $boletim_tabela = [
                'adiantamento'=>[
                    'codigos'=>0,
                    'rublicas'=>0,
                    'quantidade'=>0,
                    'valor'=> 0,
                    'id'=>0,
                ],
                'seguro'=>[
                    'codigos'=>0,
                    'rublicas'=>0,
                    'quantidade'=>0,
                    'valor'=> 0,
                    'id'=>0,
                ],
                'sindicator'=>[
                    'codigos'=>0,
                    'rublicas'=>0,
                    'quantidade'=>0,
                    'valor'=> 0,
                    'id'=>0,
                ],
                'descontos'=>[
                    'codigos'=>0,
                    'rublicas'=>0,
                    'quantidade'=>0,
                    'valor'=> 0,
                    'id'=>0,
                ],
                'irrf'=>[
                    'codigos'=>0,
                    'rublicas'=>0,
                    'quantidade'=>0,
                    'valor'=> 0,
                    'id'=>0,
                ],
                'inss'=>[
                    'codigos'=>0,
                    'rublicas'=>0,
                    'quantidade'=>0,
                    'valor'=> 0,
                    'id'=>0,
                ],
            ];

            if (count($basecalculos_15) > 0) {
                if ($basecalculo->trabalhador === $basecalculos_15[$i]->trabalhador) {
                    $basecalculos[$i]->valorliquido -= $basecalculos_15[$i]->bivalorliquido;
                    $basecalculos[$i]->valordesconto += $basecalculos_15[$i]->bivalorliquido;
                }
                foreach ($descontos as $d => $desconto) {
                    if ($basecalculo->trabalhador === $desconto->id && $desconto->dsquinzena === '2 - Segunda') {
                        $basecalculos[$i]->valorliquido -= $desconto->valor;
                        $basecalculos[$i]->valordesconto += $desconto->valor;
                    }
                }
            }
            foreach ($descontos as $d => $desconto) {
                if ($basecalculo->trabalhador === $desconto->id && $desconto->dsquinzena === '1 - Primeira') {
                    $basecalculos[$i]->valorliquido -= $desconto->valor;
                    $basecalculos[$i]->valordesconto += $desconto->valor;
                }
            }
            $sindicato = str_replace(".","",$sindicator->escondicaosindicato);
            $sindicato = str_replace(',','.',$sindicato);
            $sindicato = (float) $sindicato;
            $basecalculos[$i]->valordesconto += $sindicato;
            $basecalculos[$i]->valorliquido -= $sindicato;

            $seguro = str_replace(".","",$sindicator->esseguro);
            $seguro = str_replace(',','.',$seguro);
            $seguro = (float) $seguro;
            $basecalculos[$i]->valordesconto += $seguro;
            $basecalculos[$i]->valorliquido -= $seguro;

            $base_irrf = str_replace(',','.',$irrflista[0]->irdepedente) * $basecalculo->binumfilhos;
            foreach ($inss_valores as $n => $inss_valor) {
                if ($inss_valor->trabalhador === $basecalculo->trabalhador) {
                    $base_irrf -= $inss_valor->desconto;
                }
            }
            foreach ($inss13_valores as $s => $inss13_valor) {
                if ($inss13_valor->trabalhador === $basecalculo->trabalhador) {
                    $base_irrf -= $inss13_valor->desconto;
                }
            }
            $base_irrf = $basecalculo->fgts  - $base_irrf;
           
            foreach ($irrflista as $key => $irrf) {
                $novoirrf =  str_replace(".","",$irrf->irsvalorfinal);
                $novoirrf =  str_replace(',','.',$novoirrf);
                $novoirrf = (float) $novoirrf;
                if (!in_array($novoirrf, $valor_final_irrf)) {
                    array_push($valor_final_irrf,$novoirrf);
                }
            }
            foreach ($irrflista as $e => $irrf) {
                if ($base_irrf < $valor_final_irrf[0] && $i === $e) {
                    $valorbase = $base_irrf;
                    $indece = 0;
                    $resultadoinss = 0;
                    $boletim_tabela['irrf']['rublicas'] = 'IRRF';
                    $boletim_tabela['irrf']['valor'] = 0;
                    $boletim_tabela['irrf']['quantidade'] = 0;
                    $boletim_tabela['irrf']['codigos'] = 2012;
                    break;
                }elseif ($base_irrf > $valor_final_irrf[0] && $e === 0 && $i === $e && $base_irrf < $valor_final_irrf[1]) {
                    $valorbase = $base_irrf;
                    $indece = $irrf->irsindece;
                    $resultado = $base_irrf * ((float)str_replace(',','.',$irrf->irsindece)/100);
                    $boletim_tabela['irrf']['rublicas'] = 'IRRF';
                    $boletim_tabela['irrf']['valor'] = $resultado;
                    $boletim_tabela['irrf']['quantidade'] = str_replace(',','.',$irrf->irsindece);
                    $boletim_tabela['irrf']['codigos'] = 2012;
                    $basecalculos[$i]->valorliquido -= $resultado;
                    $basecalculos[$i]->valordesconto += $resultado;
                    break;
                }elseif ($base_irrf > $valor_final_irrf[1] && $e === 1 && $i === $e && $base_irrf < $valor_final_irrf[2]) {
                    $valorbase = $base_irrf;
                    $indece = $irrf->irsindece;
                    $resultado = $base_irrf * ((float)str_replace(',','.',$irrf->irsindece)/100);
                    $boletim_tabela['irrf']['rublicas'] = 'IRRF';
                    $boletim_tabela['irrf']['valor'] = $resultado;
                    $boletim_tabela['irrf']['quantidade'] = str_replace(',','.',$irrf->irsindece);
                    $boletim_tabela['irrf']['codigos'] = 2012;
                    $basecalculos[$i]->valorliquido -= $resultado;
                    $basecalculos[$i]->valordesconto += $resultado;
                    break;
                }elseif ($base_irrf > $valor_final_irrf[2] && $e === 2 && $i === $e && $base_irrf < $valor_final_irrf[3]) {
                    $valorbase = $base_irrf;
                    $indece = $irrf->irsindece;
                    $resultado = $base_irrf * ((float)str_replace(',','.',$irrf->irsindece)/100);
                    $boletim_tabela['irrf']['rublicas'] = 'IRRF';
                    $boletim_tabela['irrf']['valor'] = $resultado;
                    $boletim_tabela['irrf']['quantidade'] = str_replace(',','.',$irrf->irsindece);
                    $boletim_tabela['irrf']['codigos'] = 2012;
                    $basecalculos[$i]->valorliquido -= $resultado;
                    $basecalculos[$i]->valordesconto += $resultado;
                    break;
                }elseif ($base_irrf > $valor_final_irrf[3] && $e === 3 && $i === $e) {
                    $valorbase = $base_irrf;
                    $indece = $irrf->irsindece;
                    $resultado = $base_irrf * ((float)str_replace(',','.',$irrf->irsindece)/100);
                    $boletim_tabela['irrf']['rublicas'] = 'IRRF';
                    $boletim_tabela['irrf']['valor'] = $resultado;
                    $boletim_tabela['irrf']['quantidade'] = str_replace(',','.',$irrf->irsindece);
                    $boletim_tabela['irrf']['codigos'] = 2012;
                    $basecalculos[$i]->valorliquido -= $resultado;
                    $basecalculos[$i]->valordesconto += $resultado;
                    break;
                }
            }
            // dd($valorbase,$valor_final_irrf);
            $inssferiasdecimoter =  $valorcalculo->buscaUnidaderFeriasDecimoter($basecalculo->trabalhador,1009,$datafinal);
            $inssdsr1818 = $valorcalculo->buscaUnidaderFeriasDecimoter($basecalculo->trabalhador,1008,$datafinal);
            $valor_inss = $inssferiasdecimoter->vencimento + $inssdsr1818->vencimento;
            foreach ($insslista as $key => $inss) {
                $novoinss =  str_replace(".","",$inss->isvalorfinal);
                $novoinss =  str_replace(',','.',$novoinss);
                $novoinss = (float) $novoinss;
                if (!in_array($novoinss, $valorfinal)) {
                    array_push($valorfinal,$novoinss);
                }
                
                if ($valor_inss <= $valorfinal[$key] && $key === 0) {
                    $boletim_tabela['inss']['quantidade'] = str_replace(',','.',$inss->isindece);
                    $resultadoinss = $valor_inss * ((float)str_replace(',','.',$inss->isindece)/100);
                    $boletim_tabela['inss']['valor'] = $resultadoinss;
                    $boletim_tabela['inss']['codigos'] = '2001';
                    $boletim_tabela['inss']['rublicas'] = 'INSS';
                    $basecalculos[$i]->valorliquido -= $resultadoinss;
                    $basecalculos[$i]->valordesconto += $resultadoinss;
                    break;
                }elseif ($valor_inss > $valorfinal[0] && $valor_inss <= $valorfinal[$key] && $key === 1) {
                    $boletim_tabela['inss']['quantidade'] = str_replace(',','.',$inss->isindece);
                    $resultadoinss = $valor_inss - $valorfinal[0];
                    $resultadoinss = $resultadoinss * ((float)str_replace(',','.',$inss->isindece)/100);
                    $resultadoinss = $resultadoinss + ((float)str_replace(',','.',$insslista[0]->isreducao));
                    $boletim_tabela['inss']['valor'] = $resultadoinss;
                    $boletim_tabela['inss']['codigos'] = '2001';
                    $boletim_tabela['inss']['rublicas'] = 'INSS';
                    $basecalculos[$i]->valorliquido -= $resultadoinss;
                    $basecalculos[$i]->valordesconto += $resultadoinss;
                  break;
                }elseif ($valor_inss <= $valorfinal[$key] && $key === 2) {
                    $boletim_tabela['inss']['quantidade'] = str_replace(',','.',$inss->isindece);
                    $resultadoinss = $valor_inss - $valorfinal[1];
                    $resultadoinss = $resultadoinss * ((float)str_replace(',','.',$inss->isindece)/100);
                    $resultadoinss = $resultadoinss + ((float)str_replace(',','.',$insslista[1]->isreducao));
                    $boletim_tabela['inss']['valor'] = $resultadoinss;
                    $boletim_tabela['inss']['codigos'] = '2001';
                    $boletim_tabela['inss']['rublicas'] = 'INSS';
                    $basecalculos[$i]->valorliquido -= $resultadoinss;
                    $basecalculos[$i]->valordesconto += $resultadoinss;
                  break;
                }elseif ($valor_inss <= $valorfinal[$key] && $key === 3) {
                    $boletim_tabela['inss']['quantidade'] = str_replace(',','.',$inss->isindece);
                    $resultadoinss = $valor_inss - $valorfinal[2];
                    $resultadoinss = $resultadoinss * ((float)str_replace(',','.',$inss->isindece)/100);
                    $resultadoinss = $resultadoinss + ((float)str_replace(',','.',$insslista[2]->isreducao));
                    $boletim_tabela['inss']['valor'] = $resultadoinss;
                    $boletim_tabela['inss']['codigos'] = '2001';
                    $boletim_tabela['inss']['rublicas'] = 'INSS';
                    $basecalculos[$i]->valorliquido -= $resultadoinss;
                    $basecalculos[$i]->valordesconto += $resultadoinss;
                  break;
                }
            }
            // dd($inssferiasdecimoter,$inssdsr1818,$boletim_tabela);
            $novabasecalculo =  $basecalculo->cadastroFolhar($basecalculos[$i],$valorbase,$indece,$folhas['id']);
            foreach ($tabelapreco_codigo as $d => $tabelapreco_valor) {
                $valorcalculos = $valorcalculo->listaGeral($trabalhador,$datafinal,$tabelapreco_valor);
                foreach ($valorcalculos as $v => $valorcalculo) {
                    if ($basecalculo->trabalhador === $valorcalculo->trabalhador) {
                        $valorcalculo->cadastraGeral($valorcalculo,$novabasecalculo['id']);
                    }
                }
            }
            $valorcalculo->cadastraIrrf($boletim_tabela,$novabasecalculo['id'],$basecalculo->trabalhador,$datafinal);
            $valorcalculo->cadastraInss($boletim_tabela,$novabasecalculo['id'],$basecalculo->trabalhador,$datafinal);
            if (count($basecalculos_15) > 0) {
                if ($basecalculo->trabalhador === $basecalculos_15[$i]->trabalhador) {
                    $boletim_tabela['adiantamento']['codigos'] = '2003';
                    $boletim_tabela['adiantamento']['rublicas'] = 'Adiantamento';
                    $boletim_tabela['adiantamento']['quantidade'] = 1;
                    $boletim_tabela['adiantamento']['valor'] = $basecalculos_15[$i]->bivalorliquido;
                    $valorcalculo->cadastraAdiantamento($boletim_tabela,$novabasecalculo['id'],$basecalculos_15[$i]->trabalhador,$datafinal);
                }
            }
            foreach ($descontos as $d => $desconto) {
                if ($basecalculo->trabalhador === $desconto->id && $desconto->dsquinzena === '1 - Primeira') {
                  
                    $boletim_tabela['descontos']['codigos'] = 0;
                    $boletim_tabela['descontos']['rublicas'] = $desconto->dsdescricao;
                    $boletim_tabela['descontos']['quantidade'] = $desconto->quantidade;
                    $boletim_tabela['descontos']['valor'] = $desconto->valor;
                    $valorcalculo->cadastraDesconto($boletim_tabela,$novabasecalculo['id'],$basecalculo->trabalhador,$datafinal);
                }
                if ($basecalculo->trabalhador === $desconto->id && $desconto->dsquinzena === '2 - Segunda' && count($basecalculos_15) > 0) {
                  
                    $boletim_tabela['descontos']['codigos'] = 0;
                    $boletim_tabela['descontos']['rublicas'] = $desconto->dsdescricao;
                    $boletim_tabela['descontos']['quantidade'] = $desconto->quantidade;
                    $boletim_tabela['descontos']['valor'] = $desconto->valor;
                    $valorcalculo->cadastraDesconto($boletim_tabela,$novabasecalculo['id'],$basecalculo->trabalhador,$datafinal);
                }
            }
            $boletim_tabela['seguro']['codigos'] = '1014';
            $boletim_tabela['seguro']['rublicas'] = 'Seguro';
            $boletim_tabela['seguro']['quantidade'] = 1;
            $boletim_tabela['seguro']['valor'] = $seguro;
            $valorcalculo->cadastroSeguro($boletim_tabela,$novabasecalculo['id'],$basecalculo->trabalhador,$datafinal);

            $boletim_tabela['sindicator']['codigos'] = '1011';
            $boletim_tabela['sindicator']['rublicas'] = 'Sindicator';
            $boletim_tabela['sindicator']['quantidade'] = 1;
            $boletim_tabela['sindicator']['valor'] = $sindicato;
            $valorcalculo->cadastroSindicator($boletim_tabela,$novabasecalculo['id'],$basecalculo->trabalhador,$datafinal);

            for ($d= 1; $d <= 31 ; $d++) { 
                $relacaodias = $relacaodia->listaRelacaoDia($trabalhador,$datafinal,$d);
                    if (isset($relacaodias[0]->valor)) {
                        foreach ($relacaodias as $r => $relacaodia) {
                            if ($basecalculo->trabalhador === $relacaodia->trabalhador) {
                                $relacaodia->cadastroGeral($relacaodia,$novabasecalculo['id']);
                            }
                        }
                    }
            }
        }
       
        // dd($descontos);
        return true;
        
    }
    public function calculardia($horas,$valores)
    {
        list($horas,$minitos) = explode(':',$horas);
        $horasex = $horas * 3600 + $minitos * 60;
        $horasex = $horasex/60;
        if ($valores != null) {
            $horasex = $valores * ($horasex/60);
        }else{
            $horasex = ($horasex/60);
        }
        return $horasex;
    }
    public function calcularhoras($horas)
    {
        if(strpos($horas,':')){
            list($horas,$minitos) = explode(':',$horas);
            $horasex = $horas * 3600 + $minitos * 60;
            $horasex = $horasex/60;
            $horasex = ($horasex/60);
        }else{
            $horasex = $horas;
        }
        return $horasex; 
    }
   public function calculoPocentagem($valor,$porcentagem)
    {
        $resultado = $valor * ($porcentagem / 100);
        return $resultado;
    }
   public function calculovalores($horas,$valores)
    {
        if(strpos($horas,':')){
        list($horas,$minitos) = explode(':',$horas);
        $horasex = $horas * 3600 + $minitos * 60;
        $horasex = $horasex/60;
        $horasex = $valores * ($horasex/60);
        }else{
        $horasex = $valores * $horas;
        }
        return $horasex; 
    }
    public function imprimirFolhar($id)
    {
        $folhar = new Folhar;
        $valorcalculo = new ValorCalculo;
        $relacaodia = new RelacaoDia;
        $folhas = $folhar->buscaLista($id);
        
        $basecalculo_id = [];
        foreach ($folhas as $key => $folhar) {
            array_push($basecalculo_id,$folhar->id);
        }
        $valorcalculos = $valorcalculo->buscaImprimir($basecalculo_id);
        $relacaodias = $relacaodia->buscaImprimir($basecalculo_id);
        // dd($relacaodias);
        $pdf = PDF::loadView('comprovantegeral',compact('folhas','valorcalculos','relacaodias'));
        return $pdf->setPaper('a4')->stream('CALCULO FOLHA GERAL.pdf');
    }
   
    public function destroy($id)
    {
        $folhar = new Folhar;
        $valorcalculo = new ValorCalculo;
        $relacaodia = new RelacaoDia;
        $basecalculo = new BaseCalculo;
        $valorcalculos = $valorcalculo->deletar($id);
        $relacaodias = $relacaodia->deletar($id);
        $basecalculo = $basecalculo->deletar($id);
        $folhas = $folhar->deletar($id);
        return redirect()->back()->withSuccess('Deletado com sucesso.');
    }
}
