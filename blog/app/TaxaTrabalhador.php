<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaxaTrabalhador extends Model
{
    protected $fillable = [
        'tsferias','tsdecimo13','tsrsr','das','tomador'
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
    public function editar($dados,$id)
    {
       return TaxaTrabalhador::where('tomador', $id)
      ->update([
        'tsferias'=>$dados['ferias_trab'],
        'tsdecimo13'=>$dados['13__saltrab'],
        'tsrsr'=>$dados['rsr'],
        'das'=>$dados['das'],
    ]);
    }
    public function deletar($id)
    {
      return TaxaTrabalhador::where('tomador', $id)->delete();
    }
}
