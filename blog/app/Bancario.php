<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bancario extends Model
{
    protected $fillable = [
        'bstitular','bsbanco','bsagencia','bsoperacao','bsconta','bspix','bsdefaltor','tomador','trabalhador'
    ];
    public function cadastro($dados)
    {
        
       return Bancario::create([
            'bstitular'=>$dados['nome__conta'],
            'bsbanco'=>$dados['banco'],
            'bsagencia'=>$dados['agencia'],
            'bsoperacao'=>$dados['operacao'],
            'bsconta'=>$dados['conta'],
            'bspix'=>$dados['pix'],
            'bsdefaltor'=>$dados['deflator'],
            'tomador'=>$dados['tomador'],
            'trabalhador'=>$dados['trabalhador']
        ]);
    }
}
