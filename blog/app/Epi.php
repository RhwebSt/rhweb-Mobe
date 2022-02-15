<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Epi extends Model
{
    protected $fillable = [
        'eiquantidade', 'esdescricao', 'estm', 'eica', 'esdatares', 'esdatadev', 'trabalhador'
    ];
    public function cadastro($dados,$i)
    {
        return Epi::create([
            'eiquantidade'=>$dados['quantidade'.$i],
            'esdescricao'=>$dados['descricao'.$i],
            'estm'=>$dados['tamanho'.$i],
            'eica'=>$dados['ca'.$i],
            'esdatares'=>$dados['data__recolhimento'.$i],
            'esdatadev'=>$dados['data__devolucao'.$i],
            'trabalhador'=>base64_decode($dados['trabalhador']),
        ]);
    }
}
