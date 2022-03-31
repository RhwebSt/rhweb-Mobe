<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Fatura extends Model
{
    protected $fillable = [
        'fsnumero', 'fsinicio', 'fsfinal', 'fsvencimento','fscompetencia', 'tomador', 'empresa'
    ];
    public function cadastro($dados)
    {
        return Fatura::create([
            'fsnumero'=>$dados['numero'],
            'fsinicio'=>$dados['ano_inicial'],
            'fsfinal'=>$dados['ano_final'],
            'fsvencimento'=>$dados['vencimento'],
            'fscompetencia'=>$dados['competencia'],
            'tomador'=>$dados['tomador'],
            'empresa'=>$dados['empresa'],
        ]);
    }
    public function buscaListaFatura()
    {
        return DB::table('tomadors')
        ->join('faturas', 'tomadors.id', '=', 'faturas.tomador')
        ->select(
            'tomadors.tsmatricula',
            'tomadors.tsnome',
            'faturas.tomador',
            'faturas.fsnumero',
            'faturas.fsinicio',
            'faturas.fsfinal',
            'faturas.id'
        )
        ->where(function($query){
            $user = auth()->user();
            $query->where('faturas.empresa', $user->empresa);
            // if ($user->hasPermissionTo('admin')) {
            //     $query->where('faturas.id','>',0);
            // }else{
            //     $query->where('faturas.empresa', $user->empresa);
            // }
        })
        ->paginate(10);
    }

    public function buscaListaFaturaOrdem($condicao)
    {
        return DB::table('tomadors')
        ->join('faturas', 'tomadors.id', '=', 'faturas.tomador')
        ->select(
            'tomadors.tsmatricula',
            'tomadors.tsnome',
            'faturas.tomador',
            'faturas.fsnumero',
            'faturas.fsinicio',
            'faturas.fsfinal',
            'faturas.id'
        )
        ->where(function($query){
            $user = auth()->user();
            $query->where('faturas.empresa', $user->empresa);
            // if ($user->hasPermissionTo('admin')) {
            //     $query->where('faturas.id','>',0);
            // }else{
            //     $query->where('faturas.empresa', $user->empresa);
            // }
        })
        ->orderBy('tomadors.tsnome', $condicao)
        ->paginate(10);
    }
    public function filtroPesquisa($dados)
    {
        return DB::table('tomadors')
        ->join('faturas', 'tomadors.id', '=', 'faturas.tomador')
        ->select(
            'tomadors.tsmatricula',
            'tomadors.tsnome',
            'faturas.tomador',
            'faturas.fsnumero',
            'faturas.fsinicio',
            'faturas.fsfinal',
            'faturas.id'
        )
        ->where(function($query) use($dados){
            $user = auth()->user();
            $query->where([
                ['faturas.empresa', $user->empresa],
                ['tomadors.tsnome',$dados['pesquisa']]
            ])
            ->whereBetween('faturas.fsfinal',[$dados['ano_inicial1'], $dados['ano_final1']]);

            // if ($user->hasPermissionTo('admin')) {
            //     $query->where([
            //         ['faturas.id','>',0],
            //         ['tomadors.tsnome',$dados['pesquisa']]
            //     ])
            //     ->whereBetween('faturas.fsfinal',[$dados['ano_inicial1'], $dados['ano_final1']]);
            // }else{
            //     $query->where([
            //         ['faturas.empresa', $user->empresa],
            //         ['tomadors.tsnome',$dados['pesquisa']]
            //     ])
            //     ->whereBetween('faturas.fsfinal',[$dados['ano_inicial1'], $dados['ano_final1']]);
            // }
        })
        ->paginate(10);
    }
    public function buscaRelatorio($tomador,$inicio,$final)
    {
        return Fatura::where(function($query) use ($tomador,$inicio,$final){
            $user = auth()->user();
            $query->where([
                ['faturas.tomador',$tomador],
                ['faturas.empresa', $user->empresa]
            ])->whereDate('faturas.fsfinal', $final);

            // if ($user->hasPermissionTo('admin')) {
            //     $query->where('faturas.tomador',$tomador) 
            //     ->whereDate('faturas.fsfinal', $final);
            // }else{
            //     $query->where([
            //         ['faturas.tomador',$tomador],
            //         ['faturas.empresa', $user->empresa]
            //     ])->whereDate('faturas.fsfinal', $final);
            // }
        })
        ->first();
    }
    public function verificaFaturas($dados)
    {
        return Fatura::where('tomador',$dados['tomador'])
        ->whereBetween('fsfinal',[$dados['ano_inicial'],$dados['ano_final']])
        ->count();
    }
    public function deletar($id)
    {
        return Fatura::where('id',$id)->delete();
    }
    public function quantidadeFatura()
    {
        return DB::table('faturas')
        ->join('empresas', 'empresas.id', '=', 'faturas.empresa')
        ->count();
    }
}
