<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    protected $fillable = [
        'eslogradouro','esbairro','estipo','esmunicipio','esuf','escomplemento','esnum','trabalhador','tomador'
    ];
    public function cadastro($dados)
    {
        return Endereco::create([
            'eslogradouro'=>$dados['logradouro'],
            'esbairro'=>$dados['bairro'],
            // 'estipo'=>$dados['tf13'],
            'esmunicipio'=>$dados['localidade'],
            'esesuf'=>$dados['uf'],
            'escomplemento'=>$dados['complemento__endereco'],
            'esnum'=>$dados['numero'],
            'tomador'=>$dados['tomador'],
            'trabalhador'=>$dados['trabalhador']
        ]);
    }
    public function editar($dados)
    {
      return Endereco::where('id', $dados['id'])
      ->update([
        'eslogradouro'=>$dados['tfaxadm'],
        'esbairro'=>$dados['tfbenef'],
        'estado'=>$dados['tfferias'],
        'estipo'=>$dados['tf13'],
        'esmunicipio'=>$dados['tfyp'],
        'esesuf'=>$dados['tfyp'],
        'escomplemento'=>$dados['tfyp'],
        'esnum'=>$dados['tfyp'],
    ]);
    }
}
