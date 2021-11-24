<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lancamentotabela extends Model
{
    protected $fillable = [
        'liboletim','lsdata','lsnumero','tomador'
    ];
    public function cadastro($dados)
    {
       return Lancamentotabela::create([
            'liboletim'=>$dados['liboletim'],
            'lsdata'=>$dados['data'],
            'lsnumero'=>$dados['num__trabalhador'],
            'tomador'=>$dados['tomador'],
        ]);
    }
    public function listacomun($id)
    {
        return Lancamentotabela::where('liboletim',$id)->first();
    }
    public function editar($dados,$id)
    {
        return Lancamentotabela::where('id', $id)
        ->update([
            'liboletim'=>$dados['liboletim'],
            'lsdata'=>$dados['data'],
            'lsnumero'=>$dados['num__trabalhador'],
        ]);
    }
    public function deletar($id)
    {
      return Lancamentotabela::where('id', $id)->delete();
    }
}
