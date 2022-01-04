<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BaseCalculo extends Model
{
    protected $fillable = [
        'biservico','biservicodsr','biinss','bifgts','bifgtsmes','biirrf','bifaixairrf','binumfilhos','bitotaldiaria','bivalorliquido','bivalorvencimento','bivalordesconto','bsadinortuno','trabalhador','tomador','folhar'
    ];
    public function cadastro($dados)
    {
        return BaseCalculo::create([
            'biservico'=>'',
            'biservicodsr'=>'',
            'biinss'=>'',
            'bifgts'=>'',
            'bifgtsmes'=>'',
            'biirrf'=>'',
            'bifaixairrf'=>'',
            'binumfilhos'=>'',
            'bitotaldiaria'=>'',
            'bivalorliquido'=>'',
            'bivalorvencimento'=>'',
            'bivalordesconto'=>'',
            'bsadinortuno'=>'',
            'trabalhador'=>'',
            'tomador'=>'',
            'folhar'=>'',
        ]);
    }
}
