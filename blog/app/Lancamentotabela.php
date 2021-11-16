<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lancamentotabela extends Model
{
    protected $fillable = [
        'liboletim','lsdata','lsnumero','tomador'
    ];
    public function cadastro($dados)
    {
       return Lancamentotabela::create([
            'liboletim'=>$dados['num__boletim'],
            'lsdata'=>$dados['data'],
            'lsnumero'=>$dados['num__trabalhador'],
            'tomador'=>$dados['tomador'],
        ]);
    }
}
