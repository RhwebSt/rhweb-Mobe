<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comissionado extends Model
{
    protected $fillable = [
        'csmatricula','csindece','trabalhador','tomador'
    ];
    public function cadastro($dados)
    {
        
       return Comissionado::create([
            'csmatricula'=>$dados['matricula__trab'],
            'csindece'=>$dados['indice'],
            'tomador'=>$dados['tomador'],
            'trabalhador'=>$dados['trabalhador'],
        ]);
    }
    public function first($id)
    {
        return Comissionado::where('trabalhador', $id)->first();
    }
    public function editar($dados,$id)
    {
        return Comissionado::where('id', $id)
        // ->orWhere('trabalhador', $id)
        // ->orWhere('empresa', $id)
        // ->orWhere('tomador', $id)
        ->update([
            'csmatricula'=>$dados['matricula__trab'],
            'csindece'=>$dados['indice'],
            'tomador'=>$dados['tomador'],
            'trabalhador'=>$dados['trabalhador'],
        ]);
    }
}
