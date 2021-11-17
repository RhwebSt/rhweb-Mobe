<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CartaoPonto extends Model
{
    protected $fillable = [
        'csdiasuteis','cssabados','csdomingos','tomador'
    ];
    public function cadastro($dados)
    {
        
       return CartaoPonto::create([
            'csdiasuteis'=>$dados['dias_uteis'],
            'cssabados'=>$dados['sabados'],
            'csdomingos'=>$dados['domingos'],
            'tomador'=>$dados['tomador']
        ]);
    }
    public function editar($dados,$id)
    {
        return CartaoPonto::where('tomador', $id)
        ->update([
            'csdiasuteis'=>$dados['dias_uteis'],
            'cssabados'=>$dados['sabados'],
            'csdomingos'=>$dados['domingos'],
        ]);
    }
    public function deletar($id)
    {
      return CartaoPonto::where('tomador', $id)->delete();
    }
}
