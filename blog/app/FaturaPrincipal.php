<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FaturaPrincipal extends Model
{
    protected $fillable = [
        'dsdescricao', 'fiindece', 'fivalor', 'tomador', 'empresa'
    ];
    public function cadastro($dados)
    {
        return FaturaPrincipal::create([
            'dsdescricao'=>$dados['descricao'],
            'fiindece'=>$dados['indice'],
            'fivalor'=>$dados['valor'],
            'tomador'=>$dados['tomador'],
            'empresa'=>$dados['empresa'],
        ]);
    }
}
