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
    private $user,$tomador,$quantrabalhador,$quantfatura,$quantfolhar,
    $quantcartaoponto;
    public function __construct()
    {
        $this->user = new User;
        $this->tomador = new Tomador;
        $this->trabalhador=new Trabalhador;
        $this->fatura = new Fatura;
        $this->folhar = new Folhar;
        $this->cartaoponto = new Lancamentotabela;
    }
    public function index()
    {
        if (auth()->check()){
            $user = Auth::user(); 
            if ($user->hasPermissionTo('Super Admin')) {
                $quantuser = $this->user->count();
                $quantuserbloqueador = $this->user->with('permissions')->get();
                $quantomador = $this->tomador->count();
                $quantrabalhador = $this->trabalhador->count();
                // dd($quantrabalhador);
                $quantfatura = $this->fatura->count();
                $quantfolhar = $this->folhar->count();
                $quantcartaoponto = $this->cartaoponto->count();
                $quantboletimtabela = $this->cartaoponto->count();
                
                return view('administrador.index',compact('user','quantuser','quantuserbloqueador','quantomador','quantrabalhador','quantfatura','quantfolhar','quantcartaoponto','quantboletimtabela'));
            }
        }
        return redirect()->route('login.administrador');
      
    }
}
