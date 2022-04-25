<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FaturaTotal extends Model
{
    protected $fillable = [
        'fstitulo', 'fivalor', 'fatura_id'
    ];
    public function cadastro($dados)
    {
        return FaturaTotal::create([
            'fstitulo'=>$dados['descricao'],
            'fivalor'=>$dados['valor'],
            'fatura_id'=>$dados['fatura']
        ]);
    }
    public function buscaRelatorio($fatura)
    {
        return FaturaTotal::where('fatura_id',$fatura)
        ->get();

    }
    public function deletarFatura($id)
    {
        return FaturaTotal::where('fatura_id',$id)->delete();
    }
}
