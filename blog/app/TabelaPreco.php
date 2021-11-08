<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TabelaPreco extends Model
{
    protected $fillable = [
        'tsano','tsrubrica','tsdescricao','tsvalor','empresa','tomador'
    ];

    public function cadastro($dados)
    {
        return TabelaPreco::create([
            'tsano'=>$dados['ano'],
            'tsrubrica'=>$dados['rubricas'],
            'tsdescricao'=>$dados['descricao'],
            'tsvalor'=>str_replace(",",".",$dados['valor']),
            'empresa'=>$dados['empresa'],
            'tomador'=>$dados['tomador']
        ]);
    }
    public function first($id)
    {
        return TabelaPreco::where('id', $id)->orWhere('tsdescricao', $id)->first();
    }
    public function editar($dados,$id)
    {
        return TabelaPreco::where('id', $id)
        ->update([
            'tsano'=>$dados['ano'],
            'tsrubrica'=>$dados['rubricas'],
            'tsdescricao'=>$dados['descricao'],
            'tsvalor'=>$dados['valor'],
        ]);
    }
    public function deletar($id)
    {
        return TabelaPreco::where('id', $id)->orWhere('tomador', $id)->delete();
    }
}
