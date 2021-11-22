<?php

namespace App\Http\Controllers\Fatura;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PDF;
class FaturaController extends Controller
{
    public function index()
    {
        $pdf = PDF::loadView('fatura');
        return $pdf->setPaper('a4')->stream('fatura.pdf');
    }
}
