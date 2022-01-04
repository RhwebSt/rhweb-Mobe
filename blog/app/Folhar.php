<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Folhar extends Model
{
    protected $fillable = [
        'fscodigo','fsinicio','fsfinal'
    ];
    public function cadastro($dados){
        return Folhar::create([
            'fscodigo'=>$dados['codigo'],
            'fsinicio'=>$dados['inicio'],
            'fsfinal'=>$dados['final']
        ]);
    }
}
