<?php

namespace App\Http\Controllers\Trabalhador;

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
use PDF;
class comprovantePagDiaController extends Controller
{
    public function ComprovantePagDia(Request $request)
    {
        $dados = $request->all();
        $ano = explode('-',$dados['ano_final']);
        $tomador = [];
        $salario = 0;
        $cartaoponto_diarias = [
            'campos'=>[
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
            ]
        ]; 
        $boletim_tabela = [
            'campos'=>[
                'dia' => [],
                'rubrica' => [],
                'valor' => [],
                'quantidade' => [],
                'codigo' => [],
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
            ]
        ];
       
        $tomador_cartao_ponto = 0;
        $tomador_cartao_ponto_horas = 0;
        $tomador_incide_folha = 0;
        $tomador_cartao_ponto_quantidade = '';
        $valorfinal = [];
        $valorbase = '';
        $resultadoinss = '';
        $indece = '';
        $total_vencimento = 0;
        $total_desconto = 0;
        $trabalhador = new Trabalhador;
        $empresa = new Empresa;
        $rublica = new Rublica;
        $depedente = new Dependente;
        $bolcartaoponto = new Bolcartaoponto;
        $lancamentorublica = new Lancamentorublica;   
        $tabelapreco = new TabelaPreco;
        $inss = new Inss;
        $indecefolha = new IncideFolhar;
        $cartaoponto = new CartaoPonto;
        
        $insslista = $inss->buscaUnidadeInss($ano[0]);
        $bolcartaopontos = $bolcartaoponto->buscaListaRelatorioLancamentoBolcartao($dados);
        $lancamentorublicas = $lancamentorublica->buscaListaRelatorioLancamentoRublica($dados);
        foreach ($bolcartaopontos as $key => $tomadores) {
            array_push($tomador,$tomadores->tomador);
        }
        foreach ($lancamentorublicas  as $key => $tomadores) {
            array_push($tomador,$tomadores->tomador);
        }
        $cartaopontos = $cartaoponto->buscaTomador($tomador);
        $indecefolhas = $indecefolha->busca_va_vt($tomador);
        $tabelaprecos = $tabelapreco->buscaTabelaTomadorInt($tomador); 

        $trabalhadors = $trabalhador->buscaUnidadeTrabalhador($dados['trabalhador']); 
        $depedentes = $depedente->buscaQuantidadeDepedente($dados['trabalhador']);
        
        // dd($cartaopontos, $indecefolhas,$tomador,$tabelaprecos);
        $empresas = $empresa->buscaUnidadeEmpresa($trabalhadors->empresa);
        $rublicas = $rublica->buscaListaRublica(0);


        foreach ($bolcartaopontos as $key => $bolcartaoponto) {
            if ($bolcartaoponto->created_at) {
                $dia = explode('-',$bolcartaoponto->created_at);
                $dia = explode('-',$bolcartaoponto->created_at);
                $dia = explode(' ',$dia[2]);
                foreach ($tabelaprecos as $key => $tabelapreco) {
                    if ($tabelapreco->tsdescricao == 'hora extra 50%' && $bolcartaoponto->bshoraex) {
                        array_push($cartaoponto_diarias['campos']['dia'],$dia[0]);
                        array_push($cartaoponto_diarias['campos']['valor'],self::calculardia($bolcartaoponto->bshoraex,$tabelapreco->tsvalor));
                        array_push($cartaoponto_diarias['campos']['descricao'],$tabelapreco->tsdescricao);
                        array_push($cartaoponto_diarias['campos']['horas'],self::calcularhoras($bolcartaoponto->bshoraex));
                    }elseif ($tabelapreco->tsdescricao == 'hora extra 100%' && $bolcartaoponto->bshoraexcem) {
                        array_push($cartaoponto_diarias['campos']['dia'],$dia[0]);
                        array_push($cartaoponto_diarias['campos']['valor'],self::calculardia($bolcartaoponto->bshoraexcem,$tabelapreco->tsvalor));
                        array_push($cartaoponto_diarias['campos']['descricao'],$tabelapreco->tsdescricao);
                        array_push($cartaoponto_diarias['campos']['horas'],self::calcularhoras($bolcartaoponto->bshoraexcem));
                    }elseif($tabelapreco->tsdescricao == 'hora normal' && $bolcartaoponto->horas_normais){
                        array_push($cartaoponto_diarias['campos']['dia'],$dia[0]);
                        array_push($cartaoponto_diarias['campos']['valor'],self::calculardia($bolcartaoponto->horas_normais,$tabelapreco->tsvalor));
                        array_push($cartaoponto_diarias['campos']['descricao'],$tabelapreco->tsdescricao);
                        array_push($cartaoponto_diarias['campos']['horas'],self::calcularhoras($bolcartaoponto->horas_normais));
                    }elseif ($tabelapreco->tsdescricao == 'adicional noturno' && $bolcartaoponto->bsadinortuno) {
                        array_push($cartaoponto_diarias['campos']['dia'],$dia[0]);
                        array_push($cartaoponto_diarias['campos']['valor'],self::calculardia($bolcartaoponto->bsadinortuno,$tabelapreco->tsvalor));
                        array_push($cartaoponto_diarias['campos']['descricao'],$tabelapreco->tsdescricao);
                        array_push($cartaoponto_diarias['campos']['horas'],self::calcularhoras($bolcartaoponto->bsadinortuno));
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
                    array_push($boletim_tabela['campos']['dia'],$dia[0]);
                    $vencimento = $lancamentorublica->lfvalor * $lancamentorublica->lsquantidade;
                    array_push($boletim_tabela['campos']['valor'], $vencimento);
                    array_push($boletim_tabela['campos']['rubrica'], $lancamentorublica->lshistorico);
                    array_push($boletim_tabela['campos']['quantidade'], $lancamentorublica->lsquantidade);
                    if (!in_array($rublica->rsrublica,$boletim_tabela['campos']['codigo'])) {
                        array_push($boletim_tabela['campos']['codigo'], $rublica->rsrublica);
                        array_push($boletim_tabela['campos']['descricao'], $rublica->rsdescricao);
                    }
                }
            }
        }
       
        foreach ($boletim_tabela['campos']['rubrica'] as $key => $boletim_tabelas) {
            if ($boletim_tabelas === 'hora normal') {
                $boletim_tabela['horasNormais']['valor'] += $boletim_tabela['campos']['valor'][$key]; 
                $boletim_tabela['horasNormais']['quantidade'] += $boletim_tabela['campos']['quantidade'][$key];
                $salario +=  $boletim_tabela['campos']['valor'][$key];
            }elseif ($boletim_tabelas === 'diaria normal') {
                $boletim_tabela['diariaNormais']['valor'] += $boletim_tabela['campos']['valor'][$key];  
                $boletim_tabela['diariaNormais']['quantidade'] += $boletim_tabela['campos']['quantidade'][$key];
                $salario +=  $boletim_tabela['campos']['valor'][$key];
            }elseif ($boletim_tabelas === 'hora extra 50%') {
                $boletim_tabela['hora extra 50%']['valor'] += $boletim_tabela['campos']['valor'][$key];  
                $boletim_tabela['hora extra 50%']['quantidade'] += $boletim_tabela['campos']['quantidade'][$key];
                $salario +=  $boletim_tabela['campos']['valor'][$key];
            }elseif ($boletim_tabelas === 'hora extra 100%') {
                $boletim_tabela['hora extra 100%']['valor'] += $boletim_tabela['campos']['valor'][$key];  
                $boletim_tabela['hora extra 100%']['quantidade'] += $boletim_tabela['campos']['quantidade'][$key];
                $salario +=  $boletim_tabela['campos']['valor'][$key];
            }elseif ($boletim_tabelas === 'adicional noturno') {
                $boletim_tabela['adicional noturno']['valor'] += $boletim_tabela['campos']['valor'][$key];  
                $boletim_tabela['adicional noturno']['quantidade'] += $boletim_tabela['campos']['quantidade'][$key];
                $salario +=  $boletim_tabela['campos']['valor'][$key];
            }elseif ($boletim_tabelas === 'gratificação') {
                $boletim_tabela['gratificação']['valor'] += $boletim_tabela['campos']['valor'][$key];  
                $boletim_tabela['gratificação']['quantidade'] += $boletim_tabela['campos']['quantidade'][$key];
                $salario +=  $boletim_tabela['campos']['valor'][$key];
            }
        }
        
        foreach ($cartaoponto_diarias['campos']['descricao'] as $key => $cartaopontos_descricao) {
            if ($cartaopontos_descricao === 'hora normal') {
                $boletim_tabela['horasNormais']['valor'] += $cartaoponto_diarias['campos']['valor'][$key]; 
                $boletim_tabela['horasNormais']['quantidade'] += $cartaoponto_diarias['campos']['horas'][$key];
                $salario +=  $cartaoponto_diarias['campos']['valor'][$key];
            }elseif ($cartaopontos_descricao === 'diaria normal') {
                $boletim_tabela['diariaNormais']['valor'] += $cartaoponto_diarias['campos']['valor'][$key];  
                $boletim_tabela['diariaNormais']['quantidade'] += $cartaoponto_diarias['campos']['horas'][$key];
                $salario +=  $cartaoponto_diarias['campos']['valor'][$key];
            }elseif ($cartaopontos_descricao === 'hora extra 50%') {
                $boletim_tabela['hora extra 50%']['valor'] += $cartaoponto_diarias['campos']['valor'][$key];  
                $boletim_tabela['hora extra 50%']['quantidade'] += $cartaoponto_diarias['campos']['horas'][$key];
                $salario +=  $cartaoponto_diarias['campos']['valor'][$key];
            }elseif ($cartaopontos_descricao === 'hora extra 100%') {
                $boletim_tabela['hora extra 100%']['valor'] += $cartaoponto_diarias['campos']['valor'][$key];  
                $boletim_tabela['hora extra 100%']['quantidade'] += $cartaoponto_diarias['campos']['horas'][$key];
                $salario +=  $cartaoponto_diarias['campos']['valor'][$key];
            }elseif ($cartaopontos_descricao === 'adicional noturno') {
                $boletim_tabela['adicional noturno']['valor'] += $cartaoponto_diarias['campos']['valor'][$key];  
                $boletim_tabela['adicional noturno']['quantidade'] += $cartaoponto_diarias['campos']['horas'][$key];
                $salario +=  $cartaoponto_diarias['campos']['valor'][$key];
            }elseif ($cartaopontos_descricao === 'gratificação') {
                $boletim_tabela['gratificação']['valor'] += $cartaoponto_diarias['campos']['valor'][$key];  
                $boletim_tabela['gratificação']['quantidade'] += $cartaoponto_diarias['campos']['horas'][$key];
                $salario +=  $cartaoponto_diarias['campos']['valor'][$key];
            }
        }
      
        foreach ($cartaopontos as $key => $cartao) {
            $tomador_cartao_ponto_horas += self::calculardia($cartao->csdiasuteis,null);
        }
        
        $tomador_cartao_ponto_quantidade = $boletim_tabela['horasNormais']['quantidade'] /  ceil($tomador_cartao_ponto_horas);
        
        foreach ($indecefolhas as $key => $indecefolha_valores) {
            $tomador_incide_folha += $indecefolha_valores->instransporte;
        }
        $tomador_cartao_ponto = $tomador_incide_folha * ceil($tomador_cartao_ponto_quantidade);
        $total_desconto += $tomador_cartao_ponto;
    
        $dsr1818 = self::calculoPocentagem($salario,18.18);
        $total_vencimento += $dsr1818;

        $serviso_dsr = $dsr1818 + $salario;

        $decimo_ter =self::calculoPocentagem($serviso_dsr,8.34);

        $total_vencimento += $decimo_ter;

        $ferias_decimoter = self::calculoPocentagem($serviso_dsr,11.12);

        $total_vencimento += $ferias_decimoter;

        $valor_inss = $ferias_decimoter +  $serviso_dsr;
        foreach ($insslista as $key => $inss) {
            $novoinss =  str_replace(".","",$inss->isvalorfinal);
            $novoinss =  str_replace(',','.',$novoinss);
            $novoinss = (float) $novoinss;
            if (!in_array($novoinss, $valorfinal)) {
                array_push($valorfinal,$novoinss);
            }
            if ($valor_inss <= $valorfinal[$key] && $key === 0) {
              $valorbase = $inss->isvalorfinal;
              $indece = $inss->isindece;
              $resultadoinss = $valor_inss * ((float)str_replace(',','.',$inss->isindece)/100);
            //   dd($resultadoinss,$valor_inss);
              break;
            }elseif ($valor_inss > $valorfinal[0] && $valor_inss <= $valorfinal[$key] && $key === 1) {
                $valorbase = $inss->isvalorfinal;
                $indece = $inss->isindece;
                $resultadoinss = $valor_inss - $valorfinal[0];
                $resultadoinss = $resultadoinss * ((float)str_replace(',','.',$inss->isindece)/100);
                $resultadoinss = $resultadoinss + ((float)str_replace(',','.',$insslista[0]->isreducao));
              break;
            }elseif ($valor_inss <= $valorfinal[$key] && $key === 2) {
                $valorbase = $inss->isvalorfinal;
                $indece = $inss->isindece;
                $resultadoinss = $valor_inss - $valorfinal[1];
                $resultadoinss = $resultadoinss * ((float)str_replace(',','.',$inss->isindece)/100);
                $resultadoinss = $resultadoinss + ((float)str_replace(',','.',$insslista[1]->isreducao));
                // dd($resultadoinss,$insslista[1]->isreducao);
              break;
            }elseif ($valor_inss <= $valorfinal[$key] && $key === 3) {
                $valorbase = $inss->isvalorfinal;
                $indece = $inss->isindece;
                $resultadoinss = $valor_inss - $valorfinal[2];
                $resultadoinss = $resultadoinss * ((float)str_replace(',','.',$inss->isindece)/100);
                $resultadoinss = $resultadoinss + ((float)str_replace(',','.',$insslista[2]->isreducao));
                // dd($resultadoinss,$insslista[2]->isreducao);
              break;
            }
           
        }
        if ($trabalhadors) {
            $empresas = $empresa->buscaUnidadeEmpresa($trabalhadors->empresa);
            $pdf = PDF::loadView('comprovantePagDia',compact('trabalhadors','empresas','dados','lancamentorublicas','depedentes','boletim_tabela','total_vencimento','total_desconto','cartaoponto_diarias','valorbase','serviso_dsr','salario','tomador_cartao_ponto','tomador_cartao_ponto_quantidade','tomador_cartao_ponto_horas','dsr1818','indece','resultadoinss','ferias_decimoter','decimo_ter'));
            return $pdf->setPaper('a4')->stream('RECIBO PAGAMENTO SALÁRIO.pdf');
        }
        try {
        } catch (\Exception $e) {
            // $error = $e->getTrace();
            // dd($error[0]['args'][4]['rublicas'],$error); 
            $url = [
                'trabalhador'
            ];
            return redirect()->route('error.index',$url);
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
