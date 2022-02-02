<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FaturaSecundaria extends Model
{
    protected $fillable = [
        'fsdescricao', 'fiindece', 'fivalor', 'fatura'
    ];
    public function cadastro($dados)
    {
        return FaturaSecundaria::create([
            'fsdescricao'=>$dados['descricao'],
            'fiindece'=>$dados['indice'],
            'fivalor'=>$dados['valor'],
            'fatura'=>$dados['fatura']
        ]);
    }
    public function buscaRelatorio($fatura)
    {
        return FaturaSecundaria::where('fatura',$fatura)
        ->get();

    }
    public function deletarFatura($id)
    {
        return FaturaSecundaria::where('fatura',$id)->delete();
    }
}
