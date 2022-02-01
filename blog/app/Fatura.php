<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Fatura extends Model
{
    protected $fillable = [
        'fsnumero', 'fsinicio', 'fsfinal', 'fsvencimento', 'tomador', 'empresa'
    ];
    public function cadastro($dados)
    {
        return Fatura::create([
            // 'fsnumero'=>$dados['logradouro'],
            'fsinicio'=>$dados['ano_inicial'],
            'fsfinal'=>$dados['ano_final'],
            // 'fsvencimento'=>$dados['localidade'],
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
            if ($user->hasPermissionTo('admin')) {
                $query->where('faturas.id','>',0);
            }else{
                $query->where('faturas.empresa', $user->empresa);
            }
        })
        ->paginate(10);
    }
    public function buscaRelatorio($tomador,$inicio,$final)
    {
        return Fatura::where(function($query) use ($tomador,$inicio,$final){
            $user = auth()->user();
            if ($user->hasPermissionTo('admin')) {
                $query->where('faturas.tomador',$tomador) 
                ->whereDate('faturas.fsfinal', $final);
            }else{
                $query->where([
                    ['faturas.tomador',$tomador],
                    ['tomadors.empresa', $user->empresa]
                ])->whereDate('faturas.fsfinal', $final);
            }
        })
        ->first();
    }
}
