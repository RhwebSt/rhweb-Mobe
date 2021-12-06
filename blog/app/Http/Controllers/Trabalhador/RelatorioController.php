<?php

namespace App\Http\Controllers\Trabalhador;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Trabalhador;
class RelatorioController extends Controller
{
    public function index()
    {
        $url = "https://managersaas.tecnospeed.com.br:8081/ManagerAPIWeb/nfe/exportaxml";
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        $resultado = json_decode(curl_exec($ch));
        // $trabalhador = new Trabalhador;
        // $trabalhadors = $trabalhador->roltrabalhado();
        // return response()->json($trabalhadors);
    }
}
