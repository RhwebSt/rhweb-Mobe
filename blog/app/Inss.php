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
            'isvalorinicial'=>$dados['valor__inicial'],
            'isvalorfinal'=>$dados['valor__final'],
            'isindece'=>$dados['indice'],
            'isreducao'=>$dados['fator'],
            'user'=>$dados['user']
        ]);
    }
    public function edita($dados,$id)
    {
        return Inss::where('id', $id)
        ->update([
            'isano'=>$dados['ano'],
            'isvalorinicial'=>$dados['valor__inicial'],
            'isvalorfinal'=>$dados['valor__final'],
            'isindece'=>$dados['indice'],
            'isreducao'=>$dados['fator']
        ]);
    }
    public function getlist($id)
    {
        return Inss::where('isano',$id)->get();
    }
}
