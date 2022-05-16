<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class AvusoDescricao extends Model
{
    protected $fillable = [
        'asdescricao', 'aivalor', 'asstatus', 'avuso_id'
    ];
    public function avuso()
    {
        return $this->belongsTo(Avuso::class);
    }
       public function cadastro($dados,$i)
       {
           
           return AvusoDescricao::create([
               'asdescricao'=>$dados['descricao'.$i],
               'aivalor'=>str_replace(",",".",str_replace(".","",$dados['valor'.$i])),
               'asstatus'=>$dados['cd'.$i],
               'avuso_id'=>$dados['avuso']
           ]);
       }
       public function listaRecibo($avuso)
       {
           return AvusoDescricao::where('avuso_id',$avuso)->get();
       }

       public function listaReciboTrabalhador($avuso)
       {
           return DB::table('avusos')
           ->rightJoin('avuso_descricaos', 'avusos.id', '=', 'avuso_descricaos.avuso_id')
           ->select('avusos.aicodigo','avuso_descricaos.asstatus','avusos.created_at','avuso_descricaos.aivalor')
           ->where('avuso_id',$avuso)
           ->get();
       }
       public function deletarAvuso($id)
       {
           return AvusoDescricao::where('avuso_id',$id)->delete();
       }
}
