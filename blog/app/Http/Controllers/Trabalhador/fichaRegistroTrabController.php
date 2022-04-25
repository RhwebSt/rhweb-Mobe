<?php

namespace App\Http\Controllers\Trabalhador;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Trabalhador;
use App\Empresa;
use App\Dependente;
use PDF;
class fichaRegistroTrabController extends Controller
{
    private $trabalhador,$empresa;
    public function __construct()
    {
        $this->trabalhador = new Trabalhador;
        $this->empresa = new Empresa;
       
    }
    public function fichaRegistroTrabalhador($id)
    {
        $id = base64_decode($id);
        $user = auth()->user();
        $empresas = $this->empresa->where('id',$user->empresa_id)->with('endereco')->first(); 
        $trabalhadors = $this->trabalhador->where('id',$id)
        ->with(['documento','endereco','categoria','nascimento','bancario','depedente'])->first();
        
        // dd($trabalhadors);
            // $trabalhadors = $trabalhador->buscaUnidadeTrabalhador($id);
            if ($trabalhadors) {
                // $empresas = $empresa->buscaUnidadeEmpresa($trabalhadors->empresa); 
                // $depedentes = $depedente->buscaListaDepedente($id); 
                $pdf = PDF::loadView('fichaRegistroTrab',compact('trabalhadors','empresas'));
                return $pdf->setPaper('a4')->stream('ficha_'.$trabalhadors->tsnome.'.pdf');
            }
            try {
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->withErrors(['false'=>'Não foi possível gerar a ficha de registro do trabalhador.']);
        }
    }
}
