<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FaturaDemostrativa extends Model
{
    protected $fillable = [
        'dsdescricao', 'fiindece', 'fivalor', 'fatura'
    ];
    public function cadastro($dados)
    {
        return FaturaDemostrativa::create([
            'dsdescricao'=>$dados['descricao'],
            'fivalor'=>$dados['valor'],
            'fatura'=>$dados['fatura']
        ]);
    }
    public function buscaRelatorio($fatura)
    {
        return FaturaDemostrativa::where('fatura',$fatura)
        ->get();

    }
    public function deletarFatura($id)
    {
        return FaturaDemostrativa::where('fatura',$id)->delete();
    }
}
