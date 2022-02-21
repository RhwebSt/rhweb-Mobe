<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FaturaTotal extends Model
{
    protected $fillable = [
        'fstitulo', 'fivalor', 'fatura'
    ];
    public function cadastro($dados)
    {
        return FaturaTotal::create([
            'fstitulo'=>$dados['descricao'],
            'fivalor'=>$dados['valor'],
            'fatura'=>$dados['fatura']
        ]);
    }
    public function buscaRelatorio($fatura)
    {
        return FaturaTotal::where('fatura',$fatura)
        ->get();

    }
    public function deletarFatura($id)
    {
        return FaturaTotal::where('fatura',$id)->delete();
    }
}
