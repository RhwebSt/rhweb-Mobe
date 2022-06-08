<?php

namespace App\Http\Controllers\ComprovantePag;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PDF;
class ComprovantePagController extends Controller
{
    public function index()
    {
        $pdf = PDF::loadView('comprovantePag');
        return $pdf->setPaper('a4')->stream('Comprovante de Pagamento.pdf');
    }
}
