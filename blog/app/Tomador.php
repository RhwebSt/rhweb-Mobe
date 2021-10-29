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
    // public function lista()
    // {
    //    return DB::table('tomadors')
    //         ->join('enderecos', 'tomadors.id', '=', 'enderecos.tomador')
    //         // ->join('orders', 'users.id', '=', 'orders.user_id')
    //         ->select('tomadors.*', 'enderecos.*')
    //         ->paginate(20);
    // }
    public function first($id)
    {
       return DB::table('tomadors')
            ->join('enderecos', 'tomadors.id', '=', 'enderecos.tomador')
            ->join('taxas', 'tomadors.id', '=', 'taxas.tomador')
            ->join('retencao_faturas', 'tomadors.id', '=', 'retencao_faturas.tomador')
            ->join('cartao_pontos', 'tomadors.id', '=', 'cartao_pontos.tomador')
            ->join('parametrosefips', 'tomadors.id', '=', 'parametrosefips.tomador')
            ->join('taxa_trabalhadors', 'tomadors.id', '=', 'taxa_trabalhadors.tomador')
            ->join('indice_faturas', 'tomadors.id', '=', 'indice_faturas.tomador')
            ->join('bancarios', 'tomadors.id', '=', 'bancarios.tomador')
            ->select(
                'tomadors.*', 
                'enderecos.*',
                'taxas.*',
                'retencao_faturas.*',
                'cartao_pontos.*',
                'parametrosefips.*',
                'taxa_trabalhadors.*',
                'indice_faturas.*',
                'bancarios.*'
            )
            ->where('tsnome', $id)
            ->first();
    }
    public function editar($dados,$id)
    {
      return Tomador::where('id', $id)
      ->update(
        [
            'tsnome'=>$dados['nome__completo'],
            'tsfantasia'=>$dados['nome__fantasia'],
            'tscnpj'=>$dados['cnpj'],
            'tsmatricula'=>$dados['matricula'],
            'tssimples'=>$dados['simples'],
            'tstelefone'=>$dados['telefone'],
            'tstipo'=>$dados['tipo']
        ]
     );
    }
    public function deletar($id)
    {
      return Tomador::where('id', $id)->delete();
    }
}
