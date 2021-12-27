<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Irrf extends Model
{
    protected $fillable = [
        'irsano','irsvalorinicial','irsvalorfinal','irsindece','irsreducao','irdepedente','user'
    ];
    public function cadastro($dados)
    {
        return Irrf::create([
            'irsano'=>$dados['ano'],
            'irdepedente'=>$dados['ded__dependente'],
            // 'irsvalorinicial'=>$dados['valor__inicial'],
            'irsvalorfinal'=>$dados['valor__final'],
            'irsindece'=>$dados['indice'],
            'irsreducao'=>$dados['fator'],
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
            'irsano'=>$dados['ano'],
            'irdepedente'=>$dados['ded__dependente'],
            // 'irsvalorinicial'=>$dados['valor__inicial'],
            'irsvalorfinal'=>$dados['valor__final'],
            'irsindece'=>$dados['indice'],
            'irsreducao'=>$dados['fator'],
        ]);
    }
}
