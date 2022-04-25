<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Lancamentotabela extends Model
{
    protected $fillable = [
        'liboletim','lsdata','lsnumero','lsstatus','lsferiado','tomador_id','empresa_id'
    ];
    public function cadastro($dados)
    {
       return Lancamentotabela::create([
            'liboletim'=>$dados['liboletim'],
            'lsdata'=>$dados['data'],
            'lsnumero'=>$dados['num__trabalhador'],
            'lsstatus'=>$dados['status'],
            'lsferiado'=>$dados['feriado'],
            'tomador_id'=>$dados['tomador'],
            'empresa_id'=>$dados['empresa']
        ]);
    }
    public function buscaListaLancamentoTab($id,$status)
    {
        return DB::table('lancamentotabelas')
        ->join('tomadors', 'tomadors.id', '=', 'lancamentotabelas.tomador_id')
        ->select(
            'tomadors.tsnome',
            'tomadors.tscnpj', 
            'lancamentotabelas.*', 
            )
        ->where(function($query) use ($id,$status){
            $user = auth()->user();
            if ($id) {
                $query->where([
                    ['lancamentotabelas.liboletim',$id],
                    ['lancamentotabelas.lsstatus',$status],
                    ['lancamentotabelas.empresa_id', $user->empresa]
                ]);
            }else{
                $query->where([
                    ['lancamentotabelas.id','>',$id],
                    ['lancamentotabelas.lsstatus',$status],
                    ['lancamentotabelas.empresa_id', $user->empresa]
                ]);
            }

            // if ($user->hasPermissionTo('admin')) {
            //     if ($id) {
            //         $query->where([
            //             ['lancamentotabelas.liboletim',$id],
            //             ['lancamentotabelas.lsstatus',$status]
            //         ])
            //         ->orWhere('lancamentotabelas.id',$id);
            //     }else{
            //         $query->where([
            //             ['lancamentotabelas.id','>',$id],
            //             ['lancamentotabelas.lsstatus',$status]
            //         ]);
            //     }
              
            // }else{
            //     if ($id) {
            //         $query->where([
            //             ['lancamentotabelas.liboletim',$id],
            //             ['lancamentotabelas.lsstatus',$status],
            //             ['lancamentotabelas.empresa', $user->empresa]
            //         ]);
            //     }else{
            //         $query->where([
            //             ['lancamentotabelas.id','>',$id],
            //             ['lancamentotabelas.lsstatus',$status],
            //             ['lancamentotabelas.empresa', $user->empresa]
            //         ]);
            //     }
            // }
        })
        ->orderBy('created_at','desc')
        ->distinct()
        ->limit(100)
        ->get();
    }
    public function buscaListas($status,$condicao = null)
    {
        return DB::table('lancamentotabelas')
        ->join('tomadors', 'tomadors.id', '=', 'lancamentotabelas.tomador_id')
        ->join('cartao_pontos', 'tomadors.id', '=', 'cartao_pontos.tomador_id')
        ->select(
            'tomadors.tsnome',
            'cartao_pontos.csdiasuteis',
            'cartao_pontos.cssabados',
            'cartao_pontos.csdomingos', 
            'lancamentotabelas.*', 
            )
        ->where(function($query) use ($status){
            $user = auth()->user();
            $query->where([
                ['lancamentotabelas.lsstatus',$status],
                ['tomadors.empresa_id', $user->empresa]
            ]);

            // if ($user->hasPermissionTo('admin')) {
            //     $query->where('lsstatus',$status);
            // }else{
            //     $query->where([
            //         ['lancamentotabelas.lsstatus',$status],
            //         ['tomadors.empresa', $user->empresa]
            //     ]);
            // }
        })
        ->orderBy('lancamentotabelas.liboletim', $condicao)
        ->paginate(5);
    }
    public function pesquisaLista($status,$condicao = null,$dados)
    {
        return DB::table('lancamentotabelas')
        ->join('tomadors', 'tomadors.id', '=', 'lancamentotabelas.tomador_id')
        ->join('cartao_pontos', 'tomadors.id', '=', 'cartao_pontos.tomador_id')
        ->select(
            'tomadors.tsnome', 
            'cartao_pontos.csdiasuteis',
            'cartao_pontos.cssabados',
            'cartao_pontos.csdomingos', 
            'lancamentotabelas.*', 
            )
        ->where(function($query) use ($status,$dados){
            $user = auth()->user();
            $query->where([
                ['lancamentotabelas.lsstatus',$status],
                ['tomadors.empresa_id', $user->empresa_id],
                ['lancamentotabelas.liboletim','like','%'.$dados.'%'] 
            ])
            ->orWhere([
                ['lsstatus',$status],
                ['tomadors.empresa_id', $user->empresa_id],
                ['tomadors.tsnome','like','%'.$dados.'%']
            ])
            ->orWhere([
                ['lsstatus',$status],
                ['tomadors.empresa_id', $user->empresa_id],
                ['tomadors.tscnpj','like','%'.$dados.'%']
            ]);

            // if ($user->hasPermissionTo('admin')) {
            //     $query->where([
            //         ['lsstatus',$status],
            //         ['lancamentotabelas.liboletim','like','%'.$dados.'%']
            //     ])
            //     ->orWhere([
            //         ['lsstatus',$status],
            //         ['tomadors.tsnome','like','%'.$dados.'%']
            //     ])
            //     ->orWhere([
            //         ['lsstatus',$status],
            //         ['tomadors.tscnpj','like','%'.$dados.'%']
            //     ]);
            // }else{
            //     $query->where([
            //         ['lancamentotabelas.lsstatus',$status],
            //         ['tomadors.empresa', $user->empresa],
            //         ['lancamentotabelas.liboletim','like','%'.$dados.'%']
            //     ])
            //     ->orWhere([
            //         ['lsstatus',$status],
            //         ['tomadors.empresa', $user->empresa],
            //         ['tomadors.tsnome','like','%'.$dados.'%']
            //     ])
            //     ->orWhere([
            //         ['lsstatus',$status],
            //         ['tomadors.empresa', $user->empresa],
            //         ['tomadors.tscnpj','like','%'.$dados.'%']
            //     ]);
            // }
        })
        ->orderBy('lancamentotabelas.liboletim', $condicao)
        ->paginate(10);
    }
    public function buscaUnidade($id)
    {
        return DB::table('lancamentotabelas')
        ->join('tomadors', 'tomadors.id', '=', 'lancamentotabelas.tomador_id')
        ->join('cartao_pontos', 'tomadors.id', '=', 'cartao_pontos.tomador_id')
        ->select(
            'tomadors.tsnome',
            'tomadors.id as tomador', 
            'cartao_pontos.csdiasuteis',
            'cartao_pontos.cssabados',
            'cartao_pontos.csdomingos',
            'lancamentotabelas.*', 
            )
        ->where(function($query) use ($id){
            $user = auth()->user();
            $query->where([
                ['lancamentotabelas.id',$id],
                ['tomadors.empresa_id', $user->empresa_id]
            ]);
            // if ($user->hasPermissionTo('admin')) {
            //     $query->where('lancamentotabelas.id',$id);
            // }else{
            //     $query->where([
            //         ['lancamentotabelas.id',$id],
            //         ['tomadors.empresa', $user->empresa]
            //     ]);
            // }
        })
        ->first();
    }
    public function buscaUnidadeLancamentoTab($id,$status = null)
    {
        return Lancamentotabela::where(function($query) use ($id,$status){
            $user = auth()->user();
            $query->where([
                ['liboletim',$id],
                ['lsstatus',$status],
                ['empresa_id', $user->empresa_id]
            ]);
            // if ($user->hasPermissionTo('admin')) {
            //     $query->where([
            //         ['liboletim',$id],
            //         ['lsstatus',$status]
            //     ])->orWhere('id',$id);
            // }else{
            //     $query->where([
            //         ['liboletim',$id],
            //         ['lsstatus',$status],
            //         ['empresa', $user->empresa]
            //     ]);
            //     // ->orWhere([
            //     //     ['id',$id],
            //     //     //['trabalhadors.empresa', $user->empresa]
            //     // ]);
            // }
        })->first();
    }
    public function buscaTomador($id)
    {
        return Lancamentotabela::where('tomador_id',$id)->get();
    }
    public function verificaBoletimMes($dados,$novadata)
    {
        return Lancamentotabela::where(function($query) use ($dados,$novadata){
            $user = auth()->user();
            $query->where([
                ['liboletim',$dados['liboletim']],
                ['lsstatus',$dados['status']],
                ['empresa_id', $user->empresa_id]
            ])
            ->whereMonth('created_at',$novadata[1])
            ->whereYear('created_at',$novadata[0]);

            // if ($user->hasPermissionTo('admin')) {
            //     $query->where([
            //         ['liboletim',$dados['liboletim']],
            //         ['lsstatus',$dados['status']]
            //     ])
            //     ->whereMonth('created_at',$novadata[1])
            //     ->whereYear('created_at',$novadata[0]);
            // }else{
            //     $query->where([
            //         ['liboletim',$dados['liboletim']],
            //         ['lsstatus',$dados['status']],
            //         ['empresa', $user->empresa]
            //     ])
            //     ->whereMonth('created_at',$novadata[1])
            //     ->whereYear('created_at',$novadata[0]);
            // }
        })->count();
    }
    public function verificarFolhar($inicio,$final)
    {
        $user = auth()->user();
        return Lancamentotabela::whereBetween('lsdata',[$inicio,$final])
        ->where('empresa_id',$user->empresa_id)
        ->count();
    }
    public function verificaBoletimDias($dados)
    {
        return Lancamentotabela::where(function($query) use ($dados){
            $user = auth()->user();
            $query->where([
                ['liboletim',$dados['liboletim']],
                ['lsstatus',$dados['status']],
                ['empresa_id', $user->empresa_id]
            ])
            ->whereDate('created_at',$dados['data']);
            // if ($user->hasPermissionTo('admin')) {
            //     $query->where([
            //         ['liboletim',$dados['liboletim']],
            //         ['lsstatus',$dados['status']]
            //     ])
            //     ->whereDate('created_at',$dados['data']);
            // }else{
            //     $query->where([
            //         ['liboletim',$dados['liboletim']],
            //         ['lsstatus',$dados['status']],
            //         ['empresa', $user->empresa]
            //     ])
            //     ->whereDate('created_at',$dados['data']);
            // }
        })->count();
    }
    public function relatorioBoletimTabela($id)
    { 
        return DB::table('lancamentotabelas')
        // ->join('lancamentorublicas', 'trabalhadors.id', '=', 'lancamentorublicas.trabalhador')
        ->join('lancamentorublicas', 'lancamentotabelas.id', '=', 'lancamentorublicas.lancamento_id')
        ->join('tomadors', 'tomadors.id', '=', 'lancamentotabelas.tomador_id')
        ->join('empresas', 'empresas.id', '=', 'tomadors.empresa_id')
        ->select(
            // 'trabalhadors.tsnome as trabalhadornome',
            // 'trabalhadors.id as trabalhadorid',
            // 'trabalhadors.tsmatricula', 
            'lancamentorublicas.licodigo',
            'lancamentorublicas.lshistorico',
            'lancamentorublicas.lsquantidade',
            'lancamentorublicas.lfvalor',
            'lancamentorublicas.lftomador',
            'lancamentorublicas.trabalhador_id',
            'lancamentotabelas.liboletim',
            'lancamentotabelas.lsdata',
            'empresas.esnome',
            'empresas.id',
            'tomadors.tsnome' 
            )
        ->where(function($query) use ($id){
            $user = auth()->user();
            $query->where([
                ['lancamentotabelas.liboletim',$id],
                ['lancamentotabelas.empresa_id', $user->empresa]
            ]);
            // if ($user->hasPermissionTo('admin')) {
            //     $query->where('lancamentotabelas.liboletim',$id);
            // }else{
            //     $query->where([
            //         ['lancamentotabelas.liboletim',$id],
            //         ['lancamentotabelas.empresa', $user->empresa]
            //     ]);
            // }
        })
        ->get();
    }
    public function relatoriocartaoponto($id) 
    {
        return DB::table('trabalhadors')
        ->join('bolcartaopontos', 'trabalhadors.id', '=', 'bolcartaopontos.trabalhador_id')
        ->join('lancamentotabelas', 'lancamentotabelas.id', '=', 'bolcartaopontos.lancamento_id')
        ->join('tomadors', 'tomadors.id', '=', 'lancamentotabelas.tomador_id')
        ->join('empresas', 'empresas.id', '=', 'tomadors.empresa_id')
        ->select(
            'trabalhadors.tsnome as trabalhadornome',
            // 'trabalhadors.id as trabalhadorid',
            // 'trabalhadors.tsmatricula', 
            // 'bolcartaopontos.licodigo',
            // 'bolcartaopontos.lshistorico',
            // 'bolcartaopontos.lsquantidade',
            // 'bolcartaopontos.lfvalor',
            // 'bolcartaopontos.trabalhador',
            'bolcartaopontos.*',
            'lancamentotabelas.liboletim',
            'lancamentotabelas.lsdata',
            'lancamentotabelas.empresa_id',
            'empresas.esnome',
            'tomadors.tsnome' 
            )
        ->where(function($query) use ($id){
            $user = auth()->user();
            $query->where([
                ['lancamentotabelas.liboletim',$id],
                ['trabalhadors.empresa_id', $user->empresa_id]
            ]);

            // if ($user->hasPermissionTo('admin')) {
            //     $query->where('lancamentotabelas.liboletim',$id);
            // }else{
            //     $query->where([
            //         ['lancamentotabelas.liboletim',$id],
            //         ['trabalhadors.empresa', $user->empresa]
            //     ]);
            // }
        })
        ->get();
    }
    public function editar($dados,$id)
    {
        return Lancamentotabela::where('id', $id)
        ->update([
            'liboletim'=>$dados['liboletim'],
            'lsdata'=>$dados['data'],
            'lsnumero'=>$dados['num__trabalhador'],
            'lsferiado'=>$dados['feriado'],
            'tomador_id'=>$dados['tomador']
        ]);
    }
    public function deletar($id)
    {
      return Lancamentotabela::where('id', $id)->delete();
    }
    public function deletarTomador($id)
    {
        return Lancamentotabela::where('tomador_id', $id)->delete();
    }
    public function quantidadeCartaoPonto()
    {
        return DB::table('lancamentotabelas')
        ->join('empresas', 'empresas.id', '=', 'lancamentotabelas.empresa_id')
        ->where('lancamentotabelas.lsstatus', 'D')
        ->count();
    }
    public function quantidadeBoletimTabela()
    {
        return DB::table('lancamentotabelas')
        ->join('empresas', 'empresas.id', '=', 'lancamentotabelas.empresa_id')
        ->where('lancamentotabelas.lsstatus', 'M')
        ->count();
    }
    public function boletimTomador($id,$ano_inicio,$ano_final)
    {
        return Lancamentotabela::select(
            'liboletim',
            'lsdata',
            'lsstatus',
            'id'
        )
        ->where('tomador_id',$id)
        ->whereBetween('lsdata',[$ano_inicio, $ano_final])
        ->get();
    }
}
