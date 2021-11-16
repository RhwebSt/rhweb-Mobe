<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lancamentorublica extends Model
{
    protected $fillable = [
        'lshistorico','lsquatidade','licodigo','trabalhador','lancamento'
    ];
    public function cadastro($dados)
    {
       return Lancamentorublica::create([
            'lshistorico'=>$dados['rubrica'],
            'lsquantidade'=>$dados['quantidade'],
            'licodigo'=>$dados['codigo'],
            'trabalhador'=>$dados['trabalhador'],
            'lancamento'=>$dados['lancamento'],
        ]);
    }
}
