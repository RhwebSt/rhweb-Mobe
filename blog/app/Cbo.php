<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cbo extends Model
{
    protected $fillable = [
        'cscodigo', 'csdescricao', 'user'
    ];
    public function cadastro($dados)
    {
       return Cbo::create([
            'cscodigo'=>$dados['codigo__cbo'],
            'csdescricao'=>$dados['descricao__cbo'],
            'user'=>$dados['user']
        ]);
    }
    public function verificarCbo($codigo)
    {
        return Cbo::where('cscodigo',$codigo)->count();
    }
    public function buscaListaCbo($id,$condicao)
    {
        return Cbo::where(function($query) use ($id){
            if ($id) {
                $query->where('cscodigo','like','%'.$id.'%')
                ->orWhere('csdescricao','like','%'.$id.'%');
            }else{
                $query->where('id','>',0);
            }
        })
        ->orderBy('cscodigo', $condicao)
        ->paginate(10);
    }
    public function lista()
    {
        return Cbo::get();
    }
    public function editar($id)
    {
        return Cbo::where('id',$id)->first();
    }
    public function atualizar($dados, $id)
    {
        return Cbo::where('id', $id)
            ->update([
                'cscodigo'=>$dados['codigo__cbo'],
                'csdescricao'=>$dados['descricao__cbo'],
            ]);
    }
}
