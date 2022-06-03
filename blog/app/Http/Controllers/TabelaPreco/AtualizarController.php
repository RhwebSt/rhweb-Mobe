<?php

namespace App\Http\Controllers\TabelaPreco;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Tomador;
class AtualizarController extends Controller
{
    private $tomador;
    public function __construct()
    {
        $this->tomador = new Tomador;
    }
    public function index(Type $var = null)
    {
        switch ($variable) {
            case 'value':
                
                break;
            
            default:
                # code...
                break;
        }
    }
}
