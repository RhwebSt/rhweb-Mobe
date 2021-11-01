<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ValoresRublica extends Model
{
    protected $fillable = [
        'vsvttrabalhador','vsvatrabalhador','vsnrofatura','vsreciboavulso','vsmatricula','vsnrorequisicao','vsnroboletins','vsnrocartaoponto','vsnroequesocial','vsnroflha','vscbo','empresa'
    ];
    public function cadastro($dados)
    {
        return ValoresRublica::create([
            'vsvttrabalhador'=>$dados['vt__trabalhador'],
            'vsvatrabalhador'=>$dados['va__trabalhador'],
            'vsnrofatura'=>$dados['nro__fatura'],
            'vsreciboavulso'=>$dados['nro__reciboavulso'],
            'vsmatricula'=>$dados['matric__trabalhador'],
            'vsnrorequisicao'=>$dados['nro__requisicao'],
            'vsnroboletins'=>$dados['nro__boletins'],
            'vscbo'=>$dados['cbo'],
            'vsnrocartaoponto'=>$dados['nro__cartaoponto'],
            'vsnroequesocial'=>$dados['seq__esocial'],
            'vsnroflha'=>$dados['nro__folha'],
            'empresa'=>$dados['empresa'],
        ]);
    }
}
