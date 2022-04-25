<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FaturaDemostrativa extends Model
{
    protected $fillable = [
        'dsdescricao', 'fiindece', 'fivalor', 'fatura_id'
    ];
    public function cadastro($dados)
    {
        return FaturaDemostrativa::create([
            'dsdescricao'=>$dados['descricao'],
            'fivalor'=>$dados['valor'],
            'fatura_id'=>$dados['fatura']
        ]);
    }
    public function buscaRelatorio($fatura)
    {
        return FaturaDemostrativa::where('fatura_id',$fatura)
        ->get();

    }
    public function deletarFatura($id)
    {
        return FaturaDemostrativa::where('fatura_id',$id)->delete();
    }
}
