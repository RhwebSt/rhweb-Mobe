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
    
    public function verificaCadastroCnpj($dados)
    {
        $user = auth()->user();
        return Tomador::where([
            ['tscnpj',$dados['cnpj']],
            ['empresa',$user->empresa]
        ])
        ->count();
    }
    public function buscaListaTomador($tomador)
    {
        return Tomador::where('empresa',$tomador)->select('id')->get();
    }
    public function first($id)
    {
       return DB::table('tomadors')
            ->join('enderecos', 'tomadors.id', '=', 'enderecos.tomador')
            ->join('taxas', 'tomadors.id', '=', 'taxas.tomador')
            // ->join('retencao_faturas', 'tomadors.id', '=', 'retencao_faturas.tomador')
            ->join('cartao_pontos', 'tomadors.id', '=', 'cartao_pontos.tomador')
            ->join('parametrosefips', 'tomadors.id', '=', 'parametrosefips.tomador')
            ->join('incide_folhars', 'tomadors.id', '=', 'incide_folhars.tomador')
            ->join('indice_faturas', 'tomadors.id', '=', 'indice_faturas.tomador')
            ->join('bancarios', 'tomadors.id', '=', 'bancarios.tomador')
            ->select(
                'tomadors.*', 
                'enderecos.*',
                'taxas.*',
                // 'retencao_faturas.*',
                'cartao_pontos.*',
                'parametrosefips.*',
                'incide_folhars.*',
                'indice_faturas.*',
                'bancarios.*'
            )
            ->where(function($query) use ($id){
                $user = auth()->user();
                if ($user->hasPermissionTo('admin')) {
                    $query->where('tsnome',$id)
                    ->orWhere('tscnpj',$id)
                    // ->orWhere('tsmatricula',$id)
                    ->orWhere('tomadors.id',$id);
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
                            ['tomadors.id',$id],
                            ['tomadors.empresa', $user->empresa],
                        ]);
                        // ->orWhere([
                        //     ['tsmatricula',$id],
                        //     ['tomadors.empresa', $user->empresa],
                        // ]);
                }
               
            })
            ->first();
    }
    public function pesquisa($id)
    {
        return DB::table('tomadors')
        ->join('cartao_pontos', 'tomadors.id', '=', 'cartao_pontos.tomador')
        ->select(
            'tomadors.tsnome',
            'tomadors.tsmatricula',
            'tomadors.tscnpj',
            'cartao_pontos.tomador',
            'cartao_pontos.csdiasuteis',
            'cartao_pontos.cssabados',
            'cartao_pontos.csdomingos',
        ) 
        ->where(function($query) use ($id){
            $user = auth()->user();
            if ($user->hasPermissionTo('admin')) {
                if ($id) {
                    $query->where('tsnome','like','%'.$id.'%')
                    ->orWhere('tscnpj', 'like', '%'.$id.'%')
                    ->orWhere('tsmatricula', 'like', '%'.$id.'%')
                    ->orWhere('tomadors.id',$id);
                }else{
                    $query->where('tomadors.id','>',$id);
                }
            }else{
                if ($id) {
                 $query->where([
                        ['tsnome','like','%'.$id.'%'],
                        ['tomadors.empresa', $user->empresa]
                    ])
                    ->orWhere([
                        ['tscnpj','like','%'.$id.'%'],
                        ['tomadors.empresa', $user->empresa],
                    ])
                    ->orWhere([
                        ['tomadors.id','like','%'.$id.'%'],
                        ['tomadors.empresa', $user->empresa],
                    ])
                    ->orWhere([
                        ['tsmatricula','like','%'.$id.'%'],
                        ['tomadors.empresa', $user->empresa],
                    ]);
                }else{
                    $query->where([
                        ['tomadors.id','>',$id],
                        ['tomadors.empresa', $user->empresa]
                    ]);
                }
            }
           
        })
        ->orderBy('tomadors.tsnome')
        ->distinct()
        ->limit(100)
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
    public function buscaNomeTomadorTabelaPreco($id)
    {
        return Tomador::where('id', $id)
        ->select('tsnome')
        ->first();
    }
    public function tomadorBoletim($id)
    {
        return DB::table('tomadors')
        ->join('empresas', 'empresas.id', '=', 'tomadors.empresa')
        ->select('empresas.esnome','tomadors.tsnome')
        ->where(function($query) use ($id){
            $user = auth()->user();
            if ($user->hasPermissionTo('admin')) {
                $query->where('tomadors.id',$id);
            }else{
                $query->where([
                    ['tomadors.id',$id],
                    ['tomadors.empresa', $user->empresa]
                ]);
            }
           
        })
        ->first();
    }
}
