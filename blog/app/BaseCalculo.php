<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class BaseCalculo extends Model
{
    protected $fillable = [
        'biservico','biservicodsr','biinss','bifgts','bifgtsmes','biirrf','bifaixairrf','binumfilhos','bitotaldiaria','bivalorliquido','bivalorvencimento','bivalordesconto','bsadinortuno','trabalhador_id','tomador_id','folhar_id','created_at'
    ];
    public function trabalhador()
    {
        return $this->belongsTo(Trabalhador::class);
    }
    public function tomador()
    {
        return $this->belongsTo(Tomador::class);
    }
    public function folhar()
    {
        return $this->belongsTo(Folhar::class);
    }
    public function valorcalculo()
    {
        return $this->hasMany(ValorCalculo::class)->orderBy('vicodigo','ASC');;
    }
    public function relacaodia()
    {
        return $this->hasMany(RelacaoDia::class);
    }
    
    public function cadastros($dados)
    {
        return BaseCalculo::create([
            'biservico'=>$dados['servico'],
            'biservicodsr'=>$dados['servicodsr'],
            'biinss'=>$dados['base_inss'],
            'bifgts'=>$dados['base_fgts'],
            'bifgtsmes'=>$dados['fgts_mes'],
            'biirrf'=>$dados['base_irrf'],
            // 'bifaixairrf'=>$dados['irrf']['indece'][$i],
            'binumfilhos'=>$dados['depedente'],
            'bitotaldiaria'=>$dados['salario'],
            'bivalorliquido'=>$dados['liquido'],
            'bivalorvencimento'=>$dados['vencimento'],
            'bivalordesconto'=>$dados['desconto'],
            'trabalhador_id'=>$dados['trabalhador'],
            'tomador_id'=>$dados['tomador'],
            'folhar_id'=>$dados['folhar'],
        ]);
    }
    
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
            'trabalhador_id'=>$dados['salario']['id'][$i],
            'tomador_id'=>$tomador,
            'folhar_id'=>$folhar,
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
                 trabalhador_id,
                 binumfilhos,
                 created_at'
                )
        )
        ->groupBy('trabalhador_id','binumfilhos','created_at')
        ->whereIn('trabalhador_id',$trabalhador)
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
            'trabalhador_id'=>$dados->trabalhador,
            'folhar_id'=>$folhar,
            'created_at'=>$dados->created_at
        ]);
    }
    public function listaBaseCalculo($trabalahdor)
    {
        return BaseCalculo::select('id')
        ->whereIn('trabalhador_id',$trabalahdor)
        ->get();
    }
    public function boletimBusca($trabalhador,$datainicio,$datafinal)
    {
        return DB::table('base_calculos')
        ->join('folhars', 'folhars.id', '=', 'base_calculos.folhar_id')
        ->select(
            'base_calculos.bivalorliquido',
            'base_calculos.trabalhador'
        )
        ->whereIn('trabalhador_id',$trabalhador)
        ->where('tomador_id',null)
        ->whereBetween('base_calculos.created_at',[$datainicio, $datafinal])
        ->get();
    }
    public function editerFk($tomador,$data,$folhar)
    {
        return BaseCalculo::whereIn('tomador_id',$tomador)
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
        ->join('trabalhadors', 'trabalhadors.id', '=', 'base_calculos.trabalhador_id')
        ->select('trabalhadors.tsnome','trabalhadors.id','base_calculos.folhar_id')
        ->whereIn('base_calculos.folhar_id',$folhar)
        ->where('base_calculos.tomador_id',null)
        ->distinct()
        ->orderBy('trabalhadors.tsnome', 'asc')
        ->get();
    }
    public function listaTomador($folhar,$condicao)
    {
        return DB::table('base_calculos')
        ->join('tomadors', 'tomadors.id', '=', 'base_calculos.tomador_id')
        ->select('tomadors.tsnome','tomadors.id','base_calculos.folhar_id')
        ->whereIn('base_calculos.folhar_id',$folhar)
        ->distinct()
        ->orderBy('tomadors.tsnome', $condicao)
        ->get();
    }
    public function buscaId($folhar)
    {
        return BaseCalculo::select('id')->where('folhar_id',$folhar)
        ->get();
    }
    public function verifica($folhar)
    {
        return BaseCalculo::where('folhar_id',$folhar)->count();
    }
    public function verificaTrabalhador($id)
    {
        return BaseCalculo::where('trabalhador_id',$id)->count();
    }

    public function verificaTomador($id)
    {
        return BaseCalculo::where('tomador_id',$id)->count();
    }
}
