<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Comissionado extends Model
{
    protected $fillable = [
        'csmatricula','csindece','trabalhador_id','tomador_id'
    ];
    public function cadastro($dados)
    {
        
       return Comissionado::create([
            'csmatricula'=>$dados['matricula__trab'],
            'csindece'=>$dados['indice'],
            'tomador_id'=>$dados['tomador'],
            'trabalhador_id'=>$dados['trabalhador'],
        ]);
    }
    public function verifica($dados) 
    {
        return Comissionado::where([
            ['tomador_id',$dados['tomador']],
            ['trabalhador_id',$dados['trabalhador']],
        ])->count();
    }
    public function first($id)
    {
        return DB::table('comissionados')
        ->join('tomadors', 'tomadors.id', '=', 'comissionados.tomador_id')
        
        ->select(
            'tomadors.*', 
           'comissionados.*'
        )
        ->where(function($query) use ($id){
            $user = auth()->user();
            $query->where('trabalhador_id', $id);
            // if ($user->hasPermissionTo('admin')) {
            //     $query->where('trabalhador', $id);
            // }
        })
        ->first();
    }
    public function pesquisas()
    {
        return DB::table('comissionados')
        ->join('trabalhadors', 'trabalhadors.id', '=', 'comissionados.trabalhador_id')
        ->select(
           'trabalhadors.tsnome', 
        )
        ->where(function($query){
            $user = auth()->user();
            $query->where('trabalhadors.empresa_id', $user->empresa_id);
        })
        ->get();
    }
    public function buscaListaComissionado($pesquisa)
    {
        return DB::table('comissionados')
        ->join('tomadors', 'tomadors.id', '=', 'comissionados.tomador_id')
        ->join('trabalhadors', 'trabalhadors.id', '=', 'comissionados.trabalhador_id')
        ->select(
            'tomadors.tsnome as tomador',
            'trabalhadors.tsnome as trabalhador',
            'trabalhadors.tsmatricula',
            'comissionados.csindece',
            'comissionados.id',
        )
        ->where(function($query) use($pesquisa){
            $user = auth()->user();
            if ($pesquisa) {
                $query->where([
                    ['trabalhadors.tsnome','like','%'.$pesquisa.'%'],
                    ['trabalhadors.empresa_id', $user->empresa_id]
                ])
                ->orWhere([
                    ['trabalhadors.tscpf','like','%'.$pesquisa.'%'],
                    ['trabalhadors.empresa_id', $user->empresa_id],
                ])
                ->orWhere([
                    ['trabalhadors.tsmatricula','like','%'.$pesquisa.'%'],
                    ['trabalhadors.empresa_id', $user->empresa_id],
                ]);
            }else {
                $query->where('trabalhadors.empresa_id',$user->empresa_id);
            }
           
        })
        ->paginate(10);
    }
    public function buscaUnidadeComissionado($id)
    {
        return DB::table('comissionados')
        ->join('tomadors', 'tomadors.id', '=', 'comissionados.tomador_id')
        ->join('trabalhadors', 'trabalhadors.id', '=', 'comissionados.trabalhador_id')
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
                ['trabalhadors.empresa_id',$user->empresa],
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
        return Comissionado::where('tomador_id', $id)->delete();
    }
    public function deletaTrabalhador($id)
    {
        return Comissionado::where('trabalhador_id', $id)->delete();
    }
    public function deletar($id)
    {
        return Comissionado::where('id', $id)->delete();
    }
}
