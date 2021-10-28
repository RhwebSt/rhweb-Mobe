<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaxaTrabalhador extends Model
{
    protected $fillable = [
        'tsferias','tsdecimo13','tsrsr','das'
    ];
    public function cadastro($dados)
    {
        
       return TaxaTrabalhador::create([
            'tsferias'=>$dados['ferias_trab'],
            'tsdecimo13'=>$dados['13__saltrab'],
            'tsrsr'=>$dados['rsr'],
            'das'=>$dados['das'],
            'tomador'=>$dados['tomador']
        ]);
    }
    public function editar($dados)
    {
        TaxaTrabalhador::where('id', $dados['id'])
      ->update([
        'tsferias'=>$dados['ferias_trab'],
        'tsdecimo13'=>$dados['13__saltrab'],
        'tsrsr'=>$dados['rsr'],
        'das'=>$dados['das'],
    ]);
    }
}
