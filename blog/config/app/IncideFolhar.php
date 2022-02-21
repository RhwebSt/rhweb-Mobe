<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IncideFolhar extends Model
{
    protected $fillable = [
        'insalimentacao','instransporte','instipotrans','instipoali','tomador'
    ];
    public function cadastro($dados)
    {
        return IncideFolhar::create([
            'insalimentacao'=>str_replace(",",".",$dados['folharalim']),
            'instransporte'=>str_replace(",",".",$dados['folhartransporte']),
            'instipotrans'=>str_replace(",",".",$dados['folhartipotrans']),
            'instipoali'=>str_replace(",",".",$dados['folhartipoalim']),
            'tomador'=>$dados['tomador']
        ]);
    }
    public function editar($dados,$id)
   {
        return IncideFolhar::where('tomador', $id)
        ->update([
            'insalimentacao'=>str_replace(",",".",$dados['folharalim']),
            'instransporte'=>str_replace(",",".",$dados['folhartransporte']),
            'instipotrans'=>str_replace(",",".",$dados['folhartipotrans']),
            'instipoali'=>str_replace(",",".",$dados['folhartipoalim']),
        ]);
   }
   public function deletar($id)
   {
     return IncideFolhar::where('tomador', $id)->delete();
   }
   public function busca_va_vt($id)
   {
        return IncideFolhar::whereIn('tomador', $id)->get();
   }
   public function buscaUnidade_va_vt($id)
   {
    return IncideFolhar::where('tomador', $id)->first();
   }
}
