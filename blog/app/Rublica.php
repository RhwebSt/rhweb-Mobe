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
    public function first($id)
    {
        return Rublica::where('id',$id)->get();
    }
    public function listarublica($id)
    {
        return Rublica::where('rsrublica','like','%'.$id.'%')->orWhere('rsdescricao','like','%'.$id.'%')->get();
    }
}
