<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class FaturaPrincipal extends Model
{
    protected $fillable = [
        'dsdescricao', 'fiindece', 'fivalor', 'fatura'
    ];
    public function cadastro($dados)
    {
        return FaturaPrincipal::create([
            'dsdescricao'=>$dados['descricao'],
            'fiindece'=>$dados['indice'],
            'fivalor'=>$dados['valor'],
            'fatura'=>$dados['fatura']
        ]);
    }
    public function buscaRelatorio($fatura)
    {
        return FaturaPrincipal::where('fatura',$fatura)
        ->get();

    }
    public function deletarFatura($id)
    {
        return FaturaPrincipal::where('fatura',$id)->delete();
    }
}
