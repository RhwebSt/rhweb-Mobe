<?php

namespace App\Http\Controllers\Trabalhador;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Trabalhador;
use App\Empresa;
use App\Epi;
use PDF;
class fichaEpiTrabController extends Controller
{
   
    private $trabalhador,$empresa,$epi;
    public function __construct()
    {
        $this->trabalhador = new Trabalhador;
        $this->empresa = new Empresa;
        $this->epi = new Epi;
       
    }
    public function ficha($id)
    {
        // $epi = $this->epi->buscalista($id);
        $id = base64_decode($id); 
        $user = auth()->user();
        $empresas = $this->empresa->where('id',$user->empresa_id)->with('endereco')->first(); 
        $trabalhadors = $this->trabalhador->where('id',$id)
        ->with(['documento','endereco','categoria','nascimento','bancario','depedente','epi'])->first();
        
            // $trabalhadors = $trabalhador->buscaUnidadeTrabalhador($id);
            // if ($trabalhadors) {
            //     $empresas = $empresa->buscaUnidadeEmpresa($trabalhadors->empresa);
                $pdf = PDF::loadView('fichaEpi',compact('trabalhadors','empresas'));
                return $pdf->setPaper('a4')->stream('Ficha '.$trabalhadors->tsnome.'.pdf');
            // }
            try {
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->withErrors(['false'=>'Não foi possível gerar a ficha de EPI.']);
        }
    }
}
