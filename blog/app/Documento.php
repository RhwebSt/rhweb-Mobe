<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
    protected $fillable = [
        'dstipo','dsemissao','uf','ctps','pis','trabalhador'
    ];
    public function cadastro($dados)
    {
       return Documento::create([
            // 'dstipo'=>$dados['categoria__contrato'],
            // 'dsemissao'=>$dados['data__admissao'],
            'uf'=>$dados['uf__ctps'],
            'ctps'=>$dados['ctps'],
            'pis'=>$dados['pis'],
            'trabalhador'=>$dados['trabalhador'],
        ]);
    }
}
