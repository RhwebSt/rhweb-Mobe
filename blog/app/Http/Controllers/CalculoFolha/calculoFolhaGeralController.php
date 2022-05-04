<?php
namespace App\Http\Controllers\CalculoFolha;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Lancamentotabela;
use App\Bolcartaoponto;
use App\Lancamentorublica;
use App\Tomador;
use App\Trabalhador;
use App\Rublica;
use App\Folhar;
use App\ValoresRublica;
use App\CartaoPonto;
use App\Inss;
use App\Irrf;
use App\BaseCalculo;
use App\RelacaoDia;
use App\ValorCalculo;
use App\Dependente;
use App\Descontos;
use App\Empresa;
use Carbon\Carbon;
use App\Leis;
use PDF;
class calculoFolhaGeralController extends Controller
{
    private $lancamentotabela,$folhar,$valorrublica,$rublica,$tomador,$trabalhador,$bolcartaoponto,$lancamentorublica,
    $cartaoponto,$inss,$irrf,$leis,$basecalculo,$relacaodia,$valorcalculo,$depedente,$desconto,$empresa;
    public function __construct()
    {
        $this->valorrublica = new ValoresRublica;
        $this->lancamentotabela = new Lancamentotabela;
        $this->tomador = new Tomador;
        $this->trabalhador = new Trabalhador;
        $this->bolcartaoponto = new Bolcartaoponto;
        $this->lancamentorublica = new Lancamentorublica;
        $this->rublica = new Rublica;
        $this->folhar = new Folhar;
        $this->cartaoponto = new CartaoPonto;
        $this->inss = new Inss;
        $this->irrf = new Irrf;
        $this->basecalculo = new BaseCalculo;
        $this->relacaodia = new RelacaoDia;
        $this->valorcalculo = new ValorCalculo;
        $this->depedente = new Dependente;
        $this->desconto = new Descontos;
        $this->empresa = new Empresa;
        $this->leis = new Leis;
    }
    public function calculoFolhaGeral($datainicio,$datafinal,$competencia)
    {
        $user = auth()->user();
        $date1 = Carbon::createFromFormat('Y-m-d', $datainicio);
        $date2 = Carbon::createFromFormat('Y-m-d', $datafinal);
        $quantdias = $date2->diffInDays($date1); 
        $inss_lista = $this->inss->where('isano',date('Y',strtotime($datafinal)))->get();
        $irrf_lista = $this->irrf->where('irsano',date('Y',strtotime($datafinal)))->get();
        $seguros = $this->empresa->buscaSeguro($user->empresa_id);
        $tomador = $this->tomador->where('empresa_id',$user->empresa_id)
        ->with(['tabelapreco','cartaoponto','incidefolhar'])->get();
        $tomador_id = [];
        $valorrublica = $this->valorrublica->where('empresa_id',$user->empresa->id)->first();
        if (!$valorrublica->vsnrofolha) {
            $valorrublica->vsnrofolha = 1;
        }else{
            $valorrublica->vsnrofolha += 1;
        }
        $this->valorrublica->where('empresa_id', $user->empresa_id)
        ->update(['vsnrofolha'=>$valorrublica->vsnrofolha]);
        $folhar = [
            'codigo'=>$valorrublica->vsnrofolha,
            'inicio'=>$datainicio,
            'final'=>$datafinal,
            'competencia'=>$competencia,
            'empresa_id'=>$user->empresa_id
        ];
        $folhar = $this->folhar->cadastro($folhar,$user->empresa_id);

        foreach ($tomador as $key => $tomadores) {
            $salario = 0;
            $dados=[
                'id'=>[],
                'codigos'=>[],
                'dia' => [],
                'valor' =>[],
                'quantidade' => [],
                'descricao' => []
            ];
           
            $lancamentotabela = $this->lancamentotabela
            ->with(['lacamentorublica','bolcartaoponto'])
            ->whereBetween('lsdata',[$datainicio,$datafinal])
            ->where('tomador_id',$tomadores->id)
            ->get();
            // dd($lancamentotabela->lacamentorublica);
            foreach ($lancamentotabela as $key => $lancamentotabelas) {
                foreach ($lancamentotabelas->bolcartaoponto as $key => $bolcartaopontos) {
                    foreach ($tomadores->tabelapreco as $key => $tabelapreco) {
                        if ($tabelapreco->tsdescricao == 'hora normal') {
                            array_push($dados['id'],$bolcartaopontos->trabalhador_id);
                            //$salario += self::calculardia($bolcartaopontos->horas_normais,$tabelapreco->tsvalor);
                            array_push($dados['valor'], self::calculardia($bolcartaopontos->horas_normais,$tabelapreco->tsvalor));
                            array_push($dados['quantidade'], self::calcularhoras($bolcartaopontos->horas_normais));
                            array_push($dados['dia'], date('d',strtotime($bolcartaopontos->created_at)));
                            array_push($dados['descricao'], $tabelapreco->tsdescricao);
                            array_push($dados['codigos'], $tabelapreco->tsrubrica);
                        }else if ($tabelapreco->tsdescricao == 'hora extra 50%') {
                            array_push($dados['id'],$bolcartaopontos->trabalhador_id);
                            //$salario += self::calculardia($bolcartaopontos->bshoraex,$tabelapreco->tsvalor);
                            array_push($dados['valor'],self::calculardia($bolcartaopontos->bshoraex,$tabelapreco->tsvalor));
                            array_push($dados['quantidade'], self::calcularhoras($bolcartaopontos->bshoraex));
                            array_push($dados['dia'], date('d',strtotime($bolcartaopontos->created_at)));
                            array_push($dados['descricao'], $tabelapreco->tsdescricao);
                           array_push($dados['codigos'], $tabelapreco->tsrubrica);
                        }else if ($tabelapreco->tsdescricao == 'hora extra 100%') {
                            array_push($dados['id'],$bolcartaopontos->trabalhador_id);
                            //$salario += self::calculardia($bolcartaopontos->bshoraexcem,$tabelapreco->tsvalor);
                            array_push($dados['valor'],self::calculardia($bolcartaopontos->bshoraexcem,$tabelapreco->tsvalor));
                            array_push($dados['quantidade'], self::calcularhoras($bolcartaopontos->bshoraexcem));
                            array_push($dados['dia'], date('d',strtotime($bolcartaopontos->created_at)));
                            array_push($dados['descricao'], $tabelapreco->tsdescricao);
                            array_push($dados['codigos'], $tabelapreco->tsrubrica);
                        }elseif ($tabelapreco->tsdescricao == 'adicional noturno') {
                            array_push($dados['id'],$bolcartaopontos->trabalhador_id);
                            //$salario += self::calculardia($bolcartaopontos->bsadinortuno,$tabelapreco->tsvalor);
                            array_push($dados['valor'],self::calculardia($bolcartaopontos->bsadinortuno,$tabelapreco->tsvalor));
                            array_push($dados['quantidade'], self::calcularhoras($bolcartaopontos->bsadinortuno));
                            array_push($dados['dia'], date('d',strtotime($bolcartaopontos->created_at)));
                            array_push($dados['descricao'], $tabelapreco->tsdescricao);
                            array_push($dados['codigos'], $tabelapreco->tsrubrica);
                        }
                        
                      
                    }
                }
                foreach ($lancamentotabelas->lacamentorublica as $key => $lancamentorublicas) {
                    if ($lancamentorublicas->lsdescricao == 'hora normal') {
                        array_push($dados['id'],$lancamentorublicas->trabalhador_id);
                        array_push($dados['valor'], self::calculovalores($lancamentorublicas->lsquantidade,$lancamentorublicas->lfvalor));
                        array_push($dados['quantidade'], self::calcularhoras($lancamentorublicas->lsquantidade));
                        array_push($dados['dia'], date('d',strtotime($lancamentorublicas->created_at)));
                        array_push($dados['descricao'], $lancamentorublicas->lsdescricao);
                        array_push($dados['codigos'], $lancamentorublicas->licodigo);
                       
                    }elseif ($lancamentorublicas->lsdescricao == 'hora extra 50%') {
                        array_push($dados['id'],$lancamentorublicas->trabalhador_id);
                        array_push($dados['valor'], self::calculovalores($lancamentorublicas->lsquantidade,$lancamentorublicas->lfvalor));
                        array_push($dados['quantidade'], self::calcularhoras($lancamentorublicas->lsquantidade));
                        array_push($dados['dia'], date('d',strtotime($lancamentorublicas->created_at)));
                        array_push($dados['descricao'], $lancamentorublicas->lsdescricao);
                        array_push($dados['codigos'], $lancamentorublicas->licodigo);
                    }elseif ($lancamentorublicas->lsdescricao == 'hora extra 100%') {
                        array_push($dados['id'],$lancamentorublicas->trabalhador_id);
                        array_push($dados['valor'], self::calculovalores($lancamentorublicas->lsquantidade,$lancamentorublicas->lfvalor));
                        array_push($dados['quantidade'], self::calcularhoras($lancamentorublicas->lsquantidade));
                        array_push($dados['dia'], date('d',strtotime($lancamentorublicas->created_at)));
                        array_push($dados['descricao'], $lancamentorublicas->lsdescricao);
                        array_push($dados['codigos'], $lancamentorublicas->licodigo);
                    }elseif ($lancamentorublicas->lsdescricao == 'adicional noturno') {
                        array_push($dados['id'],$lancamentorublicas->trabalhador_id);
                        array_push($dados['valor'], self::calculovalores($lancamentorublicas->lsquantidade,$lancamentorublicas->lfvalor));
                        array_push($dados['quantidade'], self::calcularhoras($lancamentorublicas->lsquantidade));
                        array_push($dados['dia'], date('d',strtotime($lancamentorublicas->created_at)));
                        array_push($dados['descricao'], $lancamentorublicas->lsdescricao);
                        array_push($dados['codigos'], $lancamentorublicas->licodigo);
                    }elseif ($lancamentorublicas->lsdescricao == 'diaria normal') {
                        array_push($dados['id'],$lancamentorublicas->trabalhador_id);
                        array_push($dados['valor'], self::calculovalores($lancamentorublicas->lsquantidade,$lancamentorublicas->lfvalor));
                        array_push($dados['quantidade'], self::calcularhoras($lancamentorublicas->lsquantidade));
                        array_push($dados['dia'], date('d',strtotime($lancamentorublicas->created_at)));
                        array_push($dados['descricao'], $lancamentorublicas->lsdescricao);
                        array_push($dados['codigos'], $lancamentorublicas->licodigo);
                    }elseif ($lancamentorublicas->lsdescricao == 'gratificação') {
                        $dsr =  $this->rublica->buscaRublicaUnidade('gratificação');
                        array_push($dados['id'],$lancamentorublicas->trabalhador_id);
                        array_push($dados['valor'], self::calculovalores($lancamentorublicas->lsquantidade,$lancamentorublicas->lfvalor));
                        array_push($dados['quantidade'], self::calcularhoras($lancamentorublicas->lsquantidade));
                        array_push($dados['dia'], date('d',strtotime($lancamentorublicas->created_at)));
                        array_push($dados['descricao'], $dsr->rsdescricao);
                        array_push($dados['codigos'], $dsr->rsrublica);
                    }else{
                        $dsr =  $this->rublica->buscaRublicaUnidade('produção');
                        array_push($dados['id'],$lancamentorublicas->trabalhador_id);
                        array_push($dados['valor'], self::calculovalores($lancamentorublicas->lsquantidade,$lancamentorublicas->lfvalor));
                        array_push($dados['quantidade'], self::calcularhoras($lancamentorublicas->lsquantidade));
                        array_push($dados['dia'], date('d',strtotime($lancamentorublicas->created_at)));
                        array_push($dados['descricao'], $dsr->rsdescricao);
                        array_push($dados['codigos'], $dsr->rsrublica);
                    }
                }
            }
            $trabalhador = $this->trabalhador->whereIn('id',$dados['id'])
            ->with('depedente')->get();
            foreach ($trabalhador as $t => $trabalhadores) {
                $boletim = [
                    'horanormal'=>[
                        'id'=>'',
                        'codigos'=>'',
                        'dia' =>'',
                        'valor' =>'',
                        'quantidade' => '',
                        'descricao' =>''
                    ],
                    'diarianormal'=>[
                        'id'=>'',
                        'codigos'=>'',
                        'dia' => '',
                        'valor' =>'',
                        'quantidade' =>'',
                        'descricao' =>''
                    ],
                    'hora50'=>[
                        'id'=>'',
                        'dia' => '',
                        'codigos'=>'',
                        'valor' =>'',
                        'quantidade' => '',
                        'descricao' =>''
                    ],
                    'hora100'=>[
                        'id'=>'',
                        'dia' => '',
                        'codigos'=>'',
                        'valor' =>'',
                        'quantidade' =>'',
                        'descricao' =>''
                    ],
                    'noturno'=>[
                        'id'=>'',
                        'dia' => '',
                        'codigos'=>'',
                        'valor' =>'',
                        'quantidade' => '',
                        'descricao' => ''
                    ],
                    'producao'=>[
                        'id'=>'',
                        'dia' => '',
                        'codigos'=>'',
                        'valor' =>'',
                        'quantidade' => '',
                        'descricao' => ''
                    ],
                    'gratificacao'=>[
                        'id'=>'',
                        'dia' => '',
                        'codigos'=>'',
                        'valor' =>'',
                        'quantidade' => '',
                        'descricao' => ''
                    ],
                    'vt'=>[
                        'id'=>'',
                        'dia' => '',
                        'codigos'=>'',
                        'valor' =>0,
                        'quantidade' => 0,
                        'descricao' => ''
                    ],
                    'va'=>[
                        'id'=>'',
                        'dia' => '',
                        'codigos'=>'',
                        'valor' =>0,
                        'quantidade' => 0,
                        'descricao' => ''
                    ],
                    'diaria'=>[
                        'id'=>'',
                        'dia' => '',
                        'codigos'=>'',
                        'valor' =>'',
                        'quantidade' => '',
                        'descricao' => ''
                    ],
                    'dsr1818'=>[
                        'valor'=>0,
                        'codigos'=>'',
                        'quantidade'=> 0,
                        'rublicas'=>0,
                    ],
                    'decimo_ter'=>[
                        'valor'=>0,
                        'codigos'=>'',
                        'quantidade'=> 0,
                        'rublicas'=>0,
                    ],
                    'ferias_decimoter'=>[
                        'valor'=>0,
                        'codigos'=>'',
                        'quantidade'=> 0,
                        'rublicas'=>0,
                    ],
                    'inss_sobre_ter'=>[
                        'valor'=>0,
                        'codigos'=>'',
                        'quantidade'=> 0,
                        'rublicas'=>0,
                    ],
                    'inss'=>[
                        'valor'=>0,
                        'codigos'=>'',
                        'quantidade'=> 0,
                        'rublicas'=>0,
                    ],
                    'servico'=>0,
                    'salario'=>0,
                    'servicodsr'=>0,
                    'base_inss'=>0,
                    'base_fgts'=>0,
                    'base_irrf'=>0,
                    'fgts_mes'=>0,
                    'vencimento'=>0,
                    'desconto'=>0,
                    'liquido'=>0,
                    'folhar'=>$folhar['id'],
                    'depedente'=>0,
                    'tomador'=>$tomadores->id,
                    'trabalhador'=>'',
                    'basecalculo'=>''
                    
                ];
                $dia = [
                    'dias'=>[],
                    'valor'=>[],
                    'basecalculo'=>'',
                    'trabalhador'=>'',
                ];
                $boletim['trabalhador'] = $trabalhadores->id;
                $dia['trabalhador'] = $trabalhadores->id;
                foreach ($dados['id'] as $i => $dado) {
                    if ($dado == $trabalhadores->id) {
                        if ($dados['descricao'][$i] == 'hora normal') {
                            $boletim['horanormal']['descricao'] = $dados['descricao'][$i];
                            $boletim['horanormal']['codigos'] = $dados['codigos'][$i];
                            if (!$boletim['horanormal']['valor']) {
                                $boletim['horanormal']['valor'] = $dados['valor'][$i];
                                $boletim['horanormal']['quantidade'] = $dados['quantidade'][$i];
                                $boletim['servico'] += $dados['valor'][$i];
                            }else{
                                $boletim['horanormal']['valor'] += $dados['valor'][$i]; 
                                $boletim['horanormal']['quantidade'] += $dados['quantidade'][$i];
                                $boletim['servico'] += $dados['valor'][$i];
                            }
                        }
                        if ($dados['descricao'][$i] == 'diaria normal') {
                            $boletim['diarianormal']['descricao'] = $dados['descricao'][$i];
                            $boletim['diarianormal']['codigos'] = $dados['codigos'][$i];
                            if (!$boletim['diarianormal']['valor']) {
                                $boletim['diarianormal']['valor'] = $dados['valor'][$i];
                                $boletim['diarianormal']['quantidade'] = $dados['quantidade'][$i];
                                $boletim['servico'] += $dados['valor'][$i];
                            }else{
                                $boletim['diarianormal']['valor'] += $dados['valor'][$i]; 
                                $boletim['diarianormal']['quantidade'] += $dados['quantidade'][$i];
                                $boletim['servico'] += $dados['valor'][$i];
                            }
                        }
                        if ($dados['descricao'][$i] == 'hora extra 50%') {
                            $boletim['hora50']['descricao'] = $dados['descricao'][$i];
                            $boletim['hora50']['codigos'] = $dados['codigos'][$i];
                            if (!$boletim['hora50']['valor']) {
                                $boletim['hora50']['valor'] = $dados['valor'][$i];
                                $boletim['hora50']['quantidade'] = $dados['quantidade'][$i];
                                $boletim['servico'] += $dados['valor'][$i];
                            }else{
                                $boletim['hora50']['valor'] += $dados['valor'][$i]; 
                                $boletim['hora50']['quantidade'] += $dados['quantidade'][$i];
                                $boletim['servico'] += $dados['valor'][$i];
                            }
                        }
                        if ($dados['descricao'][$i] == 'hora extra 100%') {
                            $boletim['hora100']['descricao'] = $dados['descricao'][$i];
                            $boletim['hora100']['codigos'] = $dados['codigos'][$i];
                            if (!$boletim['hora100']['valor']) {
                                $boletim['hora100']['valor'] = $dados['valor'][$i];
                                $boletim['hora100']['quantidade'] = $dados['quantidade'][$i];
                                $boletim['servico'] += $dados['valor'][$i];
                            }else{
                                $boletim['hora100']['valor'] += $dados['valor'][$i]; 
                                $boletim['hora100']['quantidade'] += $dados['quantidade'][$i];
                                $boletim['servico'] += $dados['valor'][$i];
                            }
                        }
                        if ($dados['descricao'][$i] == 'adicional noturno') {
                            $boletim['noturno']['descricao'] = $dados['descricao'][$i];
                            $boletim['noturno']['codigos'] = $dados['codigos'][$i];
                            if (!$boletim['noturno']['valor']) {
                                $boletim['noturno']['valor'] = $dados['valor'][$i];
                                $boletim['noturno']['quantidade'] = $dados['quantidade'][$i];
                                $boletim['servico'] += $dados['valor'][$i];
                            }else{
                                $boletim['noturno']['valor'] += $dados['valor'][$i]; 
                                $boletim['noturno']['quantidade'] += $dados['quantidade'][$i];
                                $boletim['servico'] += $dados['valor'][$i];
                            }
                        }
                        if ($dados['descricao'][$i] == 'produção') {
                            $boletim['producao']['descricao'] = $dados['descricao'][$i];
                            $boletim['producao']['codigos'] = $dados['codigos'][$i];
                            if (!$boletim['producao']['valor']) {
                                $boletim['producao']['valor'] = $dados['valor'][$i];
                                $boletim['producao']['quantidade'] = $dados['quantidade'][$i];
                                $boletim['servico'] += $dados['valor'][$i];
                            }else{
                                $boletim['producao']['valor'] += $dados['valor'][$i]; 
                                $boletim['producao']['quantidade'] += $dados['quantidade'][$i];
                                $boletim['servico'] += $dados['valor'][$i];
                            }
                        }
                        if ($dados['descricao'][$i] == 'gratificação') {
                            $boletim['gratificacao']['descricao'] = $dados['descricao'][$i];
                            $boletim['gratificacao']['codigos'] = $dados['codigos'][$i];
                            if (!$boletim['gratificacao']['valor']) {
                                $boletim['gratificacao']['valor'] = $dados['valor'][$i];
                                $boletim['gratificacao']['quantidade'] = $dados['quantidade'][$i];
                                $boletim['servico'] += $dados['valor'][$i];
                            }else{
                                $boletim['gratificacao']['valor'] += $dados['valor'][$i]; 
                                $boletim['gratificacao']['quantidade'] += $dados['quantidade'][$i];
                                $boletim['servico'] += $dados['valor'][$i];
                            }
                        }
                        // if ($dados['descricao'][$i] == 'diaria normal') {
                        //     if (!array_key_exists($t,$boletim['diarianormal']['descricao'])) {
                        //         array_push($boletim['diarianormal']['descricao'],$dados['descricao'][$i]);
                        //         array_push($boletim['diarianormal']['codigos'],$dados['codigos'][$i]);
                                
                                
                        //     }
                        //     if (!array_key_exists($t,$boletim['diarianormal']['valor'])) {
                        //         array_push($boletim['diarianormal']['valor'],$dados['valor'][$i]);
                        //         array_push($boletim['diarianormal']['quantidade'],$dados['quantidade'][$i]);
                        //         $boletim['servico'] += $dados['valor'][$i];
                        //     }else{
                        //         $boletim['diarianormal']['valor'][$t] += $dados['valor'][$i]; 
                        //         $boletim['diarianormal']['quantidade'][$t] += $dados['quantidade'][$i];
                        //         $boletim['servico'] += $dados['valor'][$i];
                        //     }
                        // }
                        // if ($dados['descricao'][$i] == 'hora extra 50%') {
                        //     if (!array_key_exists($t,$boletim['hora50']['descricao'])) {
                        //         array_push($boletim['hora50']['descricao'],$dados['descricao'][$i]);
                        //         array_push($boletim['hora50']['codigos'],$dados['codigos'][$i]);
                                
                        //     }
                        //     if (!array_key_exists($t,$boletim['hora50']['valor'])) {
                        //         array_push($boletim['hora50']['valor'],$dados['valor'][$i]);
                        //         array_push($boletim['hora50']['quantidade'],$dados['quantidade'][$i]);
                        //         $boletim['servico'] += $dados['valor'][$i];
                        //     }else{
                        //         $boletim['hora50']['valor'][$t] += $dados['valor'][$i]; 
                        //         $boletim['hora50']['quantidade'][$t] += $dados['quantidade'][$i];
                        //         $boletim['servico'] += $dados['valor'][$i];
                        //     }
                        // }
                        // if ($dados['descricao'][$i] == 'hora extra 100%') {
                        //     if (!array_key_exists($t,$boletim['hora100']['descricao'])) {
                        //         array_push($boletim['hora100']['descricao'],$dados['descricao'][$i]);
                        //         array_push($boletim['hora100']['codigos'],$dados['codigos'][$i]);
                                
                        //     }
                        //     if (!array_key_exists($t,$boletim['hora100']['valor'])) {
                        //         array_push($boletim['hora100']['valor'],$dados['valor'][$i]);
                        //         array_push($boletim['hora100']['quantidade'],$dados['quantidade'][$i]);
                        //         $boletim['servico'] += $dados['valor'][$i];
                        //     }else{
                        //         $boletim['hora100']['valor'][$t] += $dados['valor'][$i]; 
                        //         $boletim['hora100']['quantidade'][$t] += $dados['quantidade'][$i];
                        //         $boletim['servico'] += $dados['valor'][$i];
                        //     }
                        // }
                        // if ($dados['descricao'][$i] == 'adicional noturno') {
                        //     if (!array_key_exists($t,$boletim['noturno']['descricao'])) {
                        //         array_push($boletim['noturno']['descricao'],$dados['descricao'][$i]);
                        //         array_push($boletim['noturno']['codigos'],$dados['codigos'][$i]);
                                
                        //     }
                        //     if (!array_key_exists($t,$boletim['noturno']['valor'])) {
                        //         array_push($boletim['noturno']['valor'],$dados['valor'][$i]);
                        //         array_push($boletim['noturno']['quantidade'],$dados['quantidade'][$i]);
                        //         $boletim['servico'] += $dados['valor'][$i];
                        //     }else{
                        //         $boletim['noturno']['valor'][$t] += $dados['valor'][$i];
                        //         $boletim['noturno']['quantidade'][$t] += $dados['quantidade'][$i];
                        //         $boletim['servico'] += $dados['valor'][$i]; 
                        //     }
                        // }
                        // if ($dados['descricao'][$i] == 'produção') {
                        //     if (!array_key_exists($t,$boletim['producao']['descricao'])) {
                        //         array_push($boletim['producao']['descricao'],$dados['descricao'][$i]);
                        //         array_push($boletim['producao']['codigos'],$dados['codigos'][$i]);
                        //     }
                        //     if (!array_key_exists($t,$boletim['producao']['valor'])) {
                        //         array_push($boletim['producao']['valor'],$dados['valor'][$i]);
                        //         array_push($boletim['producao']['quantidade'],$dados['quantidade'][$i]);
                        //         $boletim['servico'] += $dados['valor'][$i];
                        //     }else{
                        //         $boletim['producao']['valor'][$t] += $dados['valor'][$i]; 
                        //         $boletim['producao']['quantidade'][$t] += $dados['quantidade'][$i];
                        //         $boletim['servico'] += $dados['valor'][$i]; 
                        //     }
                        // }
                        // if ($dados['descricao'][$i] == 'gratificação') {
                        //     if (!array_key_exists($t,$boletim['gratificacao']['descricao'])) {
                        //         array_push($boletim['gratificacao']['descricao'],$dados['descricao'][$i]);
                        //         array_push($boletim['gratificacao']['codigos'],$dados['codigos'][$i]);
                        //     }
                        //     if (!array_key_exists($t,$boletim['gratificacao']['valor'])) {
                        //         array_push($boletim['gratificacao']['valor'],$dados['valor'][$i]);
                        //         array_push($boletim['gratificacao']['quantidade'],$dados['quantidade'][$i]);
                        //         $boletim['servico'] += $dados['valor'][$i];
                        //     }else{
                        //         $boletim['gratificacao']['valor'][$t] += $dados['valor'][$i]; 
                        //         $boletim['gratificacao']['quantidade'][$t] += $dados['quantidade'][$i]; 
                        //         $boletim['servico'] += $dados['valor'][$i];
                        //     }
                        // }
                        if (!in_array($dados['dia'][$i],$dia['dias'])) {
                            array_push($dia['dias'],$dados['dia'][$i]);
                            array_push($dia['valor'],$dados['valor'][$i]);
                            $boletim['salario'] = $dados['valor'][$i];
                            
                        }else{
                            $key = array_search($dados['dia'][$i], $dia['dias']);
                            $dia['valor'][$key] += $dados['valor'][$i];
                            $boletim['salario'] += $dados['valor'][$i];
                        }
                    }
                }
               
                $boletim['vencimento'] = $boletim['servico'];
                
                $tomador_cartao_ponto_horas = self::calculardia($tomadores->cartaoponto[0]->csdiasuteis,null);
                if (isset($boletim['horanormal']['valor'])) {
                    $horasnormais = $boletim['horanormal']['valor'];
                }else{
                    $horasnormais = 0;
                }

                if (isset($boletim['diarianormal']['valor'])) {
                    $diariasnormais = $boletim['diarianormal']['valor'];
                }else{
                    $diariasnormais = 0;
                }
                $tomador_cartao_ponto_horas =  $horasnormais / $tomador_cartao_ponto_horas + $diariasnormais;
                $vt =  $this->rublica->buscaRublicaUnidade('Vale transporte');
                $boletim['vt']['codigos'] = $vt->rsrublica;
                $boletim['vt']['descricao'] = $vt->rsdescricao;
                $boletim['vt']['quantidade'] = $tomador_cartao_ponto_horas;
                $boletim['vt']['valor'] = $tomadores->incidefolhar[0]->instransporte * ceil($tomador_cartao_ponto_horas);
                $boletim['vencimento'] +=  $boletim['vt']['valor'];
                $va =  $this->rublica->buscaRublicaUnidade('Vale alimentação');
                $boletim['va']['codigos'] = $va->rsrublica;
                $boletim['va']['descricao'] = $va->rsdescricao;
                $boletim['va']['quantidade'] = $tomador_cartao_ponto_horas;
                $boletim['va']['valor'] = $tomadores->incidefolhar[0]->insalimentacao * ceil($tomador_cartao_ponto_horas);
                // dd($tomador_cartao_ponto_horas);
                $boletim['vencimento'] +=  $boletim['va']['valor'];
                $dsr =  $this->rublica->buscaRublicaUnidade('DSR 18,18%');
                $boletim['dsr1818']['codigos'] = $dsr->rsrublica;
                $boletim['dsr1818']['rublicas'] = $dsr->rsdescricao;
                $boletim['dsr1818']['quantidade'] = 18.18;
                $boletim['dsr1818']['valor'] = self::calculoPocentagem($boletim['servico'],18.18);
                $boletim['vencimento'] +=  $boletim['dsr1818']['valor'];
                $boletim['servicodsr'] = $boletim['dsr1818']['valor'] + $boletim['servico'];
                $dsr =  $this->rublica->buscaRublicaUnidade('13º Salário');
                $boletim['decimo_ter']['codigos'] = $dsr->rsrublica;
                $boletim['decimo_ter']['rublicas'] = $dsr->rsdescricao;
                $boletim['decimo_ter']['quantidade'] = 8.34;
                $boletim['decimo_ter']['valor'] = self::calculoPocentagem($boletim['servico'],8.34);
                $boletim['vencimento'] +=  $boletim['decimo_ter']['valor'];
                $dsr =  $this->rublica->buscaRublicaUnidade('Ferias + 1/3');
                $boletim['ferias_decimoter']['codigos'] = $dsr->rsrublica;
                $boletim['ferias_decimoter']['rublicas'] = $dsr->rsdescricao;
                $boletim['ferias_decimoter']['quantidade'] = 11.12;
                $boletim['ferias_decimoter']['valor'] = self::calculoPocentagem($boletim['servico'],11.12);
                $boletim['vencimento'] +=  $boletim['ferias_decimoter']['valor'];
                $boletim['base_inss'] = $boletim['ferias_decimoter']['valor'] + $boletim['servicodsr'];
                $boletim['base_fgts'] = $boletim['decimo_ter']['valor'] + $boletim['ferias_decimoter']['valor'] + $boletim['servicodsr'];
                $boletim['fgts_mes'] = $boletim['base_fgts'] * 0.08;
                $inss = $boletim['ferias_decimoter']['valor'] + $boletim['servicodsr'];
                $dsr =  $this->rublica->buscaRublicaUnidade('INSS Sobre 13º Salário');
                $boletim['inss_sobre_ter']['codigos'] = $dsr->rsrublica;
                $boletim['inss_sobre_ter']['rublicas'] = $dsr->rsdescricao;
                $boletim['inss_sobre_ter']['quantidade'] = 7.5;
                $boletim['inss_sobre_ter']['valor'] =  $boletim['decimo_ter']['valor'] * 0.075;
                $boletim['desconto'] +=  $boletim['inss_sobre_ter']['valor'];
                $inss_rublica =  $this->rublica->buscaRublicaUnidade('INSS');
                foreach ($inss_lista as $in => $valor_inss) {
                    $novoinss =  str_replace(".","",$valor_inss->isvalorfinal);
                    $novoinss =  str_replace(',','.',$novoinss);
                    $novoinss = (float) $novoinss;
                    if ($inss <= $novoinss && $in == 0) {
                        $resultado = $inss * ((float)str_replace(',','.',$valor_inss->isindece)/100);
                        $boletim['inss']['valor'] = $resultado;
                        $boletim['inss']['codigos'] = $inss_rublica->rsrublica;
                        $boletim['inss']['rublicas'] = $inss_rublica->rsdescricao;
                        $boletim['inss']['quantidade'] = $boletim['base_inss']/$resultado;
                        $boletim['desconto'] += $resultado;
                    }elseif ($inss > str_replace(',','.',str_replace(".","",$inss_lista[0]->isvalorfinal))  && $inss <= $novoinss && $in == 1) {
                        $resultado = $inss - str_replace(',','.',str_replace(".","",$inss_lista[0]->isvalorfinal));
                        $resultado = $resultado * ((float)str_replace(',','.',$valor_inss->isindece)/100);
                        $resultado = $resultado + ((float)str_replace(',','.',$inss_lista[0]->isreducao));
                        $boletim['inss']['valor'] = $resultado;
                        $boletim['inss']['codigos'] = $inss_rublica->rsrublica;
                        $boletim['inss']['rublicas'] = $inss_rublica->rsdescricao;
                        $boletim['inss']['quantidade'] = $boletim['base_inss']/$resultado;
                        $boletim['desconto'] += $resultado;
                    }elseif ($inss > str_replace(',','.',str_replace(".","",$inss_lista[1]->isvalorfinal))  && $inss <= $novoinss && $in == 2) {
                        $resultado = $inss - str_replace(',','.',str_replace(".","",$inss_lista[1]->isvalorfinal));
                        $resultado = $resultado * ((float)str_replace(',','.',$valor_inss->isindece)/100);
                        $resultado = $resultado + ((float)str_replace(',','.',$inss_lista[1]->isreducao));
                        $boletim['inss']['valor'] = $resultado;
                        $boletim['inss']['codigos'] = $inss_rublica->rsrublica;
                        $boletim['inss']['rublicas'] = $inss_rublica->rsdescricao;
                        $boletim['inss']['quantidade'] = $boletim['base_inss']/$resultado;
                        $boletim['desconto'] += $resultado;
                    }elseif ( $inss >= $novoinss && $in == 3) {
                        $resultado = $inss - str_replace(',','.',str_replace(".","",$inss_lista[2]->isvalorfinal));
                        $resultado = $resultado * ((float)str_replace(',','.',$valor_inss->isindece)/100);
                        $resultado = $resultado + ((float)str_replace(',','.',$inss_lista[2]->isreducao));
                        $boletim['inss']['valor'] = $resultado;
                        $boletim['inss']['codigos'] = $inss_rublica->rsrublica;
                        $boletim['inss']['rublicas'] = $inss_rublica->rsdescricao;
                        $boletim['inss']['quantidade'] = $boletim['base_inss']/$resultado;
                        $boletim['desconto'] += $resultado;
                    }
                   
                }
                $boletim['liquido'] = $boletim['vencimento'] - $boletim['desconto'];
                $boletim['depedente'] = $trabalhadores->depedente->count();
                $boletim['base_irrf'] = str_replace(',','.',$irrf_lista[0]->irdepedente) * $boletim['depedente'];
                $boletim['base_irrf'] += $boletim['inss']['valor'] + $boletim['inss_sobre_ter']['valor'];
                $boletim['base_irrf'] = $boletim['base_fgts'] -  $boletim['base_irrf'];

                $basecalculo = $this->basecalculo->cadastros($boletim);
                $boletim['basecalculo'] = $basecalculo['id'];
                $dia['basecalculo'] = $basecalculo['id'];
                for ($i=0; $i < count($dia['dias']); $i++) { 
                    $this->relacaodia->cadastros($dia,$i);
                }
               
                if ($boletim['horanormal']['valor']) {
                    $this->valorcalculo->cadastroHorasnormais($boletim);
                }
               
                if ($boletim['hora50']['valor']) {
                    $this->valorcalculo->cadastroHoras50($boletim);
                }
                if ($boletim['hora100']['valor']) {
                    $this->valorcalculo->cadastroHoras100($boletim);
                }
                if ($boletim['noturno']['valor']) {
                    $this->valorcalculo->cadastroNoturno($boletim);
                }
                if ($boletim['producao']['valor']) {
                    $this->valorcalculo->cadastroProducao($boletim);
                }
                if ($boletim['gratificacao']['valor']) {
                    $this->valorcalculo->cadastroGratificacao($boletim);
                }
                if ($boletim['diarianormal']['valor']) {
                    $this->valorcalculo->cadastroDiarianormal($boletim);
                }
               
                $this->valorcalculo->cadastroVa($boletim);
                $this->valorcalculo->cadastroVt($boletim);
                $this->valorcalculo->cadastrodsr($boletim);
                $this->valorcalculo->cadastrodecimo_ter($boletim);
                $this->valorcalculo->cadastroferias_decimoter($boletim);
                $this->valorcalculo->cadastroinss($boletim);
                $this->valorcalculo->cadastroinss_decimoter($boletim);
            }
           
        }
    //    dd($dados,$boletim,$dia)
       $rublica = $this->rublica->get();
       $irrf_rublica =  $this->rublica->buscaRublicaUnidade('IRRF');
       $sim = [];
       $nao = [];
       foreach ($rublica as $key => $rublicas) {
           if ($rublicas->rsincidencia == 'Sim') {
               array_push($sim,(int) $rublicas->rsrublica);
           }else{
              array_push($nao,(int) $rublicas->rsrublica);
           }
       }
       $basecalculo = $this->basecalculo->where('folhar_id',$folhar['id'])
      
       ->selectRaw(
           'SUM(biservico) as biservico,
           SUM(biservicodsr) as biservicodsr,
           SUM(biinss) as biinss, 
           SUM(bifgts) as bifgts, 
           SUM(bifgtsmes) as bifgtsmes, 
          
           SUM(bivalorliquido) as bivalorliquido, 
           SUM(bivalorvencimento) as bivalorvencimento, 
           SUM(bivalordesconto) as bivalordesconto,
           folhar_id,
           trabalhador_id'
        )
       ->groupBy('trabalhador_id','folhar_id')->get();
       foreach ($basecalculo as $key => $basecalculos) {
            $depedente = $this->depedente->where('trabalhador_id',$basecalculos->trabalhador_id)->count();
            $base_irrf = str_replace(',','.',$irrf_lista[0]->irdepedente) * $depedente;
            $codigo = [2001,2002];
            $faxa = "";
            $folha = 0;
            $totaldias = 0;
            $boletim = [
                'irrf'=>[
                    'codigos'=>0,
                    'rublicas'=>0,
                    'quantidade'=>0,
                    'valor'=> 0,
                    'id'=>0,
                ],
                'adiantamento'=>[
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
                'trabalhador'=>'',
                'basecalculo'=>''
            ];
            $valorcalculos =   $this->valorcalculo->listaGeral($folhar['id'],$basecalculos->trabalhador_id,$codigo);
            foreach ($valorcalculos as $key => $valorcalculo) {
                $base_irrf += $valorcalculo->desconto;
            }
            $base_irrf = $basecalculos->bifgts - $base_irrf;
            foreach ($irrf_lista as $key => $irrf) {
                $novoirrf = (float) $irrf->irsvalorfinal;
                if ($base_irrf < $novoirrf && $key === 0) {
                    $faxa = 0;
                    $resultadoinss = 0;
                    $boletim['irrf']['rublicas'] = $irrf_rublica->rsdescricao;
                    $boletim['irrf']['valor'] = 0;
                    $boletim['irrf']['quantidade'] = 0;
                    $boletim['irrf']['codigos'] = $irrf_rublica->rsrublica;
                }elseif ($base_irrf > (float)$irrf_lista[0]->irsvalorfinal && $base_irrf < $novoirrf && $key === 1) {
                    $faxa = $irrf->irsindece;
                    $resultado = $base_irrf * ((float)str_replace(',','.',$irrf->irsindece)/100);
                    $boletim['irrf']['rublicas'] = $irrf_rublica->rsdescricao;
                    $boletim['irrf']['valor'] = $resultado;
                    $boletim['irrf']['quantidade'] = str_replace(',','.',$irrf->irsindece);
                    $boletim['irrf']['codigos'] = $irrf_rublica->rsrublica;
                    $basecalculos->bivalorliquido -= $resultado;
                    $basecalculos->bivalordesconto += $resultado;
                }elseif ($base_irrf > (float)$irrf_lista[1]->irsvalorfinal && $base_irrf < $novoirrf && $key === 2) {
                    $faxa = $irrf->irsindece;
                    $resultado = $base_irrf * ((float)str_replace(',','.',$irrf->irsindece)/100);
                    $boletim['irrf']['rublicas'] = $irrf_rublica->rsdescricao;
                    $boletim['irrf']['valor'] = $resultado;
                    $boletim['irrf']['quantidade'] = str_replace(',','.',$irrf->irsindece);
                    $boletim['irrf']['codigos'] = $irrf_rublica->rsrublica;
                    $basecalculos->bivalorliquido -= $resultado;
                    $basecalculos->bivalordesconto += $resultado;
                }elseif ($base_irrf > (float)$irrf_lista[2]->irsvalorfinal && $base_irrf < $novoirrf && $key === 3) {
                    $faxa = $irrf->irsindece;
                    $resultado = $base_irrf * ((float)str_replace(',','.',$irrf->irsindece)/100);
                    $boletim['irrf']['rublicas'] = $irrf_rublica->rsdescricao;
                    $boletim['irrf']['valor'] = $resultado;
                    $boletim['irrf']['quantidade'] = str_replace(',','.',$irrf->irsindece);
                    $boletim['irrf']['codigos'] = $irrf_rublica->rsrublica;
                    $basecalculos->bivalorliquido -= $resultado;
                    $basecalculos->bivalordesconto += $resultado;
                }
            }
            if ($quantdias > 15) {
                $datafinal = explode('-',$datafinal);
                $datafinal = $datafinal[0].'-'.$datafinal[1].'-15';
                $folha = DB::table('folhars') 
                ->join('base_calculos', 'folhars.id', '=', 'base_calculos.folhar_id')
                ->select('bivalorliquido')
                ->whereBetween('folhars.fsfinal',[$datainicio,$datafinal])
                ->where('base_calculos.tomador_id','!=',null)
                ->where('base_calculos.trabalhador_id',$basecalculos->trabalhador_id)
                ->first();
                if ($folha) {
                    $basecalculos->bivalorliquido -= $folhar->bivalorliquido;
                    $basecalculos->bivalordesconto += $folhar->bivalorliquido;
                }
               
            }
            $desconto = $this->desconto
            ->where('trabalhador_id',$basecalculos->trabalhador_id)
            ->whereBetween('dscompetencia',[substr($datainicio, 0, 7),substr($datafinal, 0, 7)])
            ->selectRaw(
                'dsquinzena,
                dsdescricao,
                dscompetencia,	
                COUNT(dsdescricao) as quantidade,
                SUM(dfvalor) as valor'
            )
            ->groupBy('dscompetencia','dsquinzena','dsdescricao')
            ->first();
            if ($desconto) {
                if ($quantdias <= 15 && $desconto->dsquinzena === '1 - Primeira') {
                    $basecalculos->bivalorliquido -= $desconto->valor;
                    $basecalculos->bivalordesconto += $desconto->valor;
                }
                if ($quantdias > 15 && $desconto->dsquinzena === '2 - Segunda') {
                    $basecalculos->bivalorliquido -= $desconto->valor;
                    $basecalculos->bivalordesconto += $desconto->valor;
                }
            }
            if ($seguros->esseguro) {
                $seguro = str_replace(',','.',$seguros->esseguro);
                $seguro = (float) $seguro;
                $basecalculos->bivalordesconto += $seguro;
                $basecalculos->bivalorliquido -= $seguro;
            }
            if ($seguros->escondicaosindicato) {
                $sindicato = str_replace(',','.',$seguros->escondicaosindicato);
                $sindicato = (float) $sindicato;
                $basecalculos->bivalordesconto += $sindicato;
                $basecalculos->bivalorliquido -= $sindicato;
            }
            $relacaodia =   DB::table('base_calculos') 
            ->join('relacao_dias', 'base_calculos.id', '=', 'relacao_dias.base_calculo_id')
            ->selectRaw('SUM(relacao_dias.rivalor) as valor,rsdia')
            ->where('base_calculos.folhar_id',$folhar['id'])
            ->where('base_calculos.tomador_id','!=',null)
            ->where('relacao_dias.trabalhador_id',$basecalculos->trabalhador_id)
            ->groupBy('rsdia')
            ->get();
            foreach ($relacaodia as $key => $relacaodias) {
                $totaldias += $relacaodias->valor;
            }
            // dd($base_irrf,$irrf_lista,$boletim,$faxa);
            $base =  $this->basecalculo->create([
                'biservico'=>$basecalculos->biservico,
                'biservicodsr'=>$basecalculos->biservicodsr,
                'biinss'=>$basecalculos->biinss,
                'bifgts'=>$basecalculos->bifgts,
                'bifgtsmes'=>$basecalculos->bifgtsmes,
                'biirrf'=>$base_irrf,
                'bifaixairrf'=>$faxa,
                'binumfilhos'=>$depedente,
                'bitotaldiaria'=>$totaldias,
                'bivalorliquido'=>$basecalculos->bivalorliquido,
                'bivalorvencimento'=>$basecalculos->bivalorvencimento,
                'bivalordesconto'=>$basecalculos->bivalordesconto,
                'trabalhador_id'=>$basecalculos->trabalhador_id,
                'folhar_id'=>$basecalculos->folhar_id,
            ]);
            foreach ($relacaodia as $key => $relacaodias) {
                $this->relacaodia->create([
                    'rsdia'=>$relacaodias->rsdia,
                    'rivalor'=>$relacaodias->valor,
                    'base_calculo_id'=>$base['id'],
                    'trabalhador_id'=>$basecalculos->trabalhador_id
                ]);
            }
            if ($folha) {
                $adiantamento =  $this->rublica->buscaRublicaUnidade('Adiantamento');
                $boletim['adiantamento']['codigos'] = $adiantamento->rsrublica;
                $boletim['adiantamento']['rublicas'] = $adiantamento->rsdescricao;
                $boletim['adiantamento']['quantidade'] = 1;
                $boletim['adiantamento']['valor'] = $folhar->bivalorliquido;
                $boletim['trabalhador'] = $basecalculos->trabalhador_id;
                $boletim['basecalculo'] = $base['id'];
                $this->valorcalculo->cadastroadiantamento($boletim);
            }
            if ($desconto) {
                $boletim['descontos']['codigos'] = 0;
                $boletim['descontos']['rublicas'] = $desconto->rsdescricao;
                $boletim['descontos']['quantidade'] = $desconto->quantidade;;
                $boletim['descontos']['valor'] = $desconto->valor;
                $boletim['trabalhador'] = $basecalculos->trabalhador_id;
                $boletim['basecalculo'] = $base['id'];
                $this->valorcalculo->cadastroadesconto($boletim);
            }
            if ($seguros->esseguro) {
                $seguros_rublicas =  $this->rublica->buscaRublicaUnidade('Seguro');
                $boletim['seguro']['codigos'] = $seguros_rublicas->rsrublica;
                $boletim['seguro']['rublicas'] = $seguros_rublicas->rsdescricao;
                $boletim['seguro']['quantidade'] = 1;
                $boletim['seguro']['valor'] = $seguro;
                $boletim['trabalhador'] = $basecalculos->trabalhador_id;
                $boletim['basecalculo'] = $base['id'];
                $this->valorcalculo->cadastroaseguro($boletim);
            }
            if ($seguros->escondicaosindicato) {
                $seguros_rublicas =  $this->rublica->buscaRublicaUnidade('Sindicator');
                $boletim['sindicator']['codigos'] = $seguros_rublicas->rsrublica;
                $boletim['sindicator']['rublicas'] = $seguros_rublicas->rsdescricao;
                $boletim['sindicator']['quantidade'] = 1;
                $boletim['sindicator']['valor'] = $sindicato;
                $boletim['trabalhador'] = $basecalculos->trabalhador_id;
                $boletim['basecalculo'] = $base['id'];
                $this->valorcalculo->cadastroasindicator($boletim);
            }
            $valorcalculo =   $this->valorcalculo->listaGeral($folhar['id'],$basecalculos->trabalhador_id,$sim);
            
            foreach ($valorcalculo as $key => $valorcalculos) {
                $this->valorcalculo->create([
                    'vicodigo'=> $valorcalculos->vicodigo,
                    'vsdescricao'=>$valorcalculos->vsdescricao,
                    'vireferencia'=>$valorcalculos->referencia,
                    'vivencimento'=>$valorcalculos->vencimento,
                    'base_calculo_id'=>$base['id'],
                    'trabalhador_id'=>$basecalculos->trabalhador_id,
                ]);
            }
            
            $valorcalculo =   $this->valorcalculo->listaGeral($folhar['id'],$basecalculos->trabalhador_id,$nao);
            // dd($valorcalculo);
            foreach ($valorcalculo as $key => $valorcalculos) {
                $this->valorcalculo->create([
                    'vicodigo'=> $valorcalculos->vicodigo,
                    'vsdescricao'=>$valorcalculos->vsdescricao,
                    'vireferencia'=>$valorcalculos->referencia,
                    'vivencimento'=>$valorcalculos->vencimento,
                    'videscinto'=>$valorcalculos->desconto,
                    'base_calculo_id'=>$base['id'],
                    'trabalhador_id'=>$basecalculos->trabalhador_id,
                ]);
            }
           
       }
      
       
       dd($valorcalculo);
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
}
?>