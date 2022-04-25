<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bancario extends Model
{
    protected $fillable = [
        'bstitular','bsbanco','bsagencia','bsoperacao','bsconta','bspix','tomador_id','trabalhador_id'
    ];
    public function trabalhador()
    {
        return $this->belongsTo(Trabalhador::class);
    }
    public function tomador()
    {
        return $this->belongsTo(Tomador::class);
    }
    public function cadastro($dados)
    {
        
       return Bancario::create([
            // 'bstitular'=>$dados['nome__conta'],
            'bsbanco'=>$dados['banco'],
            'bsagencia'=>$dados['agencia'],
            'bsoperacao'=>$dados['operacao'],
            'bsconta'=>$dados['conta'],
            'bspix'=>$dados['pix'],
            'tomador_id'=>$dados['tomador'],
            'trabalhador_id'=>$dados['trabalhador']
        ]);
    }
    public function editar($dados,$id)
    {
        return Bancario::where('biid', $id)
        // ->orWhere('trabalhador', $id)
        ->update([
            // 'bstitular'=>$dados['nome__conta'],
            'bsbanco'=>$dados['banco'],
            'bsagencia'=>$dados['agencia'],
            'bsoperacao'=>$dados['operacao'],
            'bsconta'=>$dados['conta'],
            'bspix'=>$dados['pix'],
        ]);
    }
    public function first($id,$campo)
    {
        return Bancario::where($campo,$id)
        // ->orWhere('biid',$id)
        // ->orWhere(function($query) use ($id){
        //     $query->where('trabalhador', $id)
        //           ->whereNull('empresa')
        //           ->whereNull('tomador');
        // })
        // ->orWhere(function($query) use ($id){
        //     $query->where('tomador', $id)
        //           ->whereNull('empresa')
        //           ->whereNull('trabalhador');
        // })
        ->first();
    }
    public function deletar($id)
    {
      return Bancario::where('biid', $id)->delete();
    }
    public function deletarTrabalhador($id)
    {
        return Bancario::where('trabalhador_id', $id)->delete();
    }
    public function deletarTomador($id)
    {
        return Bancario::where('tomador_id', $id)->delete();
    }
}
