<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class AvusoDescricao extends Model
{
    protected $fillable = [
        'asdescricao', 'aivalor', 'asstatus', 'avuso'
    ];
       public function cadastro($dados,$i)
       {
           
           return AvusoDescricao::create([
               'asdescricao'=>$dados['descricao'.$i],
               'aivalor'=>str_replace(",",".",$dados['valor'.$i]),
               'asstatus'=>$dados['cd'.$i],
               'avuso'=>$dados['avuso']
           ]);
       }
       public function listaRecibo($avuso)
       {
           return AvusoDescricao::where('avuso',$avuso)->get();
       }

       public function listaReciboTrabalhador($avuso)
       {
           return DB::table('avusos')
           ->rightJoin('avuso_descricaos', 'avusos.id', '=', 'avuso_descricaos.avuso')
           ->select('avusos.aicodigo','avuso_descricaos.asstatus','avusos.created_at','avuso_descricaos.aivalor')
           ->where('avuso',$avuso)
           ->get();
       }
       public function deletarAvuso($id)
       {
           return AvusoDescricao::where('avuso',$id)->delete();
       }
}
