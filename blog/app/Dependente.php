<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dependente extends Model
{
    protected $fillable = [
        'dsnome','dstipo','dsdata','dscpf','dsirrf','dssf','trabalhador'
    ];
    public function cadastro($dados)
    {
       return Dependente::create([
            'dsnome'=>$dados['nome__dependente'],
            'dstipo'=>$dados['tipo__dependente'],
            'dsdata'=>$dados['data__nascimento'],
            'dscpf'=>$dados['cpf__dependente'],
            'dsirrf'=>$dados['irrf'],
            'dssf'=>$dados['sf'],
            'trabalhador'=>$dados['trabalhador'],
        ]);
    }
    public function buscaListaDepedente($id)
    {
        return Dependente::where('trabalhador', $id)->get();
    }
    public function buscaQuantidadeDepedente($id)
    {
        return Dependente::where('trabalhador', $id)->count();
    }
    public function buscaUnidadeDepedente($id)
    {
        return Dependente::where('id', $id)->first();
    }
    public function editar($dados,$id)
    {
        return Dependente::where('id', $id)
        ->update([
            'dsnome'=>$dados['nome__dependente'],
            'dstipo'=>$dados['tipo__dependente'],
            'dsdata'=>$dados['data__nascimento'],
            'dscpf'=>$dados['cpf__dependente'],
            'dsirrf'=>$dados['irrf'],
            'dssf'=>$dados['sf'],
        ]);
    }
    public function deletar($id)
    {
        return Dependente::where('id', $id)->delete();
    }
}
