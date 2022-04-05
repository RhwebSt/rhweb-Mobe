<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inss extends Model
{
    protected $fillable = [
        'isano','isvalorinicial','isvalorfinal','isindece','isreducao','user'
    ];
    public function cadastro($dados)
    {
        return Inss::create([
            'isano'=>$dados['ano'],
            // 'isvalorinicial'=>$dados['valor__inicial'],
            'isvalorfinal'=>$dados['valor__final'],
            'isindece'=>str_replace(",",".",$dados['indice']),
            'isreducao'=>str_replace(",",".",$dados['fator']),
            'user'=>$dados['user'] 
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
    public function buscaListaInss()
    {
        return Inss::selectRaw(
            'SUM(isvalorfinal) as valor,
            isano'
        )
        ->groupBy('isano')
        ->paginate(5);
    }
}
