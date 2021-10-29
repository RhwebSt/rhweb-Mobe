<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Taxa extends Model
{
    protected $fillable = [
        'tftaxaadm','tfbenef','tfferias','tf13','tftaxafed','tomador'
    ];
    public function cadastro($dados)
    {
        return Taxa::create([
            'tftaxaadm'=>$dados['taxa_adm'],
            'tfbenef'=>$dados['caixa_benef'],
            'tfferias'=>$dados['ferias'],
            'tf13'=>$dados['13_salario'],
            'tftaxafed'=>$dados['taxa__fed'],
            'tomador'=>$dados['tomador']
        ]);
    }
    public function editar($dados,$id)
    {
      return Taxa::where('id', $id)
      ->update([
        'tftaxaadm'=>$dados['taxa_adm'],
        'tfbenef'=>$dados['caixa_benef'],
        'tfferias'=>$dados['ferias'],
        'tf13'=>$dados['13_salario'],
        'tftaxafed'=>$dados['taxa__fed']
    ]);
    }
    public function deletar($id)
    {
      return Taxa::where('tomador', $id)->delete();
    }
}
