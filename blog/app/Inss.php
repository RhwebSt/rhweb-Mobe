<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inss extends Model
{
    protected $fillable = [
        'isano','isvalorinicial','isvalorfinal','isindece','isreducao','user_id'
    ];
    public function cadastro($dados)
    {
        return Inss::create([
            'isano'=>$dados['ano'],
            // 'isvalorinicial'=>$dados['valor__inicial'],
            'isvalorfinal'=>$dados['valor__final'],
            'isindece'=>str_replace(",",".",$dados['indice']),
            'isreducao'=>str_replace(",",".",$dados['fator']),
            'user_id'=>$dados['user'] 
        ]);
    }
    public function edita($dados,$id)
    {
        return Inss::where('id', $id)
        ->update([
            'isano'=>$dados['ano'],
            // 'isvalorinicial'=>$dados['valor__inicial'],
            'isvalorfinal'=>str_replace(",",".",$dados['valor__final']),
            'isindece'=>str_replace(",",".",$dados['indice']),
            'isreducao'=>str_replace(",",".",$dados['fator'])
        ]);
    }
    public function buscaUnidadeInss($id)
    {
        return Inss::where('isano',$id)->get();
    }
    public function deletar($id)
    {
        return Inss::where('isano',$id)->delete();
    }
    public function buscaListaInss($ano)
    {
        return Inss::where(function($query) use ($ano){
            if ($ano) {
                $query->where('isano',$ano);
            }else{
                $query->where('id','>',0);
            }
        })->selectRaw(
            'SUM(isvalorfinal) as valor,
            isano'
        )
        ->groupBy('isano')
        ->orderBy('isano','desc')
        ->paginate(5);
    }
}
