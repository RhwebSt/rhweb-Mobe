<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class RelacaoDia extends Model
{
    protected $fillable = [
        'rsdia','rivalor','base_calculo_id','trabalhador_id','created_at'
    ];
    public function basecalculo()
    {
        return $this->belongsTo(BaseCalculo::class);
    }
    public function cadastros($dados,$i)
    {
        return RelacaoDia::create([
            'rsdia'=>$dados['dias'][$i],
            'rivalor'=>$dados['valor'][$i],
            'base_calculo_id'=>$dados['basecalculo'],
            'trabalhador_id'=>$dados['trabalhador']
        ]);
    }
    public function cadastro($dia,$valor,$basecalculo,$trabalhador,$data)
    {
        return RelacaoDia::create([
            'rsdia'=>$dia,
            'rivalor'=>$valor,
            'basecalculo'=>$basecalculo,
            'trabalhador_id'=>$trabalhador,
            'created_at'=>$data
        ]);
    }
    public function listaRelacaoDia($trabalhador,$data,$i)
    {
        return RelacaoDia::select(
            DB::raw('SUM(rivalor) as valor,trabalhador_id,rsdia,created_at')
        )
        ->groupBy('trabalhador_id','rsdia','created_at')
        ->where('rsdia',$i)
        ->whereIn('trabalhador_id',$trabalhador)
        ->whereDate('created_at', $data)
        ->get();

    }
    public function cadastroGeral($dados,$basecalculo)
    {
     return RelacaoDia::create([
        'rsdia'=>$dados['rsdia'],
        'rivalor'=>$dados['valor'],
        'basecalculo'=>$basecalculo,
        'trabalhador_id'=>$dados['trabalhador'],
        'created_at'=>$dados['created_at']
        ]);
    }
    public function buscaImprimir($id)
    {
        return RelacaoDia::select('rsdia','rivalor','base_calculo_id','trabalhador_id')
        ->whereIn('base_calculo_id',$id)
        ->get();
    }
    public function buscaImprimirTrabalhador($id)
    {
        return RelacaoDia::select('rsdia','rivalor','base_calculo_id','trabalhador_id')
        ->where('base_calculo_id',$id)
        ->get();
    }
    public function deletar($id)
    {
        return RelacaoDia::whereIn('basecalculo_id',$id)->delete();
    }
}
