<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BaseCalculo extends Model
{
    protected $fillable = [
        'biservico','biservicodsr','biinss','bifgts','bifgtsmes','biirrf','bifaixairrf','binumfilhos','bitotaldiaria','bivalorliquido','bivalorvencimento','bivalordesconto','bsadinortuno','trabalhador','tomador','folhar'
    ];
    public function cadastro($dados,$depedentes,$tomador,$folhar = null,$i)
    {
        return BaseCalculo::create([
            'biservico'=>$dados['salario']['valor'][$i],
            'biservicodsr'=>$dados['serviso_dsr']['valor'][$i],
            'biinss'=>$dados['base_inss']['valor'][$i],
            'bifgts'=>$dados['base_fgts']['valor'][$i],
            'bifgtsmes'=>$dados['fgts_mes']['valor'][$i],
            'biirrf'=>$dados['base_irrf']['valor'][$i],
            'bifaixairrf'=>$dados['base_irrf']['valor'][$i],
            'binumfilhos'=>$depedentes[$i]->depedentes,
            'bitotaldiaria'=>$dados['salario']['valor'][$i],
            'bivalorliquido'=>$dados['vencimento']['valor'][$i] - $dados['novodesconto']['valor'][$i],
            'bivalorvencimento'=>$dados['vencimento']['valor'][$i],
            'bivalordesconto'=>$dados['novodesconto']['valor'][$i],
            // 'bsadinortuno'=>'',
            'trabalhador'=>$dados['salario']['id'][$i],
            'tomador'=>$tomador,
            'folhar'=>$folhar,
        ]);
    }
}
