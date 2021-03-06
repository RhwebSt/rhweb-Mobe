<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Rublica extends Model
{
    protected $fillable = [
        'rsrublica','rsdescricao','rsincidencia','rsdc','empresa_id'
    ];
    public function cadastro($dados)
    {
       return Rublica::create([
            'rsrublica'=>$dados['rubricas'],
            'rsdescricao'=>$dados['descricao'],
            'rsincidencia'=>$dados['incidencia'],
            'rsdc'=>$dados['dc'],
            'empresa_id'=>$dados['empresa'],
        ]);
    }
    public function editar($dados,$id)
    {
        return Rublica::where('id', $id)
        ->update([
            'rsrublica'=>$dados['rubricas'],
            'rsdescricao'=>$dados['descricao'],
            'rsincidencia'=>$dados['incidencia'],
            'rsdc'=>$dados['dc'],
        ]);
    }
    public function deletar($id)
    {
        return Rublica::where('id', $id)->delete();
    }
    public function buscaTabelaPreco($tomador)
    {
        return DB::table('rublicas')
        ->join('tabela_precos', 'rublicas.rsrublica', '=', 'tabela_precos.tsrubrica_id')
        ->select('tabela_precos.tsrubrica','rublicas.rsincidencia')
        ->where('tabela_precos.tomador_id',$tomador)
        ->get();

    }
    public function buscaListaRublica($id)
    {
        return Rublica::where(function($query) use ($id){
            $user = auth()->user();
            if ($user->hasPermissionTo('admin') && $id) {
                $query->where('rsrublica','like','%'.$id.'%')
                ->orWhere('rsdescricao','like','%'.$id.'%');
            }else if ($user->hasPermissionTo('admin') && empty($id)) {
                $query->where('id','>',0);
            }
        })->get();
    }
    public function buscaUnidadeRublica($id)
    {
        return Rublica::where(function($query) use ($id){
            $user = auth()->user();
            if ($user->hasPermissionTo('admin') && $id) {
                $query->where('rsrublica',$id)
                ->orWhere('rsdescricao',$id);
            }
        })->first();
    }
    public function editarRublicas($id)
    {
        return Rublica::where(function($query) use ($id){
            $user = auth()->user();
            if ($user->hasPermissionTo('admin') && $id) {
                $query->where('id',$id);
            }
        })->first();
    }
    public function lista($dados,$condicao)
    {
        return Rublica::where(function($query) use ($dados){
            if ($dados) {
                $query->where('rsrublica','like','%'.$dados.'%')
                ->orWhere('rsdescricao','like','%'.$dados.'%');
            }else{
                $query->where('id','>',0);
            }
        })
        ->orderBy('rsrublica', $condicao)
        ->paginate(5);
    }
    public function listaRublicas()
    {
        return Rublica::whereBetween('rsrublica',[1000,1007])
        ->get();
    }
    public function listaRublicaTabelaPreco()
    {
        return Rublica::whereBetween('rsrublica',[1000,1005])
        ->orderBy('rsrublica', 'ASC')
        ->get();
    }
    public function listaGeral()
    {
        return Rublica::orderBy('rsrublica', 'asc')->get();
    }
    public function buscaRublicaUnidade($descricao)
    {
        return Rublica::where('rsdescricao',$descricao)->first();
    }
}
