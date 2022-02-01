<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FaturaDemostrativa extends Model
{
    protected $fillable = [
        'dsdescricao', 'fiindece', 'fivalor', 'fatura'
    ];
    public function cadastro($dados)
    {
        return FaturaDemostrativa::create([
            'fsdescricao'=>$dados['descricao'],
            'fivalor'=>$dados['valor'],
            'fatura'=>$dados['fatura']
        ]);
    }
}
