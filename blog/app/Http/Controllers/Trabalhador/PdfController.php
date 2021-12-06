<?php

namespace App\Http\Controllers\Trabalhador;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Trabalhador;
use App\Empresa;
use PDF;
class PdfController extends Controller
{
    public function rolnome()
    {
        // $ch = curl_init();
        // $header = [
        //     'Authorization:Basic YWRtaW46MTIzbXVkYXI='
        // ];
        // curl_setopt_array($ch,[
        //     CURLOPT_URL =>'https://managersaas.tecnospeed.com.br:8081/ManagerAPIWeb/nfe/exportaxml',
        //     CURLOPT_CUSTOMREQUEST => 'POST',
        //     CURLOPT_RETURNTRANSFER => TRUE,
        //     CURLOPT_HTTPHEADER => $header
        // ]);
        // $url = "https://managersaas.tecnospeed.com.br:8081/ManagerAPIWeb/nfe/exportaxml";
        // $ch = curl_init($url);
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        // curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        // $resultado = json_decode(curl_exec($ch));
        // dd($resultado);
        $trabalhador = new Trabalhador;
        $empresa = new Empresa;
        $empresas = '';
        $trabalhadors = $trabalhador->roltrabalhado();
        if (isset($trabalhadors[0]->empresa)) {
            $empresas = $empresa->first($trabalhadors[0]->empresa);
        }
        $pdf = PDF::loadView('pdf',compact('trabalhadors','empresas'));
        return $pdf->setPaper('a4')->stream('relatoria.pdf');
    }
}
