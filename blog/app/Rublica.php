<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Rublica extends Model
{
    protected $fillable = [
        'rsrublica','rsdescricao','rsincidencia','rsdc','empresa'
    ];
    public function cadastro($dados)
    {
       return Rublica::create([
            'rsrublica'=>$dados['rubricas'],
            'rsdescricao'=>$dados['descricao'],
            'rsincidencia'=>$dados['incidencia'],
            'rscd'=>$dados['dc'],
            'empresa'=>$dados['empresa'],
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
        ->join('tabela_precos', 'rublicas.rsrublica', '=', 'tabela_precos.tsrubrica')
        ->select('tabela_precos.tsrubrica','rublicas.rsincidencia')
        ->where('tabela_precos.tomador',$tomador)
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
    public function lista()
    {
        return Rublica::paginate(5);
    }
    public function listaRublicas()
    {
        return Rublica::whereBetween('rsrublica',[1000,1007])
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
