<?php

namespace App\Http\Controllers\Administrador\Tomador;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Tomador;
use App\Taxa;
use App\Endereco;
use App\Bancario;
use App\RetencaoFatura;
use App\CartaoPonto;
use App\Parametrosefip;
use App\TaxaTrabalhador;
use App\IncideFolhar;
use App\IndiceFatura;
use App\TabelaPreco;
use App\Bolcartaoponto;
use App\Lancamentorublica;
use App\Lancamentotabela;
use App\Comissionado;
use App\ValoresRublica;
use App\Rublica;
use App\BaseCalculo;

class BancoController extends Controller
{
    private $rublica, $tomador, $valorrublica, $taxa, $endereco, $bancario,
        $tabelapreco, $cartaoponto, $parametrosefip, $incidefolhar, $indicefatura,
        $comissionado, $retencaofatura, $bolcartaoponto, $lancamentorublica, $lancamentotabela, $basecalculo;
    public function __construct()
    {
        $this->rublica = new Rublica;
        $this->tomador = new Tomador;
        $this->valorrublica = new ValoresRublica;
        $this->taxa = new Taxa;
        $this->endereco = new Endereco;
        $this->bancario = new Bancario;
        $this->tabelapreco = new TabelaPreco;
        $this->cartaoponto = new CartaoPonto;
        $this->parametrosefip = new Parametrosefip;
        $this->incidefolhar = new IncideFolhar;
        $this->indicefatura = new IndiceFatura;
        $this->comissionado = new Comissionado;
        $this->retencaofatura = new RetencaoFatura;
        $this->bolcartaoponto = new Bolcartaoponto;
        $this->lancamentorublica = new Lancamentorublica;
        $this->lancamentotabela = new Lancamentotabela;
        $this->basecalculo = new BaseCalculo;
    }
    public function cadastroTxt(Request $request)
    {
        $file = $request->file('file');
        $dados = file($file);
        $rublicas = $this->rublica->listaRublicaTabelaPreco();
        $id = '';
        foreach ($dados as $i => $linha) {
            if ($linha) {
                $tomador = [
                    'nome__completo' => '',
                    'nome__fantasia' => '',
                    'tipo' => '',
                    'cnpj' => '',
                    'matricula' => '',
                    'simples' => '',
                    'telefone' => '',
                    'cep' => '',
                    'logradouro' => '',
                    'numero' => '',
                    'bairro' => '',
                    'localidade' => '',
                    'uf' => '',
                    'taxa_adm' => '',
                    'taxa__fed' => '',
                    'deflator' => '',
                    'das' => '',
                    'cod__fpas' => null,
                    'cod__grps' => null,
                    'cod__recol' => null,
                    'cod__fap' => null,
                    'cnae' => null,
                    'fap__aliquota' => null,
                    'rat__ajustado' => null,
                    'fpas__terceiros' => null,
                    'aliq__terceiros' => null,
                    'alimentacao' => '',
                    'transporte' => '',
                    'epi' => '',
                    'seguro__trabalhador' => '',
                    'folhartransporte' => '',
                    'folhartipotrans' => '',
                    'folharalim' => '',
                    'folhartipoalim' => '',
                    'dias_uteis' => '',
                    'sabados' => '',
                    'domingos' => '',
                    'banco' => '',
                    'agencia' => '',
                    'operacao' => '',
                    'conta' => '',
                    'pix' => '',
                    'empresa' => 15,
                    'trabalhador' => null,
                ];
                $tomador['matricula'] = str_replace("  ", "",substr($linha, 0, 6));
                $tomador['nome__completo'] = str_replace("  ", "",substr($linha, 6, 40));
                $tomador['logradouro'] = str_replace("  ", "",substr($linha, 40, 40));
                $tomador['numero'] = str_replace("  ", "",substr($linha, 86, 5));
                $tomador['bairro'] = str_replace("  ", "",substr($linha, 91, 30));
                $tomador['localidade'] = str_replace("  ", "",substr($linha, 121, 30));
                $tomador['uf'] = str_replace("  ", "",substr($linha, 151, 2));
                $tomador['cep'] = str_replace("  ", "",substr($linha, 153, 8));
                $tomador['telefone'] = str_replace("  ", "",substr($linha, 161, 12));
                $tomador['tipo'] = substr($linha, 173, 1) == 1 ? str_replace("  ", "",substr($linha, 173, 1)) . '-CNPJ' : str_replace("  ", "",substr($linha, 173, 1)) . '-CPF';
                $tomador['cnpj'] = str_replace("  ", "",substr($linha, 174, 14));
                // dd($tomador);
                $tomadors = $this->tomador->cadastro($tomador);
                if ($tomadors) {
                    $tomador['tomador'] = $tomadors['id'];
                    $id = 
                    foreach ($rublicas as $key => $rublica) {
                        $dadostabelapreco = [
                            'ano' => date('Y'),
                            'rubricas' => $rublica->rsrublica,
                            'descricao' => $rublica->rsdescricao,
                            'status' => '',
                            'valor' => 0,
                            'valor__tomador' => 0,
                            'empresa' => 15,
                            'tomador' => $tomadors['id']
                        ];
                        $this->tabelapreco->cadastro($dadostabelapreco);
                    }
                    $incidefolhars = $this->incidefolhar->cadastro($tomador);
                    $enderecos = $this->endereco->cadastro($tomador);
                    $taxas = $this->taxa->cadastro($tomador);
                    $bancarios = $this->bancario->cadastro($tomador);
                    // $retencaofaturas = $retencaofatura->cadastro($dados);
                    $cartaoponto = $this->cartaoponto->cadastro($tomador);
                    $parametrosefips = $this->parametrosefip->cadastro($tomador);
                    // $taxatrabalhador = $taxatrabalhador->cadastro($dados);
                    $indicefaturas = $this->indicefatura->cadastro($tomador);
                }
            }
        }
        return response()->json(['result' => true], 200);
        // try {
        // } catch (\Throwable $th) {
        //     $cartaoponto = $this->cartaoponto->deletar($dados['tomador']);
        //     $parametrosefips = $this->parametrosefip->deletar($dados['tomador']);
        //     $indicefaturas = $this->indicefatura->deletar($dados['tomador']);
        //     $taxas = $this->taxa->deletar($dados['tomador']);
        //     $incidefolhars = $this->incidefolhar->deletar($dados['tomador']);
        //     $this->endereco->deletarTomador($dados['tomador']);
        //     $this->bancario->deletarTomador($dados['tomador']);
        //     $this->tabelapreco->deletatomador($dados['tomador']);
        //     $this->tomador->deletar($dados['tomador']);
        //     // return redirect()->route('tomador.index')->withInput()->withErrors(['false'=>'Não foi possível cadastrar.']);
        // }
    }
}
