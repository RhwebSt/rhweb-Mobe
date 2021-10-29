<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IndiceFatura extends Model
{
    protected $fillable = [
        'isalimentacao','istransporte','isepi','isseguroportrabalhador','isvaletransporte','isindecesobrefolha','isvalealimentacao','tomador'
    ];
    public function cadastro($dados)
    {
        return IndiceFatura::create([
            'isalimentacao'=>$dados['alimentacao'],
            'istransporte'=>$dados['transporte'],
            'isepi'=>$dados['epi'],
            'isseguroportrabalhador'=>$dados['seguro__trabalhador'],
            'isindecesobrefolha'=>$dados['indice__folha'],
            'isvaletransporte'=>$dados['valor__transporte'],
            'isvalealimentacao'=>$dados['valor__alimentacao'],
            'tomador'=>$dados['tomador']
        ]);
    }
   public function editar($dados,$id)
   {
        return IndiceFatura::where('tomador', $id)
        ->update([
            'isalimentacao'=>$dados['alimentacao'],
            'istransporte'=>$dados['transporte'],
            'isepi'=>$dados['epi'],
            'isseguroportrabalhador'=>$dados['seguro__trabalhador'],
            'isindecesobrefolha'=>$dados['indice__folha'],
            'isvaletransporte'=>$dados['valor__transporte'],
            'isvalealimentacao'=>$dados['valor__alimentacao'],
        ]);
   }
   public function deletar($id)
    {
      return IndiceFatura::where('tomador', $id)->delete();
    }
}
