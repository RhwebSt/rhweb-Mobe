<?php

namespace App\Http\Controllers\Descontos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Descontos;
use App\Empresa;
use PDF;
class relatorioController extends Controller
{
    private $empresa;
    public function __construct()
    {
        $this->empresa = new Empresa;
    }
    public function index($inicio,$final)
    {
        $desconto = new Descontos;
        $inicio = base64_decode($inicio);
        $final = base64_decode($final);
        $user = Auth::user();
        try {
            $empresa = $this->empresa->buscaUnidadeEmpresa($user->empresa);
            $descontos = $desconto->buscaRelatorio($user->empresa,$inicio,$final);
            if (count($descontos) < 1) {
                return redirect()->back()->withInput()->withErrors(['false'=>'Não a dados cadatrados!']);
            }
            $pdf = PDF::loadView('rolDescontos',compact('descontos','empresa','inicio','final'));
            return $pdf->setPaper('a4')->stream('RELATÓRIO DESCONTOS.pdf');
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->withErrors(['false'=>'Não foi possivél gera o relatório.']);
        }
       
    }
    public function reltatorioTrabalhador(Request $request)
    {
        $dados = $request->all();
        $desconto = new Descontos;
        $user = Auth::user();
        try {
            $empresa = $this->empresa->buscaUnidadeEmpresa($user->empresa);
            $descontos = $desconto->relatorioTrabalhador($user->empresa,$dados);
            if (count($descontos) < 1) {
                return redirect()->back()->withInput()->withErrors(['false'=>'Não a dados cadatrados!']);
            }
            $pdf = PDF::loadView('rolDescontoTrab',compact('descontos','empresa','dados'));
            return $pdf->setPaper('a4')->stream('RELATÓRIO DESCONTOS TRABALHADOR '.$dados['pesquisa'].'.pdf');
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->withErrors(['false'=>'Não foi possivél gera o relatório.']);
        }
       
    }
}
