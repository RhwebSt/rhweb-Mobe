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
            'fivalor'=>$dados['valor']?str_replace(",",".",$dados['valor']):0, 
            'fatura'=>$dados['fatura']
        ]);
    }
    public function buscaRelatorio($fatura)
    {
        return FaturaSecundaria::where('fatura',$fatura)
        ->where([
            ['fsdescricao','!=','Vale Transporte'],
            ['fsdescricao','!=','Vale Alimentação']
        ])
        ->get();

    }
    public function buscaRelatorioValesTrans($fatura)
    {
        return FaturaSecundaria::where([
            ['fatura',$fatura],
            ['fsdescricao','Vale Transporte'],
        ])
        ->get();
    }
    public function buscaRelatorioValesAlim($fatura)
    {
        return FaturaSecundaria::where([
            ['fatura',$fatura],
            ['fsdescricao','Vale Alimentação']
        ])
        ->get();
    }
    public function deletarFatura($id)
    {
        return FaturaSecundaria::where('fatura',$id)->delete();
    }
}
