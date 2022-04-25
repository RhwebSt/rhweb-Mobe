<?php

namespace App\Http\Controllers\Trabalhador;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Trabalhador;
use App\Empresa;
use PDF;
class PdfController extends Controller
{
    private $trabalhador,$empresa;
    public function __construct()
    {
        $this->trabalhador = new Trabalhador;
        $this->empresa = new Empresa;
       
    }
    public function rolnome()
    {
            $user = auth()->user();
            // $trabalhadors = $trabalhador->roltrabalhado();  
            // $empresas = $empresa->buscaUnidadeEmpresa($user->empresa);
            $user = auth()->user();
        try {
            $empresas = $this->empresa->where('id',$user->empresa_id)->with('endereco')->first(); 
            $trabalhadors = $this->trabalhador->where('empresa_id',$user->empresa_id)
            ->with(['documento','endereco','categoria','nascimento','bancario','depedente'])->get();
            $pdf = PDF::loadView('pdf',compact('trabalhadors','empresas'));
            return $pdf->setPaper('a4')->stream('relatoria.pdf');
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->withErrors(['false'=>'Não foi possível gerar a ficha de registro do trabalhador.']);
        }
    }
}
