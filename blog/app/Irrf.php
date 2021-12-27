<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Irrf extends Model
{
    protected $fillable = [
        'irsano','irsvalorinicial','irsvalorfinal','irsindece','user'
    ];
    public function cadastro($dados)
    {
        return Irrf::create([
            'irsano'=>$dados['irsano'],
            'irsvalorinicial'=>$dados['valor__inicial'],
            'irsvalorfinal'=>$dados['valor__final'],
            'irsindece'=>$dados['indice'],
            'user'=>$dados['user']
        ]);
    }
    public function buscaListaIrrf($id)
    {
        return Irrf::where('irsano',$id)->get();
    }
    public function edita($dados,$id)
    {
        return Irrf::where('id', $id)
        ->update([
            'irsano'=>$dados['irsano'],
            'irsvalorinicial'=>$dados['valor__inicial'],
            'irsvalorfinal'=>$dados['valor__final'],
            'irsindece'=>$dados['indice'],
        ]);
    }
}
