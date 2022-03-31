<?php

namespace App\Http\Controllers\Administrador;

use App\Fatura;
use App\Folhar;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Tomador;
use App\Trabalhador;
use App\Lancamentotabela;
class AdministradorController extends Controller
{
    private $quantuser,$quantomador,$quantrabalhador,$quantfatura,$quantfolhar,
    $quantcartaoponto;
    public function __construct()
    {
        $this->quantuser = new User;
        $this->quantomador = new Tomador;
        $this->quantrabalhador=new Trabalhador;
        $this->quantfatura = new Fatura;
        $this->quantfolhar = new Folhar;
        $this->quantcartaoponto = new Lancamentotabela;
    }
    public function index()
    {
        if (auth()->check()){
            $user = Auth::user();   
            if ($user->hasPermissionTo('Super Admin')) {
                $quantuser = $this->quantuser->quantidadeUsuarios();
                $quantuserbloqueador = $this->quantuser->quantidadeBloqueadoUsuarios();
                $quantomador = $this->quantomador->quantidadeTomador();
                $quantrabalhador = $this->quantrabalhador->quantidadeTrabalhador();
                $quantfatura = $this->quantfatura->quantidadeFatura();
                $quantfolhar = $this->quantfolhar->quantidadeFolhar();
                $quantcartaoponto = $this->quantcartaoponto->quantidadeCartaoPonto();
                $quantboletimtabela = $this->quantcartaoponto->quantidadeBoletimTabela();
                return view('administrador.index',compact('quantuser','quantuserbloqueador','quantomador','quantrabalhador','quantfatura','quantfolhar','quantcartaoponto','quantboletimtabela'));
            }
        }
        return redirect()->route('login.administrador');
      
    }
}
