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
class calculoFolhaGeralController extends Controller
{
    private $lancamentotabela,$folhar,$valorrublica,$rublica,$tomador,$trabalhador,$bolcartaoponto,$lancamentorublica,
    $cartaoponto;
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
    }
    public function calculoFolhaGeral($datainicio,$datafinal,$competencia)
    {
        $user = auth()->user();
       
        $tomador = $this->tomador->where('empresa_id',$user->empresa_id)
        ->with('tabelapreco')->get();
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
            'fsfinal'=>$datafinal,
            'fscompetencia'=>$competencia,
            'empresa_id'=>$user->empresa_id
        ];
        // $folhar = $this->folhar->cadastro($folhar,$user->empresa_id);

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
                'servico'=>0,
                'servicodsr'=>0,
                'base_inss'=>0,
                'base_fgts'=>0,
                'fgts_mes'=>0,
                // 'folhar'=>$folhar['id'],
                // 'depedente'=>$trabalhadores->depedente->count(),
                
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
                foreach ($dados['id'] as $i => $dado) {
                    if ($dado == $trabalhadores->id) {
                        if ($dados['descricao'][$i] == 'hora normal') {
                            if (!array_key_exists($t,$boletim['horanormal']['descricao'])) {
                                array_push($boletim['horanormal']['descricao'],$dados['descricao'][$i]);
                                
                            }
                            if (!array_key_exists($t,$boletim['horanormal']['valor'])) {
                                array_push($boletim['horanormal']['valor'],$dados['valor'][$i]);
                            }else{
                                $boletim['horanormal']['valor'][$t] += $dados['valor'][$i]; 
                            }
                        }
                    }
                }
               
            }
            dd($dados,$boletim);
        }
      
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