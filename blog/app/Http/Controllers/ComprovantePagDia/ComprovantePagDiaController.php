<?php

namespace App\Http\Controllers\ComprovantePagDia;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PDF;
class ComprovantePagDiaController extends Controller
{
    public function index()
    {
        $pdf = PDF::loadView('comprovantePagDia');
        return $pdf->setPaper('a4')->stream('comprovantepagamentodiaria.pdf');
    }
}
