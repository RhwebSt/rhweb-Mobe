<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $fillable = [
        'cscategoria','cssituacao','csafastamento','csadmissao','cbo','trabalhador'
    ];
    public function cadastro($dados)
    {
       return Categoria::create([
            'cscategoria'=>$dados['categoria__contrato'],
            'cssituacao'=>$dados['situacao__contrato'],
            'csafastamento'=>$dados['data__afastamento'],
            'csadmissao'=>$dados['data__admissao'],
            'cbo'=>$dados['cbo'],
            'trabalhador'=>$dados['trabalhador'],
        ]);
    }
    public function editar($dados,$id)
    {
        return Categoria::where('trabalhador', $id)
        ->update([
            'cscategoria'=>$dados['categoria__contrato'],
            'cssituacao'=>$dados['situacao__contrato'],
            'csafastamento'=>$dados['data__afastamento'],
            'csadmissao'=>$dados['data__admissao'],
            'cbo'=>$dados['cbo'],
        ]);
    }
    public function deletar($id)
    {
        return Categoria::where('trabalhador', $id)->delete();
    }
}
