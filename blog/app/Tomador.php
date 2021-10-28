<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Tomador extends Model
{
    protected $fillable = [
        'tsnome','tsfantasia','tscnpj','tsmatricula','tstipo','tssimples'
    ];
    public function cadastro($dados)
    {
        
       return Tomador::create([
            'tsnome'=>$dados['nome__completo'],
            'tsfantasia'=>$dados['nome__fantasia'],
            'tscnpj'=>$dados['cnpj'],
            'tsmatricula'=>$dados['matricula'],
            'tssimples'=>$dados['simples'],
            'tstelefone'=>$dados['telefone'],
            'tstipo'=>$dados['tipo']
        ]);
    }
    public function lista()
    {
       return DB::table('tomadors')
            ->join('enderecos', 'tomadors.id', '=', 'enderecos.tomador')
            // ->join('orders', 'users.id', '=', 'orders.user_id')
            ->select('tomadors.*', 'enderecos.*')
            ->paginate(20);
    }
    public function editar($dados)
    {
      Tomador::where('id', $dados['id'])
      ->update(['tsnome'=>$dados['tsnome'],
      'tsfantasia'=>$dados['tsfantasia'],
      'tscnpj'=>$dados['tscnpj'],
      'tsmatricula'=>$dados['tsmatricula'],
      'tssimples'=>$dados['tssimples'],
      'tstipo'=>$dados['tstipo']]);
    }
}
