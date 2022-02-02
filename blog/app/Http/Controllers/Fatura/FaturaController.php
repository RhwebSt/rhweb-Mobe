<?php

namespace App\Http\Controllers\Fatura;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
class FaturaController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $fatura = new Fatura;
        $faturas = $fatura->buscaListaFatura();
        return view('fatura.index',compact('user','faturas'));
        
    }
    public function store(Request $request)
    {
        $dados = $request->all();
        
        $user = auth()->user();
        $dados['empresa'] = $user->empresa;
        $tabelapreco = new TabelaPreco;
        $valorcalculor = new ValorCalculo;
        $fatura = new Fatura;
        $faturaprincipal = new FaturaPrincipal;
        $faturasecundario = new FaturaSecundaria;
        $faturademostrativa = new FaturaDemostrativa;
        $faturatotal = new FaturaTotal;
        $faturarublica = new FaturaRubrica;
        $subtotalA = 0;
        $subtotalB = 0;
        $totalbruto = 0;
        $valorentencao = 0;
        $valordemostrativo = 0;
        $valorbasefolha = 0;
        $totalproducao = 0;
        $producao = [
            'descricao'=>'',
            'indice'=>'',
            'valor'=>'',
            'fatura'=>''
        ];
        $dadosrublicas =[
            'item'=>'',
            'descricao'=>'',
            'unidade'=>'',
            'preco'=>'',
            'total'=>'',
            'fatura'=>''
        ];
        $faturas = $fatura->cadastro($dados);
        
        $producaofatura = $valorcalculor->producaoFatura($dados);
        $indecefatura = $valorcalculor->producaoFaturaIn($dados);
        $rublicasfatura = $valorcalculor->rublicasFatura($dados);
        $tabelaprecos = $tabelapreco->listaUnidadeTomador($dados['tomador']);
        // dd($producaofatura,$rublicasfatura,$indecefatura,$tabelaprecos);

        foreach ($tabelaprecos as $y => $tabelapreco) {
            foreach ($indecefatura as $e => $indecefaturas) {
                if ($indecefaturas->vicodigo == $tabelapreco->tsrubrica) {
                    $dadosrublicas['item'] = $tabelapreco->tsrubrica;
                    $dadosrublicas['descricao'] = $tabelapreco->tsdescricao;
                    $dadosrublicas['unidade'] = $indecefaturas->referencia;
                    $dadosrublicas['preco'] = $tabelapreco->tstomvalor;
                    $dadosrublicas['total'] = $indecefaturas->referencia * $tabelapreco->tstomvalor;
                    $dadosrublicas['fatura'] = $faturas['id'];
                    $faturarublica->cadastro($dadosrublicas);
                    $totalproducao += $indecefaturas->referencia * $tabelapreco->tstomvalor;
                }
            }
        }
        $producao['descricao'] = 'Produção';
        $producao['indice'] = 1;
        $producao['valor'] = $totalproducao;
        $producao['fatura'] = $faturas['id'];
        $faturaprincipal->cadastro($producao);
        
        $subtotalA += $totalproducao;
        // $faturaprincipais = 
        foreach ($rublicasfatura as $r => $valorublica) {
            if ($valorublica->vicodigo === 1008) {
                $producao['descricao'] = 'DSR';
                $producao['indice'] = $valorublica->vireferencia;
                $producao['valor'] = $valorublica->vencimento;
                $producao['fatura'] = $faturas['id'];
                $faturaprincipal->cadastro($producao);
                $subtotalA += $valorublica->vencimento;
            }
            if ($valorublica->vicodigo === 1009) {
                $producao['descricao'] = 'Férias';
                $producao['indice'] = $valorublica->vireferencia;
                $producao['valor'] = $valorublica->vencimento;
                $producao['fatura'] = $faturas['id'];
                $faturaprincipal->cadastro($producao);
                $valordemostrativo += $valorublica->vencimento;
                $subtotalB += $valorublica->vencimento;
            }
            if ($valorublica->vicodigo === 1010) {
                $producao['descricao'] = '13° Salário';
                $producao['indice'] = $valorublica->vireferencia;
                $producao['valor'] = $valorublica->vencimento;
                $producao['fatura'] = $faturas['id'];
                $faturaprincipal->cadastro($producao);
                $subtotalB += $valorublica->vencimento;
            }
            if ($valorublica->vicodigo === 2001) {
                $producao['descricao'] = 'INSS Trabalhador';
                $producao['indice'] = $valorublica->vireferencia;
                $producao['valor'] = $valorublica->desconto;
                $producao['fatura'] = $faturas['id'];
                $faturasecundario->cadastro($producao);
                $totalbruto += $valorublica->desconto;
                $valorentencao += $valorublica->desconto;
                $valorbasefolha += $valorublica->desconto;
            }
        }

       
        $producao['descricao'] = 'Férias Sindicato';
        $producao['indice'] = 1.00;
        $producao['valor'] = $subtotalA * (1.00/100);
        $producao['fatura'] = $faturas['id'];
        $faturaprincipal->cadastro($producao);
        $totalbruto += $subtotalA * (1.00/100);

        $producao['descricao'] = '13° Salário Sindicato';
        $producao['indice'] = 0.66;
        $producao['valor'] = $subtotalA * (0.66/100);
        $producao['fatura'] = $faturas['id'];
        $faturaprincipal->cadastro($producao);
        $totalbruto += $subtotalA * (0.66/100);

        $producao['descricao'] = 'Taxa ADM/Trab.Avulso';
        $producao['indice'] = 1.99;
        $producao['valor'] = $subtotalA * (1.99/100);
        $producao['fatura'] = $faturas['id'];
        $faturaprincipal->cadastro($producao);
        $totalbruto += $subtotalA * (1.99/100);

        $producao['descricao'] = 'Federação';
        $producao['indice'] = 1.99;
        $producao['valor'] = $subtotalA * (1.99/100);
        $producao['fatura'] = $faturas['id'];
        $faturaprincipal->cadastro($producao);
        $totalbruto += $subtotalA * (1.99/100);

        $producao['descricao'] = 'FGTS';
        $producao['indice'] = 8;
        $producao['valor'] = $subtotalA * (8/100);
        $producao['fatura'] = $faturas['id'];
        $faturasecundario->cadastro($producao);
        $totalbruto += $subtotalA * (8/100);
        $valorentencao += $subtotalA * (8/100);

        $producao['descricao'] = 'Retênção';
        $producao['indice'] = 0;
        $producao['valor'] = $valorentencao;
        $producao['fatura'] = $faturas['id'];
        $faturasecundario->cadastro($producao);

        $producao['descricao'] = 'Produção + Dsr 18,18% + Férias';
        $producao['valor'] = $subtotalA + $valordemostrativo;
        $producao['fatura'] = $faturas['id'];
        $faturademostrativa->cadastro($producao);
        $valorbasefolha += $subtotalA + $valordemostrativo;

        $producao['descricao'] = 'Base Calculo FGTS';
        $producao['valor'] = $subtotalA;
        $producao['fatura'] = $faturas['id'];
        $faturademostrativa->cadastro($producao);
        $valorbasefolha += $subtotalA;

        $producao['descricao'] = 'A-Sub Total';
        $producao['valor'] = $subtotalA;
        $producao['fatura'] = $faturas['id'];
        $faturatotais = $faturatotal->cadastro($producao);

        $producao['descricao'] = 'B-SubTotal';
        $producao['valor'] = $subtotalB + $subtotalA;
        $producao['fatura'] = $faturas['id'];
        $faturatotais = $faturatotal->cadastro($producao);

        $producao['descricao'] = 'Total Bruto';
        $producao['valor'] = $totalbruto;
        $producao['fatura'] = $faturas['id'];
        $faturatotais = $faturatotal->cadastro($producao);

        $producao['descricao'] = 'Folha Base';
        $producao['valor'] = $valorbasefolha;
        $producao['fatura'] = $faturas['id'];
        $faturatotais = $faturatotal->cadastro($producao);
        return redirect()->back()->withSuccess('Cadastro realizado com sucesso.'); 
        // dd($dados,$tomadores,$producaofatura,$rublicasFatura,$producao);
    }
    public function destroy($id)
    {
        $faturaprincipal = new FaturaPrincipal;
        $faturasecundario = new FaturaSecundaria;
        $faturademostrativa = new FaturaDemostrativa;
        $faturatotal = new FaturaTotal;
        $fatura = new Fatura;
        $faturarublica = new FaturaRubrica;
        $faturaprincipal->deletarFatura($id);
        $faturasecundario->deletarFatura($id);
        $faturademostrativa->deletarFatura($id);
        $faturarublica->deletarFatura($id);
        $faturatotal->deletarFatura($id);
        $fatura->deletar($id);
        return redirect()->back()->withSuccess('Deletado com sucesso.');
    }
    public function relatorio($id,$inicio,$final)
    {
        $tomador = new Tomador;
        $empresa = new Empresa;
        $fatura = new Fatura;
        $faturaprincipal = new FaturaPrincipal;
        $faturasecundario = new FaturaSecundaria;
        $faturademostrativa = new FaturaDemostrativa;
        $faturatotal = new FaturaTotal;
        $faturarublica = new FaturaRubrica;
        $faturas = $fatura->buscaRelatorio($id,$inicio,$final);
        $faturaprincipais = $faturaprincipal->buscaRelatorio($faturas->id);
        $faturarublicas = $faturarublica->buscaRelatorio($faturas->id);
        $faturasecundarios = $faturasecundario->buscaRelatorio($faturas->id);
        $faturademostrativas = $faturademostrativa->buscaRelatorio($faturas->id);
        $faturatotais = $faturatotal->buscaRelatorio($faturas->id);
        $tomadores = $tomador->tomadorFatura($id,$inicio,$final);
        $empresas = $empresa->buscaUnidadeEmpresa($tomadores->empresa);
        // dd($tomadores);
        $pdf = PDF::loadView('fatura',compact('tomadores','empresas','faturas','faturarublicas','faturaprincipais','faturasecundarios','faturademostrativas','faturatotais'));
        return $pdf->setPaper('a4')->stream('fatura.pdf');
    }
}
