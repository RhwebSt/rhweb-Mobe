<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TabelaPreco extends Model
{
    protected $fillable = [
        'tsano','tsrubrica','tsdescricao','tsvalor','empresa','tomador'
    ];

    public function cadastro($dados)
    {
        return TabelaPreco::create([
            'tsano'=>$dados['ano'],
            'tsrubrica'=>$dados['rubricas'],
            'tsdescricao'=>$dados['descricao'],
            'tsvalor'=>str_replace(",",".",$dados['valor']),
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
                ->orWhere('tsdescricao', 'like', '%'.$id.'%');
            }else{
                 $query->where([
                        ['tsrubrica',$id],
                        ['empresa', $user->empresa]
                    ])
                    ->orWhere([
                        ['tsdescricao',$id],
                        ['empresa', $user->empresa],
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
        ]);
    }
    public function deletar($id)
    {
        return TabelaPreco::where('id', $id)->delete();
    }
}
