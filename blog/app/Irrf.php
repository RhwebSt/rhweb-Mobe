<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Irrf extends Model
{
    protected $fillable = [
        'irsano','irsvalorinicial','irsvalorfinal','irsindece','irsreducao','irdepedente','user_id'
    ];
    public function cadastro($dados)
    {
        return Irrf::create([
            'irsano'=>$dados['ano'],
            'irdepedente'=>str_replace(",",".",str_replace(".","",$dados['ded__dependente'])),
            // 'irsvalorinicial'=>$dados['valor__inicial'],
            'irsvalorfinal'=>str_replace(",",".",str_replace(".","",$dados['valor__final'])),
            'irsindece'=>str_replace(",",".",str_replace(".","",$dados['indice'])),
            'irsreducao'=>str_replace(",",".",str_replace(".","",$dados['fator'])),
            'user_id'=>$dados['user']
        ]);
    }
    public function buscaUnidadeIrrf($id)
    {
        return Irrf::where('irsano',$id)->get();
    }
    public function edita($dados,$id)
    {
        return Irrf::where('id', $id)
        ->update([
            'irsano'=>$dados['ano'],
            'irdepedente'=>str_replace(",",".",str_replace(".","",$dados['ded__dependente'])),
            // 'irsvalorinicial'=>$dados['valor__inicial'],
            'irsvalorfinal'=>str_replace(",",".",str_replace(".","",$dados['valor__final'])),
            'irsindece'=>str_replace(",",".",str_replace(".","",$dados['indice'])),
            'irsreducao'=>str_replace(",",".",str_replace(".","",$dados['fator'])),
        ]);
    }
    public function buscaListaIrrf($ano)
    {
        return Irrf::where(function($query) use ($ano){
            if ($ano) {
                $query->where('irsano',$ano);
            }else{
                $query->where('id','>',0);
            }
        })->selectRaw(
            'SUM(irsvalorfinal) as valor,
            irsano'
        )
        ->groupBy('irsano')
        ->orderBy('irsano','desc')
        ->paginate(5);
    }
}
