<?php

namespace App\Http\Controllers\CalculoFolha;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Trabalhador;
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
use PDF;
class calculoFolhaPorTomadorController extends Controller
{
    public function calculoFolhaPorTomador($trabalhador = null,$tomador = null,$datainicio,$datafinal)
    {
        $ano = explode('-',$datafinal);
        $user = auth()->user();
        $funcionario = [];
        $cartaoponto_diarias = [
            'campos'=>[
                'id'=>[],
                'dia' => [],
                'valor' => [],
                'horas' => [],
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
                'quantidade'=> [],
                'id'=>[],
                'valor'=> []
            ],
            'diariaNormais'=>[
                'quantidade'=> [],
                'id'=>[],
                'valor'=> []
            ],
            'hora extra 50%'=>[
                'quantidade'=> [],
                'id'=>[],
                'valor'=> []
            ],
            'hora extra 100%'=>[
                'quantidade'=> [],
                'id'=>[],
                'valor'=> []
            ],
            'adicional noturno'=>[
                'quantidade'=> [],
                'id'=>[],
                'valor'=> []
            ],
            'gratificação'=>[
                'quantidade'=> [],
                'id'=>[],
                'valor'=> []
            ],
            'adiantamento'=>[
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
        $insslista = $inss->buscaUnidadeInss($ano[0]);
        $irrflista = $irrf->buscaListaIrrf($ano[0]);
        $bolcartaopontos = $bolcartaoponto->buscaListaLancamentoBolcartao($tomador,$datainicio,$datafinal);
        $lancamentorublicas = $lancamentorublica->buscaListaLancamentoRublica($tomador,$datainicio,$datafinal);
        // dd($lancamentorublicas,$bolcartaopontos);
        foreach ($bolcartaopontos as $key => $trabalhador) {
            array_push($funcionario,$trabalhador->trabalhador);
        }
        foreach ($lancamentorublicas as $key => $trabalhador) {
            array_push($funcionario,$trabalhador->trabalhador);
        }
        $trabalhadores = $trabalhado->listaTrabalhadorInt($funcionario);
        $tabelaprecos = $tabelapreco->buscaUnidadeTabelaRelatorio($tomador);
        $cartaopontos = $cartaoponto->buscaUnidadeTomador($tomador);
        $indecefolhas = $indecefolha->buscaUnidade_va_vt($tomador);
        $depedentes = $depedente->buscaListaDepedenteInt($funcionario);
        $sindicator = $empresa->buscaContribuicaoSidicato($user->empresa);
        $rublicas = $rublica->buscaListaRublica(0);
        foreach ($bolcartaopontos as $key => $bolcartaoponto) {
            if ($bolcartaoponto->created_at) {
                $dia = explode('-',$bolcartaoponto->created_at);
                $dia = explode('-',$bolcartaoponto->created_at);
                $dia = explode(' ',$dia[2]);
                foreach ($tabelaprecos as $key => $tabelapreco) {
                    if($tabelapreco->tsdescricao == 'hora extra 50%' && $bolcartaoponto->bshoraex){
                        array_push($cartaoponto_diarias['campos']['id'],$bolcartaoponto->trabalhador);
                        array_push($cartaoponto_diarias['campos']['dia'],$dia[0]);
                        array_push($cartaoponto_diarias['campos']['valor'],self::calculardia($bolcartaoponto->bshoraex,$tabelapreco->tsvalor));
                        array_push($cartaoponto_diarias['campos']['descricao'],$tabelapreco->tsdescricao);
                        array_push($cartaoponto_diarias['campos']['horas'],self::calcularhoras($bolcartaoponto->bshoraex));
                    }else if($tabelapreco->tsdescricao == 'hora extra 100%' && $bolcartaoponto->bshoraexcem){
                        array_push($cartaoponto_diarias['campos']['id'],$bolcartaoponto->trabalhador);
                        array_push($cartaoponto_diarias['campos']['dia'],$dia[0]);
                        array_push($cartaoponto_diarias['campos']['valor'],self::calculardia($bolcartaoponto->bshoraexcem,$tabelapreco->tsvalor));
                        array_push($cartaoponto_diarias['campos']['descricao'],$tabelapreco->tsdescricao);
                        array_push($cartaoponto_diarias['campos']['horas'],self::calcularhoras($bolcartaoponto->bshoraexcem));
                    }else if($tabelapreco->tsdescricao == 'hora normal' && $bolcartaoponto->horas_normais){
                        array_push($cartaoponto_diarias['campos']['id'],$bolcartaoponto->trabalhador);
                        array_push($cartaoponto_diarias['campos']['dia'],$dia[0]);
                        array_push($cartaoponto_diarias['campos']['valor'],self::calculardia($bolcartaoponto->horas_normais,$tabelapreco->tsvalor));
                        array_push($cartaoponto_diarias['campos']['descricao'],$tabelapreco->tsdescricao);
                        array_push($cartaoponto_diarias['campos']['horas'],self::calcularhoras($bolcartaoponto->horas_normais));
                    }else if($tabelapreco->tsdescricao == 'adicional noturno' && $bolcartaoponto->bsadinortuno){
                        array_push($cartaoponto_diarias['campos']['id'],$bolcartaoponto->trabalhador);
                        array_push($cartaoponto_diarias['campos']['dia'],$dia[0]);
                        array_push($cartaoponto_diarias['campos']['valor'],self::calculardia($bolcartaoponto->bsadinortuno,$tabelapreco->tsvalor));
                        array_push($cartaoponto_diarias['campos']['descricao'],$tabelapreco->tsdescricao);
                        array_push($cartaoponto_diarias['campos']['horas'],self::calcularhoras($bolcartaoponto->bsadinortuno));
                    }elseif ($tabelapreco->tsdescricao == 'adiantamento' && $tabelapreco->tsvalor) {
                        array_push($cartaoponto_diarias['campos']['valor'],$tabelapreco->tsvalor);
                        array_push($cartaoponto_diarias['campos']['descricao'],$tabelapreco->tsdescricao);
                        array_push($cartaoponto_diarias['campos']['horas'],1);
                        array_push($cartaoponto_diarias['campos']['id'],$bolcartaoponto->trabalhador);
                        // $total_desconto =  $boletim_tabela['adiantamento']['valor'];
                    }
                }
            }
        }
        foreach ($rublicas as $key => $rublica) {
            foreach ($lancamentorublicas as $key => $lancamentorublica) {
                if ($lancamentorublica->lsdescricao === $rublica->rsdescricao && $rublica->rsdc === 'Créditos') {
                    $dia = explode('-',$lancamentorublica->created_at);
                    $dia = explode('-',$lancamentorublica->created_at);
                    $dia = explode(' ',$dia[2]);
                    array_push($boletim_tabela['campos']['id'],$lancamentorublica->trabalhador);
                    array_push($boletim_tabela['campos']['dia'],$dia[0]);
                    $vencimento = $lancamentorublica->lfvalor * $lancamentorublica->lsquantidade;
                    array_push($boletim_tabela['campos']['valor'], $vencimento);
                    array_push($boletim_tabela['campos']['rubrica'], $lancamentorublica->lshistorico);
                    array_push($boletim_tabela['campos']['quantidade'], $lancamentorublica->lsquantidade);
                    array_push($boletim_tabela['campos']['codigo'], $rublica->rsrublica);
                    array_push($boletim_tabela['campos']['descricao'], $rublica->rsdescricao);
                }
            }
        }
        foreach ($boletim_tabela['campos']['rubrica'] as $key => $boletim_tabelas) {
            if ($boletim_tabelas === 'hora normal') {
                if (!in_array($boletim_tabela['campos']['id'],$boletim_tabela['horasNormais']['id'])) {
                    array_push($boletim_tabela['horasNormais']['quantidade'],$boletim_tabela['campos']['quantidade'][$key]);
                    array_push($boletim_tabela['horasNormais']['valor'],$boletim_tabela['campos']['valor'][$key]);
                    array_push($boletim_tabela['horasNormais']['id'],$boletim_tabela['campos']['id'][$key]);
                }
            }elseif ($boletim_tabelas === 'diaria normal') {
                if (!in_array($boletim_tabela['campos']['id'],$boletim_tabela['diariaNormais']['id'])) {
                    array_push($boletim_tabela['diariaNormais']['quantidade'],$boletim_tabela['campos']['quantidade'][$key]);
                    array_push($boletim_tabela['diariaNormais']['valor'],$boletim_tabela['campos']['valor'][$key]);
                    array_push($boletim_tabela['diariaNormais']['id'],$boletim_tabela['campos']['id'][$key]);
                }
            }elseif ($boletim_tabelas === 'hora extra 50%') {
                if (!in_array($boletim_tabela['campos']['id'],$boletim_tabela['hora extra 50%']['id'])) {
                    array_push($boletim_tabela['hora extra 50%']['quantidade'],$boletim_tabela['campos']['quantidade'][$key]);
                    array_push($boletim_tabela['hora extra 50%']['valor'],$boletim_tabela['campos']['valor'][$key]);
                    array_push($boletim_tabela['hora extra 50%']['id'],$boletim_tabela['campos']['id'][$key]);
                }
            }elseif ($boletim_tabelas === 'hora extra 100%') {
                if (!in_array($boletim_tabela['campos']['id'],$boletim_tabela['hora extra 100%']['id'])) {
                    array_push($boletim_tabela['hora extra 100%']['quantidade'],$boletim_tabela['campos']['quantidade'][$key]);
                    array_push($boletim_tabela['hora extra 100%']['valor'],$boletim_tabela['campos']['valor'][$key]);
                    array_push($boletim_tabela['hora extra 100%']['id'],$boletim_tabela['campos']['id'][$key]);
                }
            }elseif ($boletim_tabelas === 'adicional noturno') {
                if (!in_array($boletim_tabela['campos']['id'],$boletim_tabela['adicional noturno']['id'])) {
                    array_push($boletim_tabela['adicional noturno']['quantidade'],$boletim_tabela['campos']['quantidade'][$key]);
                    array_push($boletim_tabela['adicional noturno']['valor'],$boletim_tabela['campos']['valor'][$key]);
                    array_push($boletim_tabela['adicional noturno']['id'],$boletim_tabela['campos']['id'][$key]);
                }
            }elseif ($boletim_tabelas === 'gratificação') {
                if (!in_array($boletim_tabela['campos']['id'],$boletim_tabela['gratificação']['id'])) {
                    array_push($boletim_tabela['gratificação']['quantidade'],$boletim_tabela['campos']['quantidade'][$key]);
                    array_push($boletim_tabela['gratificação']['valor'],$boletim_tabela['campos']['valor'][$key]);
                    array_push($boletim_tabela['gratificação']['id'],$boletim_tabela['campos']['id'][$key]);
                }
            }
        }
        
        foreach ($cartaoponto_diarias['campos']['descricao'] as $key => $cartaopontos_descricao) {
            
            foreach ($boletim_tabela['horasNormais']['id'] as $i => $boletim_tabela_id) {
                if ($boletim_tabela_id === $cartaoponto_diarias['campos']['id'][$key] && $cartaopontos_descricao === 'hora normal') {
                    $boletim_tabela['horasNormais']['valor'][$i] += $cartaoponto_diarias['campos']['valor'][$key];
                    $boletim_tabela['horasNormais']['quantidade'][$i] += $cartaoponto_diarias['campos']['horas'][$key];
                }
            }
            foreach ($boletim_tabela['hora extra 50%']['id'] as $i => $boletim_tabela_ex50_id) {
                if ($boletim_tabela_ex50_id === $cartaoponto_diarias['campos']['id'][$key] && $cartaopontos_descricao === 'hora extra 50%') {
                    
                    $boletim_tabela['hora extra 50%']['valor'][$i] += $cartaoponto_diarias['campos']['valor'][$key];
                    $boletim_tabela['hora extra 50%']['quantidade'][$i] += $cartaoponto_diarias['campos']['horas'][$key];
                }
            }
            foreach ($boletim_tabela['hora extra 100%']['id'] as $i => $boletim_tabela_ex100_id) {
                if ($boletim_tabela_ex100_id === $cartaoponto_diarias['campos']['id'][$key] && $cartaopontos_descricao === 'hora extra 100%') {
                       
                       $boletim_tabela['hora extra 100%']['valor'][$i] += $cartaoponto_diarias['campos']['valor'][$key];
                       $boletim_tabela['hora extra 100%']['quantidade'][$i] += $cartaoponto_diarias['campos']['horas'][$key];
                }
            }
            foreach ($boletim_tabela['adicional noturno']['id'] as $i => $boletim_tabela_noturno_id) {
                if ($boletim_tabela_noturno_id === $cartaoponto_diarias['campos']['id'][$key] && $cartaopontos_descricao === 'adicional noturno') {
                       
                       $boletim_tabela['adicional noturno']['valor'][$i] += $cartaoponto_diarias['campos']['valor'][$key];
                       $boletim_tabela['adicional noturno']['quantidade'][$i] += $cartaoponto_diarias['campos']['horas'][$key];
                }
            }
            foreach ($boletim_tabela['gratificação']['id'] as $i => $boletim_tabela_gradificacao_id) {
                if ($boletim_tabela_gradificacao_id === $cartaoponto_diarias['campos']['id'][$key] && $cartaopontos_descricao === 'gratificação') {
                       
                       $boletim_tabela['gratificação']['valor'][$i] += $cartaoponto_diarias['campos']['valor'][$key];
                       $boletim_tabela['gratificação']['quantidade'][$i] += $cartaoponto_diarias['campos']['horas'][$key];
                }
            }
            foreach ($boletim_tabela['diariaNormais']['id'] as $i => $boletim_tabela_diariaNormais_id) {
                if ($boletim_tabela_diariaNormais_id === $cartaoponto_diarias['campos']['id'][$key] && $cartaopontos_descricao === 'diaria normal') {
                       $boletim_tabela['diariaNormais']['valor'][$i] += $cartaoponto_diarias['campos']['valor'][$key];
                       $boletim_tabela['diariaNormais']['quantidade'][$i] += $cartaoponto_diarias['campos']['horas'][$key];
                }
            }
            if ($cartaopontos_descricao === 'adiantamento') {
                if(!in_array($cartaoponto_diarias['campos']['id'][$key],$boletim_tabela['adiantamento']['id'])){
                    array_push($boletim_tabela['adiantamento']['id'],$cartaoponto_diarias['campos']['id'][$key]);
                    array_push($boletim_tabela['adiantamento']['valor'],$cartaoponto_diarias['campos']['valor'][$key]);
                    array_push($boletim_tabela['adiantamento']['quantidade'],$cartaoponto_diarias['campos']['horas'][$key]);
                    array_push($boletim_tabela['desconto']['id'],$cartaoponto_diarias['campos']['id'][$key]);
                    array_push($boletim_tabela['desconto']['valor'],$cartaoponto_diarias['campos']['valor'][$key]);
                }
            }
        }
        
        $dadosTrabalhador['tomador_cartao_ponto_horas'] += self::calculardia($cartaopontos->csdiasuteis,null);
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
        $tomador_incide_folha = $indecefolhas->instransporte;
        
        foreach ($dadosTrabalhador['tomador_cartao_ponto_quantidade'] as $key => $quantidade) {
            array_push($dadosTrabalhador['tomador_cartao_ponto_vt'],$tomador_incide_folha * ceil($quantidade));
            array_push($boletim_tabela['vencimento']['valor'],$dadosTrabalhador['tomador_cartao_ponto_vt'][$key]);
        }
        $tomador_incide_folha = $indecefolhas->insalimentacao;
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
            array_push($boletim_tabela['salario']['valor'],$salario);
            array_push($boletim_tabela['salario']['id'],$trabalhador_id->trabalhador);
        }
        foreach ($boletim_tabela['salario']['valor'] as $key => $valor_salario) {
            array_push($boletim_tabela['dsr1818']['valor'],self::calculoPocentagem($valor_salario,18.18));
            array_push($boletim_tabela['dsr1818']['id'],$boletim_tabela['salario']['id'][$key]);

            $boletim_tabela['vencimento']['valor'][$key] += $boletim_tabela['dsr1818']['valor'][$key] + $valor_salario;

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
        
        foreach ($depedentes as $key => $depedentes_valor) {
            $base_irrf = str_replace(',','.',$irrflista[0]->irdepedente) * $depedentes_valor->depedentes;
            array_push($boletim_tabela['base_irrf']['valor'],$base_irrf);
            array_push($boletim_tabela['base_irrf']['id'],$depedentes_valor->trabalhador);
        }
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
        foreach ($boletim_tabela['base_irrf']['valor'] as $key => $base_irrf_valor) {
            $boletim_tabela['base_irrf']['valor'][$key] = $boletim_tabela['base_fgts']['valor'][$key]- $boletim_tabela['inss']['resultadoinss'][$key] - $boletim_tabela['base_irrf']['valor'][$key];
            if ($boletim_tabela['base_irrf']['valor'][$key] < 0) {
                $boletim_tabela['base_irrf']['valor'][$key] = 0;
            }
        }
        foreach ($irrflista as $key => $irrf) {
            $novoirrf =  str_replace(".","",$irrf->irsvalorfinal);
            $novoirrf =  str_replace(',','.',$novoirrf);
            $novoirrf = (float) $novoirrf;
            if (!in_array($novoirrf, $valor_final_irrf)) {
                array_push($valor_final_irrf,$novoirrf);
            }
        }
        foreach ($boletim_tabela['base_irrf']['valor'] as $i => $base_irrf_valor) {
            $resultado = 0;
            array_push($boletim_tabela['irrf']['id'],$boletim_tabela['base_irrf']['id'][$i]);
            foreach ($irrflista as $e => $irrf) {
                if ($base_irrf_valor < $valor_final_irrf[0] && $i === $e) {
                    array_push($boletim_tabela['irrf']['valorbase'],0);
                    array_push($boletim_tabela['irrf']['indece'],0);
                    array_push($boletim_tabela['irrf']['resultadoinss'],0);
                }elseif ($base_irrf_valor > $valor_final_irrf[0] && $e === 0 && $i === $e && $base_irrf_valor < $valor_final_irrf[1]) {
                    array_push($boletim_tabela['irrf']['valorbase'],$irrf->irsvalorfinal);
                    array_push($boletim_tabela['irrf']['indece'],$irrf->irsindece);
                    $resultado = $base_irrf_valor * ((float)str_replace(',','.',$irrf->irsindece)/100);
                    array_push($boletim_tabela['irrf']['resultadoinss'],$resultado);
                    break;
                }elseif ($base_irrf_valor > $valor_final_irrf[1] && $e === 1 && $i === $e && $base_irrf_valor < $valor_final_irrf[2]) {
                    array_push($boletim_tabela['irrf']['valorbase'],$irrf->irsvalorfinal);
                    array_push($boletim_tabela['irrf']['indece'],$irrf->irsindece);
                    $resultado = $base_irrf_valor * ((float)str_replace(',','.',$irrf->irsindece)/100);
                    array_push($boletim_tabela['irrf']['resultadoinss'],$resultado);
                    break;
                }elseif ($base_irrf_valor > $valor_final_irrf[2] && $e === 2 && $i === $e && $base_irrf_valor < $valor_final_irrf[3]) {
                    array_push($boletim_tabela['irrf']['valorbase'],$irrf->irsvalorfinal);
                    array_push($boletim_tabela['irrf']['indece'],$irrf->irsindece);
                    $resultado = $base_irrf_valor * ((float)str_replace(',','.',$irrf->irsindece)/100);
                    array_push($boletim_tabela['irrf']['resultadoinss'],$resultado);
                    break;
                }elseif ($base_irrf_valor > $valor_final_irrf[3] && $e === 3 && $i === $e) {
                    array_push($boletim_tabela['irrf']['valorbase'],$irrf->irsvalorfinal);
                    array_push($boletim_tabela['irrf']['indece'],$irrf->irsindece);
                    $resultado = $base_irrf_valor * ((float)str_replace(',','.',$irrf->irsindece)/100);
                    array_push($boletim_tabela['irrf']['resultadoinss'],$resultado);
                    break;
                }
            }
            array_push($boletim_tabela['desconto']['valor'],$resultado);
            array_push($boletim_tabela['desconto']['id'],$boletim_tabela['valor_inss']['id'][$i]);
        }
        $sindicator = str_replace(".","",$sindicator->escondicaosindicato);
        $sindicator = str_replace(',','.',$sindicator);
        $sindicator = (float) $sindicator;
        foreach ($boletim_tabela['decimo_ter']['valor'] as $key => $decimo_ter_valor) {
            $inss_sobre_ter = $decimo_ter_valor * 0.075;
            array_push($boletim_tabela['inss_sobre_ter']['valor'],$inss_sobre_ter);
        }
        
        // dd($boletim_tabela,$dadosTrabalhador,$depedentes); 
        $pdf = PDF::loadView('comprovantePagDiatomador',compact('dadosTrabalhador','trabalhadores','boletim_tabela','sindicator','depedentes'));
        return $pdf->setPaper('a4')->stream('RECIBO PAGAMENTO SALÁRIO.pdf');
        
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
