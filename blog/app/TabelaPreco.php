<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class TabelaPreco extends Model
{
    protected $fillable = [
        'tsano','tsrubrica','tsdescricao','tsvalor','tstomvalor','tsstatus','empresa_id','tomador_id'
    ];
    public function tomador()
    {
        return $this->belongsTo(Tomador::class);
    }
    public function cadastro($dados)
    {
        return TabelaPreco::create([
            'tsano'=>$dados['ano'],
            'tsrubrica'=>$dados['rubricas'],
            'tsdescricao'=>$dados['descricao'],
            'tsstatus'=>$dados['status'],
            'tsvalor'=>str_replace(",",".",str_replace(".","",$dados['valor'])),
            'tstomvalor'=>str_replace(",",".",str_replace(".","",$dados['valor__tomador'])),
            'empresa_id'=>$dados['empresa'],
            'tomador_id'=>$dados['tomador']
        ]);
    }
    public function buscaListaTabela($id,$tomador)
    {
        return TabelaPreco::where(function($query) use ($id,$tomador){
            $user = auth()->user();
            if ($id) {
                $query->where([
                    ['tsrubrica','like','%'.$id.'%'],
                    ['tomador_id',$tomador],
                    ['empresa_id', $user->empresa_id]
                ])
                ->where('tsano', date("Y"))
                ->orWhere([
                    ['tsdescricao','like','%'.$id.'%'],
                    ['tomador_id',$tomador],
                    ['empresa_id', $user->empresa_id],
                ])
                ->where('tsano', date("Y"));
            }else{
                $query->where([
                    ['id','>',$id],
                    ['tomador',$tomador],
                    ['empresa_id', $user->empresa_id]
                ])
                ->where('tsano', date("Y"));
            } 

            // if ($user->hasPermissionTo('admin')) {
            //     if ($id) {
            //         $query->where([
            //             ['tsrubrica','like',$id],
            //             ['tomador',$tomador]
            //         ])
            //         ->where('tsano', date("Y"))
            //         ->orWhere([
            //             ['tsdescricao', 'like', '%'.$id.'%'],
            //             ['tomador',$tomador]
            //         ])
            //         ->where('tsano', date("Y"));
            //     }else{
            //         $query->where([
            //             ['id','>',$id],
            //             ['tomador',$tomador]
            //         ]) 
            //         ->where('tsano', date("Y"));
            //     }
               
            // }else{
            //     if ($id) {
            //         $query->where([
            //             ['tsrubrica','like','%'.$id.'%'],
            //             ['tomador',$tomador],
            //             ['empresa', $user->empresa]
            //         ])
            //         ->where('tsano', date("Y"))
            //         ->orWhere([
            //             ['tsdescricao','like','%'.$id.'%'],
            //             ['tomador',$tomador],
            //             ['empresa', $user->empresa],
            //         ])
            //         ->where('tsano', date("Y"));
            //     }else{
            //         $query->where([
            //             ['id','>',$id],
            //             ['tomador',$tomador],
            //             ['empresa', $user->empresa]
            //         ])
            //         ->where('tsano', date("Y"));
            //     }    
            // }
           
        })
        ->orderBy('tsrubrica', 'asc')
        ->get();
    }
    public function buscaTabelaTomador($tomador,$ano,$condicao,$ordem) 
    {
        return TabelaPreco::where(function($query) use ($tomador,$ano,$condicao){
            $user = auth()->user();
            if ($condicao) {
                $query->orWhere([
                    ['tomador_id',$tomador],
                    // ['tsano',$ano],
                    ['tsrubrica',$condicao]
                ])
                ->orWhere([
                    ['tomador_id',$tomador],
                    // ['tsano',$ano],
                    ['tsdescricao','like','%'.$condicao.'%']
                ]);
            }else{
                $query->where([
                    ['tomador_id',$tomador],
                    // ['tsano',$ano]
                ]);
            }

            // if ($user->hasPermissionTo('admin')) {
            //     if ($condicao) {
            //         $query->orWhere([
            //             ['tomador',$tomador],
            //             ['tsano',$ano],
            //             ['tsrubrica',$condicao]
            //         ])
            //         ->orWhere([
            //             ['tomador',$tomador],
            //             ['tsano',$ano],
            //             ['tsdescricao','like','%'.$condicao.'%']
            //         ]);
            //     }else{
            //         $query->where([
            //             ['tomador',$tomador],
            //             ['tsano',$ano]
            //         ]);
            //     }
            // }else{
            //      $query->where([
            //         ['tomador',$tomador],
            //         ['tsano',$ano]
            //     ]);
            // }
           
        })
        ->orderBy('tsrubrica', $ordem)
        ->paginate(5);
    }
    public function listaUnidadeTomador($tomador)
    {
        return TabelaPreco::where(function($query) use ($tomador){
            $user = auth()->user();
            $query->where([
                ['tomador_id',$tomador],
                ['empresa_id', $user->empresa_id]
            ]);
            // if ($user->hasPermissionTo('admin')) {
            //     $query->where('tomador',$tomador);
            // }else{
            //      $query->where([
            //         ['tomador',$tomador],
            //         ['empresa', $user->empresa]
            //     ]);
            // }
           
        })
        ->orderBy('tsrubrica', 'asc')
        ->get();
    }
    public function buscaTabelaTomadorInt($tomador)
    {
        return TabelaPreco::where(function($query) use ($tomador){
            $user = auth()->user();
            $query->where('empresa_id', $user->empresa_id)
            ->whereIn('tomador_id', $tomador);

            // if ($user->hasPermissionTo('admin')) {
            //     $query->whereIn('tomador', $tomador);
            // }else{
            //      $query->where('empresa', $user->empresa)
            //      ->whereIn('tomador', $tomador);
            // }
           
        })
        ->get();
    }
    public function buscaUnidadeTabela($id,$tomador = null)
    {
        return TabelaPreco::where(function($query) use ($id,$tomador){
            $user = auth()->user();
            $query->where([
                ['tsrubrica',$id],
                ['tomador_id',$tomador],
                ['empresa_id', $user->empresa_id]
            ])
            ->orWhere([
                ['tsdescricao',$id],
                ['tomador_id',$tomador],
                ['empresa_id', $user->empresa_id],
            ])
            ->orWhere([
                ['id',$id],
                ['empresa_id', $user->empresa_id]
            ]);

            // if ($user->hasPermissionTo('admin')) {
            //     $query->where([
            //         ['tsrubrica',$id],
            //         ['tomador',$tomador]
            //     ])
            //     ->orWhere([
            //         ['tsdescricao',$id],
            //         ['tomador',$tomador]
            //     ])
            //     ->orWhere('id',$id);
            // }else{
            //     $query->where([
            //         ['tsrubrica',$id],
            //         ['tomador',$tomador],
            //         ['empresa', $user->empresa]
            //     ])
            //     ->orWhere([
            //         ['tsdescricao',$id],
            //         ['tomador',$tomador],
            //         ['empresa', $user->empresa],
            //     ])
            //     ->orWhere([
            //         ['id',$id],
            //         ['empresa', $user->empresa]
            //     ]);
            // }
           
        })
        ->first();
    }
    public function buscaUnidadeTabelaRelatorio($tomador)
    {
        return TabelaPreco::where('tomador_id',$tomador)->get();
    }
    public function verificaRublica($dados)
    {
        return TabelaPreco::where([
            ['tsano',$dados['ano']],
            ['tsrubrica',$dados['rubricas']],
            ['tomador_id',$dados['tomador']]
        ])->count();
    }
    public function tomadorFolhar($id)
    {
        return DB::table('base_calculos')
        ->join('tomadors', 'tomadors.id', '=', 'base_calculos.tomador_id')
        ->join('tabela_precos', 'tomadors.id', '=', 'tabela_precos.tomador_id')
        ->join('rublicas', 'rublicas.rsrublica', '=', 'tabela_precos.tsrubrica_id')
        ->select('tabela_precos.tsrubrica','rublicas.rsincidencia')
        ->where('base_calculos.folhar',$id)
        ->distinct()
        ->get();
    }
    public function editar($dados,$id)
    {
        return TabelaPreco::where('id', $id)
        ->update([
            'tsano'=>$dados['ano'],
            'tsrubrica'=>$dados['rubricas'],
            'tsdescricao'=>$dados['descricao'],
            'tsvalor'=>str_replace(",",".",str_replace(".","",$dados['valor'])),
            'tstomvalor'=>str_replace(",",".",str_replace(".","",$dados['valor__tomador'])),
        ]);
    }
    public function Atualizar($tomador,$ano_h,$ano_o)
    {
        DB::table('tabela_precos')->where([
            ['tomador_id', $tomador],
            ['tsano', $ano_o],
        ])
        ->chunkById(100, function ($tabelaprecos) use($ano_h) {
            foreach ($tabelaprecos as $tabelapreco) {
                TabelaPreco::create([
                    'tsano'=>$ano_h,
                    'tsrubrica'=>$tabelapreco->tsrubrica,
                    'tsdescricao'=>$tabelapreco->tsdescricao,
                    'tsstatus'=>$tabelapreco->tsstatus,
                    'tsvalor'=>$tabelapreco->tsvalor,
                    'tstomvalor'=>$tabelapreco->tstomvalor,
                    'empresa_id'=>$tabelapreco->empresa,
                    'tomador_id'=>$tabelapreco->tomador
                ]);
            }
        });
    }
    public function deletar($id)
    {
        return TabelaPreco::where('id', $id)->delete();
    }
    public function deletatomador($id)
    {
        return TabelaPreco::where('tomador_id', $id)->delete();
    }
    public function buscaTabelaPrecoEditar($id)
    {
        return TabelaPreco::where('id', $id)->first();
    }
    public function verificaTabelaPrecoAtual($tomador,$ano)
    {
        return TabelaPreco::where([
            ['tomador', $tomador],
            ['tsano',$ano]
        ])
        ->get();
    }
}
