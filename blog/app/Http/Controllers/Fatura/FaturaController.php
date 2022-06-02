<?php

namespace App\Http\Controllers\Fatura;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Fatura\Validacao;
use Carbon\Carbon;
use PDF;
use App\Tomador;
use App\ValorCalculo;
use App\Fatura;
use App\FaturaPrincipal;
use App\FaturaSecundaria;
use App\FaturaDemostrativa;
use App\FaturaTotal;
use App\Empresa;
use App\FaturaRubrica;
use App\TabelaPreco;
use App\Rublica;
use App\ValoresRublica;
class FaturaController extends Controller
{
    private $rublica,$valorrublica,$fatura,$tabelapreco,$valorcalculor,$faturaprincipais,
    $faturasecundario,$faturademostrativa,$faturatotal,$faturarublica,$tomador,$empresa;
    public function __construct()
    {
        $this->rublica = new Rublica;
        $this->valorrublica = new ValoresRublica;
        $this->fatura = new Fatura;
        $this->tabelapreco = new TabelaPreco;
        $this->valorcalculor = new ValorCalculo;
        $this->faturaprincipal = new FaturaPrincipal;
        $this->faturasecundario = new FaturaSecundaria;
        $this->faturademostrativa = new FaturaDemostrativa;
        $this->faturatotal = new FaturaTotal;
        $this->faturarublica = new FaturaRubrica;
        $this->tomador = new Tomador;
        $this->empresa = new Empresa;
    } 
    public function index()
    {
        $user = auth()->user();
        
        $valorrublica_fatura = $this->valorrublica->buscaUnidadeEmpresa($user->empresa_id);
        $faturas = $this->fatura->buscaListaFatura();
        // dd($faturas);
        return view('fatura.index',compact('user','faturas','valorrublica_fatura'));
        
    }
    public function filtroPesquisa(Validacao $request)
    {
        $dados = $request->all();
       
        $user = auth()->user();
        $valorrublica_fatura = $this->valorrublica->buscaUnidadeEmpresa($user->empresa);
        $faturas = $this->fatura->filtroPesquisa($dados);
        return view('fatura.index',compact('user','faturas','valorrublica_fatura'));
    }
    public function filtroPesquisaOrdem($condicao)
    {
        $user = auth()->user();
        $valorrublica_fatura = $this->valorrublica->buscaUnidadeEmpresa($user->empresa);
        $faturas = $this->fatura->buscaListaFaturaOrdem($condicao);
        return view('fatura.index',compact('user','faturas','valorrublica_fatura'));
    }
    public function store(Validacao $request)
    {
        $dados = $request->all();
        $today = Carbon::today();
       
        $user = auth()->user();
        if (date('m',strtotime($dados['ano_inicial'])) !== date('m',strtotime($dados['ano_final']))) {
            return redirect()->back()->withInput()->withErrors(['ano_inicial'=>'O valor inicial e o valor final tem que ser do mesmo mês!','ano_final'=>'O valor inicial e o valor final tem que ser do mesmo mês!']);
        }else if ((int)date('m',strtotime($dados['vencimento'])) !== (int)date('m',strtotime($dados['ano_inicial']))) {
            return redirect()->back()->withInput()->withErrors(['vencimento'=>'O mês de vencimento tem que ser igual ao periodo!']);
        }else if ((int)date('m',strtotime($dados['vencimento'])) !== (int)date('m',strtotime($dados['ano_final']))){
            return redirect()->back()->withInput()->withErrors(['vencimento'=>'O mês de vencimento tem que ser igual ao periodo!']);
        }else if ((int)date('m',strtotime($dados['vencimento'])) !== (int)date('m',strtotime($dados['competencia']))){
            return redirect()->back()->withInput()->withErrors(['vencimento'=>'O mês de vencimento tem que ser igual ao competência!']);
        }
        // dd(date('m',strtotime($dados['ano_inicial'])),$dados);
        // if (strtotime($dados['ano_inicial']) > strtotime($today)) {
        //     return redirect()->back()->withInput()->withErrors(['ano_inicial'=>'Só é valida data atuais!']);
        // }
        // if (strtotime($dados['ano_final']) > strtotime($today)) {
        //     return redirect()->back()->withInput()->withErrors(['ano_final'=>'Só é valida data atuais!']);
        // }
        if (!$dados['tomador']) {
            return redirect()->back()->withInput()->withErrors(['pesquisa'=>'Tomador não encontrador.']);
        }
        $verifica = $this->fatura->verificaFaturas($dados);
        if ($verifica) {
            return redirect()->back()->withInput()->withErrors(['false'=>'Já foi lançada uma fatura para este tomador nesse mês.']);
        }
        
        $dados['empresa'] = $user->empresa_id;
        $rublica = $this->rublica->get();
        $sim = [];
        $nao = [];
        foreach ($rublica as $key => $rublicas) {
            if ($rublicas->rsincidencia == 'Sim') {
                array_push($sim,(int) $rublicas->rsrublica);
            }else{
               array_push($nao,(int) $rublicas->rsrublica);
            }
        }
        $tomador = $this->tomador->where('id',$dados['tomador'])->with('taxa')->first();
        $fatura1 =  $this->valorcalculor->producaoFaturaIn($dados,$sim);
        $fatura2 =  $this->valorcalculor->producaoFatura($dados,$nao);
        $tabelapreco = $this->tabelapreco->where('tomador_id',$dados['tomador'])->get();
        dd($fatura1,$fatura2,$tabelapreco,$sim,$nao,$dados);
        if (count($fatura1) < 1 || count($fatura2) < 1 || count($tabelapreco) < 1) {
            return redirect()->back()->withInput()->withErrors(['false'=>'Não à dados suficientes para gera a fatura.']);
        }
        $quantrabalhador = $this->valorcalculor->quantrabalhador($dados);
        $dados['trabalhador'] = $quantrabalhador[0]->trabalhador;
        $dados['folhar'] = $fatura1[0]->fscodigo;
        $dados['folhar'] = $fatura2[0]->fscodigo;
        $dadosrublicas =[
            'item'=>'',
            'descricao'=>'',
            'unidade'=>0,
            'preco'=>0,
            'total'=>0,
            'fatura'=>''
        ];
        $producao = [
            'descricao'=>'',
            'indice'=>'',
            'valor'=>0,
            'fatura'=>''
        ];
        $subtotalA = 0;
        $subtotalB = 0;
        $totalbruto = 0;
        $valorentencao = 0;
        $valorbasefolha = 0;
        $valordemostrativo = 0;
        $totalproducao = 0;
        $faturas = $this->fatura->cadastro($dados);
        $this->valorrublica->where('id', $user->empresa_id)
        ->chunkById(100, function ($valorrublica) use ($user) {
            foreach ($valorrublica as $valorrublicas) {
                $numero = $valorrublicas->vsnrofatura += 1;
                $this->valorrublica->where('empresa_id', $user->empresa_id)
                ->update(['vsnrofatura'=>$numero]);
            }
        });
        foreach ($tabelapreco as $key => $tabelaprecos) {
            foreach ($fatura1 as $key => $fatura_valor) {
                if (!$tabelaprecos->tsstatus && $tabelaprecos->tsrubrica == $fatura_valor->vicodigo) {
                    $dadosrublicas['item'] = $fatura_valor->vicodigo;
                    $dadosrublicas['descricao'] = $fatura_valor->vsdescricao;
                    $dadosrublicas['unidade'] = $fatura_valor->referencia;
                    $dadosrublicas['preco'] = $tabelaprecos->tsvalor;
                    $dadosrublicas['total'] = $fatura_valor->referencia * $tabelaprecos->tsvalor;
                    $dadosrublicas['fatura'] = $faturas['id'];
                    $this->faturarublica->cadastro($dadosrublicas);
                    $producao['valor'] += $fatura_valor->valor;
                    $subtotalA += $fatura_valor->valor;
                    $totalproducao = $subtotalA;
                }
            }
        }
        foreach ($fatura1 as $key => $fatura_valor) {
            if ($fatura_valor->vicodigo === 1006 || $fatura_valor->vsdescricao === 'produção') {
                $dadosrublicas['item'] = $fatura_valor->vicodigo;
                $dadosrublicas['descricao'] = $fatura_valor->vsdescricao;
                $dadosrublicas['unidade'] = $fatura_valor->referencia;
                $dadosrublicas['preco'] = $tabelaprecos->tsvalor;
                $dadosrublicas['total'] = $fatura_valor->referencia * $tabelaprecos->tsvalor;
                $dadosrublicas['fatura'] = $faturas['id'];
                $this->faturarublica->cadastro($dadosrublicas);
                $producao['valor'] += $fatura_valor->valor;
                $subtotalA += $fatura_valor->valor;
                $totalproducao = $subtotalA;
            }
        }
        $producao['descricao'] = 'Produção';
        $producao['indice'] = 1;
        $producao['fatura'] = $faturas['id'];
        $this->faturaprincipal->cadastro($producao);
        foreach ($fatura2 as $r => $valorublica) {
            if ($valorublica->vicodigo === 1008) {
                $producao['descricao'] = 'DSR';
                $producao['indice'] = $valorublica->vireferencia;
                $producao['valor'] = ($valorublica->vireferencia / 100) * $producao['valor'];
                $producao['fatura'] = $faturas['id'];
                $this->faturaprincipal->cadastro($producao);
                $subtotalA += $producao['valor'];
            }elseif ($valorublica->vicodigo === 1009) {
                $producao['descricao'] = 'Férias';
                $producao['indice'] = $valorublica->vireferencia;
                $producao['valor'] = $valorublica->vencimento;
                $producao['fatura'] = $faturas['id'];
                $this->faturaprincipal->cadastro($producao);
                $valordemostrativo += $valorublica->vencimento;
                $subtotalB += $valorublica->vencimento;
            }elseif ($valorublica->vicodigo === 1010) {
                $producao['descricao'] = '13° Salário';
                $producao['indice'] = $valorublica->vireferencia;
                $producao['valor'] = $valorublica->vencimento;
                $producao['fatura'] = $faturas['id'];
                $this->faturaprincipal->cadastro($producao);
                $subtotalB += $valorublica->vencimento;
            }elseif ($valorublica->vicodigo === 2001) {
                $producao['valor'] = $valorublica->desconto;
                $valorentencao += $valorublica->desconto;
                $valorbasefolha += $valorublica->desconto;  
                $totalbruto  += $valorublica->desconto;
            }else if ($valorublica->vicodigo == 2002){
                $producao['descricao'] = 'INSS Trabalhador';
                $producao['indice'] = 0;
                $producao['valor'] += $valorublica->desconto;
                $producao['fatura'] = $faturas['id'];
                $this->faturasecundario->cadastro($producao);
                $valorentencao += $valorublica->desconto;
                $valorbasefolha += $valorublica->desconto;
                $totalbruto  += $valorublica->desconto;
            }
            
        }
        
       
        $producao['descricao'] = 'Férias Sindicato';
        $producao['indice'] = 1.00;
        $producao['valor'] = $subtotalA * (1.00/100);
        $producao['fatura'] = $faturas['id'];
        $this->faturaprincipal->cadastro($producao);
        $totalbruto += $producao['valor'];
        $producao['descricao'] = '13° Salário Sindicato';
        $producao['indice'] = 0.66;
        $producao['valor'] = $subtotalA * (0.66/100);
        $producao['fatura'] = $faturas['id'];
        $this->faturaprincipal->cadastro($producao);
        $totalbruto += $producao['valor'];

        $producao['descricao'] = 'Taxa ADM/Trab.Avulso';
        $producao['indice'] = $tomador->taxa[0]->tftaxaadm;
        $producao['valor'] = $subtotalA * ($tomador->taxa[0]->tftaxaadm/100);
        $producao['fatura'] = $faturas['id'];
        $this->faturaprincipal->cadastro($producao);
        $totalbruto += $producao['valor'];

        foreach($fatura1 as $e => $indecefaturas){
            if ($indecefaturas->vicodigo === 1012 || $indecefaturas->vicodigo === 1013) {
                $producao['descricao'] = $indecefaturas->vsdescricao;
                $producao['indice'] = $indecefaturas->referencia;
                $producao['valor'] = $indecefaturas->valor;
                $producao['fatura'] = $faturas['id'];
                $this->faturasecundario->cadastro($producao);
                $totalbruto += $indecefaturas->valor;
            }
        }

        $producao['descricao'] = 'Federação';
        $producao['indice'] = 1.99;
        $producao['valor'] = $subtotalA * (1.99/100);
        $producao['fatura'] = $faturas['id'];
        $this->faturaprincipal->cadastro($producao);
        $totalbruto += $producao['valor'];
        $producao['descricao'] = 'FGTS';
        $producao['indice'] = 8;
        $producao['valor'] = $subtotalA * (8/100);
        $producao['fatura'] = $faturas['id'];
        $this->faturasecundario->cadastro($producao);
        $totalbruto += $producao['valor'];
        $valorentencao += $subtotalA * (8/100);
        $producao['descricao'] = 'Retênção';
        $producao['indice'] = 0;
        $producao['valor'] = $valorentencao;
        $producao['fatura'] = $faturas['id'];
        $this->faturasecundario->cadastro($producao);
        $producao['descricao'] = $dados['text__adiantamento'];
        $producao['indice'] = 0;
        $producao['valor'] = $dados['valor__adiantamento'];
        $producao['fatura'] = $faturas['id'];
        $this->faturasecundario->cadastro($producao);

        $producao['descricao'] = $dados['texto__credito'];
        $producao['indice'] = 0;
        $producao['valor'] = $dados['valor__creditos'];
        $producao['fatura'] = $faturas['id'];
        $this->faturasecundario->cadastro($producao);

        $producao['descricao'] = 'Produção + Dsr 18,18% + Férias';
        $producao['valor'] = $subtotalA + $valordemostrativo;
        $producao['fatura'] = $faturas['id'];
        $this->faturademostrativa->cadastro($producao);
        $valorbasefolha += $subtotalA + $valordemostrativo;
        
        $producao['descricao'] = 'Base Cálculo 13º Salário';
        $producao['valor'] = $subtotalA;
        $producao['fatura'] = $faturas['id'];
        $this->faturademostrativa->cadastro($producao);
        $valorbasefolha += $subtotalA;

        $producao['descricao'] = 'Base Calculo FGTS';
        $producao['valor'] = $subtotalB + $subtotalA;
        $producao['fatura'] = $faturas['id'];
        $this->faturademostrativa->cadastro($producao);
        $valorbasefolha += $subtotalA + $subtotalB;

        $producao['descricao'] = 'A-Sub Total';
        $producao['valor'] = $subtotalA;
        $producao['fatura'] = $faturas['id'];
        $faturatotais = $this->faturatotal->cadastro($producao);

        $producao['descricao'] = 'B-SubTotal';
        $producao['valor'] = $subtotalB + $subtotalA;
        $producao['fatura'] = $faturas['id'];
        $faturatotais = $this->faturatotal->cadastro($producao);
        $totalbruto += $subtotalB + $subtotalA;
        $producao['descricao'] = 'Total Bruto';
        $producao['valor'] = $totalbruto;
        $producao['fatura'] = $faturas['id'];
        $faturatotais = $this->faturatotal->cadastro($producao);
        $producao['descricao'] = 'Total Líquido';
        $producao['valor'] = str_replace(",",".",$dados['valor__creditos'])+($totalbruto-$valorentencao-str_replace(",",".",$dados['valor__adiantamento']));
        $producao['fatura'] = $faturas['id'];
        $faturatotais = $this->faturatotal->cadastro($producao);
        $producao['descricao'] = 'Folha Base';
        $producao['valor'] = $valorbasefolha;
        $producao['fatura'] = $faturas['id'];
        $faturatotais = $this->faturatotal->cadastro($producao);
        $producao['descricao'] = 'Total da Produção';
        $producao['valor'] = $totalproducao;
        $producao['fatura'] = $faturas['id'];
        $faturatotais = $this->faturatotal->cadastro($producao);
        
       
       
        
        // $dados['empresa'] = $user->empresa;
      
        // $subtotalA = 0;
        // $subtotalB = 0;
        // $totalbruto = 0;
        // $valorentencao = 0;
        // $valordemostrativo = 0;
        // $valorbasefolha = 0;
        // $totalproducao = 0;
        // $incide = [];
        // $naoincide = [];
        // $producao = [
        //     'descricao'=>'',
        //     'indice'=>'',
        //     'valor'=>'',
        //     'fatura'=>''
        // ];
       
        // $rublicas = $this->rublica->listaGeral();
        // foreach ($rublicas as $key => $rublica) {
        //     if ($rublica->rsincidencia === 'Sim') {
        //         array_push($incide,$rublica->rsrublica);
        //     }
        //     if ($rublica->rsincidencia === 'Não') {
        //         array_push($naoincide,$rublica->rsrublica);
        //     }
        // }
        // $verifica = $this->fatura->verificaFaturas($dados);
        // if ($verifica) {
        //     return redirect()->back()->withInput()->withErrors(['false'=>'Já foi lançada uma fatura para este tomador nesse mês.']);
        // }
        // $tomador = $this->tomador->first($dados['tomador']);
        // $producaofatura = $this->valorcalculor->producaoFatura($dados,$incide);
        // $indecefatura = $this->valorcalculor->producaoFaturaIn($dados,$incide);
        
        // $rublicasfatura = $this->valorcalculor->rublicasFatura($dados);
        // $rublicasfaturainss = $this->valorcalculor->rublicasFaturaInss($dados);
        // $tabelaprecos = $this->tabelapreco->listaUnidadeTomador($dados['tomador']);
        // // dd($indecefatura,$tabelaprecos,$rublicasfatura);
        // if (count($indecefatura) < 1 || count($rublicasfatura) < 1 || count($tabelaprecos) < 1) {
        //     return redirect()->back()->withInput()->withErrors(['false'=>'Não à dados suficientes para gera a fatura.']);
        // }
        
        //     $faturas = $this->fatura->cadastro($dados);
        //     if ($faturas) {
        //         $dadosrublicas =[
        //             'item'=>'',
        //             'descricao'=>'',
        //             'unidade'=>0,
        //             'preco'=>0,
        //             'total'=>0,
        //             'fatura'=>''
        //         ];
        //         $this->valorrublica->editarFatura($dados['numero'],$user->empresa);
        //         foreach ($tabelaprecos as $y => $tabelapreco) {
        //             foreach ($indecefatura as $e => $indecefaturas) {
        //                 if ($indecefaturas->vicodigo == $tabelapreco->tsrubrica) {
        //                     // $dadosrublicas['item'] = $tabelapreco->tsrubrica;
        //                     // $dadosrublicas['descricao'] = $tabelapreco->tsdescricao;
        //                     // $dadosrublicas['unidade'] = $indecefaturas->referencia;
        //                     // $dadosrublicas['preco'] = $tabelapreco->tstomvalor;
        //                     // $dadosrublicas['total'] = $indecefaturas->referencia * $tabelapreco->tstomvalor;
        //                     // $dadosrublicas['fatura'] = $faturas['id'];
        //                     // $this->faturarublica->cadastro($dadosrublicas);
        //                     // $totalproducao += $indecefaturas->referencia * $tabelapreco->tstomvalor;
        //                     $dadosrublicas['item'] = $tabelapreco->tsrubrica;
        //                     $dadosrublicas['descricao'] = $tabelapreco->tsdescricao;
        //                     $dadosrublicas['unidade'] = $indecefaturas->referencia;
        //                     $dadosrublicas['preco'] = $indecefaturas->valor;
        //                     $dadosrublicas['total'] = $indecefaturas->valor;
        //                     $dadosrublicas['fatura'] = $faturas['id'];
        //                     $this->faturarublica->cadastro($dadosrublicas);
        //                     $totalproducao += $indecefaturas->valor;
        //                 } 
        //             }
        //         }
        //         // $dadosrublicas =[
        //         //     'item'=>'',
        //         //     'descricao'=>'',
        //         //     'unidade'=>0,
        //         //     'preco'=>0,
        //         //     'total'=>0,
        //         //     'fatura'=>''
        //         // ];
        //         // foreach ($indecefatura as $e => $indecefaturas) {
        //         //     foreach ($tabelaprecos as $y => $tabelapreco) {
        //         //         if($indecefaturas->vsdescricao == $tabelapreco->tsstatus){
        //         //             $dadosrublicas['item'] = $indecefaturas->vicodigo;
        //         //             $dadosrublicas['descricao'] = $indecefaturas->vsdescricao;
        //         //             $dadosrublicas['unidade'] += $indecefaturas->referencia;
        //         //             $dadosrublicas['total'] += $indecefaturas->referencia * $tabelapreco->tstomvalor;
        //         //             $dadosrublicas['fatura'] = $faturas['id'];
        //         //             $this->faturarublica->cadastro($dadosrublicas);
        //         //             $totalproducao += $indecefaturas->referencia * $tabelapreco->tstomvalor;
        //         //             break;
        //         //         }
        //         //     }
                    
        //         // }
        //         // if ($dadosrublicas['fatura']) {
        //         //     $this->faturarublica->cadastro($dadosrublicas);
        //         // }
               
        //         foreach($indecefatura as $e => $indecefaturas){
        //             if ($indecefaturas->vicodigo === 1012 || $indecefaturas->vicodigo === 1013) {
        //                 $producao['descricao'] = $indecefaturas->vsdescricao;
        //                 $producao['indice'] = $indecefaturas->referencia;
        //                 $producao['valor'] = $indecefaturas->valor;
        //                 $producao['fatura'] = $faturas['id'];
        //                 $this->faturasecundario->cadastro($producao);
        //                 $totalbruto += $indecefaturas->valor;
        //             }
        //         }
        //         $producao['descricao'] = 'Produção';
        //         $producao['indice'] = 1;
        //         $producao['valor'] = $totalproducao;
        //         $producao['fatura'] = $faturas['id'];
        //         $this->faturaprincipal->cadastro($producao);
                
        //         $subtotalA += $totalproducao;
                
        //         foreach ($rublicasfatura as $r => $valorublica) {
        //             if ($valorublica->vicodigo === 1008) {
        //                 $producao['descricao'] = 'DSR';
        //                 $producao['indice'] = $valorublica->vireferencia;
        //                 $producao['valor'] = ($valorublica->vireferencia / 100) * $totalproducao;
        //                 $producao['fatura'] = $faturas['id'];
        //                 $this->faturaprincipal->cadastro($producao);
        //                 $subtotalA += $producao['valor'];
        //             }
        //             if ($valorublica->vicodigo === 1009) {
        //                 $producao['descricao'] = 'Férias';
        //                 $producao['indice'] = $valorublica->vireferencia;
        //                 $producao['valor'] = $valorublica->vencimento;
        //                 $producao['fatura'] = $faturas['id'];
        //                 $this->faturaprincipal->cadastro($producao);
        //                 $valordemostrativo += $valorublica->vencimento;
        //                 $subtotalB += $valorublica->vencimento;
        //             }
        //             if ($valorublica->vicodigo === 1010) {
        //                 $producao['descricao'] = '13° Salário';
        //                 $producao['indice'] = $valorublica->vireferencia;
        //                 $producao['valor'] = $valorublica->vencimento;
        //                 $producao['fatura'] = $faturas['id'];
        //                 $this->faturaprincipal->cadastro($producao);
        //                 $subtotalB += $valorublica->vencimento;
        //             }
                   
        //         }
        //         foreach ($rublicasfaturainss as $r => $valorublica) {
        //             if ($valorublica->vicodigo === 2001) {
        //                 $producao['valor'] = $valorublica->desconto;
        //                 $valorentencao += $valorublica->desconto;
        //                 $valorbasefolha += $valorublica->desconto;   
        //             }else if ($valorublica->vicodigo == 2002){
        //                 $producao['descricao'] = 'INSS Trabalhador';
        //                 $producao['indice'] = 0;
        //                 $producao['valor'] += $valorublica->desconto;
        //                 $producao['fatura'] = $faturas['id'];
        //                 $this->faturasecundario->cadastro($producao);
        //                 $valorentencao += $valorublica->desconto;
        //                 $valorbasefolha += $valorublica->desconto;
        //             }
        //         }
            
        //         $producao['descricao'] = 'Férias Sindicato';
        //         $producao['indice'] = 1.00;
        //         $producao['valor'] = $subtotalA * (1.00/100);
        //         $producao['fatura'] = $faturas['id'];
        //         $this->faturaprincipal->cadastro($producao);
        //         $totalbruto += $subtotalA * (1.00/100);

        //         $producao['descricao'] = '13° Salário Sindicato';
        //         $producao['indice'] = 0.66;
        //         $producao['valor'] = $subtotalA * (0.66/100);
        //         $producao['fatura'] = $faturas['id'];
        //         $this->faturaprincipal->cadastro($producao);
        //         $totalbruto += $subtotalA * (0.66/100);

        //         $producao['descricao'] = 'Taxa ADM/Trab.Avulso';
        //         $producao['indice'] = $tomador->tftaxaadm;
        //         $producao['valor'] = $subtotalA * ($tomador->tftaxaadm/100);
        //         $producao['fatura'] = $faturas['id'];
        //         $this->faturaprincipal->cadastro($producao);
        //         $totalbruto += $subtotalA * ($tomador->tftaxaadm/100);

        //         $producao['descricao'] = 'Federação';
        //         $producao['indice'] = 1.99;
        //         $producao['valor'] = $subtotalA * (1.99/100);
        //         $producao['fatura'] = $faturas['id'];
        //         $this->faturaprincipal->cadastro($producao);
        //         $totalbruto += $subtotalA * (1.99/100);

        //         $producao['descricao'] = 'FGTS';
        //         $producao['indice'] = 8;
        //         $producao['valor'] = $subtotalA * (8/100);
        //         $producao['fatura'] = $faturas['id'];
        //         $this->faturasecundario->cadastro($producao);
        //         $totalbruto += $subtotalA * (8/100);
        //         $valorentencao += $subtotalA * (8/100);

        //         $producao['descricao'] = 'Retênção';
        //         $producao['indice'] = 0;
        //         $producao['valor'] = $valorentencao;
        //         $producao['fatura'] = $faturas['id'];
        //         $this->faturasecundario->cadastro($producao);

        //         $producao['descricao'] = $dados['text__adiantamento'];
        //         $producao['indice'] = 0;
        //         $producao['valor'] = $dados['valor__adiantamento'];
        //         $producao['fatura'] = $faturas['id'];
        //         $this->faturasecundario->cadastro($producao);

        //         $producao['descricao'] = $dados['texto__credito'];
        //         $producao['indice'] = 0;
        //         $producao['valor'] = $dados['valor__creditos'];
        //         $producao['fatura'] = $faturas['id'];
        //         $this->faturasecundario->cadastro($producao);

        //         $producao['descricao'] = 'Produção + Dsr 18,18% + Férias';
        //         $producao['valor'] = $subtotalA + $valordemostrativo;
        //         $producao['fatura'] = $faturas['id'];
        //         $this->faturademostrativa->cadastro($producao);
        //         $valorbasefolha += $subtotalA + $valordemostrativo;

        //         $producao['descricao'] = 'Base Cálculo 13º Salário';
        //         $producao['valor'] = $subtotalA;
        //         $producao['fatura'] = $faturas['id'];
        //         $this->faturademostrativa->cadastro($producao);
        //         $valorbasefolha += $subtotalA;

            

        //         $producao['descricao'] = 'A-Sub Total';
        //         $producao['valor'] = $subtotalA;
        //         $producao['fatura'] = $faturas['id'];
        //         $faturatotais = $this->faturatotal->cadastro($producao);

        //         $producao['descricao'] = 'B-SubTotal';
        //         $producao['valor'] = $subtotalB + $subtotalA;
        //         $producao['fatura'] = $faturas['id'];
        //         $faturatotais = $this->faturatotal->cadastro($producao);
        //         $totalbruto += $subtotalB + $subtotalA;

        //         $producao['descricao'] = 'Base Calculo FGTS';
        //         $producao['valor'] = $subtotalB + $subtotalA;
        //         $producao['fatura'] = $faturas['id'];
        //         $this->faturademostrativa->cadastro($producao);
        //         $valorbasefolha += $subtotalA + $subtotalB;

        //         $producao['descricao'] = 'Total Bruto';
        //         $producao['valor'] = $totalbruto;
        //         $producao['fatura'] = $faturas['id'];
        //         $faturatotais = $this->faturatotal->cadastro($producao);

        //         $producao['descricao'] = 'Total Líquido';
        //         $producao['valor'] = str_replace(",",".",$dados['valor__creditos'])+($totalbruto-$valorentencao-str_replace(",",".",$dados['valor__adiantamento']));
        //         $producao['fatura'] = $faturas['id'];
        //         $faturatotais = $this->faturatotal->cadastro($producao);

        //         $producao['descricao'] = 'Folha Base';
        //         $producao['valor'] = $valorbasefolha;
        //         $producao['fatura'] = $faturas['id'];
        //         $faturatotais = $this->faturatotal->cadastro($producao);
        //         return redirect()->back()->withSuccess('Cadastro realizado com sucesso.'); 
            // }
            try {
            return redirect()->back()->withSuccess('Cadastro realizado com sucesso.'); 
        } catch (\Throwable $th) {
            // $this->faturaprincipal->deletarFatura($faturas['id']);
            // $this->faturasecundario->deletarFatura($faturas['id']);
            // $this->faturademostrativa->deletarFatura($faturas['id']);
            // $this->faturarublica->deletarFatura($faturas['id']);
            // $this->faturatotal->deletarFatura($faturas['id']);
            // $valorrublica_fatura = $this->valorrublica->buscaUnidadeEmpresa($user->empresa);
            // $quantidade = $valorrublica_fatura->vsnrofatura - 1;
            $this->valorrublica->where('id', $user->empresa_id)
            ->chunkById(100, function ($valorrublica) use ($user) {
                foreach ($valorrublica as $valorrublicas) {
                    $numero = $valorrublicas->vsnrofatura -= 1;
                    $this->valorrublica->where('empresa_id', $user->empresa_id)
                    ->update(['vsnrofatura'=>$numero]);
                }
            });
            $this->fatura->deletar($faturas['id']);
            // $this->valorrublica->editarFatura($quantidade,$user->empresa);
            return redirect()->back()->withInput()->withErrors(['false'=>'Não foi possível cadastrar.']);
        }
    }
    public function destroy($id)
    {
        $user = auth()->user();
        try {
            // $valorrublica_fatura = $this->valorrublica->buscaUnidadeEmpresa($user->empresa);
            // $quantidade = $valorrublica_fatura->vsnrofatura - 1;

            // $this->faturaprincipal->deletarFatura($id);
            // $this->faturasecundario->deletarFatura($id);
            // $this->faturademostrativa->deletarFatura($id);
            // $this->faturarublica->deletarFatura($id);
            // $this->faturatotal->deletarFatura($id);
            $this->valorrublica->where('id', $user->empresa_id)
            ->chunkById(100, function ($valorrublica) use ($user) {
                foreach ($valorrublica as $valorrublicas) {
                    $numero = $valorrublicas->vsnrofatura -= 1;
                    $this->valorrublica->where('empresa_id', $user->empresa_id)
                    ->update(['vsnrofatura'=>$numero]);
                }
            });
            $this->fatura->deletar($id);
            // $this->valorrublica->editarFatura($quantidade,$user->empresa);
            return redirect()->back()->withSuccess('Deletado com sucesso.');
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->withErrors(['false'=>'Não foi possível deletar o registro.']);
        }
    }
    public function relatorio($id,$inicio,$final)
    {
        
            // $faturas = $this->fatura->buscaRelatorio($id,$inicio,$final);
            // $faturaprincipais = $this->faturaprincipal->buscaRelatorio($faturas->id);
            // $faturarublicas = $this->faturarublica->buscaRelatorio($faturas->id);
            // $faturasecundarios = $this->faturasecundario->buscaRelatorio($faturas->id);
            // $faturavalestrans = $this->faturasecundario->buscaRelatorioValesTrans($faturas->id);
            // $faturavalesalim = $this->faturasecundario->buscaRelatorioValesAlim($faturas->id);
            // $faturademostrativas = $this->faturademostrativa->buscaRelatorio($faturas->id);
            // $faturatotais = $this->faturatotal->buscaRelatorio($faturas->id);
            // $tomadores = $this->tomador->tomadorFatura($id,$inicio,$final);
            // $empresas = $this->empresa->buscaUnidadeEmpresa($tomadores->empresa_id);
            // // dd($faturasecundarios,$faturavalestrans,$faturavalesalim);
            // $pdf = PDF::loadView('fatura',compact('tomadores','faturavalesalim','faturavalestrans','empresas','faturas','faturarublicas','faturaprincipais','faturasecundarios','faturademostrativas','faturatotais'));
          
            $fatura = $this->fatura->where('id',$id)
            ->with([
            'tomador.endereco',
            'tomador.parametrosefip',
            'tomador.bancario',
            'faturadesmostrativa',
            'faturaprincipal',
            'faturasecundaria',
            'faturadesmostrativa',
            'faturarubrica',
            'faturatotal',
            'empresa.endereco'
            ])->first();
            // dd($fatura);
            $pdf = PDF::loadView('fatura',compact('fatura'));
            return $pdf->setPaper('a4')->stream('fatura.pdf');
            try {
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->withErrors(['false'=>'Não foi possível gerar o relatório.']);
        }
    }
}
