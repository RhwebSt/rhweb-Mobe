<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Epi extends Model
{
    protected $fillable = [
        'eiquantidade', 'esdescricao', 'estm', 'eica', 'esdatares', 'esdatadev', 'trabalhador_id'
    ];
    public function trabalhador()
    {
        return $this->belongsTo(Trabalhador::class);
    }
    public function cadastro($dados,$i)
    {
        return Epi::create([
            'eiquantidade'=>$dados['quantidade'.$i],
            'esdescricao'=>$dados['descricao'.$i],
            'estm'=>$dados['tamanho'.$i],
            'eica'=>$dados['ca'.$i],
            'esdatares'=>$dados['data__recolhimento'.$i],
            'esdatadev'=>$dados['data__devolucao'.$i],
            'trabalhador_id'=>base64_decode($dados['trabalhador']),
        ]);
    }
    public function buscalista($id)
    {
        return Epi::where('trabalhador_id',base64_decode($id))->get();
    }
    public function deletar($id)
    {
        return Epi::where('id',$id)->delete();
    }
    public function deletar_cadastra($trabalhador)
    {
        return Epi::where('trabalhador_id',base64_decode($trabalhador))->delete();
    }
}
