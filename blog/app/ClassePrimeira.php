<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClassePrimeira extends Model
{
    protected $fillable = [
        'cscodigo', 'csdescricao', 'classes'
    ];
    public function cadastro($dados)
    {
       return ClassePrimeira::create([
            // 'cscodigo'=>$dados['codigo__cbo'],
            'csdescricao'=>$dados['texto1'],
            'classes'=>$dados['classes']
        ]);
    }
    public function atualizar($dados, $id)
    {
        return ClassePrimeira::where('classes', $id)
        ->update([
            'csdescricao'=>$dados['texto1'],
        ]);
    }
}
