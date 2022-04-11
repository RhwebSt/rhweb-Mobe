<?php

namespace App\Http\Controllers\CalculoFolha;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
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
use App\Lancamentotabela;
use App\Leis;
use PDF;
class calculoFolhaGeralController extends Controller
{
    private $rublica,$leis,$lancamentotabela,$trabalhado,$empresa,$depedente,
    $bolcartaoponto,$lancamentorublica,$tabelapreco,$inss,$irrf,$indecefolha,
    $cartaoponto,$tomador,$valoresrublica,$basecalculo,$valorcalculo,$relacaodia,$folhar,$desconto;
    public function __construct()
    {
        $this->trabalhado = new Trabalhador;
        $this->empresa = new Empresa;
        $this->depedente = new Dependente;
        $this->bolcartaoponto = new Bolcartaoponto;
        $this->lancamentorublica = new Lancamentorublica;   
        $this->tabelapreco = new TabelaPreco;
        $this->inss = new Inss;
        $this->irrf = new Irrf;
        $this->indecefolha = new IncideFolhar;
        $this->cartaoponto = new CartaoPonto;
        $this->tomador = new Tomador;
        $this->valoresrublica = new ValoresRublica;
        $this->basecalculo = new BaseCalculo;
        $this->valorcalculo = new ValorCalculo;
        $this->relacaodia = new RelacaoDia;
        $this->rublica = new Rublica;
        $this->leis = new Leis;
        $this->lancamentotabela = new Lancamentotabela;
        $this->folhar = new Folhar;
        $this->desconto = new Descontos;
    }
    public function calculoFolhaGeral($datainicio,$datafinal,$competencia)
    {
        $folhar = new Folhar; 
        $today = Carbon::today();
        // if (strtotime($datafinal) > strtotime($today)) {
        //     return redirect()->back()->withInput()->withErrors(['ano_final'=>'Só é valida data atuais!']);
        // }
        // if (strtotime($datainicio) > strtotime($today)) {
        //     return redirect()->back()->withInput()->withErrors(['ano_inicial'=>'Só é valida data atuais!']);
        // }
        $folhas = $folhar->verificaFolhar($datainicio,$datafinal);
        $lancamentotabela = $this->lancamentotabela->verificarFolhar($datainicio,$datafinal);
        if(!$lancamentotabela){
            return redirect()->back()->withInput()->withErrors(['false'=>'Não existe nenhum valor neste período.']);
        }
        if ($folhas) {
            return redirect()->route('calculo.folha.index')->withInput()->withErrors(['false'=>'Esta data e o número da folha já estão cadastrados.']);
        }
        $ano = explode('-',$datafinal);
        $user = auth()->user();
         
        $dias = [];
        $trabalhado_cal_folha = [];
        $tomador_cal_folha = [];
        $tabelapreco_codigo = [];
        $basecalculoid = [];
        $numerofolhar = 0;
       
        $insslista = $this->inss->buscaUnidadeInss($ano[0]);
        $irrflista = $this->irrf->buscaListaIrrf($ano[0]);
        
        if (count($insslista) < 1) {
            return redirect()->back()->withErrors(['false'=>'O inss '.$ano[0].' não está cadastrado. Entre em contato com suporte.']);
        }elseif (count($irrflista) < 1) {
            return redirect()->back()->withErrors(['false'=>'O irrf '.$ano[0].' não está cadastrado. Entre em contato com suporte.']);
        }

        $rublicas = $this->rublica->buscaListaRublica(0);
        foreach ($rublicas as $key => $rublicas_valor) {
            if (!in_array($rublicas_valor->tsrubrica,$tabelapreco_codigo)) {
                array_push($tabelapreco_codigo,$rublicas_valor->rsrublica);
            }
        }
        $tomadores = $this->tomador->buscaListaTomador($user->empresa);
        $quantidadetomador = count($tomadores);
        
        foreach ($tomadores as $t => $tomador_id) {
            $bolcartaopontos = $this->bolcartaoponto->buscaListaLancamentoBolcartao($tomador_id->id,$datainicio,$datafinal);
            $lancamentorublicas = $this->lancamentorublica->buscaListaLancamentoRublica($tomador_id->id,$datainicio,$datafinal);
        if (count($bolcartaopontos) > 0 || count($lancamentorublicas) > 0) {
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
                    'quantidade'=>[],
                    'valor'=>[]
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
           
            $valorfinal = [];
            
            // dd($bolcartaopontos,$lancamentorublicas);
            foreach ($bolcartaopontos as $key => $trabalhador) {
                array_push($funcionario,$trabalhador->trabalhador);
                array_push($trabalhado_cal_folha,$trabalhador->trabalhador);
            }
            foreach ($lancamentorublicas as $key => $trabalhador) {
                array_push($funcionario,$trabalhador->trabalhador);
                array_push($trabalhado_cal_folha,$trabalhador->trabalhador);
            }
            
            $trabalhadores = $this->trabalhado->listaTrabalhadorInt($funcionario);
            // dd($trabalhadores,$funcionario,$bolcartaopontos,$lancamentorublicas);
            $tabelaprecos = $this->tabelapreco->buscaUnidadeTabelaRelatorio($tomador_id->id);
            $cartaopontos = $this->cartaoponto->buscaUnidadeTomador($tomador_id->id);
            $indecefolhas = $this->indecefolha->buscaUnidade_va_vt($tomador_id->id);
            $depedentes = $this->depedente->buscaListaDepedenteInt($funcionario);
            $sindicator = $this->empresa->buscaContribuicaoSidicato($user->empresa);
            $rublicas = $this->rublica->buscaListaRublica(0);
            
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
                        if ($lancamentorublica_valor->licodigo == $tabelapreco->tsrubrica) {
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
                    if (isset($boletim_tabela['horasNormais']['quantidade'][$z])) {
                        $horasnormais = $boletim_tabela['horasNormais']['quantidade'][$z];
                    }else{
                        $horasnormais = 0;
                    }
                    
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
                    $vt =  $this->rublica->buscaRublicaUnidade('Vale transporte');
                    if (isset($indecefolhas->instransporte)) {
                        array_push($boletim_tabela['vt']['rublicas'],$vt->rsdescricao);
                        array_push($boletim_tabela['vt']['codigos'],$vt->rsrublica);
                        $resultadovt = $indecefolhas->instransporte * ceil($resultado);
                        array_push($boletim_tabela['vt']['valor'],$resultadovt);
                        array_push($boletim_tabela['vencimento']['valor'],$resultadovt);
                    }
                    $va =  $this->rublica->buscaRublicaUnidade('Vale alimentação');
                    if (isset($indecefolhas->insalimentacao)) {
                        array_push($boletim_tabela['va']['rublicas'],$va->rsdescricao);
                        array_push($boletim_tabela['va']['codigos'],$va->rsrublica);
                        $resultadova = $indecefolhas->insalimentacao * ceil($resultado);
                        array_push($boletim_tabela['va']['valor'],$resultadova);
                        $boletim_tabela['vencimento']['valor'][$z] += $resultadova;
                    }
                }
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
                foreach ($boletim_tabela['adicional noturno']['id'] as $i => $boletim_tabela_adicionalnoturno_id) {
                    if ($boletim_tabela_adicionalnoturno_id === $trabalhador_id->trabalhador) {
                        $salario += $boletim_tabela['adicional noturno']['valor'][$i];
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
                $dsr =  $this->rublica->buscaRublicaUnidade('DSR 18,18%');
                array_push($boletim_tabela['dsr1818']['codigos'],$dsr->rsrublica);
                array_push($boletim_tabela['dsr1818']['rublicas'],$dsr->rsdescricao);
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
                $salario13 =  $this->rublica->buscaRublicaUnidade('13º Salário');
                
                array_push($boletim_tabela['decimo_ter']['codigos'],$salario13->rsrublica);
                array_push($boletim_tabela['decimo_ter']['rublicas'],$salario13->rsdescricao);
                array_push($boletim_tabela['decimo_ter']['quantidade'],8.34);
                $ferias =  $this->rublica->buscaRublicaUnidade('Ferias + 1/3');
                array_push($boletim_tabela['ferias_decimoter']['valor'],self::calculoPocentagem($serviso_dsr_valor,11.12));
                array_push($boletim_tabela['ferias_decimoter']['id'],$boletim_tabela['serviso_dsr']['id'][$key]);
                array_push($boletim_tabela['ferias_decimoter']['codigos'],$ferias->rsrublica);
                array_push($boletim_tabela['ferias_decimoter']['rublicas'],$ferias->rsdescricao);
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
            
            $inss_rublica =  $this->rublica->buscaRublicaUnidade('INSS');
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
                        
                        $resultadoinss = $valor_inss * ((float)str_replace(',','.',$inss->isindece)/100);
                        array_push($boletim_tabela['inss']['valor'],$resultadoinss);
                        array_push($boletim_tabela['inss']['codigos'],$inss_rublica->rsrublica);
                        array_push($boletim_tabela['inss']['rublicas'],$inss_rublica->rsdescricao);
                        array_push($boletim_tabela['inss']['quantidade'],$base_inss/$resultadoinss);
                        // dd($base_inss/$resultadoinss);
                        
                        break;
                    }elseif ($valor_inss > $valorfinal[0] && $valor_inss <= $valorfinal[$key] && $key === 1) {
                        array_push($boletim_tabela['inss']['valorbase'],$inss->isvalorfinal);
                        // array_push($boletim_tabela['inss']['quantidade'],$inss->isindece);
                        $resultadoinss = $valor_inss - $valorfinal[0];
                        $resultadoinss = $resultadoinss * ((float)str_replace(',','.',$inss->isindece)/100);
                        $resultadoinss = $resultadoinss + ((float)str_replace(',','.',$insslista[0]->isreducao));
                        array_push($boletim_tabela['inss']['valor'],$resultadoinss);
                        array_push($boletim_tabela['inss']['codigos'],$inss_rublica->rsrublica);
                        array_push($boletim_tabela['inss']['rublicas'],$inss_rublica->rsdescricao);
                        array_push($boletim_tabela['inss']['quantidade'],$base_inss/$resultadoinss);
                      break;
                    }elseif ($valor_inss <= $valorfinal[$key] && $key === 2) {
                        array_push($boletim_tabela['inss']['valorbase'],$inss->isvalorfinal);
                        // array_push($boletim_tabela['inss']['quantidade'],$inss->isindece);
                        $resultadoinss = $valor_inss - $valorfinal[1];
                        $resultadoinss = $resultadoinss * ((float)str_replace(',','.',$inss->isindece)/100);
                        $resultadoinss = $resultadoinss + ((float)str_replace(',','.',$insslista[1]->isreducao));
                        array_push($boletim_tabela['inss']['valor'],$resultadoinss);
                        array_push($boletim_tabela['inss']['codigos'],$inss_rublica->rsrublica);
                        array_push($boletim_tabela['inss']['rublicas'],$inss_rublica->rsdescricao);
                        array_push($boletim_tabela['inss']['quantidade'],$base_inss/$resultadoinss);
                      break;
                    }elseif ($valor_inss >= $valorfinal[$key] && $key === 3) {
                        array_push($boletim_tabela['inss']['valorbase'],$inss->isvalorfinal);
                        // array_push($boletim_tabela['inss']['quantidade'],$inss->isindece);
                        $resultadoinss = $valor_inss - $valorfinal[2];
                        $resultadoinss = $resultadoinss * ((float)str_replace(',','.',$inss->isindece)/100);
                        $resultadoinss = $resultadoinss + ((float)str_replace(',','.',$insslista[2]->isreducao));
                        array_push($boletim_tabela['inss']['valor'],$resultadoinss);
                        array_push($boletim_tabela['inss']['codigos'],$inss_rublica->rsrublica);
                        array_push($boletim_tabela['inss']['rublicas'],$inss_rublica->rsdescricao);
                        array_push($boletim_tabela['inss']['quantidade'],$base_inss/$resultadoinss);
                      break;
                    }
                }
                array_push($boletim_tabela['desconto']['valor'],$resultadoinss);
                array_push($boletim_tabela['desconto']['id'],$boletim_tabela['valor_inss']['id'][$i]);
            }
           
            // dd($boletim_tabela,$inss_rublica,$insslista,$valorfinal,$valor_inss);
            $inss13_rublica =  $this->rublica->buscaRublicaUnidade('INSS Sobre 13º Salário');
            foreach ($boletim_tabela['decimo_ter']['valor'] as $key => $decimo_ter_valor) {
                
                $inss_sobre_ter = $decimo_ter_valor * 0.075;
                array_push($boletim_tabela['inss_sobre_ter']['valor'],$inss_sobre_ter);
                array_push($boletim_tabela['inss_sobre_ter']['codigos'],$inss13_rublica->rsrublica);
                array_push($boletim_tabela['inss_sobre_ter']['rublicas'],$inss13_rublica->rsdescricao);
                array_push($boletim_tabela['inss_sobre_ter']['quantidade'],7.5);
                array_push($boletim_tabela['inss_sobre_ter']['id'],$boletim_tabela['decimo_ter']['id'][$key]);
                $boletim_tabela['desconto']['valor'][$key] += $inss_sobre_ter;
              
            }
           
            foreach ($trabalhadores as $i => $trabalhadores_id) {
                $desconto = 0;
             
                foreach ($boletim_tabela['desconto']['id'] as $i => $desconto_id) {
                    if ($desconto_id === $trabalhadores_id->trabalhador) {
                        $desconto += $boletim_tabela['desconto']['valor'][$i];
                    }
                }
               
                array_push($boletim_tabela['novodesconto']['id'],$trabalhadores_id->id);
                array_push($boletim_tabela['novodesconto']['valor'],$desconto);
            }
            // dd($boletim_tabela,$trabalhadores);
            foreach ($trabalhadores as $key => $trabalhador) {
                $novodepedentes = 0;
                foreach ($depedentes as $d => $depedente) {
                    if ($trabalhador->id === $depedente->trabalhador) {
                        $novodepedentes = $depedente->depedentes;
                    }
                }
                $basecalculos = $this->basecalculo->cadastro($boletim_tabela,$novodepedentes,$tomador_id->id,null,$key,$datafinal);
                // dd($boletim_tabela,$trabalhadores,$basecalculos);
                array_push($basecalculoid,$basecalculos['id']);
                if ($basecalculos['id']) {
                    foreach ($boletim_tabela['horasNormais']['id'] as $key => $horasNormais_valor) {
                        if ($horasNormais_valor === $trabalhador->id) {
                            $this->valorcalculo->cadastroHorasnormais($boletim_tabela,$basecalculos['id'],$trabalhador->id,$key,$datafinal);
                        }
                    }
                    foreach ($boletim_tabela['hora extra 50%']['id'] as $key => $horasex_50_valor) {
                        if ($horasex_50_valor === $trabalhador->id) {
                            $this->valorcalculo->cadastroHorasEx50($boletim_tabela,$basecalculos['id'],$trabalhador->id,$key,$datafinal);
                        }
                    }
                    foreach ($boletim_tabela['hora extra 100%']['id'] as $key => $horasex_100_valor) {
                        if ($horasex_100_valor === $trabalhador->id) {
                            $this->valorcalculo->cadastroHorasEx100($boletim_tabela,$basecalculos['id'],$trabalhador->id,$key,$datafinal);
                        }
                    }
                    foreach ($boletim_tabela['diariaNormais']['id'] as $key => $diariaNormais_valor) {
                        if($diariaNormais_valor === $trabalhador->id) {
                            $this->valorcalculo->cadastrodiariaNormais($boletim_tabela,$basecalculos['id'],$trabalhador->id,$key,$datafinal);
                        }
                    }

                    foreach ($boletim_tabela['adicional noturno']['id'] as $key => $adicionalnoturno_valor) {
                        if($adicionalnoturno_valor === $trabalhador->id) {
                            $this->valorcalculo->cadastroadicionalNoturno($boletim_tabela,$basecalculos['id'],$trabalhador->id,$key,$datafinal);
                        }
                    }
                   
                    foreach ($boletim_tabela['gratificação']['id'] as $key => $gratificacao_valor) {
                        if($gratificacao_valor === $trabalhador->id) {
                            $this->valorcalculo->cadastroGratificacao($boletim_tabela,$basecalculos['id'],$trabalhador->id,$key,$datafinal);
                        }
                    }
                    
                    foreach ($boletim_tabela['producao']['id'] as $key => $producao_valor) {
                        if($producao_valor === $trabalhador->id) {
                            $this->valorcalculo->cadastroProducao($boletim_tabela,$basecalculos['id'],$trabalhador->id,$key,$datafinal);
                        }
                    }
                    
                    foreach ($boletim_tabela['dsr1818']['id'] as $key => $dsr1818_valor) {
                        if($dsr1818_valor === $trabalhador->id) {
                            $this->valorcalculo->cadastrodsr1818($boletim_tabela,$basecalculos['id'],$trabalhador->id,$key,$datafinal);
                        }
                    }
                   
                    foreach ($boletim_tabela['ferias_decimoter']['id'] as $key => $ferias_decimoter_valor) {
                        if($ferias_decimoter_valor === $trabalhador->id) {
                            $this->valorcalculo->cadastraFeriasDecimoter($boletim_tabela,$basecalculos['id'],$trabalhador->id,$key,$datafinal);
                        }
                    }
                    if (array_key_exists($key,$boletim_tabela['decimo_ter']['id'])) {
                        
                    }
                    foreach ($boletim_tabela['decimo_ter']['id'] as $key => $decimoter_valor) {
                        if($decimoter_valor === $trabalhador->id) {
                            $this->valorcalculo->cadastraDecimoTer($boletim_tabela,$basecalculos['id'],$trabalhador->id,$key,$datafinal);
                        }
                    }
                   
                    foreach ($boletim_tabela['inss_sobre_ter']['id'] as $key => $inss_sobre_ter_valor) {
                        if($inss_sobre_ter_valor === $trabalhador->id) {
                            $this->valorcalculo->cadastrainssSobreTer($boletim_tabela,$basecalculos['id'],$trabalhador->id,$key,$datafinal);
                        }
                    }
                   
                    foreach ($boletim_tabela['inss']['id'] as $key => $inss_valor) {
                        if($inss_valor === $trabalhador->id) {
                            //dd($boletim_tabela);
                            $this->valorcalculo->cadastraInssTomador($boletim_tabela,$basecalculos['id'],$trabalhador->id,$key,$datafinal);
                        }else{
                            
                        }
                    }
                    
                    foreach ($boletim_tabela['sindicator']['id'] as $key => $sindicator_valor) {
                        if($sindicator_valor === $trabalhador->id) {
                            $this->valorcalculo->cadastroSindicator($boletim_tabela,$basecalculos['id'],$trabalhador->id,$key,$datafinal);
                        }
                    }
                    
                    foreach ($boletim_tabela['seguro']['id'] as $key => $seguro_valor) {
                        if($seguro_valor === $trabalhador->id) {
                            $this->valorcalculo->cadastroSeguro($boletim_tabela,$basecalculos['id'],$trabalhador->id,$key,$datafinal);
                        }
                    }
                   
                    foreach ($boletim_tabela['vt']['id'] as $key => $vt_valor) {
                        if($vt_valor === $trabalhador->id) {
                            $this->valorcalculo->cadastroVT($boletim_tabela,$basecalculos['id'],$trabalhador->id,$key,$datafinal);
                        }
                    }
                    
                    foreach ($boletim_tabela['va']['id'] as $key => $va_valor) {
                        if($va_valor === $trabalhador->id) {
                            $this->valorcalculo->cadastroVA($boletim_tabela,$basecalculos['id'],$trabalhador->id,$key,$datafinal);
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
                            $this->relacaodia->cadastro($novodia,$resultador,$basecalculos['id'],$trabalhador->id,$datafinal);
                        }
                    }
                }
            }
        }
            if (($quantidadetomador - 1) === $t) {
                $calculofolhar = self::calculoFolhar($trabalhado_cal_folha,$tomador_cal_folha,$tabelapreco_codigo,$datainicio,$datafinal,$competencia);
                return redirect()->route('calculo.folha.index')->withSuccess('Cadastro realizado com sucesso.');
                if ($calculofolhar) {
                    return redirect()->route('calculo.folha.index')->withSuccess('Cadastro realizado com sucesso.');
                }
            }
        }
        try {
        } catch (\Throwable $th) {
            $this->valorcalculo->deletar($basecalculoid);
            $this->relacaodia->deletar($basecalculoid);
            $this->basecalculo->deletar($basecalculoid);
            return redirect()->back()->withInput()->withErrors(['false'=>'Não foi porssível cadastra o registro.']);
        }
       
        
    }
    public function calculoFolhar($trabalhador,$tomador,$tabelapreco_codigo,$datainicio,$datafinal,$competencia)
    {
        
       
        $user = auth()->user();
        $ano = explode('-',$datafinal);
        
            //code...

        
        $irrflista = $this->irrf->buscaUnidadeIrrf($ano[0]);
        
        $insslista = $this->inss->buscaUnidadeInss($ano[0]);
        $dados_folhar = [
            'codigo'=>'',
            'inicio'=>$datainicio,
            'final'=>$datafinal,
            'competencia'=>$competencia,
        ];
        
        $descontos = $this->desconto->buscaRelatorioTrabalhador($user->empresa,$trabalhador,$datainicio,$datafinal);
        $basecalculos_15 = $this->basecalculo->boletimBusca($trabalhador,$datainicio,$datafinal);
        
        // dd($trabalhador,$descontos);
        $sindicator = $this->empresa->buscaContribuicaoSidicato($user->empresa);
        $seguros = $this->empresa->buscaSeguro($user->empresa);
        $valor_final_irrf = [];
        $folhas = $this->folhar->buscaUltimaoRegistroFolhar($user->empresa);
        if ($folhas) {
            $dados_folhar['codigo'] = $folhas->fscodigo + 1;
            $folhas = $this->folhar->cadastro($dados_folhar,$user->empresa);
        }else{
            $valoresrublicas = $this->valoresrublica->buscaUnidadeEmpresa($user->empresa);
            if (empty($valoresrublicas->vsnroflha)) {
                $numerofolhar = 1;
                $dados_folhar['codigo'] = $numerofolhar;
                $this->valoresrublica->editarUnidadeNuFolhar($user->empresa,$numerofolhar);
                $folhas = $this->folhar->cadastro($dados_folhar,$user->empresa);
            }else{
                $dados_folhar['codigo'] = $valoresrublicas->vsnroflha + 1;
                $folhas = $this->folhar->cadastro($dados_folhar,$user->empresa);
            }
        } 
        $this->basecalculo->editerFk($tomador,$datafinal,$folhas['id']);
        $basecalculos = $this->basecalculo->calculoLista($trabalhador,$datafinal);
        // dd($basecalculos);
        $inss_valores = $this->valorcalculo->buscaInss($trabalhador,$datafinal);
        $inss13_valores = $this->valorcalculo->buscaInss13($trabalhador,$datafinal);
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
                // dd($basecalculos_15,$trabalhador);
                foreach ($basecalculos_15 as $key => $basecalculos_15_valor) {
                    if ($basecalculo->trabalhador === $basecalculos_15_valor->trabalhador) {
                        $basecalculos[$i]->valorliquido -= $basecalculos_15_valor->bivalorliquido;
                        $basecalculos[$i]->valordesconto += $basecalculos_15_valor->bivalorliquido;
                    }
                }
              
                // foreach ($descontos as $d => $desconto) {
                //     if ($basecalculo->trabalhador === $desconto->id && $desconto->dsquinzena === '2 - Segunda') {
                //         $basecalculos[$i]->valorliquido -= $desconto->valor;
                //         $basecalculos[$i]->valordesconto += $desconto->valor;
                //     }
                // }
            }
    
            foreach ($descontos as $d => $desconto) {
                if ($basecalculo->trabalhador === $desconto->id && $desconto->dsquinzena === '1 - Primeira' && strpos($datafinal,$desconto->dscompetencia) !== false) {
                    $basecalculos[$i]->valorliquido -= $desconto->valor;
                    $basecalculos[$i]->valordesconto += $desconto->valor;
                }else if ($basecalculo->trabalhador === $desconto->id && $desconto->dsquinzena === '2 - Segunda' && strpos($datafinal,$desconto->dscompetencia) !== false) {
                    $basecalculos[$i]->valorliquido -= $desconto->valor;
                    $basecalculos[$i]->valordesconto += $desconto->valor;
                }
            }
        
            if (isset($sindicator->escondicaosindicato)) {
                $sindicato = str_replace(".","",$sindicator->escondicaosindicato);
            }else{
                $sindicato = 0;
            }
            
            $sindicato = str_replace(',','.',$sindicato);
            $sindicato = (float) $sindicato;
            $basecalculos[$i]->valordesconto += $sindicato;
            $basecalculos[$i]->valorliquido -= $sindicato;
            // dd(str_replace(",",".",$seguro->esseguro));
            // $seguro = str_replace(".","",$seguro->esseguro);
            $seguro = str_replace(',','.',$seguros->esseguro);
            $seguro = (float) $seguro;
            $basecalculos[$i]->valordesconto += $seguro;
            $basecalculos[$i]->valorliquido -= $seguro;
            // dd($irrflista[0]->irdepedente,$basecalculo->binumfilhos);
            $base_irrf = str_replace(',','.',$irrflista[0]->irdepedente) * $basecalculo->binumfilhos;
            foreach ($inss_valores as $n => $inss_valor) {
                if ($inss_valor->trabalhador === $basecalculo->trabalhador) {
                    $base_irrf += $inss_valor->desconto;
                }
            }
            foreach ($inss13_valores as $s => $inss13_valor) {
                if ($inss13_valor->trabalhador === $basecalculo->trabalhador) {
                    $base_irrf += $inss13_valor->desconto;
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
            $irrf_rublica =  $this->rublica->buscaRublicaUnidade('IRRF');
            foreach ($irrflista as $e => $irrf) {
                if ($base_irrf < $valor_final_irrf[0] && $i === $e) {
                    $valorbase = $base_irrf;
                    $indece = 0;
                    $resultadoinss = 0;
                    $boletim_tabela['irrf']['rublicas'] = $irrf_rublica->rsdescricao;
                    $boletim_tabela['irrf']['valor'] = 0;
                    $boletim_tabela['irrf']['quantidade'] = 0;
                    $boletim_tabela['irrf']['codigos'] = $irrf_rublica->rsrublica;
                    break;
                }elseif ($base_irrf > $valor_final_irrf[0] && $e === 0 && $i === $e && $base_irrf < $valor_final_irrf[1]) {
                    $valorbase = $base_irrf;
                    $indece = $irrf->irsindece;
                    $resultado = $base_irrf * ((float)str_replace(',','.',$irrf->irsindece)/100);
                    $boletim_tabela['irrf']['rublicas'] = $irrf_rublica->rsdescricao;
                    $boletim_tabela['irrf']['valor'] = $resultado;
                    $boletim_tabela['irrf']['quantidade'] = str_replace(',','.',$irrf->irsindece);
                    $boletim_tabela['irrf']['codigos'] = $irrf_rublica->rsrublica;
                    $basecalculos[$i]->valorliquido -= $resultado;
                    $basecalculos[$i]->valordesconto += $resultado;
                    break;
                }elseif ($base_irrf > $valor_final_irrf[1] && $e === 1 && $i === $e && $base_irrf < $valor_final_irrf[2]) {
                    $valorbase = $base_irrf;
                    $indece = $irrf->irsindece;
                    $resultado = $base_irrf * ((float)str_replace(',','.',$irrf->irsindece)/100);
                    $boletim_tabela['irrf']['rublicas'] = $irrf_rublica->rsdescricao;
                    $boletim_tabela['irrf']['valor'] = $resultado;
                    $boletim_tabela['irrf']['quantidade'] = str_replace(',','.',$irrf->irsindece);
                    $boletim_tabela['irrf']['codigos'] = $irrf_rublica->rsrublica;
                    $basecalculos[$i]->valorliquido -= $resultado;
                    $basecalculos[$i]->valordesconto += $resultado;
                    break;
                }elseif ($base_irrf > $valor_final_irrf[2] && $e === 2 && $i === $e && $base_irrf < $valor_final_irrf[3]) {
                    $valorbase = $base_irrf;
                    $indece = $irrf->irsindece;
                    $resultado = $base_irrf * ((float)str_replace(',','.',$irrf->irsindece)/100);
                    $boletim_tabela['irrf']['rublicas'] = $irrf_rublica->rsdescricao;
                    $boletim_tabela['irrf']['valor'] = $resultado;
                    $boletim_tabela['irrf']['quantidade'] = str_replace(',','.',$irrf->irsindece);
                    $boletim_tabela['irrf']['codigos'] = $irrf_rublica->rsrublica;
                    $basecalculos[$i]->valorliquido -= $resultado;
                    $basecalculos[$i]->valordesconto += $resultado;
                    break;
                }elseif ($base_irrf > $valor_final_irrf[3] && $e === 3 && $i === $e) {
                    $valorbase = $base_irrf;
                    $indece = $irrf->irsindece;
                    $resultado = $base_irrf * ((float)str_replace(',','.',$irrf->irsindece)/100);
                    $boletim_tabela['irrf']['rublicas'] = $irrf_rublica->rsdescricao;
                    $boletim_tabela['irrf']['valor'] = $resultado;
                    $boletim_tabela['irrf']['quantidade'] = str_replace(',','.',$irrf->irsindece);
                    $boletim_tabela['irrf']['codigos'] = $irrf_rublica->rsrublica;
                    $basecalculos[$i]->valorliquido -= $resultado;
                    $basecalculos[$i]->valordesconto += $resultado;
                    break;
                }
            }
            $inss_rublica =  $this->rublica->buscaRublicaUnidade('INSS');
            $inss =  $this->valorcalculo->buscaUnidaderInss($basecalculo->trabalhador,$inss_rublica->rsrublica,$inss_rublica->rsdescricao,$datafinal);
            $boletim_tabela['inss']['valor'] = $inss->desconto;
            $boletim_tabela['inss']['codigos'] = $inss->vicodigo;
            $boletim_tabela['inss']['rublicas'] = $inss->vsdescricao;
            $boletim_tabela['inss']['quantidade'] = 0;
            // dd($inss,$tabelapreco_codigo);
            // $inssferiasdecimoter =  $this->valorcalculo->buscaUnidaderFeriasDecimoter($basecalculo->trabalhador,1009,$datafinal);
            // $inssdsr1818 = $this->valorcalculo->buscaUnidaderFeriasDecimoter($basecalculo->trabalhador,1008,$datafinal);
            // $valor_inss = $inssferiasdecimoter->vencimento + $inssdsr1818->vencimento + $basecalculo->servico;
        
            // $inss_rublica =  $this->rublica->buscaRublicaUnidade('INSS');
            // foreach ($insslista as $key => $inss) {
            //     $novoinss =  str_replace(".","",$inss->isvalorfinal);
            //     $novoinss =  str_replace(',','.',$novoinss);
            //     $novoinss = (float) $novoinss;
            //     if (!in_array($novoinss, $valorfinal)) {
            //         array_push($valorfinal,$novoinss);
            //     }
                
            //     if ($valor_inss <= $valorfinal[$key] && $key === 0) {
            //         $boletim_tabela['inss']['quantidade'] = str_replace(',','.',$inss->isindece);
            //         $resultadoinss = $valor_inss * ((float)str_replace(',','.',$inss->isindece)/100);
            //         $boletim_tabela['inss']['valor'] = $resultadoinss;
            //         $boletim_tabela['inss']['codigos'] = $inss_rublica->rsrublica;
            //         $boletim_tabela['inss']['rublicas'] = $inss_rublica->rsdescricao;
            //         // $basecalculos[$i]->valorliquido -= $resultadoinss;
            //         // $basecalculos[$i]->valordesconto += $resultadoinss;
            //         break;
            //     }elseif ($valor_inss > $valorfinal[0] && $valor_inss <= $valorfinal[$key] && $key === 1) {
            //         $boletim_tabela['inss']['quantidade'] = str_replace(',','.',$inss->isindece);
            //         $resultadoinss = $valor_inss - $valorfinal[0];
            //         $resultadoinss = $resultadoinss * ((float)str_replace(',','.',$inss->isindece)/100);
            //         $resultadoinss = $resultadoinss + ((float)str_replace(',','.',$insslista[0]->isreducao));
            //         $boletim_tabela['inss']['valor'] = $resultadoinss;
            //         $boletim_tabela['inss']['codigos'] = $inss_rublica->rsrublica;
            //         $boletim_tabela['inss']['rublicas'] = $inss_rublica->rsdescricao;
            //         // $basecalculos[$i]->valorliquido -= $resultadoinss;
            //         // $basecalculos[$i]->valordesconto += $resultadoinss;
            //       break;
            //     }elseif ($valor_inss <= $valorfinal[$key] && $key === 2) {
            //         $boletim_tabela['inss']['quantidade'] = str_replace(',','.',$inss->isindece);
            //         $resultadoinss = $valor_inss - $valorfinal[1];
            //         $resultadoinss = $resultadoinss * ((float)str_replace(',','.',$inss->isindece)/100);
            //         $resultadoinss = $resultadoinss + ((float)str_replace(',','.',$insslista[1]->isreducao));
            //         $boletim_tabela['inss']['valor'] = $resultadoinss;
            //         $boletim_tabela['inss']['codigos'] = $inss_rublica->rsrublica;
            //         $boletim_tabela['inss']['rublicas'] = $inss_rublica->rsdescricao;
            //         // $basecalculos[$i]->valorliquido -= $resultadoinss;
            //         // $basecalculos[$i]->valordesconto += $resultadoinss;
            //       break;
            //     }elseif ($valor_inss >= $valorfinal[$key] && $key === 3) {
            //         $boletim_tabela['inss']['quantidade'] = str_replace(',','.',$inss->isindece);
            //         $resultadoinss = $valor_inss - $valorfinal[2];
            //         $resultadoinss = $resultadoinss * ((float)str_replace(',','.',$inss->isindece)/100);
            //         $resultadoinss = $resultadoinss + ((float)str_replace(',','.',$insslista[2]->isreducao));
            //         $boletim_tabela['inss']['valor'] = $resultadoinss;
            //         $boletim_tabela['inss']['codigos'] = $inss_rublica->rsrublica;
            //         $boletim_tabela['inss']['rublicas'] = $inss_rublica->rsdescricao;
            //         // $basecalculos[$i]->valorliquido -= $resultadoinss;
            //         // $basecalculos[$i]->valordesconto += $resultadoinss;
            //       break;
            //     }
            // }
            // dd($inssferiasdecimoter,$inssdsr1818,$boletim_tabela);
            $novabasecalculo =  $basecalculo->cadastroFolhar($basecalculos[$i],$valorbase,$indece,$folhas['id']);
            foreach ($tabelapreco_codigo as $d => $tabelapreco_valor) {
                $valorcalculos = $this->valorcalculo->listaGeral($trabalhador,$datafinal,$tabelapreco_valor);
                foreach ($valorcalculos as $v => $valorcalculo) {
                    if ($basecalculo->trabalhador === $valorcalculo->trabalhador && $valorcalculo->vicodigo != 2001) {
                        $valorcalculo->cadastraGeral($valorcalculo,$novabasecalculo['id']);
                    }
                }
            }
            $valorcalculo->cadastraIrrf($boletim_tabela,$novabasecalculo['id'],$basecalculo->trabalhador,$datafinal);
            $valorcalculo->cadastraInss($boletim_tabela,$novabasecalculo['id'],$basecalculo->trabalhador,$datafinal);
            $adiantamento =  $this->rublica->buscaRublicaUnidade('Adiantamento');
        
            if (count($basecalculos_15) > 0) {
                foreach ($basecalculos_15 as $key => $basecalculos_15_valor) {
                    if ($basecalculo->trabalhador === $basecalculos_15_valor->trabalhador) {
                        $boletim_tabela['adiantamento']['codigos'] = $adiantamento->rsrublica;
                        $boletim_tabela['adiantamento']['rublicas'] = $adiantamento->rsdescricao;
                        $boletim_tabela['adiantamento']['quantidade'] = 1;
                        $boletim_tabela['adiantamento']['valor'] = $basecalculos_15_valor->bivalorliquido;
                        $valorcalculo->cadastraAdiantamento($boletim_tabela,$novabasecalculo['id'],$basecalculos_15_valor->trabalhador,$datafinal);
                    }
                }
               
            }
            foreach ($descontos as $d => $desconto) {
                if ($basecalculo->trabalhador === $desconto->id && $desconto->dsquinzena === '1 - Primeira' && strpos($datafinal,$desconto->dscompetencia) !== false) {
                  
                    $boletim_tabela['descontos']['codigos'] = 0;
                    $boletim_tabela['descontos']['rublicas'] = $desconto->dsdescricao;
                    $boletim_tabela['descontos']['quantidade'] = $desconto->quantidade;
                    $boletim_tabela['descontos']['valor'] = $desconto->valor;
                    $valorcalculo->cadastraDesconto($boletim_tabela,$novabasecalculo['id'],$basecalculo->trabalhador,$datafinal);
                }
                if ($basecalculo->trabalhador === $desconto->id && $desconto->dsquinzena === '2 - Segunda' && strpos($datafinal,$desconto->dscompetencia) !== false) {
                  
                    $boletim_tabela['descontos']['codigos'] = 0;
                    $boletim_tabela['descontos']['rublicas'] = $desconto->dsdescricao;
                    $boletim_tabela['descontos']['quantidade'] = $desconto->quantidade;
                    $boletim_tabela['descontos']['valor'] = $desconto->valor;
                    $valorcalculo->cadastraDesconto($boletim_tabela,$novabasecalculo['id'],$basecalculo->trabalhador,$datafinal);
                }
            }
            $seguros_rublicas =  $this->rublica->buscaRublicaUnidade('Seguro');
            $boletim_tabela['seguro']['codigos'] = $seguros_rublicas->rsrublica;
            $boletim_tabela['seguro']['rublicas'] = $seguros_rublicas->rsdescricao;
            $boletim_tabela['seguro']['quantidade'] = 1;
            $boletim_tabela['seguro']['valor'] = $seguro;
            $valorcalculo->cadastroSeguro($boletim_tabela,$novabasecalculo['id'],$basecalculo->trabalhador,$datafinal);

            $sindicator_rublicas =  $this->rublica->buscaRublicaUnidade('Sindicator');
        
            $boletim_tabela['sindicator']['codigos'] = $sindicator_rublicas->rsrublica;
            $boletim_tabela['sindicator']['rublicas'] = $sindicator_rublicas->rsdescricao;
            $boletim_tabela['sindicator']['quantidade'] = 1;
            $boletim_tabela['sindicator']['valor'] = $sindicato;
            $valorcalculo->cadastroSindicator($boletim_tabela,$novabasecalculo['id'],$basecalculo->trabalhador,$datafinal);

            for ($d= 1; $d <= 31 ; $d++) { 
                $relacaodias = $this->relacaodia->listaRelacaoDia($trabalhador,$datafinal,$d);
                    if (isset($relacaodias[0]->valor)) {
                        foreach ($relacaodias as $r => $relacaodia) {
                            if ($basecalculo->trabalhador === $relacaodia->trabalhador) {
                                $relacaodia->cadastroGeral($relacaodia,$novabasecalculo['id']);
                            }
                        }
                    }
            }
        }
        return true;
        try {
        } catch (\Throwable $th) {
            $folhar = $this->folhar->Folhar($datainicio,$datafinal);
            $basecalculo_id = $this->basecalculo->buscaId($folhar->id);
            $base_id = [];
            foreach($basecalculo_id as $i=>$basevalor){
                array_push($base_id,$basevalor->id);
            }
            $this->valorcalculo->deletar($base_id);
            $this->relacaodia->deletar($base_id);
            $this->basecalculo->deletar($base_id);
            return redirect()->back()->withInput()->withErrors(['false'=>'Não foi porssível cadastra o registro.']);
        }
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
       
        $folhas = $this->folhar->buscaLista($id);
        $leis = $this->leis->categorias();
        if (!$folhas) {
            return redirect()->back()->withInput()->withErrors(['false'=>'Não foi lançada a folha pra este trabalhador.']);
        }
        $basecalculo_id = [];
        foreach ($folhas as $key => $folhar) {
            array_push($basecalculo_id,$folhar->id); 
        }
        $valorcalculos = $this->valorcalculo->buscaImprimir($basecalculo_id);
        $relacaodias = $this->relacaodia->buscaImprimir($basecalculo_id);
        $pdf = PDF::loadView('comprovantegeral',compact('folhas','leis','valorcalculos','relacaodias'));
        return $pdf->setPaper('a4')->stream('CALCULO FOLHA GERAL.pdf');
    }
    public function diasDatasQuat($data_inicial,$data_final) {
        $diferenca = strtotime($data_final) - strtotime($data_inicial);
        $dias = floor($diferenca / (60 * 60 * 24)); 
        if ($dias <= 15) {
            $dias = false;
        }else{
            $dias = true;
        }
        return $dias;
    }
    public function destroy($id)
    {
        try {
            $basecalculo_id = $this->basecalculo->buscaId($id);
            $base_id = [];
            foreach($basecalculo_id as $i=>$basevalor){
                array_push($base_id,$basevalor->id);
            }
            $this->valorcalculo->deletar($base_id);
            $this->relacaodia->deletar($base_id);
            $this->basecalculo->deletar($base_id);
            $this->folhar->deletar($id);
            return redirect()->back()->withSuccess('Deletado com sucesso.');
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->withErrors(['false'=>'Não foi porssível deletar o registro.']);
        }
    }
}
