<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class FaturaPrincipal extends Model
{
    protected $fillable = [
        'dsdescricao', 'fiindece', 'fivalor', 'fatura_id'
    ];
    public function fatura()
    {
        return $this->belongsTo(Fatura::class);
    }
    public function cadastro($dados)
    {
        return FaturaPrincipal::create([
            'dsdescricao'=>$dados['descricao'],
            'fiindece'=>$dados['indice'],
            'fivalor'=>$dados['valor'],
            'fatura_id'=>$dados['fatura']
        ]);
    }
    public function buscaRelatorio($fatura)
    {
        return FaturaPrincipal::where('fatura_id',$fatura)
        ->get();

    }
    public function deletarFatura($id)
    {
        return FaturaPrincipal::where('fatura_id',$id)->delete();
    }
}
