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
    public function verifica($dados) 
    {
        return Comissionado::where([
            ['tomador',$dados['tomador']],
            ['trabalhador',$dados['trabalhador']],
        ])->count();
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
            $user = auth()->user();
            if ($user->hasPermissionTo('admin')) {
                $query->where('trabalhador', $id);
            }
        })
        ->first();
    }
    public function buscaListaComissionado()
    {
        return DB::table('comissionados')
        ->join('tomadors', 'tomadors.id', '=', 'comissionados.tomador')
        ->join('trabalhadors', 'trabalhadors.id', '=', 'comissionados.trabalhador')
        ->select(
            'tomadors.tsnome as tomador',
            'trabalhadors.tsnome as trabalhador',
            'trabalhadors.tsmatricula',
            'comissionados.csindece',
            'comissionados.id',
        )
        ->where(function($query){
            $user = auth()->user();
            $query->where('trabalhadors.empresa',$user->empresa);
        })
        ->get();
    }
    public function buscaUnidadeComissionado($id)
    {
        return DB::table('comissionados')
        ->join('tomadors', 'tomadors.id', '=', 'comissionados.tomador')
        ->join('trabalhadors', 'trabalhadors.id', '=', 'comissionados.trabalhador')
        ->select(
            'tomadors.tsnome as tomador',
            'trabalhadors.tsnome as trabalhador',
            'trabalhadors.tsmatricula',
            'trabalhadors.id as idtrabalhador',
            'tomadors.id as idtomador',
            'comissionados.csindece',
            'comissionados.id',
        )
        ->where(function($query) use ($id){
            $user = auth()->user();
            $query->where([
                ['trabalhadors.empresa',$user->empresa],
                ['comissionados.id',$id]
            ]);
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
    public function deletaTomador($id)
    {
        return Comissionado::where('tomador', $id)->delete();
    }
    public function deletaTrabalhador($id)
    {
        return Comissionado::where('trabalhador', $id)->delete();
    }
    public function deletar($id)
    {
        return Comissionado::where('id', $id)->delete();
    }
}
