<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FaturaRubrica extends Model
{
    protected $fillable = [
        'rsitem', 'rsdescricao', 'riunidade', 'ripreco', 'ritotal', 'fatura'
    ];
    public function cadastro($dados)
    {
        return FaturaRubrica::create([
            'rsitem'=>$dados['item'],
            'rsdescricao'=>$dados['descricao'],
            'riunidade'=>$dados['unidade'],
            'ripreco'=>$dados['preco'],
            'ritotal'=>$dados['total'],
            'fatura'=>$dados['fatura']
        ]);
    }
    public function buscaRelatorio($fatura)
    {
        return FaturaRubrica::where('fatura',$fatura)
        ->get();

    }
    public function deletarFatura($id)
    {
        return FaturaRubrica::where('fatura',$id)->delete();
    }
}
