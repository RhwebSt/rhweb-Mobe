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
            'binumfilhos'=>$depedentes[$i]->depedentes,
            'bitotaldiaria'=>$dados['salario']['valor'][$i],
            'bivalorliquido'=>$dados['vencimento']['valor'][$i] - $dados['novodesconto']['valor'][$i],
            'bivalorvencimento'=>$dados['vencimento']['valor'][$i],
            'bivalordesconto'=>$dados['novodesconto']['valor'][$i],
            // 'bsadinortuno'=>'',
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
            'bivalorliquido'=>$dados->bivalorliquido,
            'bivalorvencimento'=>$dados->valorvencimento,
            'bivalordesconto'=>$dados->valordesconto,
            'trabalhador'=>$dados->trabalhador,
            'tomador'=>1,
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
}
