<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RetencaoFatura extends Model
{
    protected $fillable = [
        'rsinssempresa','rstipoinssempresa','rsfgts','rstipofgts','rsvalorfatura','tomador'
    ];
    public function cadastro($dados)
    {
        
       return RetencaoFatura::create([
            'rsinssempresa'=>str_replace(",",".",$dados['inss__empresa']),
            'rsfgts'=>str_replace(",",".",$dados['fgts__empresa']),
            'rstipoinssempresa'=>$dados['retencaoinss'],
            'rstipofgts'=>$dados['retencaofgts'],
            'rsvalorfatura'=>$dados['valor_fatura'],
            'tomador'=>$dados['tomador']
        ]);
    }
    public function editar($dados,$id)
    {
        return RetencaoFatura::where('tomador', $id)
        ->update([
            'rsinssempresa'=>str_replace(",",".",$dados['inss__empresa']),
            'rsfgts'=>str_replace(",",".",$dados['fgts__empresa']),
            'rstipoinssempresa'=>$dados['retencaoinss'],
            'rstipofgts'=>$dados['retencaofgts'],
            'rsvalorfatura'=>$dados['valor_fatura'],
      ]);
    }
    public function deletar($id)
    {
      return RetencaoFatura::where('tomador', $id)->delete();
    }
}
