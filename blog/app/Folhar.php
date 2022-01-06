<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Folhar extends Model
{
    protected $fillable = [
        'fscodigo','fsinicio','fsfinal','empresa','created_at'
    ];
    public function cadastro($dados,$empresa){
        return Folhar::create([
            'fscodigo'=>$dados['codigo'],
            'fsinicio'=>$dados['inicio'],
            'fsfinal'=>$dados['final'],
            'empresa'=>$empresa
        ]);
    }
    public function buscaUltimaoRegistroFolhar($empresa)
    {
        return Folhar::orderBy('created_at', 'desc')->where('empresa',$empresa)->first();
    }
}
