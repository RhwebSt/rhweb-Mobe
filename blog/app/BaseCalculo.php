<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class BaseCalculo extends Model
{
    protected $fillable = [
        'biservico','biservicodsr','biinss','bifgts','bifgtsmes','biirrf','bifaixairrf','binumfilhos','bitotaldiaria','bivalorliquido','bivalorvencimento','bivalordesconto','bsadinortuno','trabalhador','tomador','folhar','created_at'
    ];
    public function cadastro($dados,$depedentes,$tomador,$folhar = null,$i,$data)
    {
        return BaseCalculo::create([
            'biservico'=>$dados['salario']['valor'][$i],
            'biservicodsr'=>$dados['serviso_dsr']['valor'][$i],
            'biinss'=>$dados['base_inss']['valor'][$i],
            'bifgts'=>$dados['base_fgts']['valor'][$i],
            'bifgtsmes'=>$dados['fgts_mes']['valor'][$i],
            // 'biirrf'=>$dados['irrf']['valorbase'][$i],
            // 'bifaixairrf'=>$dados['irrf']['indece'][$i],
            'binumfilhos'=>$depedentes,
            'bitotaldiaria'=>$dados['salario']['valor'][$i],
            'bivalorliquido'=>$dados['vencimento']['valor'][$i] - $dados['novodesconto']['valor'][$i],
            'bivalorvencimento'=>$dados['vencimento']['valor'][$i],
            'bivalordesconto'=>$dados['novodesconto']['valor'][$i],
            'trabalhador'=>$dados['salario']['id'][$i],
            'tomador'=>$tomador,
            'folhar'=>$folhar,
            'created_at'=>$data
        ]);
    }
    public function calculoLista($trabalhador,$data)
    {
        return BaseCalculo::select(
            DB::raw(
                'SUM(biservico) as servico,
                 SUM(biservicodsr) as servicodsr,
                 SUM(biinss) as inss,
                 SUM(bifgts) as fgts,
                 SUM(bifgtsmes) as fgtsmes,
                 SUM(biirrf) as irrf,
                 SUM(bifaixairrf) as faixairrf,
                 SUM(bitotaldiaria) as totaldiaria,
                 SUM(bivalorliquido) as valorliquido,
                 SUM(bivalorvencimento) as valorvencimento,
                 SUM(bivalordesconto) as valordesconto,
                 trabalhador,
                 binumfilhos,
                 created_at'
                )
        )
        ->groupBy('trabalhador','binumfilhos','created_at')
        ->whereIn('trabalhador',$trabalhador)
        ->whereDate('created_at', $data)
        ->get();
    }
    public function cadastroFolhar($dados,$irrf,$faixa,$folhar)
    {
    
        return BaseCalculo::create([
            'biservico'=>$dados->servico,
            'biservicodsr'=>$dados->servicodsr,
            'biinss'=>$dados->inss, 
            'bifgts'=>$dados->fgts,
            'bifgtsmes'=>$dados->fgtsmes,
            'biirrf'=>$irrf,
            'bifaixairrf'=>str_replace(",",".",$faixa),
            'binumfilhos'=>$dados->binumfilhos,
            'bitotaldiaria'=>$dados->totaldiaria,
            'bivalorliquido'=>$dados->valorliquido,
            'bivalorvencimento'=>$dados->valorvencimento,
            'bivalordesconto'=>$dados->valordesconto,
            'trabalhador'=>$dados->trabalhador,
            'folhar'=>$folhar,
            'created_at'=>$dados->created_at
        ]);
    }
    public function listaBaseCalculo($trabalahdor)
    {
        return BaseCalculo::select('id')
        ->whereIn('trabalhador',$trabalahdor)
        ->get();
    }
    public function boletimBusca($trabalhador,$datainicio,$datafinal)
    {
        return DB::table('base_calculos')
        ->join('folhars', 'folhars.id', '=', 'base_calculos.folhar')
        ->select(
            'base_calculos.bivalorliquido',
            'base_calculos.trabalhador'
        )
        ->whereIn('trabalhador',$trabalhador)
        ->whereBetween('base_calculos.created_at',[$datainicio, $datafinal])
        ->get();
    }
    public function editerFk($tomador,$data,$folhar)
    {
        return BaseCalculo::whereIn('tomador',$tomador)
        ->whereDate('created_at', $data)
        ->update([
            'folhar'=>$folhar
        ]);
    }
    public function deletar($id)
    {
        return BaseCalculo::whereIn('id',$id)->delete();
    }
    public function listaTrabalhador($folhar)
    {
        return DB::table('base_calculos')
        ->join('trabalhadors', 'trabalhadors.id', '=', 'base_calculos.trabalhador')
        ->select('trabalhadors.tsnome','trabalhadors.id','base_calculos.folhar')
        ->whereIn('base_calculos.folhar',$folhar)
        ->where('base_calculos.tomador',null)
        ->distinct()
        ->orderBy('trabalhadors.tsnome', 'asc')
        ->get();
    }
    public function listaTomador($folhar)
    {
        return DB::table('base_calculos')
        ->join('tomadors', 'tomadors.id', '=', 'base_calculos.tomador')
        ->select('tomadors.tsnome','tomadors.id','base_calculos.folhar')
        ->whereIn('base_calculos.folhar',$folhar)
        ->distinct()
        ->orderBy('tomadors.tsnome', 'asc')
        ->get();
    }
    public function buscaId($folhar,$tomador)
    {
        return BaseCalculo::select('id')->where([
            ['folhar',$folhar],
            ['tomador',$tomador]
        ])
        ->get();
    }
    public function verifica($folhar)
    {
        return BaseCalculo::where('folhar',$folhar)->count();
    }
}
