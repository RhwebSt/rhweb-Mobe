<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Esocial extends Model
{
    protected $fillable = [
        'esnome', 'escodigo', 'esid', 'esambiente', 'esstatus', 'trabalhador','tomador'
    ];
    public function cadastro($dados)
    {
        return Esocial::create([
            'esnome'=>$dados['nome'],
            'escodigo'=>$dados['codigo'],
            'esid'=>$dados['id'],
            'esambiente'=>$dados['ambiente'],
            'esstatus'=>$dados['status'],
            'trabalhador'=>isset($dados['trabalhador'])?$dados['trabalhador']:null,
            'tomador'=>isset($dados['tomador'])?$dados['tomador']:null,
        ]);
    }
    public function editar($dados,$id)
    {
        return Esocial::where('trabalhador', $id)
        ->update([
            'escodigo'=>$dados['codigo'],
            'esid'=>$dados['id'],
            'esstatus'=>$dados['status'],
            'trabalhador'=>isset($dados['trabalhador'])?$dados['trabalhador']:null,
            'tomador'=>isset($dados['tomador'])?$dados['tomador']:null,
        ]);
    }
    public function verificarTrabalhador($id)
    {
        return Esocial::where('trabalhador', $id)->count();
    }
}
