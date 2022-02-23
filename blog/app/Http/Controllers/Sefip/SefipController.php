<?php

namespace App\Http\Controllers\Sefip;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Tomador;
use App\Empresa;
class SefipController extends Controller
{
    private $tomador,$empresa;
    public function __construct()
    {
        $this->tomador = new Tomador;
        $this->empresa = new Empresa;
    }
    public function geraTxt()
    {
       $user = auth()->user();
       $empresa = $this->empresa->EmpresaSefip($user->empresa);
       $empresas = [
        'cnpj'=>''
       ];
       if ($this->empresa->escnpj) {
           
       }
       $file_name = 'dados.txt';
       $cd = '00                                                   11';
       $file = fopen( $file_name, "w" );
       fputs($file, $cd);
       fclose($file);
       header("Content-Type: application/save");
       header("Content-Length:".filesize($file_name));
       header('Content-Disposition: attachment; filename="' . $file_name . '"');
       header("Content-Transfer-Encoding: binary");
       header('Expires: 0');
       header('Pragma: no-cache');
       echo $cd;
       exit;
    }
}
