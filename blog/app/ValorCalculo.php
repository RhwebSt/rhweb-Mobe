<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class ValorCalculo extends Model
{
    protected $fillable = [
        'vicodigo','vsdescricao','vireferencia','vivencimento','videsconto','basecalculo','trabalhador','created_at'
    ];
    public function cadastroHorasnormais($dados,$basecalculo,$trabalahdor,$i,$data)
    {
        return ValorCalculo::create([
            'vicodigo'=> (int)$dados['horasNormais']['codigos'][$i],
            'vsdescricao'=>$dados['horasNormais']['rublicas'][$i],
            'vireferencia'=>$dados['horasNormais']['quantidade'][$i],
            'vivencimento'=>$dados['horasNormais']['valor'][$i],
            'basecalculo'=>$basecalculo,
            'trabalhador'=>$trabalahdor,
            'created_at'=>$data
        ]);
    }
    public function listaHorasnormais($trabalhador,$data)
    {
        return ValorCalculo::select(
            DB::raw(
                'SUM(vivencimento) as vencimento,
                SUM(vireferencia) as referencia,
                trabalhador,
                vicodigo,
                vsdescricao'
                )
        )
        ->groupBy('trabalhador','vicodigo','vsdescricao')
        ->whereIn('trabalhador',$trabalhador)
        ->where('vsdescricao','hora normal')
        ->whereDate('created_at', $data)
        ->get();
    }
    public function cadastrodiariaNormais($dados,$basecalculo,$trabalahdor,$i,$data)
    {
        return ValorCalculo::create([
            'vicodigo'=> (int)$dados['diariaNormais']['codigos'][$i],
            'vsdescricao'=>$dados['diariaNormais']['rublicas'][$i],
            'vireferencia'=>$dados['diariaNormais']['quantidade'][$i],
            'vivencimento'=>$dados['diariaNormais']['valor'][$i],
            'basecalculo'=>$basecalculo,
            'trabalhador'=>$trabalahdor,
            'created_at'=>$data
        ]);
    }
    public function cadastroHorasEx50($dados,$basecalculo,$trabalahdor,$i,$data)
    {
        return ValorCalculo::create([
            'vicodigo'=> (int)$dados['hora extra 50%']['codigos'][$i],
            'vsdescricao'=>$dados['hora extra 50%']['rublicas'][$i],
            'vireferencia'=>$dados['hora extra 50%']['quantidade'][$i],
            'vivencimento'=>$dados['hora extra 50%']['valor'][$i],
            'basecalculo'=>$basecalculo,
            'trabalhador'=>$trabalahdor,
            'created_at'=>$data
        ]);
    }
    public function cadastroHorasEx100($dados,$basecalculo,$trabalahdor,$i,$data)
    {
        return ValorCalculo::create([
            'vicodigo'=> (int)$dados['hora extra 100%']['codigos'][$i],
            'vsdescricao'=>$dados['hora extra 100%']['rublicas'][$i],
            'vireferencia'=>$dados['hora extra 100%']['quantidade'][$i],
            'vivencimento'=>$dados['hora extra 100%']['valor'][$i],
            'basecalculo'=>$basecalculo,
            'trabalhador'=>$trabalahdor,
            'created_at'=>$data
        ]);
    }
    public function cadastroGratificacao($dados,$basecalculo,$trabalahdor,$i,$data)
    {
        return ValorCalculo::create([
            'vicodigo'=> (int)$dados['gratificação']['codigos'][$i],
            'vsdescricao'=>$dados['gratificação']['rublicas'][$i],
            'vireferencia'=>$dados['gratificação']['quantidade'][$i],
            'vivencimento'=>$dados['gratificação']['valor'][$i],
            'basecalculo'=>$basecalculo,
            'trabalhador'=>$trabalahdor,
            'created_at'=>$data
        ]);
    }
    public function cadastraAdiantamento($dados,$basecalculo,$trabalahdor,$i,$data)
    {
        return ValorCalculo::create([
            'vicodigo'=> (int)$dados['adiantamento']['codigos'][$i],
            'vsdescricao'=>$dados['adiantamento']['rublicas'][$i],
            'vireferencia'=>$dados['adiantamento']['quantidade'][$i],
            'vivencimento'=>$dados['adiantamento']['valor'][$i],
            'basecalculo'=>$basecalculo,
            'trabalhador'=>$trabalahdor,
            'created_at'=>$data
        ]);
    }
    public function cadastroProducao($dados,$basecalculo,$trabalahdor,$i,$data)
    {
        return ValorCalculo::create([
            'vicodigo'=> (int)$dados['producao']['codigos'][$i],
            'vsdescricao'=>$dados['producao']['rublicas'][$i],
            'vireferencia'=>$dados['producao']['quantidade'][$i],
            'vivencimento'=>$dados['producao']['valor'][$i],
            'basecalculo'=>$basecalculo,
            'trabalhador'=>$trabalahdor,
            'created_at'=>$data
        ]);
    }
}
