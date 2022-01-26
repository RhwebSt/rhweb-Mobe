<?php

namespace App\Http\Controllers\Descontos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Descontos;
use PDF;
class relatorioController extends Controller
{
    public function index($inicio,$final)
    {
        $desconto = new Descontos;
        $inicio = base64_decode($inicio);
        $final = base64_decode($final);
        $user = Auth::user();
        $descontos = $desconto->buscaRelatorio($user->empresa,$inicio,$final);
        $pdf = PDF::loadView('rolDescontos',compact('descontos'));
        return $pdf->setPaper('a4')->stream('RELATÓRIO DESCONTOS.pdf');
    }
}
