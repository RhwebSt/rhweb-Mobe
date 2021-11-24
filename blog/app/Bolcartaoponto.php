<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Bolcartaoponto extends Model
{
    protected $fillable = [
        'horas_normais','bsentradanoite','bssaidanoite','bsentradamadrugada','bssaidamadrugada','bsentradamanhao','bssaidamanhao','bsentradatarde','bssaidatarde','bstotal','bshoraex','bshoraexcem','bsadinortuno','trabalhador','lancamento'
    ];
    public function cadastro($dados)
    {
       return Bolcartaoponto::create([
            'bsentradamanhao'=>$dados['entrada1'],
            'bssaidamanhao'=>$dados['saida'],
            'bsentradatarde'=>$dados['entrada2'],
            'bssaidatarde'=>$dados['saida2'],
            'bsentradanoite'=>$dados['entrada3'],
            'bssaidanoite'=>$dados['saida3'],
            'bsentradamadrugada'=>$dados['entrada4'],
            'bssaidamadrugada'=>$dados['saida4'],
            'bstotal'=>str_replace(",",".",$dados['total']),
            'horas_normais'=>str_replace(",",".",$dados['horas_normais']),
            'bshoraex'=>str_replace(",",".",$dados['hora__extra']),
            'bshoraexcem'=>str_replace(",",".",$dados['horas__cem']),
            'bsadinortuno'=>str_replace(",",".",$dados['adc__noturno']),
            'trabalhador'=>$dados['trabalhador'],
            'lancamento'=>$dados['lancamento'],
        ]);
    }
    public function listacadastro($id)
    {
        return DB::table('trabalhadors')
        ->join('bolcartaopontos', 'trabalhadors.id', '=', 'bolcartaopontos.trabalhador')
        ->join('lancamentotabelas', 'lancamentotabelas.id', '=', 'bolcartaopontos.lancamento')
        ->select(
            'trabalhadors.*', 
            'bolcartaopontos.*', 
            )
        ->where('lancamentotabelas.id', $id)
        ->paginate(15);
    }
    public function listafirst($id)
    {
        return DB::table('trabalhadors')
        ->join('bolcartaopontos', 'trabalhadors.id', '=', 'bolcartaopontos.trabalhador')
        ->join('lancamentotabelas', 'lancamentotabelas.id', '=', 'bolcartaopontos.lancamento')
        ->join('tomadors', 'tomadors.id', '=', 'lancamentotabelas.tomador')
        ->select(
            'trabalhadors.*', 
            'bolcartaopontos.*', 
            )
        ->where(function($query) use ($id){
            $cargo =['admin'];
            $user = auth()->user();
            if (in_array($user->cargo,$cargo)) {
                $query->where('trabalhadors.tsnome', $id);
            }else{
                $query->where('trabalhadors.tsnome', $id)
                ->where('tomadors.user', $user->id);
            }
               
        })
        ->first();
    }
    public function editar($dados,$id)
    {
        return Bolcartaoponto::where('id', $id)
        ->update([
           'bsentradamanhao'=>$dados['entrada1'],
            'bssaidamanhao'=>$dados['saida'],
            'bsentradatarde'=>$dados['entrada2'],
            'bssaidatarde'=>$dados['saida2'],
            'bsentradanoite'=>$dados['entrada3'],
            'bssaidanoite'=>$dados['saida3'],
            'bsentradamadrugada'=>$dados['entrada4'],
            'bssaidamadrugada'=>$dados['saida4'],
            'bstotal'=>str_replace(",",".",$dados['total']),
            'horas_normais'=>str_replace(",",".",$dados['horas_normais']),
            'bshoraex'=>str_replace(",",".",$dados['hora__extra']),
            'bshoraexcem'=>str_replace(",",".",$dados['horas__cem']),
            'bsadinortuno'=>str_replace(",",".",$dados['adc__noturno']),
        ]);
    }
    public function deletar($id)
    {
      return Bolcartaoponto::where('lancamento', $id)->delete();
    }
}
