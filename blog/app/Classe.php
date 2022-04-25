<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Classe extends Model
{
    protected $fillable = [
        'cscodigo', 'csdescricao', 'user_id'
    ];
    public function cadastro($dados)
    {
       return Classe::create([
            'cscodigo'=>$dados['codigo__categoria'],
            'csdescricao'=>$dados['descricao__categoria'],
            'user_id'=>$dados['user']
        ]);
    }
    public function buscaListaCategoria($id,$condicao)
    {
        return DB::table('classes')
        ->join('classe_primeiras', 'classes.id', '=', 'classe_primeiras.classes_id')
        ->join('classe_segundas', 'classes.id', '=', 'classe_segundas.classes_id')
        ->select(
            'classes.id',
            'classes.cscodigo as codigo',
            'classes.csdescricao as descricao',
            'classe_primeiras.csdescricao as descricao1',
            'classe_segundas.csdescricao as descricao2'
        )
        ->where(function($query) use ($id){
            if ($id) {
                $query->where('classes.cscodigo','like','%'.$id.'%')
                ->orWhere('classes.csdescricao','like','%'.$id.'%');
            }else{
                $query->where('classes.id','>',0);
            }
        })
        ->orderBy('classes.cscodigo', $condicao)
        ->paginate(10);
    }
    public function lista()
    {
        return DB::table('classes')
        ->join('classe_primeiras', 'classes.id', '=', 'classe_primeiras.classes_id')
        ->join('classe_segundas', 'classes.id', '=', 'classe_segundas.classes_id')
        ->select(
            'classes.id',
            'classes.cscodigo as codigo',
            'classes.csdescricao as descricao',
            'classe_primeiras.csdescricao as descricao1',
            'classe_segundas.csdescricao as descricao2'
        )
        ->orderBy('classes.cscodigo','desc')
        ->get();
    }
    public function editar($id)
    {
        return DB::table('classes')
        ->join('classe_primeiras', 'classes.id', '=', 'classe_primeiras.classes_id')
        ->join('classe_segundas', 'classes.id', '=', 'classe_segundas.classes_id')
        ->select(
            'classes.id',
            'classes.cscodigo as codigo',
            'classes.csdescricao as descricao',
            'classe_primeiras.csdescricao as descricao1',
            'classe_segundas.csdescricao as descricao2'
        )
        ->where('classes.id',$id)
        ->first();
    }
    public function atualizar($dados, $id)
    {
        return Classe::where('id', $id)
        ->update([
            'cscodigo'=>$dados['codigo__categoria'],
            'csdescricao'=>$dados['descricao__categoria'],
        ]);
    }
}
