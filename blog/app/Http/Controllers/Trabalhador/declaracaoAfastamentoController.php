<?php

namespace App\Http\Controllers\Trabalhador;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Trabalhador;
use App\Empresa;
use PDF;
class declaracaoAfastamentoController extends Controller
{   private $trabalhador,$empresa;
    public function __construct()
    {
        $this->trabalhador = new Trabalhador;
        $this->empresa = new Empresa;
       
    }
    public function declarassaoafastamento($id)
    {
        $id = base64_decode($id);
        $user = auth()->user();
        $empresas = $this->empresa->where('id',$user->empresa_id)->with('endereco')->first(); 
        $trabalhadors = $this->trabalhador->where('id',$id)
        ->with(['documento','arquivo','endereco','categoria','nascimento','bancario','depedente'])->first();
        // dd($trabalhadors);
            // $trabalhadors = $trabalhador->buscaUnidadeTrabalhador($id);
            if ($trabalhadors) {
                // $empresas = $empresa->buscaUnidadeEmpresa($trabalhadors->empresa);
                $pdf = PDF::loadView('declaracaoAfastamento',compact('trabalhadors','empresas'));
                return $pdf->setPaper('a4')->stream('Declaração de afastamento '.$trabalhadors->tsnome.'.pdf');
            }
            try {
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->withErrors(['false'=>'Não foi possível gerar o relatório.']);
        }
    }
}
