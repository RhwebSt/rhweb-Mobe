<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TabelaPreco extends Model
{
    protected $fillable = [
        'tsano','tsrubrica','tsdescricao','tsvalor','tstomvalor','empresa','tomador'
    ];

    public function cadastro($dados)
    {
        return TabelaPreco::create([
            'tsano'=>$dados['ano'],
            'tsrubrica'=>$dados['rubricas'],
            'tsdescricao'=>$dados['descricao'],
            'tsvalor'=>str_replace(",",".",$dados['valor']),
            'tstomvalor'=>str_replace(",",".",$dados['valor__tomador']),
            'empresa'=>$dados['empresa'],
            'tomador'=>$dados['tomador']
        ]);
    }
    public function buscaListaTabela($id,$tomador)
    {
        return TabelaPreco::where(function($query) use ($id,$tomador){
            $user = auth()->user();
            if ($user->hasPermissionTo('admin')) {
                $query->where([
                    ['tsrubrica','like',$id],
                    ['tomador',$tomador]
                ])
                ->orWhere([
                    ['tsdescricao', 'like', '%'.$id.'%'],
                    ['tomador',$tomador]
                ])
                ->orWhere('tomador',$tomador);
            }else{
                 $query->where([
                        ['tsrubrica','like',$id],
                        ['tomador',$tomador],
                        ['empresa', $user->empresa]
                    ])
                    ->orWhere([
                        ['tsdescricao','like',$id],
                        ['tomador',$tomador],
                        ['empresa', $user->empresa],
                    ])
                    ->orWhere([
                        ['tomador',$tomador],
                        ['empresa', $user->empresa],
                    ]);
            }
           
        })
        ->get();
    }
    public function lista($id)
    {
        return TabelaPreco::where(function($query) use ($id){
            $user = auth()->user();
            if ($user->hasPermissionTo('admin')) {
                $query->where('tomador',$id);
            }else{
                 $query->where([
                    ['tomador',$id],
                    ['empresa', $user->empresa]
                ]);
            }
           
        })
        ->get();
    }
    public function buscaUnidadeTabela($id,$tomador = null)
    {
        return TabelaPreco::where(function($query) use ($id,$tomador){
            $user = auth()->user();
            if ($user->hasPermissionTo('admin')) {
                $query->where([
                    ['tsrubrica',$id],
                    ['tomador',$tomador]
                ])
                ->orWhere([
                    ['tsdescricao',$id],
                    ['tomador',$tomador]
                ])
                ->orWhere('id',$id);
            }else{
                $query->where([
                    ['tsrubrica',$id],
                    ['tomador',$tomador],
                    ['empresa', $user->empresa]
                ])
                ->orWhere([
                    ['tsdescricao',$id],
                    ['tomador',$tomador],
                    ['empresa', $user->empresa],
                ])
                ->orWhere([
                    ['id',$id],
                    ['empresa', $user->empresa]
                ]);
            }
           
        })
        ->first();
    }
    public function editar($dados,$id)
    {
        return TabelaPreco::where('id', $id)
        ->update([
            'tsano'=>$dados['ano'],
            'tsrubrica'=>$dados['rubricas'],
            'tsdescricao'=>$dados['descricao'],
            'tsvalor'=>str_replace(",",".",$dados['valor']),
            'tstomvalor'=>str_replace(",",".",$dados['valor__tomador']),
        ]);
    }
    public function deletar($id)
    {
        return TabelaPreco::where('id', $id)->delete();
    }
    public function deletatomador($id)
    {
        return TabelaPreco::where('tomador', $id)->delete();
    }
}
