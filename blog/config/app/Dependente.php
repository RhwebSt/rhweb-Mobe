<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Dependente extends Model
{
    protected $fillable = [
        'dsnome','dstipo','dsdata','dscpf','dsirrf','dssexo','dssf','trabalhador'
    ];
    public function cadastro($dados)
    {
       return Dependente::create([
            'dsnome'=>$dados['nome__dependente'],
            'dstipo'=>$dados['tipo__dependente'],
            'dsdata'=>$dados['data__nascimento'],
            'dssexo'=>$dados['sexo'],
            'dscpf'=>$dados['dscpf'],
            'dsirrf'=>$dados['irrf'],
            'dssf'=>$dados['sf'],
            'trabalhador'=>$dados['trabalhador'],
        ]);
    }
    public function verificaCpf($dados)
    {
        return Dependente::where([
            ['trabalhador', $dados['trabalhador']],
            ['dscpf',$dados['dscpf']]
        ])->count();
    }
    public function quantidadeDependente($dados)
    {
        return Dependente::where('trabalhador', $dados['trabalhador'])->count();
    }
    public function buscaListaDepedente($id)
    {
        return Dependente::where('trabalhador', $id)->get();
    }
    public function buscaListaDepedenteInt($id)
    {
        return Dependente::select(DB::raw('count(*) as depedentes,trabalhador'))
        ->groupBy('trabalhador')
        ->whereIn('trabalhador', $id)
        ->get();
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
            'dscpf'=>$dados['dscpf'],
            'dssexo'=>$dados['sexo'],
            'dsirrf'=>$dados['irrf'],
            'dssf'=>$dados['sf'],
        ]);
    }
    public function deletar($id)
    {
        return Dependente::where('id', $id)->delete();
    }
    public function deletarTrabalhador($id)
    {
        return Dependente::where('trabalhador', $id)->delete();
    }
}
