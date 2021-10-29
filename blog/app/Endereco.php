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
            'esuf'=>$dados['uf'],
            'escomplemento'=>$dados['complemento__endereco'],
            'esnum'=>$dados['numero'],
            'tomador'=>$dados['tomador'],
            'trabalhador'=>$dados['trabalhador']
        ]);
    }
    public function editar($dados,$id)
    {
      return Endereco::where('id', $id)
      ->update([
        'eslogradouro'=>$dados['logradouro'],
        'esbairro'=>$dados['bairro'],
        // 'estipo'=>$dados['tf13'],
        'esmunicipio'=>$dados['localidade'],
        'esesuf'=>$dados['uf'],
        'escomplemento'=>$dados['complemento__endereco'],
        'esnum'=>$dados['numero'],
    ]);
    }
    public function editartomador($dados,$id)
    {
        return Endereco::where('tomador', $id)
        ->update([
            'eslogradouro'=>$dados['logradouro'],
            'esbairro'=>$dados['bairro'],
            // 'estipo'=>$dados['tf13'],
            'esmunicipio'=>$dados['localidade'],
            'esuf'=>$dados['uf'],
            'escomplemento'=>$dados['complemento__endereco'],
            'esnum'=>$dados['numero'],
        ]);
    }
    public function deletar($id)
    {
        return Endereco::where('tomador', $id)->delete();
    }
}
