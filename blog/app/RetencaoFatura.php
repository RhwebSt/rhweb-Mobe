<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RetencaoFatura extends Model
{
    protected $fillable = [
        'rsinssempresa','rsfgts','rsvalorfatura','tomador'
    ];
    public function cadastro($dados)
    {
        
       return RetencaoFatura::create([
            'rsinssempresa'=>$dados['inss__empresa'],
            'rsfgts'=>$dados['fgts__empresa'],
            'rsfgts'=>$dados['valor_fatura'],
            'tomador'=>$dados['tomador']
        ]);
    }
}
