<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FaturaRubrica extends Model
{
    protected $fillable = [
        'rsitem', 'rsdescricao', 'riunidade', 'ripreco', 'ritotal', 'fatura_id'
    ];
    public function fatura()
    {
        return $this->belongsTo(Fatura::class);
    }
    public function cadastro($dados)
    {
        // dd($dados);
        return FaturaRubrica::create([
            'rsitem'=>$dados['item'],
            'rsdescricao'=>$dados['descricao'],
            'riunidade'=>$dados['unidade'],
            'ripreco'=>$dados['preco'],
            'ritotal'=>$dados['total'],
            'fatura_id'=>$dados['fatura']
        ]);
    }
    public function buscaRelatorio($fatura)
    {
        return FaturaRubrica::where('fatura_id',$fatura)
        ->get();

    }
    public function deletarFatura($id)
    {
        return FaturaRubrica::where('fatura_id',$id)->delete();
    }
}
