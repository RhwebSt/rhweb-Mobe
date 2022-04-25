<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaxaTrabalhador extends Model
{
    protected $fillable = [
        'tsferias','tsdecimo13','tsrsr','das','tomador_id'
    ];
    public function cadastro($dados)
    {
        
       return TaxaTrabalhador::create([
            'tsferias'=>str_replace(",",".",$dados['ferias_trab']),
            'tsdecimo13'=>str_replace(",",".",$dados['13__saltrab']),
            'tsrsr'=>str_replace(",",".",$dados['rsr']),
            'das'=>str_replace(",",".",$dados['das']),
            'tomador_id'=>$dados['tomador']
        ]);
    }
    public function editar($dados,$id)
    {
       return TaxaTrabalhador::where('tomador_id', $id)
      ->update([
        'tsferias'=>str_replace(",",".",$dados['ferias_trab']),
        'tsdecimo13'=>str_replace(",",".",$dados['13__saltrab']),
        'tsrsr'=>str_replace(",",".",$dados['rsr']),
        'das'=>str_replace(",",".",$dados['das']),
    ]);
    }
    public function deletar($id)
    {
      return TaxaTrabalhador::where('tomador', $id)->delete();
    }
}
