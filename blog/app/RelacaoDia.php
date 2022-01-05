<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RelacaoDia extends Model
{
    protected $fillable = [
        'rsdia','rivalor','basecalculo'
    ];
    public function cadastro($dia,$valor,$basecalculo)
    {
        return RelacaoDia::create([
            'rsdia'=>$dia,
            'rivalor'=>$valor,
            'basecalculo'=>$basecalculo,
        ]);
    }
}
