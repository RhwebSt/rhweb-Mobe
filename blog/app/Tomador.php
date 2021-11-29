<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Tomador extends Model
{
    protected $fillable = [
        'tsnome','tsfantasia','tscnpj','tsmatricula','tstipo','tssimples','tstelefone','empresa'
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
            'tstipo'=>$dados['tipo'],
            'empresa'=>$dados['empresa']

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
            ->join('incide_folhars', 'tomadors.id', '=', 'incide_folhars.tomador')
            ->join('indice_faturas', 'tomadors.id', '=', 'indice_faturas.tomador')
            ->join('bancarios', 'tomadors.id', '=', 'bancarios.tomador')
            ->select(
                'tomadors.*', 
                'enderecos.*',
                'taxas.*',
                'retencao_faturas.*',
                'cartao_pontos.*',
                'parametrosefips.*',
                'incide_folhars.*',
                'indice_faturas.*',
                'bancarios.*'
            )
            ->where(function($query) use ($id){
                $user = auth()->user();
                if ($user->hasPermissionTo('admin')) {
                    $query->where('tsnome','like','%'.$id.'%')
                    ->orWhere('tscnpj', 'like', '%'.$id.'%')
                    ->orWhere('tsmatricula', 'like', '%'.$id.'%');
                }else{
                     $query->where([
                            ['tsnome',$id],
                            ['tomadors.empresa', $user->empresa]
                        ])
                        ->orWhere([
                            ['tscnpj',$id],
                            ['tomadors.empresa', $user->empresa],
                        ])
                        ->orWhere([
                            ['tsmatricula',$id],
                            ['tomadors.empresa', $user->empresa],
                        ]);
                }
               
            })
            ->get();
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
