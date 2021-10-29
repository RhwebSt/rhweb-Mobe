<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RetencaoFatura extends Model
{
    protected $fillable = [
        'rsinssempresa','rsfgts','rsvalorfatura','tomador'
    ];
    public function cadastro($dados)
    {
        
       return RetencaoFatura::create([
            'rsinssempresa'=>$dados['inss__empresa'],
            'rsfgts'=>$dados['fgts__empresa'],
            'rsvalorfatura'=>$dados['valor_fatura'],
            'tomador'=>$dados['tomador']
        ]);
    }
    public function editar($dados,$id)
    {
        return RetencaoFatura::where('tomador', $id)
        ->update([
            'rsinssempresa'=>$dados['inss__empresa'],
            'rsfgts'=>$dados['fgts__empresa'],
            'rsvalorfatura'=>$dados['valor_fatura'],
      ]);
    }
    public function deletar($id)
    {
      return RetencaoFatura::where('tomador', $id)->delete();
    }
}
