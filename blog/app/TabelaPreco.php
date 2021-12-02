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
    public function first($id)
    {
        return TabelaPreco::where(function($query) use ($id){
            $user = auth()->user();
            if ($user->hasPermissionTo('admin')) {
                $query->where('tsrubrica','like', '%'.$id.'%')
                ->orWhere('tsdescricao', 'like', '%'.$id.'%')
                ->orWhere('id',$id);
            }else{
                 $query->where([
                        ['tsrubrica',$id],
                        ['empresa', $user->empresa]
                    ])
                    ->orWhere([
                        ['tsdescricao',$id],
                        ['empresa', $user->empresa],
                    ])
                    ->orWhere([
                        ['id',$id],
                        ['empresa', $user->empresa],
                    ]);
            }
           
        })
        ->first();
    }
    public function get($id)
    {
        return TabelaPreco::where(function($query) use ($id){
            $user = auth()->user();
            if ($user->hasPermissionTo('admin')) {
                $query->where('tsrubrica','like', '%'.$id.'%')
                ->orWhere('tsdescricao', 'like', '%'.$id.'%')
                ->orWhere('tomador',$id);
            }else{
                 $query->where([
                        ['tsrubrica',$id],
                        ['empresa', $user->empresa]
                    ])
                    ->orWhere([
                        ['tsdescricao',$id],
                        ['empresa', $user->empresa],
                    ])
                    ->orWhere([
                        ['tomador',$id],
                        ['empresa', $user->empresa],
                    ]);
            }
           
        })
        ->get();
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
}
