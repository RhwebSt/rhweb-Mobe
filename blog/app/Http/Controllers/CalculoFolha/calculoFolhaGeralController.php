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
use PDF;
class calculoFolhaGeralController extends Controller
{
    public function calculoFolhaGeral($datainicio,$datafinal)
    {
        $ano = explode('-',$datafinal);
        $user = auth()->user();
         
        $dias = [];
        $trabalhado_cal_folha = [];
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
        
        
        $tomadores = $tomador->buscaListaTomador($user->empresa);
        $quantidadetomador = count($tomadores);
        foreach ($tomadores as $t => $tomador_id) {
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
                    'id'=>[],
                    'valor'=>[]
                ],
                'serviso_dsr'=>[
                    'id'=>[],
                    'valor'=>[]
                ],
                'decimo_ter'=>[
                    'id'=>[],
                    'valor'=>[]
                ],
                'ferias_decimoter'=>[
                    'id'=>[],
                    'valor'=>[]
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
                    'id'=>[],
                    'valor'=>[]
                ],
                'inss'=>[
                    'id'=>[],
                    'valorbase'=>[],
                    'indece'=>[],
                    'resultadoinss'=>[]
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
            ];
            $valorfinal = [];
            $valor_final_irrf = [];
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
                        }elseif ($tabelapreco->tsdescricao == 'adiantamento' && $tabelapreco->tsvalor) {
                            array_push($cartaoponto_diarias['campos']['codigo'],$tabelapreco->tsrubrica);
                            array_push($cartaoponto_diarias['campos']['valor'],$tabelapreco->tsvalor);
                            array_push($cartaoponto_diarias['campos']['descricao'],$tabelapreco->tsdescricao);
                            array_push($cartaoponto_diarias['campos']['horas'],1);
                            array_push($cartaoponto_diarias['campos']['dia'],$dia[0]);
                            array_push($cartaoponto_diarias['campos']['id'],$bolcartaoponto_valor->trabalhador);
                            // $total_desconto =  $boletim_tabela['adiantamento']['valor'];
                        }
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
                            $vencimento = $lancamentorublica_valor->lfvalor * $lancamentorublica_valor->lsquantidade;
                            array_push($boletim_tabela['campos']['valor'], $vencimento);
                            array_push($boletim_tabela['campos']['rubrica'], $lancamentorublica_valor->lshistorico);
                            array_push($boletim_tabela['campos']['quantidade'], $lancamentorublica_valor->lsquantidade);
                            array_push($boletim_tabela['campos']['codigo'], $tabelapreco->tsrubrica);
                            array_push($boletim_tabela['campos']['descricao'], $tabelapreco->tsdescricao);
                        }
                    }
                }
            // dd($boletim_tabela);
            foreach ($trabalhadores as $i => $trabalhadores_id) {
                $boletim_valor = 0;
                foreach ($boletim_tabela['campos']['rubrica'] as $key => $boletim_tabelas) {
                    if ($boletim_tabelas === 'hora normal' && $boletim_tabela['campos']['id'][$key] === $trabalhadores_id->id) {
                        if (in_array($boletim_tabela['campos']['id'][$key],$boletim_tabela['horasNormais']['id'])) {
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
                       
                        if (in_array($boletim_tabela['campos']['id'][$key],$boletim_tabela['hora extra 50%']['id'])) {
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
                        if (in_array($boletim_tabela['campos']['id'][$key],$boletim_tabela['hora extra 100%']['id'])) {
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
                        if (in_array($boletim_tabela['campos']['id'][$key],$boletim_tabela['adicional noturno']['id'])) {
                            $boletim_tabela['adicional noturno']['valor'][$i] += $cartaoponto_diarias['campos']['valor'][$key];
                            $boletim_tabela['adicional noturno']['quantidade'][$i] += $cartaoponto_diarias['campos']['horas'][$key];
                        }else{
                            array_push($boletim_tabela['adicional noturno']['quantidade'],$boletim_tabela['campos']['quantidade'][$key]);
                            array_push($boletim_tabela['adicional noturno']['valor'],$boletim_tabela['campos']['valor'][$key]);
                            array_push($boletim_tabela['adicional noturno']['id'],$boletim_tabela['campos']['id'][$key]);
                        }
                    }elseif ($boletim_tabelas === 'diaria normal' && $boletim_tabela['campos']['id'][$key] === $trabalhadores_id->id) {
                        if (in_array($boletim_tabela['campos']['id'][$key],$boletim_tabela['diariaNormais']['id'])) {
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
                        if (in_array($boletim_tabela['campos']['id'][$key],$boletim_tabela['gratificação']['id'])) {
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
                            if (in_array($boletim_tabela['campos']['id'][$key],$boletim_tabela['producao']['id'])) {
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
                    }elseif ($cartaopontos_descricao === 'adiantamento' && $cartaoponto_diarias['campos']['id'][$key] === $trabalhadores_id->id) {
                       
                        if (in_array($cartaoponto_diarias['campos']['id'][$key],$boletim_tabela['adiantamento']['id'])) {
                            $boletim_tabela['adiantamento']['valor'][$i] += $cartaoponto_diarias['campos']['valor'][$key];
                            $boletim_tabela['adiantamento']['quantidade'][$i] += $cartaoponto_diarias['campos']['horas'][$key];
                        }else{
                            array_push($boletim_tabela['adiantamento']['quantidade'],$cartaoponto_diarias['campos']['horas'][$key]);
                            array_push($boletim_tabela['adiantamento']['valor'],$cartaoponto_diarias['campos']['valor'][$key]);
                            array_push($boletim_tabela['adiantamento']['id'],$cartaoponto_diarias['campos']['id'][$key]);
                            array_push($boletim_tabela['adiantamento']['codigos'],$cartaoponto_diarias['campos']['codigo'][$key]);
                            array_push($boletim_tabela['adiantamento']['rublicas'],$cartaoponto_diarias['campos']['descricao'][$key]);
                        }
                    }
                }
            }
            if (isset($cartaopontos->csdiasuteis)) {
                $dadosTrabalhador['tomador_cartao_ponto_horas'] += self::calculardia($cartaopontos->csdiasuteis,null);
            }else{
                $dadosTrabalhador['tomador_cartao_ponto_horas'] += self::calculardia('00:00',null);
            }
            
            if ($dadosTrabalhador['tomador_cartao_ponto_horas'] > 0) {
                foreach ($boletim_tabela['horasNormais']['id'] as $key => $id) {
                    array_push($dadosTrabalhador['id'],$id);
                    if (isset($boletim_tabela['horasNormais']['quantidade'][$key]) && isset($boletim_tabela['diariaNormais']['quantidade'][$key])) {
                        array_push($dadosTrabalhador['tomador_cartao_ponto_quantidade'],$boletim_tabela['horasNormais']['quantidade'][$key] /  ceil($dadosTrabalhador['tomador_cartao_ponto_horas']) + $boletim_tabela['diariaNormais']['quantidade'][$key]);
                    }else if (isset($boletim_tabela['horasNormais']['quantidade'][$key]) && !isset($boletim_tabela['diariaNormais']['quantidade'][$key])) {
                        array_push($dadosTrabalhador['tomador_cartao_ponto_quantidade'],$boletim_tabela['horasNormais']['quantidade'][$key] /  ceil($dadosTrabalhador['tomador_cartao_ponto_horas']) + 0);
                    }else{
                        array_push($dadosTrabalhador['tomador_cartao_ponto_quantidade'],ceil($dadosTrabalhador['tomador_cartao_ponto_horas']) + $boletim_tabela['diariaNormais']['quantidade'][$key]);
                    }
                }
            }
            if (isset($indecefolhas->instransporte)) {
                $tomador_incide_folha = $indecefolhas->instransporte;
            }else{
                $tomador_incide_folha = 0;
            }
            foreach ($dadosTrabalhador['tomador_cartao_ponto_quantidade'] as $key => $quantidade) {
                array_push($dadosTrabalhador['tomador_cartao_ponto_vt'],$tomador_incide_folha * ceil($quantidade));
                array_push($boletim_tabela['vencimento']['valor'],$dadosTrabalhador['tomador_cartao_ponto_vt'][$key]);
            }
            if (isset($indecefolhas->insalimentacao)) {
                $tomador_incide_folha = $indecefolhas->insalimentacao;
            }else{
                $tomador_incide_folha = 0;
            }
           
            foreach ($dadosTrabalhador['tomador_cartao_ponto_quantidade'] as $key => $quantidade) {
                array_push($dadosTrabalhador['tomador_cartao_ponto_va'],$tomador_incide_folha * ceil($quantidade));
                $boletim_tabela['vencimento']['valor'][$key] += $dadosTrabalhador['tomador_cartao_ponto_va'][$key];
            }
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
                foreach ($boletim_tabela['diariaNormais']['id'] as $i => $boletim_tabela_diariaNormais_id) {
                    if ($boletim_tabela_diariaNormais_id === $trabalhador_id->trabalhador) {
                        $salario += $boletim_tabela['diariaNormais']['valor'][$i];
                    }
                }
                foreach ($boletim_tabela['adiantamento']['id'] as $i => $boletim_tabela_adiantamento_id) {
                    if ($boletim_tabela_adiantamento_id === $trabalhador_id->trabalhador) {
                        $salario += $boletim_tabela['adiantamento']['valor'][$i];
                    }
                }
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
                array_push($boletim_tabela['ferias_decimoter']['valor'],self::calculoPocentagem($serviso_dsr_valor,11.12));
                array_push($boletim_tabela['ferias_decimoter']['id'],$boletim_tabela['serviso_dsr']['id'][$key]);
    
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
            foreach ($boletim_tabela['valor_inss']['valor'] as $i => $valor_inss) {
                $resultadoinss = 0;
                array_push($boletim_tabela['inss']['id'],$boletim_tabela['valor_inss']['id'][$i]);
                foreach ($insslista as $key => $inss) {
                    $novoinss =  str_replace(".","",$inss->isvalorfinal);
                    $novoinss =  str_replace(',','.',$novoinss);
                    $novoinss = (float) $novoinss;
                    if (!in_array($novoinss, $valorfinal)) {
                        array_push($valorfinal,$novoinss);
                    }
                    if ($valor_inss <= $valorfinal[$key] && $key === 0) {
                        array_push($boletim_tabela['inss']['valorbase'],$inss->isvalorfinal);
                        array_push($boletim_tabela['inss']['indece'],$inss->isindece);
                        $resultadoinss = $valor_inss * ((float)str_replace(',','.',$inss->isindece)/100);
                        array_push($boletim_tabela['inss']['resultadoinss'],$resultadoinss);
                        
                        break;
                    }elseif ($valor_inss > $valorfinal[0] && $valor_inss <= $valorfinal[$key] && $key === 1) {
                        array_push($boletim_tabela['inss']['valorbase'],$inss->isvalorfinal);
                        array_push($boletim_tabela['inss']['indece'],$inss->isindece);
                        $resultadoinss = $valor_inss - $valorfinal[0];
                        $resultadoinss = $resultadoinss * ((float)str_replace(',','.',$inss->isindece)/100);
                        $resultadoinss = $resultadoinss + ((float)str_replace(',','.',$insslista[0]->isreducao));
                        array_push($boletim_tabela['inss']['resultadoinss'],$resultadoinss);
                        
                      break;
                    }elseif ($valor_inss <= $valorfinal[$key] && $key === 2) {
                        array_push($boletim_tabela['inss']['valorbase'],$inss->isvalorfinal);
                        array_push($boletim_tabela['inss']['indece'],$inss->isindece);
                        $resultadoinss = $valor_inss - $valorfinal[1];
                        $resultadoinss = $resultadoinss * ((float)str_replace(',','.',$inss->isindece)/100);
                        $resultadoinss = $resultadoinss + ((float)str_replace(',','.',$insslista[1]->isreducao));
                        array_push($boletim_tabela['inss']['resultadoinss'],$resultadoinss);
                        
                      break;
                    }elseif ($valor_inss <= $valorfinal[$key] && $key === 3) {
                        array_push($boletim_tabela['inss']['valorbase'],$inss->isvalorfinal);
                        array_push($boletim_tabela['inss']['indece'],$inss->isindece);
                        $resultadoinss = $valor_inss - $valorfinal[2];
                        $resultadoinss = $resultadoinss * ((float)str_replace(',','.',$inss->isindece)/100);
                        $resultadoinss = $resultadoinss + ((float)str_replace(',','.',$insslista[2]->isreducao));
                        array_push($boletim_tabela['inss']['resultadoinss'],$resultadoinss);
                        
                      break;
                    }
                }
                array_push($boletim_tabela['desconto']['valor'],$resultadoinss);
                array_push($boletim_tabela['desconto']['id'],$boletim_tabela['valor_inss']['id'][$i]);
            }
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
            $sindicator = str_replace(".","",$sindicator->escondicaosindicato);
            $sindicator = str_replace(',','.',$sindicator);
            $sindicator = (float) $sindicator;
            foreach ($boletim_tabela['decimo_ter']['valor'] as $key => $decimo_ter_valor) {
                $inss_sobre_ter = $decimo_ter_valor * 0.075;
                array_push($boletim_tabela['inss_sobre_ter']['valor'],$inss_sobre_ter);
            }
            foreach ($trabalhadores as $i => $trabalhadores_id) {
                $desconto = $sindicator;
                foreach ($boletim_tabela['desconto']['id'] as $i => $desconto_id) {
                    if ($desconto_id === $trabalhadores_id->trabalhador) {
                        $desconto += $boletim_tabela['desconto']['valor'][$i];
                    }
                }
                foreach ($boletim_tabela['adiantamento']['id'] as $i => $adiantamento_id) {
                    if ($adiantamento_id === $trabalhadores_id->trabalhador) {
                        $desconto += $boletim_tabela['adiantamento']['valor'][$i];
                    }
                }
                array_push($boletim_tabela['novodesconto']['id'],$trabalhadores_id->id);
                array_push($boletim_tabela['novodesconto']['valor'],$desconto);
            }
            
            foreach ($trabalhadores as $key => $trabalhador) {
                
                $basecalculos = $basecalculo->cadastro($boletim_tabela,$depedentes,$tomador_id->id,null,$key,$datafinal);
                if ($basecalculos['id']) {
                    if (array_key_exists($key,$boletim_tabela['horasNormais']['id'])) {
                        $valorcalculo->cadastroHorasnormais($boletim_tabela,$basecalculos['id'],$trabalhador->id,$key,$datafinal);
                    }
                    if (array_key_exists($key,$boletim_tabela['hora extra 50%']['id'])) {
                        $valorcalculo->cadastroHorasEx50($boletim_tabela,$basecalculos['id'],$trabalhador->id,$key,$datafinal);
                    }
                    if (array_key_exists($key,$boletim_tabela['hora extra 100%']['id'])) {
                        $valorcalculo->cadastroHorasEx100($boletim_tabela,$basecalculos['id'],$trabalhador->id,$key,$datafinal);
                    }
                    if (array_key_exists($key,$boletim_tabela['diariaNormais']['id'])) {
                        $valorcalculo->cadastrodiariaNormais($boletim_tabela,$basecalculos['id'],$trabalhador->id,$key,$datafinal);
                    }
                    if (array_key_exists($key,$boletim_tabela['gratificação']['id'])) {
                        $valorcalculo->cadastroGratificacao($boletim_tabela,$basecalculos['id'],$trabalhador->id,$key,$datafinal);
                    }
                    if (array_key_exists($key,$boletim_tabela['adiantamento']['id'])) {
                        $valorcalculo->cadastraAdiantamento($boletim_tabela,$basecalculos['id'],$trabalhador->id,$key,$datafinal);
                    }
                    if (array_key_exists($key,$boletim_tabela['producao']['id'])) {
                        $valorcalculo->cadastroProducao($boletim_tabela,$basecalculos['id'],$trabalhador->id,$key,$datafinal);
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
            //dd($lancamentorublicas,$dadosTrabalhador,$boletim_tabela,$cartaoponto_diarias);
            if (($quantidadetomador - 1) === $t) {
                self::calculoFolhar($trabalhado_cal_folha,$datainicio,$datafinal);
            }
        }
       
        
    }
    public function calculoFolhar($trabalhador,$datainicio,$datafinal)
    {
        
        $basecalculo = new BaseCalculo;
        $valorcalculo = new ValorCalculo;
        $relacaodia = new RelacaoDia;
        $valoresrublica = new ValoresRublica;
        $folhar = new Folhar;
        $irrf = new Irrf;
        $user = auth()->user();
        $ano = explode('-',$datafinal);
        $irrflista = $irrf->buscaListaIrrf($ano[0]);
        $dados_folhar = [
            'codigo'=>'',
            'inicio'=>$datainicio,
            'final'=>$datafinal
        ];
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
        $basecalculos = $basecalculo->calculoLista($trabalhador,$datafinal);
        foreach ($basecalculos as $i => $basecalculo) {
            $valorbase = 0;
            $indece = 0;
            // $resultadoinss = 0;
            $base_irrf = str_replace(',','.',$irrflista[0]->irdepedente) * $basecalculo->binumfilhos;

            $base_irrf = $basecalculo->bifgts - $basecalculo->biinss - $base_irrf;
            $base_irrf = 2000.00;
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
                    $valorbase = 0;
                    $indece = 0;
                    // $resultadoinss = 0;
                    break;
                }elseif ($base_irrf > $valor_final_irrf[0] && $e === 0 && $i === $e && $base_irrf < $valor_final_irrf[1]) {
                    $valorbase = $base_irrf;
                    $indece = $irrf->irsindece;
                    // $resultado = $base_irrf * ((float)str_replace(',','.',$irrf->irsindece)/100);
                    // $resultadoinss =  $resultado ;
                    break;
                }elseif ($base_irrf > $valor_final_irrf[1] && $e === 1 && $i === $e && $base_irrf < $valor_final_irrf[2]) {
                    $valorbase = $base_irrf;
                    $indece = $irrf->irsindece;
                    // $resultado = $base_irrf * ((float)str_replace(',','.',$irrf->irsindece)/100);
                    // $resultadoinss =  $resultado ;
                    break;
                }elseif ($base_irrf > $valor_final_irrf[2] && $e === 2 && $i === $e && $base_irrf < $valor_final_irrf[3]) {
                    $valorbase = $base_irrf;
                    $indece = $irrf->irsindece;
                    // $resultado = $base_irrf * ((float)str_replace(',','.',$irrf->irsindece)/100);
                    // $resultadoinss =  $resultado ;
                    break;
                }elseif ($base_irrf > $valor_final_irrf[3] && $e === 3 && $i === $e) {
                    $valorbase = $base_irrf;
                    $indece = $irrf->irsindece;
                    // $resultado = $base_irrf * ((float)str_replace(',','.',$irrf->irsindece)/100);
                    // $resultadoinss =  $resultado ;
                    break;
                }
            }
            $basecalculo->cadastroFolhar($basecalculos[$i],$valorbase,$indece,$folhas['id']);
        }
        dd($basecalculos);
        // $valorcalculos = $valorcalculo->listaHorasnormais($trabalhador,$datafinal);
        // for ($i= 1; $i <= 31 ; $i++) { 
        //     $relacaodias = $relacaodia->listaRelacaoDia($trabalhador,$datafinal,$i);
        //     if (isset($relacaodias[0]->valor)) {
        //         dd($relacaodias);
        //     }
        //     echo($i).'<br>';
        // }
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
        $hora = explode(':',$horas);
        $hora = $hora[0].'.'.$hora[1];
        return $hora;
    }
   public function calculoPocentagem($valor,$porcentagem)
    {
        $resultado = $valor * ($porcentagem / 100);
        return $resultado;
    }
}
