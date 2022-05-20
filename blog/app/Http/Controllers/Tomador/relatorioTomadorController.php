<?php

namespace App\Http\Controllers\Tomador;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Tomador;
use App\Empresa;
use PDF;
class relatorioTomadorController extends Controller
{
    private $empresa;
    public function __construct()
    {
        $this->empresa = new Empresa;
    }
    public function relatorioGeral()
    {
        $user = auth()->user();
        $empresas = $this->empresa->where('id',$user->empresa_id)
        ->with(['endereco','tomador:empresa_id,tsnome,tscnpj,tsmatricula,tstelefone'])
        ->first();
            // $tomadores = $tomador->relatorioGeral($user->empresa_id);
            // $empresas = $empresa->buscaUnidadeEmpresa($user->empresa_id);
            $pdf = PDF::loadView('rolTomador',compact('empresas'));
            return $pdf->setPaper('a4')->stream('RELATÓRIO DA TABELA PRECO.pdf');
            try {
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->withErrors(['false'=>'Não foi possível gerar o relatório.']);
        }
    }
}
