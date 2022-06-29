<?php
namespace App\Http\Controllers\CalculoFolha;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
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
use App\Comissionado;
use PDF;
class calculoFolhaGeralController extends Controller
{
    private $lancamentotabela,$folhar,$valorrublica,$rublica,$tomador,$trabalhador,$bolcartaoponto,$lancamentorublica,
    $cartaoponto,$comissionador,$inss,$irrf,$leis,$basecalculo,$relacaodia,$valorcalculo,$depedente,$desconto,$empresa;
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
        $this->comissionador = new Comissionado;
        $today = Carbon::today();
        $this->dt = Carbon::create($today);
    }
    public function calculoFolhaGeral($datainicio,$datafinal,$competencia)
    {
        $user = auth()->user();
        
        $date1 = Carbon::createFromFormat('Y-m-d', $datainicio);
        $date2 = Carbon::createFromFormat('Y-m-d', $datafinal);
        $quantdias = $date2->diffInDays($date1); 
        $inss_lista = $this->inss->where('isano',date('Y',strtotime($datafinal)))->get();
        $irrf_lista = $this->irrf->where('irsano',date('Y',strtotime($datafinal)))->get();
        if (count($inss_lista) < 1) {
            return redirect()->back()->withErrors(['false'=>'O inss '.date('Y',strtotime($datafinal)).' não está cadastrado. Entre em contato com suporte.']);
        }
        if (count($irrf_lista) < 1) {
            return redirect()->back()->withErrors(['false'=>'O irrf '.date('Y',strtotime($datafinal)).' não está cadastrado. Entre em contato com suporte.']);
        }
        $folhar = $this->folhar->whereBetween('fsfinal',[$datainicio,$datafinal])->where('empresa_id',$user->empresa_id)->count();
        if ($folhar) {
            return redirect()->back()->withErrors(['false'=>'Ja existe uma folha lançada neste periodo.']);
        }
        $seguros = $this->empresa->buscaSeguro($user->empresa_id);
        $tomador = $this->tomador->where('empresa_id',$user->empresa_id)
        ->with(['tabelapreco','cartaoponto','incidefolhar'])->get();
        $tomador_id = [];
       
        // if (!$valorrublica->vsnrofolha) {
        //     $valorrublica->vsnrofolha = 1;
        // }else{
        //     $valorrublica->vsnrofolha += 1;
        // }
        // $this->valorrublica->where('empresa_id', $user->empresa_id)
        // ->update(['vsnrofolha'=>$valorrublica->vsnrofolha]);
        $this->valorrublica->where('empresa_id', $user->empresa_id)
        ->chunkById(100, function ($valorrublica) use ($user) {
            foreach ($valorrublica as $valorrublicas) {
                if ($valorrublicas->vsnrofolha >= 0) {
                    $numero = $valorrublicas->vsnrofolha += 1;
                    $this->valorrublica->where('empresa_id', $user->empresa_id)
                    ->update(['vsnrofolha'=>$numero]);
                }
               
            }
        });
        $valorrublica = $this->valorrublica->where('empresa_id',$user->empresa_id)->first();
        
        $folhar = [
            'codigo'=>$valorrublica->vsnrofolha,
            'inicio'=>$datainicio,
            'final'=>$datafinal,
            'competencia'=>$competencia,
            'empresa_id'=>$user->empresa_id
        ];
        $folhar = $this->folhar->cadastro($folhar,$user->empresa_id);
        $lancamentotabela = $this->lancamentotabela
            ->with(['lancamentorublica.lancamentotabela:id,lsdata','bolcartaoponto.lancamentotabela:id,lsdata','tomador:id','tomador.tabelapreco','tomador.cartaoponto','tomador.incidefolhar'])
            ->whereBetween('lsdata',[$datainicio,$datafinal])
            // ->where('tomador_id',$tomadores->id)
            ->get();
        // dd($lancamentotabela);
        if (count($lancamentotabela) < 1) {
            return redirect()->back()->withErrors(['false'=>'Não a boletins lançado neste periodo.']);
        }
        foreach ($lancamentotabela as $key => $lancamentotabelas) {
            $salario = 0;
            $dados=[
                'id'=>[],
                'codigos'=>[],
                'dia' => [],
                'valor' =>[],
                'quantidade' => [],
                'descricao' => []
            ];
           
            // $lancamentotabela = $this->lancamentotabela
            // ->with(['lancamentorublica.lancamentotabela:id,lsdata','bolcartaoponto.lancamentotabela:id,lsdata'])
            // ->whereBetween('lsdata',[$datainicio,$datafinal])
            // ->where('tomador_id',$tomadores->id)
            // ->get();
            // foreach ($lancamentotabela as $key => $lancamentotabelas) {
               
            // }
            foreach ($lancamentotabelas->bolcartaoponto as $key => $bolcartaopontos) {
                foreach ($lancamentotabelas->tomador->tabelapreco as $key => $tabelapreco) {
                    if ($tabelapreco->tsdescricao == 'hora normal' && $bolcartaopontos->horas_normais && $this->dt->year == $tabelapreco->tsano) {
                        array_push($dados['id'],$bolcartaopontos->trabalhador_id);
                        //$salario += self::calculardia($bolcartaopontos->horas_normais,$tabelapreco->tsvalor);
                        array_push($dados['valor'], self::calculardia($bolcartaopontos->horas_normais,$tabelapreco->tsvalor));
                        array_push($dados['quantidade'], self::calcularhoras($bolcartaopontos->horas_normais));
                        array_push($dados['dia'], date('d',strtotime($bolcartaopontos->lancamentotabela->lsdata)));
                        array_push($dados['descricao'], $tabelapreco->tsdescricao);
                        array_push($dados['codigos'], $tabelapreco->tsrubrica);
                    }else if ($tabelapreco->tsdescricao == 'hora extra 50%' && $bolcartaopontos->bshoraex && $this->dt->year == $tabelapreco->tsano) {
                        array_push($dados['id'],$bolcartaopontos->trabalhador_id);
                        //$salario += self::calculardia($bolcartaopontos->bshoraex,$tabelapreco->tsvalor);
                        array_push($dados['valor'],self::calculardia($bolcartaopontos->bshoraex,$tabelapreco->tsvalor));
                        array_push($dados['quantidade'], self::calcularhoras($bolcartaopontos->bshoraex));
                        array_push($dados['dia'], date('d',strtotime($bolcartaopontos->lancamentotabela->lsdata)));
                        array_push($dados['descricao'], $tabelapreco->tsdescricao);
                       array_push($dados['codigos'], $tabelapreco->tsrubrica);
                    }else if ($tabelapreco->tsdescricao == 'hora extra 100%' && $bolcartaopontos->bshoraexcem && $this->dt->year == $tabelapreco->tsano) {
                        array_push($dados['id'],$bolcartaopontos->trabalhador_id);
                        //$salario += self::calculardia($bolcartaopontos->bshoraexcem,$tabelapreco->tsvalor);
                        array_push($dados['valor'],self::calculardia($bolcartaopontos->bshoraexcem,$tabelapreco->tsvalor));
                        array_push($dados['quantidade'], self::calcularhoras($bolcartaopontos->bshoraexcem));
                        array_push($dados['dia'], date('d',strtotime($bolcartaopontos->lancamentotabela->lsdata)));
                        array_push($dados['descricao'], $tabelapreco->tsdescricao);
                        array_push($dados['codigos'], $tabelapreco->tsrubrica);
                    }elseif ($tabelapreco->tsdescricao == 'adicional noturno' && $bolcartaopontos->bsadinortuno && $this->dt->year == $tabelapreco->tsano) {
                        array_push($dados['id'],$bolcartaopontos->trabalhador_id);
                        //$salario += self::calculardia($bolcartaopontos->bsadinortuno,$tabelapreco->tsvalor);
                        array_push($dados['valor'],self::calculardia($bolcartaopontos->bsadinortuno,$tabelapreco->tsvalor));
                        array_push($dados['quantidade'], self::calcularhoras($bolcartaopontos->bsadinortuno));
                        array_push($dados['dia'], date('d',strtotime($bolcartaopontos->lancamentotabela->lsdata)));
                        array_push($dados['descricao'], $tabelapreco->tsdescricao);
                        array_push($dados['codigos'], $tabelapreco->tsrubrica);
                    }
                    
                  
                }
            }
            foreach ($lancamentotabelas->lancamentorublica as $key => $lancamentorublicas) {
                if ($lancamentorublicas->lsdescricao == 'hora normal') {
                    array_push($dados['id'],$lancamentorublicas->trabalhador_id);
                    array_push($dados['valor'], self::calculovalores($lancamentorublicas->lsquantidade,$lancamentorublicas->lfvalor));
                    array_push($dados['quantidade'], self::calcularhoras($lancamentorublicas->lsquantidade));
                    array_push($dados['dia'], date('d',strtotime($lancamentorublicas->lancamentotabela->lsdata)));
                    array_push($dados['descricao'], $lancamentorublicas->lsdescricao);
                    array_push($dados['codigos'], $lancamentorublicas->licodigo);
                   
                }elseif ($lancamentorublicas->lsdescricao == 'hora extra 50%') {
                    array_push($dados['id'],$lancamentorublicas->trabalhador_id);
                    array_push($dados['valor'], self::calculovalores($lancamentorublicas->lsquantidade,$lancamentorublicas->lfvalor));
                    array_push($dados['quantidade'], self::calcularhoras($lancamentorublicas->lsquantidade));
                    array_push($dados['dia'], date('d',strtotime($lancamentorublicas->lancamentotabela->lsdata)));
                    array_push($dados['descricao'], $lancamentorublicas->lsdescricao);
                    array_push($dados['codigos'], $lancamentorublicas->licodigo);
                }elseif ($lancamentorublicas->lsdescricao == 'hora extra 100%') {
                    array_push($dados['id'],$lancamentorublicas->trabalhador_id);
                    array_push($dados['valor'], self::calculovalores($lancamentorublicas->lsquantidade,$lancamentorublicas->lfvalor));
                    array_push($dados['quantidade'], self::calcularhoras($lancamentorublicas->lsquantidade));
                    array_push($dados['dia'], date('d',strtotime($lancamentorublicas->lancamentotabela->lsdata)));
                    array_push($dados['descricao'], $lancamentorublicas->lsdescricao);
                    array_push($dados['codigos'], $lancamentorublicas->licodigo);
                }elseif ($lancamentorublicas->lsdescricao == 'adicional noturno') {
                    array_push($dados['id'],$lancamentorublicas->trabalhador_id);
                    array_push($dados['valor'], self::calculovalores($lancamentorublicas->lsquantidade,$lancamentorublicas->lfvalor));
                    array_push($dados['quantidade'], self::calcularhoras($lancamentorublicas->lsquantidade));
                    array_push($dados['dia'], date('d',strtotime($lancamentorublicas->lancamentotabela->lsdata)));
                    array_push($dados['descricao'], $lancamentorublicas->lsdescricao);
                    array_push($dados['codigos'], $lancamentorublicas->licodigo);
                }elseif ($lancamentorublicas->lsdescricao == 'diaria normal') {
                    array_push($dados['id'],$lancamentorublicas->trabalhador_id);
                    array_push($dados['valor'], self::calculovalores($lancamentorublicas->lsquantidade,$lancamentorublicas->lfvalor));
                    array_push($dados['quantidade'], self::calcularhoras($lancamentorublicas->lsquantidade));
                    array_push($dados['dia'], date('d',strtotime($lancamentorublicas->lancamentotabela->lsdata)));
                    array_push($dados['descricao'], $lancamentorublicas->lsdescricao);
                    array_push($dados['codigos'], $lancamentorublicas->licodigo);
                }elseif ($lancamentorublicas->lsdescricao == 'gratificação') {
                    $dsr =  $this->rublica->buscaRublicaUnidade('gratificação');
                    array_push($dados['id'],$lancamentorublicas->trabalhador_id);
                    array_push($dados['valor'], self::calculovalores($lancamentorublicas->lsquantidade,$lancamentorublicas->lfvalor));
                    array_push($dados['quantidade'], self::calcularhoras($lancamentorublicas->lsquantidade));
                    array_push($dados['dia'], date('d',strtotime($lancamentorublicas->lancamentotabela->lsdata)));
                    array_push($dados['descricao'], $dsr->rsdescricao);
                    array_push($dados['codigos'], $dsr->rsrublica);
                }else{
                    $dsr =  $this->rublica->buscaRublicaUnidade('produção');
                    array_push($dados['id'],$lancamentorublicas->trabalhador_id);
                    array_push($dados['valor'], self::calculovalores($lancamentorublicas->lsquantidade,$lancamentorublicas->lfvalor));
                    array_push($dados['quantidade'], self::calcularhoras($lancamentorublicas->lsquantidade));
                    array_push($dados['dia'], date('d',strtotime($lancamentorublicas->lancamentotabela->lsdata)));
                    array_push($dados['descricao'], $dsr->rsdescricao);
                    array_push($dados['codigos'], $dsr->rsrublica);
                }
            }
            $trabalhador = $this->trabalhador->whereIn('id',$dados['id'])
            // ->select('')
            ->with('depedente')->get();
            $valor_comissionador = [
                'id'=>[],
                'porcentagem'=>[],
                'valor'=>[],
            ];
            $comissionador = $this->comissionador
            ->where('tomador_id',$lancamentotabelas->tomador_id)
            // ->whereIn('trabalhador_id',$dados['id'])
            ->get();
            if ($comissionador->count() > 0) {
                foreach ($comissionador as $key => $comissionados) {
                    // array_push($valor_comissionador['id'],$comissionados->trabalhador_id);
                    array_push($valor_comissionador['porcentagem'],$comissionados->csindece);
                }
            }
           
            foreach ($trabalhador as $t => $trabalhadores) {
                if (!in_array($trabalhadores->id,$valor_comissionador['id'])) {
                    $boletim = [
                        'horanormal'=>[
                            'id'=>'',
                            'codigos'=>'',
                            'dia' =>'',
                            'valor' =>'',
                            'quantidade' => 0,
                            'descricao' =>''
                        ],
                        'diarianormal'=>[
                            'id'=>'',
                            'codigos'=>'',
                            'dia' => '',
                            'valor' =>'',
                            'quantidade' =>0,
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
                        'comissionador'=>[
                            'valor_comissionado'=>0,
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
                        'tomador'=>$lancamentotabelas->tomador_id,
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
                            
                            if (!in_array($dados['dia'][$i],$dia['dias'])) {
                                array_push($dia['dias'],$dados['dia'][$i]);
                                array_push($dia['valor'],$dados['valor'][$i]);
                                $boletim['salario'] += $dados['valor'][$i];
                                
                            }else{
                                $key = array_search($dados['dia'][$i], $dia['dias']);
                                $dia['valor'][$key] += $dados['valor'][$i];
                                $boletim['salario'] += $dados['valor'][$i];
                            }
                        }
                    }
                    if ($boletim['servico']) {
                        
                    
                    $boletim['vencimento'] = $boletim['servico'];
                    $novovalor = 0;
                    $indece = 0;
                    if ($comissionador->count() > 0) {
                        foreach ($comissionador as $key => $comissionados) {
                            $novovalor = $boletim['vencimento'] * ($comissionados->csindece/100);
                            array_push($valor_comissionador['valor'],$novovalor);
                            array_push($valor_comissionador['id'],$comissionados->trabalhador_id);
                            $indece += $comissionados->csindece;
                            $novovalor += $boletim['vencimento'] * ($comissionados->csindece/100);
                        }
                    }
                    $tomador_cartao_ponto_horas = self::calculardia($lancamentotabelas->tomador->cartaoponto[0]->csdiasuteis,null);
                   
                    if ($boletim['horanormal']['quantidade'] && $tomador_cartao_ponto_horas) {
                        $tomador_cartao_ponto_horas =  $boletim['horanormal']['quantidade'] / $tomador_cartao_ponto_horas + $boletim['diarianormal']['quantidade'];
                    }else{
                        $tomador_cartao_ponto_horas =  $boletim['diarianormal']['quantidade'];
                    }
                    $vt =  $this->rublica->buscaRublicaUnidade('Vale transporte');
                    $boletim['vt']['codigos'] = $vt->rsrublica;
                    $boletim['vt']['descricao'] = $vt->rsdescricao;
                    $boletim['vt']['quantidade'] = ceil($tomador_cartao_ponto_horas);
                    $boletim['vt']['valor'] = $lancamentotabelas->tomador->incidefolhar[0]->instransporte * ceil($tomador_cartao_ponto_horas);
                    $boletim['vencimento'] +=  $boletim['vt']['valor'];
                    $va =  $this->rublica->buscaRublicaUnidade('Vale alimentação');
                    $boletim['va']['codigos'] = $va->rsrublica;
                    $boletim['va']['descricao'] = $va->rsdescricao;
                    $boletim['va']['quantidade'] = ceil($tomador_cartao_ponto_horas);
                    $boletim['va']['valor'] = $lancamentotabelas->tomador->incidefolhar[0]->insalimentacao * ceil($tomador_cartao_ponto_horas);
                    
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
                   
                    // if ($inss) {
                    //     dd($boletim,$inss);
                    // }
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
                            if ($resultado) {
                                $boletim['inss']['quantidade'] = $boletim['base_inss']/$resultado;
                            }
                           
                            $boletim['desconto'] += $resultado;
                            // dd('1');
                        }elseif ($inss > (float)str_replace(',','.',str_replace(".","",$inss_lista[0]->isvalorfinal))  && $inss <= $novoinss && $in == 1) {
                            $resultado = $inss - str_replace(',','.',str_replace(".","",$inss_lista[0]->isvalorfinal));
                            $resultado = $resultado * ((float)str_replace(',','.',$valor_inss->isindece)/100);
                            $resultado = $resultado + ((float)str_replace(',','.',$inss_lista[0]->isreducao));
                            $boletim['inss']['valor'] = $resultado;
                            $boletim['inss']['codigos'] = $inss_rublica->rsrublica;
                            $boletim['inss']['rublicas'] = $inss_rublica->rsdescricao;
                            if ($resultado) {
                                $boletim['inss']['quantidade'] = $boletim['base_inss']/$resultado;
                            }
                            $boletim['desconto'] += $resultado;
                            // dd('2');
                        }elseif ($inss > (float)str_replace(',','.',str_replace(".","",$inss_lista[1]->isvalorfinal))  && $inss <= $novoinss && $in == 2) {
                            $resultado = $inss - str_replace(',','.',str_replace(".","",$inss_lista[1]->isvalorfinal));
                            $resultado = $resultado * ((float)str_replace(',','.',$valor_inss->isindece)/100);
                            $resultado = $resultado + ((float)str_replace(',','.',$inss_lista[1]->isreducao));
                            $boletim['inss']['valor'] = $resultado;
                            $boletim['inss']['codigos'] = $inss_rublica->rsrublica;
                            $boletim['inss']['rublicas'] = $inss_rublica->rsdescricao;
                            if ($resultado) {
                                $boletim['inss']['quantidade'] = $boletim['base_inss']/$resultado;
                            }
                            $boletim['desconto'] += $resultado;
                            // dd('3');
                        }elseif ($inss > (float)str_replace(',','.',str_replace(".","",$inss_lista[2]->isvalorfinal))  && $inss <= $novoinss && $in == 3 || $inss > $novoinss && $in == 3) {
                            $resultado = $inss - str_replace(',','.',str_replace(".","",$inss_lista[2]->isvalorfinal));
                            $resultado = $resultado * ((float)str_replace(',','.',$valor_inss->isindece)/100);
                            $resultado = $resultado + ((float)str_replace(',','.',$inss_lista[2]->isreducao));
                            $boletim['inss']['valor'] = $resultado;
                            $boletim['inss']['codigos'] = $inss_rublica->rsrublica;
                            $boletim['inss']['rublicas'] = $inss_rublica->rsdescricao;
                            if ($resultado) {
                                $boletim['inss']['quantidade'] = $boletim['base_inss']/$resultado;
                            }
                            $boletim['desconto'] += $resultado;
                            // dd('4');
                        }
                    
                    }
                    
                    $boletim['depedente'] = $trabalhadores->depedente->count();
                    $boletim['base_irrf'] = str_replace(',','.',$irrf_lista[0]->irdepedente) * $boletim['depedente'];
                    $boletim['base_irrf'] += $boletim['inss']['valor'] + $boletim['inss_sobre_ter']['valor'];
                    $boletim['base_irrf'] = $boletim['base_fgts'] -  $boletim['base_irrf'];
                    
                    $boletim['desconto'] += $novovalor;
                    $comissionado_rublica =  $this->rublica->buscaRublicaUnidade('Comissionador');
                    $boletim['comissionador']['valor'] = $novovalor;
                    $boletim['comissionador']['rublicas'] = $comissionado_rublica->rsdescricao;
                    $boletim['comissionador']['quantidade'] = $indece;
                    $boletim['comissionador']['codigos'] = $comissionado_rublica->rsrublica;

                    $boletim['liquido'] = $boletim['vencimento'] - $boletim['desconto'];


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
                
                    // if ($boletim['va']['valor']) {
                    //     
                    // }
                    // if ($boletim['vt']['valor']) {
                    //     
                    // }
                    
                    $this->valorcalculo->cadastroVa($boletim);
                    
                    $this->valorcalculo->cadastroVt($boletim);
                    
                    $this->valorcalculo->cadastrodsr($boletim);
                    
                    $this->valorcalculo->cadastrodecimo_ter($boletim);
                    
                    $this->valorcalculo->cadastroferias_decimoter($boletim);
                    // dd($boletim,$inss);
                    $this->valorcalculo->cadastroinss($boletim);
                    
                    $this->valorcalculo->cadastrocomissionador($boletim);
                    $this->valorcalculo->cadastroinss_decimoter($boletim);
                    }
                }
            }
            $trabalhador =  $this->comissionador
            ->where('tomador_id',$lancamentotabelas->tomador_id)
            ->with('trabalhador.depedente')
            // ->whereIn('trabalhador_id',$dados['id'])
            ->get();
            // dd($valor_comissionador);
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
                        'comissionador'=>[
                            'valor_comissionado'=>0,
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
                        'tomador'=>$lancamentotabelas->tomador_id,
                        'trabalhador'=>'',
                        'basecalculo'=>''
                        
                    ];
                    $dia = [
                        'dias'=>[],
                        'valor'=>[],
                        'basecalculo'=>'',
                        'trabalhador'=>'',
                    ];
                    $boletim['trabalhador'] = $trabalhadores->trabalhador_id;
                    $dia['trabalhador'] = $trabalhadores->trabalhador_id;
                    $novovalor = 0;
                    $indece = 0;
                    foreach ($valor_comissionador['id'] as $chave => $valor_comissionados) {
                        if ($trabalhadores->trabalhador_id === $valor_comissionados) {
                            $novovalor += $valor_comissionador['valor'][$chave];
                        }
                    }
                    $boletim['servico'] +=  $novovalor;
                    $indece = $valor_comissionador['porcentagem'][$t];
                    foreach ($dados['id'] as $i => $dado) {
                        if ($dado == $trabalhadores->trabalhador_id) {
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
                    if ($boletim['servico']) {
                        $boletim['vencimento'] = $boletim['servico'];
                        $tomador_cartao_ponto_horas = self::calculardia($lancamentotabelas->tomador->cartaoponto[0]->csdiasuteis,null);
                        if ($boletim['horanormal']['quantidade'] && $tomador_cartao_ponto_horas) {
                            $tomador_cartao_ponto_horas =  $boletim['horanormal']['quantidade'] / $tomador_cartao_ponto_horas + $boletim['diarianormal']['quantidade'];
                        }else{
                            $tomador_cartao_ponto_horas =  $boletim['diarianormal']['quantidade'];
                        }
                    

                        $vt =  $this->rublica->buscaRublicaUnidade('Vale transporte');
                        $boletim['vt']['codigos'] = $vt->rsrublica;
                        $boletim['vt']['descricao'] = $vt->rsdescricao;
                        $boletim['vt']['quantidade'] = ceil($tomador_cartao_ponto_horas);
                        $boletim['vt']['valor'] = $lancamentotabelas->tomador->incidefolhar[0]->instransporte * ceil($tomador_cartao_ponto_horas);
                        $boletim['vencimento'] +=  $boletim['vt']['valor'];
                        $va =  $this->rublica->buscaRublicaUnidade('Vale alimentação');
                        $boletim['va']['codigos'] = $va->rsrublica;
                        $boletim['va']['descricao'] = $va->rsdescricao;
                        $boletim['va']['quantidade'] = ceil($tomador_cartao_ponto_horas);
                        $boletim['va']['valor'] = $lancamentotabelas->tomador->incidefolhar[0]->insalimentacao * ceil($tomador_cartao_ponto_horas);
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
                                // dd('1');
                            }elseif ($inss > (float)str_replace(',','.',str_replace(".","",$inss_lista[0]->isvalorfinal))  && $inss <= $novoinss && $in == 1) {
                                $resultado = $inss - str_replace(',','.',str_replace(".","",$inss_lista[0]->isvalorfinal));
                                $resultado = $resultado * ((float)str_replace(',','.',$valor_inss->isindece)/100);
                                $resultado = $resultado + ((float)str_replace(',','.',$inss_lista[0]->isreducao));
                                $boletim['inss']['valor'] = $resultado;
                                $boletim['inss']['codigos'] = $inss_rublica->rsrublica;
                                $boletim['inss']['rublicas'] = $inss_rublica->rsdescricao;
                                $boletim['inss']['quantidade'] = $boletim['base_inss']/$resultado;
                                $boletim['desconto'] += $resultado;
                                // dd('2');
                            }elseif ($inss > (float)str_replace(',','.',str_replace(".","",$inss_lista[1]->isvalorfinal))  && $inss <= $novoinss && $in == 2) {
                                $resultado = $inss - str_replace(',','.',str_replace(".","",$inss_lista[1]->isvalorfinal));
                                $resultado = $resultado * ((float)str_replace(',','.',$valor_inss->isindece)/100);
                                $resultado = $resultado + ((float)str_replace(',','.',$inss_lista[1]->isreducao));
                                $boletim['inss']['valor'] = $resultado;
                                $boletim['inss']['codigos'] = $inss_rublica->rsrublica;
                                $boletim['inss']['rublicas'] = $inss_rublica->rsdescricao;
                                $boletim['inss']['quantidade'] = $boletim['base_inss']/$resultado;
                                $boletim['desconto'] += $resultado;
                                // dd('3');
                            }elseif ($inss > (float)str_replace(',','.',str_replace(".","",$inss_lista[2]->isvalorfinal))  && $inss <= $novoinss && $in == 3) {
                                $resultado = $inss - str_replace(',','.',str_replace(".","",$inss_lista[2]->isvalorfinal));
                                $resultado = $resultado * ((float)str_replace(',','.',$valor_inss->isindece)/100);
                                $resultado = $resultado + ((float)str_replace(',','.',$inss_lista[2]->isreducao));
                                $boletim['inss']['valor'] = $resultado;
                                $boletim['inss']['codigos'] = $inss_rublica->rsrublica;
                                $boletim['inss']['rublicas'] = $inss_rublica->rsdescricao;
                                $boletim['inss']['quantidade'] = $boletim['base_inss']/$resultado;
                                $boletim['desconto'] += $resultado;
                                // dd('4');
                            }
                        
                        }
                        
                        $boletim['depedente'] = $trabalhadores->trabalhador->depedente->count();
                        $boletim['base_irrf'] = str_replace(',','.',$irrf_lista[0]->irdepedente) * $boletim['depedente'];
                        $boletim['base_irrf'] += $boletim['inss']['valor'] + $boletim['inss_sobre_ter']['valor'];
                        $boletim['base_irrf'] = $boletim['base_fgts'] -  $boletim['base_irrf'];
                        
                
                        $inss_rublica =  $this->rublica->buscaRublicaUnidade('Comissionador');
                        $boletim['comissionador']['valor_comissionado'] = $novovalor;
                        $boletim['comissionador']['rublicas'] = $inss_rublica->rsdescricao;
                        $boletim['comissionador']['quantidade'] = $indece;
                        $boletim['comissionador']['codigos'] = $inss_rublica->rsrublica;

                        $boletim['liquido'] = $boletim['vencimento'] - $boletim['desconto'];


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
                        // if ($boletim['va']['valor']) {
                            
                        // }
                        // if ($boletim['vt']['valor']) {
                        
                        // }
                        $this->valorcalculo->cadastroVt($boletim);
                        $this->valorcalculo->cadastroVa($boletim);
                        $this->valorcalculo->cadastrodsr($boletim);
                        $this->valorcalculo->cadastrodecimo_ter($boletim);
                        $this->valorcalculo->cadastroferias_decimoter($boletim);
                        $this->valorcalculo->cadastroinss($boletim);
                        $this->valorcalculo->cadastrocomissionador($boletim);
                        $this->valorcalculo->cadastroinss_decimoter($boletim);
                    }
            }
           
        }
       
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
            $depedente = $this->depedente->where([
                ['trabalhador_id',$basecalculos->trabalhador_id],
                ['dsirrf','Sim']
            ])->count();
          
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
                'familia'=>[
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
            $faxa = 0;
            $liquido = 0;
            if ($depedente) {
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
            }
            if ($quantdias > 15) {
                $quant = $this->relacaodia->where([
                    ['trabalhador_id',$basecalculos->trabalhador_id],
                    ['rsdia','>',15],
                ])->count();
                
                //dd($quant,$datafinal,$basecalculos->trabalhador_id,$datainicio,$basecalculos->bivalorliquido);
                if ($quant) {
                    $datafinal = explode('-',$datafinal);
                    $datafinal = $datafinal[0].'-'.$datafinal[1].'-15';
                    $folha = DB::table('folhars') 
                    ->join('base_calculos', 'folhars.id', '=', 'base_calculos.folhar_id')
                    ->select('base_calculos.bivalorliquido','base_calculos.trabalhador_id')
                    ->whereBetween('folhars.fsfinal',[$datainicio,$datafinal])
                    ->where('base_calculos.tomador_id',null)
                    ->where('base_calculos.trabalhador_id',$basecalculos->trabalhador_id)
                    ->first();
                    if ($folha) {
                       $basecalculos->bivalorliquido -= $folha->bivalorliquido;
                       $basecalculos->bivalordesconto += $folha->bivalorliquido;
                    }
                }
               
               
               
               
            }
            $desconto = $this->desconto
            ->where('trabalhador_id',$basecalculos->trabalhador_id)
            ->whereBetween('dscompetencia',[date('Y-m',strtotime($datainicio)),date('Y-m',strtotime($datafinal))])
            ->selectRaw(
                'dsquinzena,
                dsdescricao,
                dscompetencia,	
                COUNT(dsdescricao) as quantidade,
                SUM(dfvalor) as valor'
            )
            ->groupBy('dscompetencia','dsquinzena','dsdescricao')
            ->get();
            if ($desconto->count() > 0) {
                foreach ($desconto as $key => $descontos) {
                    if ($quantdias <= 15 && $descontos->dsquinzena === '1 - Primeira') {
                        $basecalculos->bivalorliquido -= $descontos->valor;
                        $basecalculos->bivalordesconto += $descontos->valor;
                    }
                    if ($quantdias > 15 && $descontos->dsquinzena === '2 - Segunda') {
                        $basecalculos->bivalorliquido -= $descontos->valor;
                        $basecalculos->bivalordesconto += $descontos->valor;
                    }
                }
            }
            if ($seguros->esseguro) {
                $seguro = str_replace(',','.',$seguros->esseguro);
                $seguro = (float) $seguro;
                $basecalculos->bivalordesconto += $seguro;
                $basecalculos->bivalorliquido -= $seguro;
            }
            if ($seguros->essindicalizado === '1-Sim') {
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
            $salario_familia = $this->depedente->where([
                ['trabalhador_id',$basecalculos->trabalhador_id],
                ['dssf','Sim']
            ])->get();
            $quantfamilia = 0;
            $valorfamilia = 0;
            foreach ($salario_familia as $key => $familia) {
                if (self::verificaidade($familia->dsdata)) {
                    $quantfamilia += 1;
                    $depedente += 1;
                }
            }
            $valorfamilia = $quantfamilia * 56.47;
            $basecalculos->bivalorvencimento += $valorfamilia;
            $basecalculos->bivalorliquido += $valorfamilia;
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
            if ($depedente) {
                $boletim['trabalhador'] = $basecalculos->trabalhador_id;
                $boletim['basecalculo'] = $base['id'];
                $this->valorcalculo->cadastroirrf($boletim);
            }
            if ($quantfamilia) {
                $familia =  $this->rublica->buscaRublicaUnidade('Salário Família');
                $boletim['familia']['codigos'] = $familia->rsrublica;
                $boletim['familia']['rublicas'] = $familia->rsdescricao;
                $boletim['familia']['quantidade'] = $quantfamilia;
                $boletim['familia']['valor'] = $valorfamilia;
                $boletim['trabalhador'] = $basecalculos->trabalhador_id;
                $boletim['basecalculo'] = $base['id'];
                $this->valorcalculo->cadastrofamilia($boletim);
            }
            if ($folha) {
               
                $adiantamento =  $this->rublica->buscaRublicaUnidade('Adiantamento');
                $boletim['adiantamento']['codigos'] = $adiantamento->rsrublica;
                $boletim['adiantamento']['rublicas'] = $adiantamento->rsdescricao;
                $boletim['adiantamento']['quantidade'] = 1;
                $boletim['adiantamento']['valor'] = $folha->bivalorliquido;
                $boletim['trabalhador'] = $basecalculos->trabalhador_id;
                $boletim['basecalculo'] = $base['id'];
                $this->valorcalculo->cadastroadiantamento($boletim);
            }
            if ($desconto->count() > 0) {
                foreach ($desconto as $key => $descontos) {
                    if ($quantdias <= 15 && $descontos->dsquinzena === '1 - Primeira') {
                        $boletim['descontos']['codigos'] = 0;
                        $boletim['descontos']['rublicas'] = $descontos->dsdescricao;
                        $boletim['descontos']['quantidade'] = $descontos->quantidade;;
                        $boletim['descontos']['valor'] = $descontos->valor;
                        $boletim['trabalhador'] = $basecalculos->trabalhador_id;
                        $boletim['basecalculo'] = $base['id'];
                        $this->valorcalculo->cadastroadesconto($boletim);
                    }
                    if ($quantdias > 15 && $descontos->dsquinzena === '2 - Segunda') {
                        $boletim['descontos']['codigos'] = 0;
                        $boletim['descontos']['rublicas'] = $descontos->dsdescricao;
                        $boletim['descontos']['quantidade'] = $descontos->quantidade;;
                        $boletim['descontos']['valor'] = $descontos->valor;
                        $boletim['trabalhador'] = $basecalculos->trabalhador_id;
                        $boletim['basecalculo'] = $base['id'];
                        $this->valorcalculo->cadastroadesconto($boletim);
                    }
                }
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
            if ($seguros->essindicalizado === '1-Sim') {
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
            
            $valorcalculo =   $this->valorcalculo->listaIntegral($folhar['id'],$basecalculos->trabalhador_id,$nao);
            // dd($valorcalculo);
            foreach ($valorcalculo as $key => $valorcalculos) {
                $this->valorcalculo->create([
                    'vicodigo'=> $valorcalculos->vicodigo,
                    'vsdescricao'=>$valorcalculos->vsdescricao,
                    'vireferencia'=> $valorcalculos->vsdescricao == 'INSS'?0:$valorcalculos->referencia,
                    'vivencimento'=>$valorcalculos->vencimento,
                    'videscinto'=>$valorcalculos->desconto,
                    'base_calculo_id'=>$base['id'],
                    'trabalhador_id'=>$basecalculos->trabalhador_id,
                ]);
            }
           
       }
      
        return redirect()->back()->withSuccess('Cadastro realizado com sucesso.');
        try { 
      } catch (\Throwable $th) {
        $this->valorrublica->where('empresa_id', $user->empresa_id)
        ->chunkById(100, function ($valorrublica) use ($user) {
            foreach ($valorrublica as $valorrublicas) {
                if ($valorrublicas->vsnrofolha > 0) {
                    $numero = $valorrublicas->vsnrofolha -= 1;
                    $this->valorrublica->where('empresa_id', $user->empresa_id)
                    ->update(['vsnrofolha'=>$numero]);
                }
            }
        });
        $this->folhar->deletar($folhar['id']);
        return redirect()->back()->withInput()->withErrors(['false'=>'Não foi possível cadastrar o registro.']);
      }
       
       
    }
    public function destroy($id)
    {
        
            // $basecalculo_id = $this->basecalculo->buscaId($id);
            // $base_id = [];
            // foreach($basecalculo_id as $i=>$basevalor){
            //     array_push($base_id,$basevalor->id);
            // }
            // $this->valorcalculo->deletar($base_id);
            // $this->relacaodia->deletar($base_id);
            // $this->basecalculo->deletar($base_id);
            $user = auth()->user();
            $permissions = Permission::where('name','like','%'.'mcfe'.'%')->first();
            
            if ($user->hasPermissionTo($permissions->name) === false && $user->hasPermissionTo('admin') === false){
                return redirect()->back()->withInput()->withErrors(['permissaonegada'=>'true']);
            }
            $this->valorrublica->where('empresa_id', $user->empresa_id)
            ->chunkById(100, function ($valorrublica) use ($user) {
                foreach ($valorrublica as $valorrublicas) {
                    if ($valorrublicas->vsnrofolha > 0) {
                        $numero = $valorrublicas->vsnrofolha -= 1;
                        $this->valorrublica->where('empresa_id', $user->empresa_id)
                        ->update(['vsnrofolha'=>$numero]);
                    }
                }
            });
            $this->folhar->deletar($id);
            return redirect()->back()->withSuccess('Deletado com sucesso.');
            try {
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->withErrors(['false'=>'Não foi possível deletar o registro.']);
        }
    }
    public function calculardia($horas,$valores)
    {
        if(strpos($horas,':')){
            list($horas,$minitos) = explode(':',$horas);
            $horasex = $horas * 3600 + $minitos * 60;
            $horasex = $horasex/60;
            if ($valores != null) {
                $horasex = $valores * ($horasex/60);
            }else{
                $horasex = ($horasex/60) * $valores;
            }
            return $horasex;
        }else{
            return $horas;
        }
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
    public function verificaidade($data)
    {
        list($ano, $mes, $dia) = explode('-', $data);
        // data atual
        $hoje = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
        // Descobre a unix timestamp da data de nascimento do fulano
        $nascimento = mktime( 0, 0, 0, $mes, $dia, $ano);

        // cálculo
        $idade = floor((((($hoje - $nascimento) / 60) / 60) / 24) / 365.25);
        if ($idade <= 12) {
            return true;
        }else{
            return false;
        }
    }
    public function imprimirFolhar($id)
    {
        
        $folhar = $this->basecalculo->where([
            ['folhar_id',$id],
            ['tomador_id',null]
        ])
        ->with(['trabalhador.documento','trabalhador.categoria','trabalhador.bancario','folhar.empresa','valorcalculo','relacaodia'])

        ->get();
        $leis = $this->leis->categorias();
        // dd($folhar);
        // $folhas = $this->folhar->buscaLista($id);
        
        // if (!$folhas) {
        //     return redirect()->back()->withInput()->withErrors(['false'=>'Não foi lançada a folha pra este trabalhador.']);
        // }
        // $basecalculo_id = [];
        // foreach ($folhas as $key => $folhar) {
        //     array_push($basecalculo_id,$folhar->id); 
        // }
        // $valorcalculos = $this->valorcalculo->buscaImprimir($basecalculo_id);
        // $relacaodias = $this->relacaodia->buscaImprimir($basecalculo_id);
        $pdf = PDF::loadView('comprovantegeral',compact('folhar','leis'));
        return $pdf->setPaper('a4')->stream('Cálculo da folha geral.pdf');
    }
}
?>