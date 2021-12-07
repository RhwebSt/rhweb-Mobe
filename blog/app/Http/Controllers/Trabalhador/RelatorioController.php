<?php

namespace App\Http\Controllers\Trabalhador;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Trabalhador;
class RelatorioController extends Controller
{
    public function index()
    {
        $trabalhador = new Trabalhador;
        $trabalhadors = $trabalhador->roltrabalhado();
        return response()->json($trabalhadors);
    }
}
