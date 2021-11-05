<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Empresa extends Model
{
    protected $fillable = [
        'esnome','escnpj','esdataregitro','esresponsavel','esemail','escnae','escondicaosindicato','esretemferias','essindicalizado','escodigomunicipio','user'
    ];
    public function cadastro($dados)
    {
       return Empresa::create([
            'esnome'=>$dados['nome'],
            'escnpj'=>$dados['cnpj_mf'],
            'esdataregitro'=>$dados['dataregistro'],
            'esresponsavel'=>$dados['responsave'],
            'esemail'=>$dados['email'],
            'escnae'=>$dados['cnae__codigo'],
            'escondicaosindicato'=>$dados['contribuicao__sindicato'],
            'esretemferias'=>$dados['retem__ferias'],
            'essindicalizado'=>$dados['sincalizado'],
            'escodigomunicipio'=>$dados['cod__municipio'],
            

        ]);
    }
    public function first($id)
    {
       return DB::table('empresas')
            ->join('enderecos', 'empresas.id', '=', 'enderecos.empresa')
            ->join('valores_rublicas', 'empresas.id', '=', 'valores_rublicas.empresa')
            ->select(
                'empresas.*', 
                'enderecos.*',
                'valores_rublicas.*',
            )
            ->where('esnome', $id)
            ->orWhere('empresas.id', $id)
            ->first();
    }
    public function editar($dados,$id)
    {
        return Empresa::where('id', $id)
        ->update([
            'esnome'=>$dados['nome'],
            'escnpj'=>$dados['cnpj_mf'],
            'esdataregitro'=>$dados['dataregistro'],
            'esresponsavel'=>$dados['responsave'],
            'esemail'=>$dados['email'],
            'escnae'=>$dados['cnae__codigo'],
            'escondicaosindicato'=>$dados['contribuicao__sindicato'],
            'esretemferias'=>$dados['retem__ferias'],
            'essindicalizado'=>$dados['sincalizado'],
            'escodigomunicipio'=>$dados['cod__municipio'],
        ]);
    }
    public function deletar($id)
    {
        return Empresa::where('id', $id)->delete();
    }
}
