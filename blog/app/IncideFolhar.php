<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IncideFolhar extends Model
{
    protected $fillable = [
        'insalimentacao','instransporte','instipotrans','instipoali','tomador_id'
    ];
    public function tomador()
    {
        return $this->belongsTo(Tomador::class);
    }
    public function cadastro($dados)
    {
        return IncideFolhar::create([
            'insalimentacao'=> $dados['folharalim']?str_replace(",",".",str_replace(".","",$dados['folharalim'])):0,
            'instransporte'=>$dados['folhartransporte']?str_replace(",",".",str_replace(".","",$dados['folhartransporte'])):0,
            // 'instipotrans'=>str_replace(",",".",str_replace(".","",$dados['folhartipotrans'])),
            // 'instipoali'=>str_replace(",",".",str_replace(".","",$dados['folhartipoalim'])),
            'tomador_id'=>$dados['tomador']
        ]);
    }
    public function editar($dados,$id)
   {
        return IncideFolhar::where('tomador_id', $id)
        ->update([
            'insalimentacao'=>str_replace(",",".",str_replace(".","",$dados['folharalim'])),
            'instransporte'=>str_replace(",",".",str_replace(".","",$dados['folhartransporte'])),
            'instipotrans'=>str_replace(",",".",str_replace(".","",$dados['folhartipotrans'])),
            'instipoali'=>str_replace(",",".",str_replace(".","",$dados['folhartipoalim'])),
        ]);
   }
   public function deletar($id)
   {
     return IncideFolhar::where('tomador_id', $id)->delete();
   }
   public function busca_va_vt($id)
   {
        return IncideFolhar::whereIn('tomador_id', $id)->get();
   }
   public function buscaUnidade_va_vt($id)
   {
    return IncideFolhar::where('tomador_id', $id)->first();
   }
}
