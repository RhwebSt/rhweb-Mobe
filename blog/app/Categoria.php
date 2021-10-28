<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $fillable = [
        'cscategoria','cssituacao','csafastamento','csadmissao','cbo','cssl','csirrf','trabalhador'
    ];
    public function cadastro($dados)
    {
       return Categoria::create([
            'cscategoria'=>$dados['categoria__contrato'],
            'cssituacao'=>$dados['situacao__contrato'],
            'csafastamento'=>$dados['data__afastamento'],
            'csadmissao'=>$dados['data__admissao'],
            'cbo'=>$dados['cbo'],
            'cssl'=>$dados['sf'],
            'csirrf'=>$dados['irrf'],
            'trabalhador'=>$dados['trabalhador'],
        ]);
    }
}
