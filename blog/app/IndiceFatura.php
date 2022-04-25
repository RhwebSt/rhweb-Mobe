<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IndiceFatura extends Model
{
    protected $fillable = [
        'isalimentacao','istransporte','isepi','isseguroportrabalhador','isvaletransporte','isindecesobrefolha','isvalealimentacao','tomador_id'
    ];
    public function tomador()
    {
        return $this->belongsTo(Tomador::class);
    }
    public function cadastro($dados)
    {
        return IndiceFatura::create([
            'isalimentacao'=>$dados['alimentacao']?str_replace(",",".",str_replace(".","",$dados['alimentacao'])):0,
            'istransporte'=>$dados['transporte']?str_replace(",",".",str_replace(".","",$dados['transporte'])):0,
            'isepi'=>$dados['epi']?str_replace(",",".",str_replace(".","",$dados['epi'])):0,
            'isseguroportrabalhador'=>$dados['seguro__trabalhador']?str_replace(",",".",str_replace(".","",$dados['seguro__trabalhador'])):0,
            // 'isindecesobrefolha'=>$dados['indice__folha'],
            // 'isvaletransporte'=>str_replace(",",".",$dados['valor__transporte']),
            // 'isvalealimentacao'=>str_replace(",",".",$dados['valor__alimentacao']),
            'tomador_id'=>$dados['tomador']
        ]);
    }
   public function editar($dados,$id)
   {
        return IndiceFatura::where('tomador_id', $id)
        ->update([
            'isalimentacao'=>str_replace(",",".",str_replace(".","",$dados['alimentacao'])),
            'istransporte'=>str_replace(",",".",str_replace(".","",$dados['transporte'])),
            'isepi'=>str_replace(",",".",str_replace(".","",$dados['epi'])),
            'isseguroportrabalhador'=>str_replace(",",".",str_replace(".","",$dados['seguro__trabalhador'])),
            // 'isindecesobrefolha'=>$dados['indice__folha'],
            // 'isvaletransporte'=>str_replace(",",".",$dados['valor__transporte']),
            // 'isvalealimentacao'=>str_replace(",",".",$dados['valor__alimentacao']),
        ]);
   }
   public function deletar($id)
    {
      return IndiceFatura::where('tomador_id', $id)->delete();
    }
}
