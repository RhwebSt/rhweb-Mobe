<?php

namespace App\Http\Controllers\Tomador;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class comprovantePagDiaController extends Controller
{
    public function ComprovantePagDia(Request $request)
    {
        $dados = $request->all();
        
        $pdf = PDF::loadView('comprovantePagDiatomador');
        return $pdf->setPaper('a4')->stream('RECIBO PAGAMENTO GERAL.pdf');
    }
}
