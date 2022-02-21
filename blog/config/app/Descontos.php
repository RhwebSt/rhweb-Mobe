<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Descontos extends Model
{
    protected $fillable = [
        'dsdescricao','dsquinzena','dscompetencia','dfvalor','trabalhador','empresa'
    ];
    public function cadastro($dados)
    {
        return Descontos::create([
           'dsdescricao'=>$dados['descricao'],
           'dsquinzena'=>$dados['quinzena'],
           'dscompetencia'=>$dados['competencia'],
           'dfvalor'=>str_replace(",",".",$dados['valor']),
           'trabalhador'=>$dados['trabalhador'],
           'empresa'=>$dados['empresa'],
        ]);
    }
    public function editar($dados,$id)
    {
        return Descontos::where('id', $id)
        ->update([
            'dsdescricao'=>$dados['descricao'],
            'dsquinzena'=>$dados['quinzena'],
            'dscompetencia'=>$dados['competencia'],
            'dfvalor'=>str_replace(",",".",$dados['valor'])
        ]);
    }
    public function lista($empresa)
    {
        return DB::table('trabalhadors')
        ->join('descontos', 'trabalhadors.id', '=', 'descontos.trabalhador')
        ->select(
            'trabalhadors.tsnome',
            'trabalhadors.tsmatricula',
            'descontos.*'
        )
        ->where('descontos.empresa',$empresa)
        ->paginate(10);
    }

    public function buscaUnidadeDesconto($id)
    {
        return DB::table('trabalhadors')
        ->join('descontos', 'trabalhadors.id', '=', 'descontos.trabalhador')
        ->select(
            'trabalhadors.tsnome',
            'trabalhadors.tsmatricula',
            'descontos.*'
        )
        ->where('descontos.id',$id)
        ->first();
    }
    public function buscaRelatorio($empresa,$dataincio,$datafinal)
    {
        return DB::table('trabalhadors') 
        ->join('descontos', 'trabalhadors.id', '=', 'descontos.trabalhador')
        ->join('empresas', 'empresas.id', '=', 'descontos.empresa')
        ->select(
            'trabalhadors.tsnome',
            'trabalhadors.tsmatricula',
            'empresas.esnome',
            'descontos.*' 
        )
        ->where('descontos.empresa',$empresa)
        ->whereBetween('descontos.dscompetencia',[substr($dataincio, 0, 7),substr($datafinal, 0, 7)])
        ->get();
    }
    public function relatorioTrabalhador($empresa,$dados)
    {
        return DB::table('trabalhadors')
        ->join('descontos', 'trabalhadors.id', '=', 'descontos.trabalhador')
        ->join('empresas', 'empresas.id', '=', 'descontos.empresa')
        ->select(
            'trabalhadors.tsnome',
            'trabalhadors.tsmatricula',
            'empresas.esnome',
            'descontos.*' 
        )
        ->where([
            ['descontos.empresa',$empresa],
            ['trabalhadors.id',$dados['idtrabalhador']]
        ])
        ->whereBetween('descontos.dscompetencia',[substr($dados['ano_inicial'], 0, 7),substr($dados['ano_final'], 0, 7)])
        ->get();
    }
    public function buscaRelatorioTrabalhador($empresa,$trabalhador,$dataincio,$datafinal)
    {
        return DB::table('trabalhadors') 
        ->join('descontos', 'trabalhadors.id', '=', 'descontos.trabalhador')
        ->selectRaw(
            'trabalhadors.id,
            descontos.dsquinzena,
            descontos.dsdescricao,
            COUNT(descontos.dsdescricao) as quantidade,
            SUM(descontos.dfvalor) as valor'
        )
        ->whereIn('trabalhadors.id',$trabalhador)
        ->where('descontos.empresa',$empresa)
        ->groupBy('trabalhadors.id','descontos.dsquinzena','descontos.dsdescricao')
        ->whereBetween('descontos.dscompetencia',[substr($dataincio, 0, 7),substr($datafinal, 0, 7)])
        ->get();
    }
    public function deletar($id)
    {
        return Descontos::where('id', $id)->delete();
    }
}
