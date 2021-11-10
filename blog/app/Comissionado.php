<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Comissionado extends Model
{
    protected $fillable = [
        'csmatricula','csindece','trabalhador','tomador'
    ];
    public function cadastro($dados)
    {
        
       return Comissionado::create([
            'csmatricula'=>$dados['matricula__trab'],
            'csindece'=>$dados['indice'],
            'tomador'=>$dados['tomador'],
            'trabalhador'=>$dados['trabalhador'],
        ]);
    }
    public function first($id)
    {
        return DB::table('comissionados')
        ->join('tomadors', 'tomadors.id', '=', 'comissionados.tomador')
        
        ->select(
            'tomadors.*', 
           'comissionados.*'
        )
        ->where(function($query) use ($id){
            $cargo =['admin'];
            $user = auth()->user();
            if (in_array($user->cargo,$cargo)) {
                $query->where('trabalhador', $id);
            }
        })
        ->first();
    }
    public function editar($dados,$id)
    {
        return Comissionado::where('id', $id)
        // ->orWhere('trabalhador', $id)
        // ->orWhere('empresa', $id)
        // ->orWhere('tomador', $id)
        ->update([
            'csmatricula'=>$dados['matricula__trab'],
            'csindece'=>$dados['indice'],
            'tomador'=>$dados['tomador'],
            'trabalhador'=>$dados['trabalhador'],
        ]);
    }
}
