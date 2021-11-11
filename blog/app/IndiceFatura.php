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
            'isalimentacao'=>str_replace(",",".",$dados['alimentacao']),
            'istransporte'=>str_replace(",",".",$dados['transporte']),
            'isepi'=>str_replace(",",".",$dados['epi']),
            'isseguroportrabalhador'=>str_replace(",",".",$dados['seguro__trabalhador']),
            // 'isindecesobrefolha'=>$dados['indice__folha'],
            // 'isvaletransporte'=>str_replace(",",".",$dados['valor__transporte']),
            // 'isvalealimentacao'=>str_replace(",",".",$dados['valor__alimentacao']),
            'tomador'=>$dados['tomador']
        ]);
    }
   public function editar($dados,$id)
   {
        return IndiceFatura::where('tomador', $id)
        ->update([
            'isalimentacao'=>str_replace(",",".",$dados['alimentacao']),
            'istransporte'=>str_replace(",",".",$dados['transporte']),
            'isepi'=>str_replace(",",".",$dados['epi']),
            'isseguroportrabalhador'=>str_replace(",",".",$dados['seguro__trabalhador']),
            // 'isindecesobrefolha'=>$dados['indice__folha'],
            // 'isvaletransporte'=>str_replace(",",".",$dados['valor__transporte']),
            // 'isvalealimentacao'=>str_replace(",",".",$dados['valor__alimentacao']),
        ]);
   }
   public function deletar($id)
    {
      return IndiceFatura::where('tomador', $id)->delete();
    }
}
