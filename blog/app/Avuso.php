<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Avuso extends Model
{
    protected $fillable = [
     'asinicial', 'asfinal','aicodigo','ailiquido', 'trabalhador', 'tomador'
    ];
    public function cadastro($dados)
    {
        return Avuso::create([
            'asinicial'=>$dados['ano_inicial'],
            'asfinal'=>$dados['ano_final'],
            'aicodigo'=>$dados['codigo'],
            'ailiquido'=>$dados['liquido'],
            'tomador'=>$dados['tomador'],
            'trabalhador'=>$dados['trabalhador']
        ]);
    }
    public function buscaListaRecibos()
    {
        return DB::table('avusos')
        ->join('trabalhadors', 'trabalhadors.id', '=', 'avusos.trabalhador')
        ->join('tomadors', 'tomadors.id', '=', 'avusos.tomador')
        ->select(
            'trabalhadors.tsnome as trabalhador',
            'trabalhadors.tsmatricula',
            'tomadors.tsnome as tomador',
            'avusos.aicodigo',
            'avusos.asinicial',
            'avusos.asfinal',
            'avusos.id',
            'avusos.trabalhador as idtrabalhador'
        )
        ->where(function($query){
            $user = auth()->user();
            if ($user->hasPermissionTo('admin')) {
                $query->where('avusos.id','>',0);
            }else{
                $query->where('trabalhadors.empresa', $user->empresa);
            }
        })
        ->paginate(10);
    }
    public function buscaTrabalhador($id = null,$trabalhador,$inicio = null,$final = null)
    {
        return DB::table('avusos')
        ->join('trabalhadors', 'trabalhadors.id', '=', 'avusos.trabalhador')
        ->join('empresas', 'empresas.id', '=', 'trabalhadors.empresa')
        ->join('enderecos', 'empresas.id', '=', 'enderecos.empresa')
        ->join('categorias','trabalhadors.id','=','categorias.trabalhador')
        ->join('documentos','trabalhadors.id','=','documentos.trabalhador')
        ->select(
            'trabalhadors.tsnome',
            'trabalhadors.tsmatricula',
            'trabalhadors.tscpf',
            'documentos.dspis',
            'categorias.cbo',
            'avusos.aicodigo',
            'avusos.id',
            'avusos.asinicial',
            'avusos.asfinal',
            'avusos.created_at',
            'categorias.cbo',
            'empresas.escnpj',
            'empresas.esnome',
            'empresas.estelefone',
            'enderecos.eslogradouro',
            'enderecos.esnum',
            'enderecos.escep',
            'enderecos.esbairro',
            'enderecos.esuf',
            'enderecos.esestado',
            'enderecos.esmunicipio',
            'empresas.esfoto',
            'empresas.escnpj'
        )
        ->where([
            ['avusos.id',$id],
            ['trabalhadors.id',$trabalhador]
        ])
        ->orWhere(function($query) use ($trabalhador,$inicio,$final){
            $query->where('trabalhadors.id',$trabalhador)
            ->whereBetween('avusos.asfinal',[$inicio,$final]);
        })
        ->first();
    }
    public function buscaTrabalhadorRecibo($trabalhador,$inicio,$final)
    {
        return Avuso::where('trabalhador',$trabalhador)
        ->whereBetween('asfinal',[$inicio,$final])
        ->get();
    }
    public function deletar($id)
    {
        return Avuso::where('id',$id)->delete();
    }
}
