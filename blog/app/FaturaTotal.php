<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FaturaTotal extends Model
{
    protected $fillable = [
        'fstitulo', 'fivalor', 'fatura'
    ];
    public function cadastro($dados)
    {
        return FaturaTotal::create([
            'fstitulo'=>$dados['descricao'],
            'fivalor'=>$dados['valor'],
            'fatura'=>$dados['fatura']
        ]);
    }
}
