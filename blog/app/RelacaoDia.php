<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class RelacaoDia extends Model
{
    protected $fillable = [
        'rsdia','rivalor','basecalculo','trabalhador','created_at'
    ];
    public function cadastro($dia,$valor,$basecalculo,$trabalhador,$data)
    {
        return RelacaoDia::create([
            'rsdia'=>$dia,
            'rivalor'=>$valor,
            'basecalculo'=>$basecalculo,
            'trabalhador'=>$trabalhador,
            'created_at'=>$data
        ]);
    }
    public function listaRelacaoDia($trabalhador,$data,$i)
    {
        return RelacaoDia::select(
            DB::raw('SUM(rivalor) as valor,trabalhador,rsdia')
        )
        ->groupBy('trabalhador','rsdia')
        ->where('rsdia',$i)
        ->whereIn('trabalhador',$trabalhador)
        ->whereDate('created_at', $data)
        ->get();

    }
}
