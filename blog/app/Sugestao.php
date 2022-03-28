<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sugestao extends Model
{
    protected $fillable = [
        'ssdescricao','ssicon','empresa'
    ];
    public function cadastro($dados)
    {
        return Sugestao::create([
            'ssdescricao'=>$dados['feedbackText'],
            'ssicon'=>$dados['icon'],
            'empresa'=>$dados['empresa'],
        ]);
    }
}
