<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CartaoPonto extends Model
{
    protected $fillable = [
        'csdiasuteis','cssabados','csdomingos','tomador_id'
    ];
    public function tomador()
    {
        return $this->belongsTo(Tomador::class);
    }
    public function cadastro($dados)
    {
        
       return CartaoPonto::create([
            'csdiasuteis'=>$dados['dias_uteis'],
            'cssabados'=>$dados['sabados'],
            'csdomingos'=>$dados['domingos'],
            'tomador_id'=>$dados['tomador']
        ]);
    }
    public function editar($dados,$id)
    {
        return CartaoPonto::where('tomador_id', $id)
        ->update([
            'csdiasuteis'=>$dados['dias_uteis'],
            'cssabados'=>$dados['sabados'],
            'csdomingos'=>$dados['domingos'],
        ]);
    }
    public function buscaTomador($id)
    {
        return CartaoPonto::whereIn('tomador_id', $id)->get();
    }
    public function buscaUnidadeTomador($id)
    {
        return CartaoPonto::where('tomador_id', $id)->first();
    }
    public function deletar($id)
    {
      return CartaoPonto::where('tomador_id', $id)->delete();
    }
}
