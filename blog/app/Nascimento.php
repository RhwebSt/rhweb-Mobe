<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nascimento extends Model
{
    protected $fillable = [
        'nsnascimento','nscivil','nsnaturalidade','nsraca','nsnacionalidade','trabalhador_id'
    ];
    public function trabalhador()
    {
        return $this->belongsTo(Trabalhador::class);
    }
    public function cadastro($dados)
    {
       return Nascimento::create([
            'nsnascimento'=>$dados['data_nascimento'],
            'nsraca'=>$dados['raca'],
            'nscivil'=>$dados['estado__civil'],
            'nsnaturalidade'=>$dados['pais__nascimento'],
            'nsnacionalidade'=>$dados['pais__nacionalidade'],
            'trabalhador_id'=>$dados['trabalhador'],
        ]);
    }
    public function editar($dados,$id)
    {
        return Nascimento::where('trabalhador_id', $id)
        ->update([
            'nsnascimento'=>$dados['data_nascimento'],
            'nscivil'=>$dados['estado__civil'],
            'nsraca'=>$dados['raca'],
            'nsnaturalidade'=>$dados['pais__nascimento'],
            'nsnacionalidade'=>$dados['pais__nacionalidade']
        ]);
    }
    public function deletar($id)
    {
        return Nascimento::where('trabalhador_id', $id)->delete();
    }
}
