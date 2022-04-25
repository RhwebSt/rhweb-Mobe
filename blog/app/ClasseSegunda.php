<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClasseSegunda extends Model
{
    protected $fillable = [
        'cscodigo', 'csdescricao', 'classes_id'
    ];
    public function cadastro($dados)
    {
       return ClasseSegunda::create([
            // 'cscodigo'=>$dados['codigo__cbo2'],
            'csdescricao'=>$dados['texto2'],
            'classes'=>$dados['classes']
        ]);
    }
    public function atualizar($dados, $id)
    {
        return ClasseSegunda::where('classes_id', $id)
        ->update([
            'csdescricao'=>$dados['texto2'],
        ]);
    }
}
