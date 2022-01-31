<?php

namespace App\Http\Controllers\Fatura;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PDF;
use App\Tomador;
use App\ValorCalculo;
use App\FaturaPrincipal;
use App\Rublica;
class FaturaController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        return view('fatura.index',compact('user'));
        // $pdf = PDF::loadView('fatura');
        // return $pdf->setPaper('a4')->stream('fatura.pdf');
    }
    public function store(Request $request)
    {
        $dados = $request->all();
        $user = auth()->user();
        $tomador = new Tomador;
        $valorcalculor = new ValorCalculo;
        $faturaprincipal = new FaturaPrincipal;
        $tomadores = $tomador->tomadorFatura($dados['tomador']);
        $producao = [
            'descricao'=>'',
            'indice'=>'',
            'valor'=>'',
            'tomador'=>'',
            'empresa'=>''
        ];
        $producaofatura = $valorcalculor->producaoFatura($dados);
        $rublicasFatura = $valorcalculor->rublicasFatura($dados);
        $producao['descricao'] = 'Produção';
        $producao['indice'] = $producaofatura[0]->vireferencia;
        $producao['valor'] = $producaofatura[0]->vencimento;
        $producao['tomador'] = $dados['tomador'];
        $producao['empresa'] = $user->empresa;
        // $faturaprincipais = $faturaprincipal->cadastro($dados);
        foreach ($rublicasFatura as $r => $valorublica) {
            if ($valorublica->vicodigo === 1008) {
                $producao['descricao'] = 'DSR';
                $producao['indice'] = $valorublica->vireferencia;
                $producao['valor'] = $valorublica->vencimento;
                $producao['tomador'] = $dados['tomador'];
                $producao['empresa'] = $user->empresa;
                $faturaprincipal->cadastro($producao);
            }
        }
        dd($dados,$tomadores,$producaofatura,$rublicasFatura,$producao);
    }
}
