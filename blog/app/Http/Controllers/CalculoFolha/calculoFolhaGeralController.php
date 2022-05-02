<?php
namespace App\Http\Controllers\CalculoFolha;
use App\Http\Controllers\Controller;
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
class calculoFolhaGeralController extends Controller
{
    private $lancamentotabela,$folhar,$valorrublica,$rublica,$tomador,$trabalhador,$bolcartaoponto,$lancamentorublica,
    $cartaoponto,$inss,$irrf,$basecalculo,$relacaodia,$valorcalculo;
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
    }
    public function calculoFolhaGeral($datainicio,$datafinal,$competencia)
    {
        $user = auth()->user();
        $inss_lista = $this->inss->where('isano',date('Y',strtotime($datafinal)))->get();
        $irrf_lista = $this->irrf->where('irsano',date('Y',strtotime($datafinal)))->get();
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
            $boletim = [
                'horanormal'=>[
                    'id'=>[],
                    'codigos'=>[],
                    'dia' => [],
                    'valor' =>[],
                    'quantidade' => [],
                    'descricao' => []
                ],
                'diarianormal'=>[
                    'id'=>[],
                    'codigos'=>[],
                    'dia' => [],
                    'valor' =>[],
                    'quantidade' => [],
                    'descricao' => []
                ],
                'hora50'=>[
                    'id'=>[],
                    'dia' => [],
                    'codigos'=>[],
                    'valor' =>[],
                    'quantidade' => [],
                    'descricao' => []
                ],
                'hora100'=>[
                    'id'=>[],
                    'dia' => [],
                    'codigos'=>[],
                    'valor' =>[],
                    'quantidade' => [],
                    'descricao' => []
                ],
                'noturno'=>[
                    'id'=>[],
                    'dia' => [],
                    'codigos'=>[],
                    'valor' =>[],
                    'quantidade' => [],
                    'descricao' => []
                ],
                'producao'=>[
                    'id'=>[],
                    'dia' => [],
                    'codigos'=>[],
                    'valor' =>[],
                    'quantidade' => [],
                    'descricao' => []
                ],
                'gratificacao'=>[
                    'id'=>[],
                    'dia' => [],
                    'codigos'=>[],
                    'valor' =>[],
                    'quantidade' => [],
                    'descricao' => []
                ],
                'vt'=>[
                    'id'=>[],
                    'dia' => [],
                    'codigos'=>'',
                    'valor' =>0,
                    'quantidade' => 0,
                    'descricao' => ''
                ],
                'va'=>[
                    'id'=>[],
                    'dia' => [],
                    'codigos'=>'',
                    'valor' =>0,
                    'quantidade' => 0,
                    'descricao' => ''
                ],
                'diaria'=>[
                    'id'=>[],
                    'dia' => [],
                    'codigos'=>[],
                    'valor' =>[],
                    'quantidade' => [],
                    'descricao' => []
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
                'servicodsr'=>0,
                'base_inss'=>0,
                'base_fgts'=>0,
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
                'basecalculo'=>''
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
                $boletim['trabalhador'] = $trabalhadores->id;
                foreach ($dados['id'] as $i => $dado) {
                    if ($dado == $trabalhadores->id) {
                        if ($dados['descricao'][$i] == 'hora normal') {
                            if (!array_key_exists($t,$boletim['horanormal']['descricao'])) {
                                array_push($boletim['horanormal']['descricao'],$dados['descricao'][$i]);
                                array_push($boletim['horanormal']['codigos'],$dados['codigos'][$i]);
                                
                                
                            }
                            if (!array_key_exists($t,$boletim['horanormal']['valor'])) {
                                array_push($boletim['horanormal']['valor'],$dados['valor'][$i]);
                                array_push($boletim['horanormal']['quantidade'],$dados['quantidade'][$i]);
                                $boletim['servico'] += $dados['valor'][$i];
                            }else{
                                $boletim['horanormal']['valor'][$t] += $dados['valor'][$i]; 
                                $boletim['horanormal']['quantidade'][$t] += $dados['quantidade'][$i];
                                $boletim['servico'] += $dados['valor'][$i];
                            }
                        }
                        if ($dados['descricao'][$i] == 'diaria normal') {
                            if (!array_key_exists($t,$boletim['diarianormal']['descricao'])) {
                                array_push($boletim['diarianormal']['descricao'],$dados['descricao'][$i]);
                                array_push($boletim['diarianormal']['codigos'],$dados['codigos'][$i]);
                                
                                
                            }
                            if (!array_key_exists($t,$boletim['diarianormal']['valor'])) {
                                array_push($boletim['diarianormal']['valor'],$dados['valor'][$i]);
                                array_push($boletim['diarianormal']['quantidade'],$dados['quantidade'][$i]);
                                $boletim['servico'] += $dados['valor'][$i];
                            }else{
                                $boletim['diarianormal']['valor'][$t] += $dados['valor'][$i]; 
                                $boletim['diarianormal']['quantidade'][$t] += $dados['quantidade'][$i];
                                $boletim['servico'] += $dados['valor'][$i];
                            }
                        }
                        if ($dados['descricao'][$i] == 'hora extra 50%') {
                            if (!array_key_exists($t,$boletim['hora50']['descricao'])) {
                                array_push($boletim['hora50']['descricao'],$dados['descricao'][$i]);
                                array_push($boletim['hora50']['codigos'],$dados['codigos'][$i]);
                                
                            }
                            if (!array_key_exists($t,$boletim['hora50']['valor'])) {
                                array_push($boletim['hora50']['valor'],$dados['valor'][$i]);
                                array_push($boletim['hora50']['quantidade'],$dados['quantidade'][$i]);
                                $boletim['servico'] += $dados['valor'][$i];
                            }else{
                                $boletim['hora50']['valor'][$t] += $dados['valor'][$i]; 
                                $boletim['hora50']['quantidade'][$t] += $dados['quantidade'][$i];
                                $boletim['servico'] += $dados['valor'][$i];
                            }
                        }
                        if ($dados['descricao'][$i] == 'hora extra 100%') {
                            if (!array_key_exists($t,$boletim['hora100']['descricao'])) {
                                array_push($boletim['hora100']['descricao'],$dados['descricao'][$i]);
                                array_push($boletim['hora100']['codigos'],$dados['codigos'][$i]);
                                
                            }
                            if (!array_key_exists($t,$boletim['hora100']['valor'])) {
                                array_push($boletim['hora100']['valor'],$dados['valor'][$i]);
                                array_push($boletim['hora100']['quantidade'],$dados['quantidade'][$i]);
                                $boletim['servico'] += $dados['valor'][$i];
                            }else{
                                $boletim['hora100']['valor'][$t] += $dados['valor'][$i]; 
                                $boletim['hora100']['quantidade'][$t] += $dados['quantidade'][$i];
                                $boletim['servico'] += $dados['valor'][$i];
                            }
                        }
                        if ($dados['descricao'][$i] == 'adicional noturno') {
                            if (!array_key_exists($t,$boletim['noturno']['descricao'])) {
                                array_push($boletim['noturno']['descricao'],$dados['descricao'][$i]);
                                array_push($boletim['noturno']['codigos'],$dados['codigos'][$i]);
                                
                            }
                            if (!array_key_exists($t,$boletim['noturno']['valor'])) {
                                array_push($boletim['noturno']['valor'],$dados['valor'][$i]);
                                array_push($boletim['noturno']['quantidade'],$dados['quantidade'][$i]);
                                $boletim['servico'] += $dados['valor'][$i];
                            }else{
                                $boletim['noturno']['valor'][$t] += $dados['valor'][$i];
                                $boletim['noturno']['quantidade'][$t] += $dados['quantidade'][$i];
                                $boletim['servico'] += $dados['valor'][$i]; 
                            }
                        }
                        if ($dados['descricao'][$i] == 'produção') {
                            if (!array_key_exists($t,$boletim['producao']['descricao'])) {
                                array_push($boletim['producao']['descricao'],$dados['descricao'][$i]);
                                array_push($boletim['producao']['codigos'],$dados['codigos'][$i]);
                            }
                            if (!array_key_exists($t,$boletim['producao']['valor'])) {
                                array_push($boletim['producao']['valor'],$dados['valor'][$i]);
                                array_push($boletim['producao']['quantidade'],$dados['quantidade'][$i]);
                                $boletim['servico'] += $dados['valor'][$i];
                            }else{
                                $boletim['producao']['valor'][$t] += $dados['valor'][$i]; 
                                $boletim['producao']['quantidade'][$t] += $dados['quantidade'][$i];
                                $boletim['servico'] += $dados['valor'][$i]; 
                            }
                        }
                        if ($dados['descricao'][$i] == 'gratificação') {
                            if (!array_key_exists($t,$boletim['gratificacao']['descricao'])) {
                                array_push($boletim['gratificacao']['descricao'],$dados['descricao'][$i]);
                                array_push($boletim['gratificacao']['codigos'],$dados['codigos'][$i]);
                            }
                            if (!array_key_exists($t,$boletim['gratificacao']['valor'])) {
                                array_push($boletim['gratificacao']['valor'],$dados['valor'][$i]);
                                array_push($boletim['gratificacao']['quantidade'],$dados['quantidade'][$i]);
                                $boletim['servico'] += $dados['valor'][$i];
                            }else{
                                $boletim['gratificacao']['valor'][$t] += $dados['valor'][$i]; 
                                $boletim['gratificacao']['quantidade'][$t] += $dados['quantidade'][$i]; 
                                $boletim['servico'] += $dados['valor'][$i];
                            }
                        }
                        if (!in_array($dados['dia'][$i],$dia['dias'])) {
                            array_push($dia['dias'],$dados['dia'][$i]);
                            array_push($dia['valor'],$dados['valor'][$i]);
                            
                        }else{
                            $key = array_search($dados['dia'][$i], $dia['dias']);
                            $dia['valor'][$key] += $dados['valor'][$i];
                        }
                    }
                }
                $boletim['vencimento'] = $boletim['servico'];
                $tomador_cartao_ponto_horas = self::calculardia($tomadores->cartaoponto[0]->csdiasuteis,null);
                if (isset($boletim['horanormal']['valor'][$t])) {
                    $horasnormais = $boletim['horanormal']['valor'][$t];
                }else{
                    $horasnormais = 0;
                }

                if (isset($boletim['diarianormal']['valor'][$t])) {
                    $diariasnormais = $boletim['diarianormal']['valor'][$t];
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
                $basecalculo = $this->basecalculo->cadastros($boletim);
                $boletim['basecalculo'] = $basecalculo['id'];
                $dia['basecalculo'] = $basecalculo['id'];
                for ($i=0; $i < count($dia['dias']); $i++) { 
                    $this->relacaodia->cadastros($dia,$i);
                }
                if (array_key_exists($t,$boletim['horanormal']['valor'])) {
                    $this->valorcalculo->cadastroHorasnormais($boletim,$t);
                }
               
                if (array_key_exists($t,$boletim['hora50']['valor'])) {
                    $this->valorcalculo->cadastroHoras50($boletim,$t);
                }
                if (array_key_exists($t,$boletim['hora100']['valor'])) {
                    $this->valorcalculo->cadastroHoras100($boletim,$t);
                }
                if (array_key_exists($t,$boletim['noturno']['valor'])) {
                    $this->valorcalculo->cadastroNoturno($boletim,$t);
                }
                if (array_key_exists($t,$boletim['producao']['valor'])) {
                    $this->valorcalculo->cadastroProducao($boletim,$t);
                }
                if (array_key_exists($t,$boletim['gratificacao']['valor'])) {
                    $this->valorcalculo->cadastroGratificacao($boletim,$t);
                }
                if (array_key_exists($t,$boletim['diarianormal']['valor'])) {
                    $this->valorcalculo->cadastroDiarianormal($boletim,$t);
                }
                $this->valorcalculo->cadastroVa($boletim);
                $this->valorcalculo->cadastroVt($boletim);
            }
           
        }
       dd($dados,$boletim,$dia);
        // dd($trabalhador);
        // foreach ($trabalhador as $key => $trabalhadores) {
        //     $salario = 0;
        //     $boletim = [
        //         'horanormal'=>[
        //             'id'=>[],
        //             'codigos'=>'',
        //             'dia' => '',
        //             'valor' =>0,
        //             'quantidade' => 0,
        //             'descricao' => ''
        //         ],
        //         'hora50'=>[
        //             'id'=>[],
        //             'dia' => '',
        //             'codigos'=>'',
        //             'valor' =>0,
        //             'quantidade' => 0,
        //             'descricao' => ''
        //         ],
        //         'hora100'=>[
        //             'id'=>[],
        //             'dia' => '',
        //             'codigos'=>'',
        //             'valor' =>0,
        //             'quantidade' => 0,
        //             'descricao' => ''
        //         ],
        //         'noturno'=>[
        //             'id'=>[],
        //             'dia' => '',
        //             'codigos'=>'',
        //             'valor' =>0,
        //             'quantidade' => 0,
        //             'descricao' => ''
        //         ],
        //         'producao'=>[
        //             'id'=>[],
        //             'dia' => '',
        //             'codigos'=>'',
        //             'valor' =>0,
        //             'quantidade' => 0,
        //             'descricao' => ''
        //         ],
        //         'gratificacao'=>[
        //             'id'=>[],
        //             'dia' => '',
        //             'codigos'=>'',
        //             'valor' =>0,
        //             'quantidade' => 0,
        //             'descricao' => ''
        //         ],
        //         'diaria'=>[
        //             'id'=>[],
        //             'dia' => '',
        //             'codigos'=>'',
        //             'valor' =>0,
        //             'quantidade' => 0,
        //             'descricao' => ''
        //         ],
        //         'dsr1818'=>[
        //             'valor'=>0,
        //             'codigos'=>'',
        //             'quantidade'=> 0,
        //             'rublicas'=>0,
        //         ],
        //         'decimo_ter'=>[
        //             'valor'=>0,
        //             'codigos'=>'',
        //             'quantidade'=> 0,
        //             'rublicas'=>0,
        //         ],
        //         'ferias_decimoter'=>[
        //             'valor'=>0,
        //             'codigos'=>'',
        //             'quantidade'=> 0,
        //             'rublicas'=>0,
        //         ],
        //         'servico'=>0,
        //         'servicodsr'=>0,
        //         'base_inss'=>0,
        //         'base_fgts'=>0,
        //         'fgts_mes'=>0,
        //         // 'folhar'=>$folhar['id'],
        //         'depedente'=>$trabalhadores->depedente->count(),
                
        //     ];
           
        //     $bolcartaoponto = $this->bolcartaoponto->where('trabalhador_id',$trabalhadores->id)
        //     ->whereBetween('created_at',[$datainicio,$datafinal])
        //     ->with('lancamentotabela.tomador.tabelapreco')->get();
        //     foreach ($bolcartaoponto as $key => $bolcartaopontos) {
        //         array_push($tomador_id,$bolcartaopontos->lancamentotabela->tomador->id);
        //         foreach ($bolcartaopontos->lancamentotabela->tomador->tabelapreco as $key => $tabelapreco) {
        //             if ($tabelapreco->tsdescricao == 'hora normal') {
        //                 $salario += self::calculardia($bolcartaopontos->horas_normais,$tabelapreco->tsvalor);
        //                 $boletim['horanormal']['valor'] +=  self::calculardia($bolcartaopontos->horas_normais,$tabelapreco->tsvalor);
        //                 $boletim['horanormal']['quantidade'] += self::calcularhoras($bolcartaopontos->horas_normais);
        //                 $boletim['horanormal']['dia'] = date('d',strtotime($bolcartaopontos->created_at));
        //                 $boletim['horanormal']['descricao'] = $tabelapreco->tsdescricao;
        //                 $boletim['horanormal']['codigos'] = $tabelapreco->tsrubrica;
        //             }else if ($tabelapreco->tsdescricao == 'hora extra 50%') {
        //                 $salario += self::calculardia($bolcartaopontos->bshoraex,$tabelapreco->tsvalor);
        //                 $boletim['hora50']['valor'] +=  self::calculardia($bolcartaopontos->bshoraex,$tabelapreco->tsvalor);
        //                 $boletim['hora50']['quantidade'] += self::calcularhoras($bolcartaopontos->bshoraex);
        //                 $boletim['hora50']['dia'] = date('d',strtotime($bolcartaopontos->created_at));
        //                 $boletim['hora50']['descricao'] = $tabelapreco->tsdescricao;
        //                 $boletim['hora50']['codigos'] = $tabelapreco->tsrubrica;
        //             }else if ($tabelapreco->tsdescricao == 'hora extra 100%') {
        //                 $salario += self::calculardia($bolcartaopontos->bshoraexcem,$tabelapreco->tsvalor);
        //                 $boletim['hora100']['valor'] +=  self::calculardia($bolcartaopontos->bshoraexcem,$tabelapreco->tsvalor);
        //                 $boletim['hora100']['quantidade'] += self::calcularhoras($bolcartaopontos->bshoraexcem);
        //                 $boletim['hora100']['dia'] = date('d',strtotime($bolcartaopontos->created_at));
        //                 $boletim['hora100']['descricao'] = $tabelapreco->tsdescricao;
        //                 $boletim['hora100']['codigos'] = $tabelapreco->tsrubrica;
        //             }elseif ($tabelapreco->tsdescricao == 'adicional noturno') {
        //                 $salario += self::calculardia($bolcartaopontos->bsadinortuno,$tabelapreco->tsvalor);
        //                 $boletim['noturno']['valor'] +=  self::calculardia($bolcartaopontos->bsadinortuno,$tabelapreco->tsvalor);
        //                 $boletim['noturno']['quantidade'] += self::calcularhoras($bolcartaopontos->bsadinortuno);
        //                 $boletim['noturno']['dia'] = date('d',strtotime($bolcartaopontos->created_at));
        //                 $boletim['noturno']['descricao'] = $tabelapreco->tsdescricao;
        //                 $boletim['noturno']['codigos'] = $tabelapreco->tsrubrica;
        //             }
        //         }
               
        //     }
        //     $lancamentorublica = $this->lancamentorublica->where('trabalhador_id',$trabalhadores->id)
        //     ->with('lancamentotabela.tomador.tabelapreco')
        //     ->whereBetween('created_at',[$datainicio,$datafinal])
        //     ->get();
            
        //     foreach ($lancamentorublica as $key => $lancamentorublicas) {
        //         array_push($tomador_id,$lancamentorublicas->lancamentotabela->tomador->id);
        //         if ($lancamentorublicas->lsdescricao == 'hora normal') {
        //             $salario += self::calculovalores($lancamentorublicas->lsquantidade,$lancamentorublicas->lfvalor);
        //             $boletim['horanormal']['valor'] += self::calculovalores($lancamentorublicas->lsquantidade,$lancamentorublicas->lfvalor);
        //             $boletim['horanormal']['quantidade'] +=  self::calcularhoras($lancamentorublicas->lsquantidade);
        //         }elseif ($lancamentorublicas->lsdescricao == 'hora extra 50%') {
        //             $salario += self::calculovalores($lancamentorublicas->lsquantidade,$lancamentorublicas->lfvalor);
        //             $boletim['hora50']['valor'] += self::calculovalores($lancamentorublicas->lsquantidade,$lancamentorublicas->lfvalor);
        //             $boletim['hora50']['quantidade'] +=  self::calcularhoras($lancamentorublicas->lsquantidade);
        //         }elseif ($lancamentorublicas->lsdescricao == 'hora extra 100%') {
        //             $salario += self::calculovalores($lancamentorublicas->lsquantidade,$lancamentorublicas->lfvalor);
        //             $boletim['hora100']['valor'] += self::calculovalores($lancamentorublicas->lsquantidade,$lancamentorublicas->lfvalor);
        //             $boletim['hora100']['quantidade'] +=  self::calcularhoras($lancamentorublicas->lsquantidade);
        //         }elseif ($lancamentorublicas->lsdescricao == 'adicional noturno') {
        //             $salario += self::calculovalores($lancamentorublicas->lsquantidade,$lancamentorublicas->lfvalor);
        //             $boletim['noturno']['valor'] += self::calculovalores($lancamentorublicas->lsquantidade,$lancamentorublicas->lfvalor);
        //             $boletim['noturno']['quantidade'] +=  self::calcularhoras($lancamentorublicas->lsquantidade);
        //         }elseif ($lancamentorublicas->lsdescricao == 'diaria normal') {
        //             $dsr =  $this->rublica->buscaRublicaUnidade('diaria normal');
        //             $salario += self::calculovalores($lancamentorublicas->lsquantidade,$lancamentorublicas->lfvalor);
        //             $boletim['diaria']['valor'] +=  $lancamentorublicas->lfvalor;
        //             $boletim['diaria']['quantidade'] += $lancamentorublicas->lsquantidade;
        //             $boletim['diaria']['dia'] = date('d',strtotime($lancamentorublicas->created_at));
        //             $boletim['diaria']['descricao'] = $dsr->rsdescricao;
        //             $boletim['diaria']['codigos'] = $dsr->rsrublica;
        //         }elseif ($lancamentorublicas->lsdescricao == 'gratificação') {
        //             $dsr =  $this->rublica->buscaRublicaUnidade('gratificação');
        //             $salario += self::calculovalores($lancamentorublicas->lsquantidade,$lancamentorublicas->lfvalor);
        //             $boletim['gratificacao']['valor'] +=  $lancamentorublicas->lfvalor;
        //             $boletim['gratificacao']['quantidade'] += $lancamentorublicas->lsquantidade;
        //             $boletim['gratificacao']['dia'] = date('d',strtotime($lancamentorublicas->created_at));
        //             $boletim['gratificacao']['descricao'] = $dsr->rsdescricao;
        //             $boletim['gratificacao']['codigos'] = $dsr->rsrublica;
        //         }else{
        //             $dsr =  $this->rublica->buscaRublicaUnidade('produção');
        //             $salario += self::calculovalores($lancamentorublicas->lsquantidade,$lancamentorublicas->lfvalor);;
        //             $boletim['producao']['valor'] +=  $lancamentorublicas->lfvalor;
        //             $boletim['producao']['quantidade'] += $lancamentorublicas->lsquantidade;
        //             $boletim['producao']['dia'] = date('d',strtotime($lancamentorublicas->created_at));
        //             $boletim['producao']['descricao'] = $dsr->rsdescricao;
        //             $boletim['producao']['codigos'] = $dsr->rsrublica;
        //         }
                
               

        //     }
        //     $cartaoponto = $this->cartaoponto->whereIn('tomador_id',$tomador_id)->get();
        //     dd($cartaoponto);
        //     // dd($lancamentorublica);
        //     $boletim['servico'] = $salario;
        //     $dsr =  $this->rublica->buscaRublicaUnidade('DSR 18,18%');
        //     $boletim['dsr1818']['codigos'] = $dsr->rsrublica;
        //     $boletim['dsr1818']['rublicas'] = $dsr->rsdescricao;
        //     $boletim['dsr1818']['quantidade'] = 18.18;
        //     $boletim['dsr1818']['valor'] = self::calculoPocentagem($salario,18.18);
        //     $boletim['servicodsr'] = $boletim['dsr1818']['valor'] + $salario;
        //     $dsr =  $this->rublica->buscaRublicaUnidade('13º Salário');
        //     $boletim['decimo_ter']['codigos'] = $dsr->rsrublica;
        //     $boletim['decimo_ter']['rublicas'] = $dsr->rsdescricao;
        //     $boletim['decimo_ter']['quantidade'] = 8.34;
        //     $boletim['decimo_ter']['valor'] = self::calculoPocentagem($salario,8.34);
        //     $dsr =  $this->rublica->buscaRublicaUnidade('Ferias + 1/3');
        //     $boletim['ferias_decimoter']['codigos'] = $dsr->rsrublica;
        //     $boletim['ferias_decimoter']['rublicas'] = $dsr->rsdescricao;
        //     $boletim['ferias_decimoter']['quantidade'] = 11.12;
        //     $boletim['ferias_decimoter']['valor'] = self::calculoPocentagem($salario,11.12);
        //     $boletim['base_inss'] = $boletim['ferias_decimoter']['valor'] + $boletim['servicodsr'];
        //     $boletim['base_fgts'] = $boletim['decimo_ter']['valor'] + $boletim['ferias_decimoter']['valor'] + $boletim['servicodsr'];
        //     $boletim['fgts_mes'] = $boletim['base_fgts'] * 0.08;
        //     dd($boletim);
        //     echo($salario).'<br>';
        //     echo($trabalhadores->id).'<br>';
        //     echo( $boletim['fgts_mes']).'<br>';
           
        // }
       
        
       
        
        // foreach ($tomador as $key => $tomador) {
        //     $boletim = [
        //         'horanormal'=>[
        //             'id'=>[],
        //             'dia' => [],
        //             'valor' => [],
        //             'quantidade' => [],
        //             'descricao' => []
        //         ]
        //     ];
            
        //     $lancamentotabela = $this->lancamentotabela
        //     ->with(['lacamentorublica','bolcartaoponto'])
        //     ->whereBetween('lsdata',[$datainicio,$datafinal])
        //     ->where('tomador_id',$tomador->id)
        //     ->get();
        //     foreach ($tomador->tabelapreco as $key => $tabelapreco) {
        //         foreach ($lancamentotabela as $key => $lancamentotabelas) {
        //             if ($lancamentotabelas->bolcartaoponto->count()) {
        //                 foreach ($lancamentotabelas->bolcartaoponto as $key => $bolcartaoponto) {
        //                     dd($bolcartaoponto->bshoraex);
        //                     if (!in_array($bolcartaoponto->trabalhador_id, $boletim['horanormal']['id']) && $tabelapreco->tsdescricao == 'hora normal' && $bolcartaoponto->horas_normais) {
        //                         array_push($boletim['horanormal']['id'],$bolcartaoponto->trabalhador_id);
        //                         array_push($boletim['horanormal']['descricao'],$tabelapreco->tsdescricao);
        //                         array_push($boletim['horanormal']['dia'], date('d',strtotime($bolcartaoponto->created_at)));
        //                     }
        //                 }
                        
        //             }
                    
        //         }
        //         dd($boletim);
        //     }
           
            
        // }
       
        // $lancamentotabela = $this->lancamentotabela
        // // ->join('tomadors', 'tomadors.id', '=', 'lancamentotabelas.tomador_id')
        // ->whereBetween('lsdata',[$datainicio,$datafinal])
        // ->where('empresa_id',$user->empresa_id)
        // ->with(['lacamentorublica','bolcartaoponto'])
        // ->get();
        // dd($lancamentotabela);
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
}
?>