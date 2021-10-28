<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Taxa extends Model
{
    protected $fillable = [
        'tftaxaadm','tfbenef','tfferias','tf13','tftaxafed','tomador'
    ];
    public function cadastro($dados)
    {
        return Taxa::create([
            'tftaxadm'=>$dados['taxa_adm'],
            'tfbenef'=>$dados['caixa_benef'],
            'tfferias'=>$dados['ferias'],
            'tf13'=>$dados['13_salario'],
            'tftaxafed'=>$dados['taxa__fed'],
            'tomador'=>$dados['tomador']
        ]);
    }
    public function editar($dados)
    {
      return Taxa::where('id', $dados['id'])
      ->update([
        'tfaxadm'=>$dados['taxa_adm'],
        'tfbenef'=>$dados['caixa_benef'],
        'tfferias'=>$dados['ferias'],
        'tf13'=>$dados['13_salario'],
        'tftaxafed'=>$dados['taxa__fed'],
    ]);
    }
}
