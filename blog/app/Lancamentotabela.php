<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Lancamentotabela extends Model
{
    protected $fillable = [
        'liboletim','lsdata','lsnumero','lsstatus','lsferiado','tomador','empresa'
    ];
    public function cadastro($dados)
    {
       return Lancamentotabela::create([
            'liboletim'=>$dados['liboletim'],
            'lsdata'=>$dados['data'],
            'lsnumero'=>$dados['num__trabalhador'],
            'lsstatus'=>$dados['status'],
            'lsferiado'=>$dados['feriado'],
            'tomador'=>$dados['tomador'],
            'empresa'=>$dados['empresa']
        ]);
    }
    public function buscaListaLancamentoTab($id,$status)
    {
        return Lancamentotabela::where(function($query) use ($id,$status){
            $user = auth()->user();
            if ($user->hasPermissionTo('admin')) {
                if ($id) {
                    $query->where([
                        ['liboletim',$id],
                        ['lsstatus',$status]
                    ])
                    ->orWhere('id',$id);
                }else{
                    $query->where([
                        ['id','>',$id],
                        ['lsstatus',$status]
                    ]);
                }
              
            }else{
                if ($id) {
                    $query->where([
                        ['liboletim',$id],
                        ['lsstatus',$status],
                        ['empresa', $user->empresa]
                    ]);
                }else{
                    $query->where([
                        ['id','>',$id],
                        ['lsstatus',$status],
                        ['empresa', $user->empresa]
                    ]);
                }
            }
        })
        ->orderBy('created_at','desc')
        ->distinct()
        ->limit(100)
        ->get();
    }
    public function buscaUnidadeLancamentoTab($id,$status = null)
    {
        return Lancamentotabela::where(function($query) use ($id,$status){
            $user = auth()->user();
            if ($user->hasPermissionTo('admin')) {
                $query->where([
                    ['liboletim',$id],
                    ['lsstatus',$status]
                ])->orWhere('id',$id);
            }else{
                $query->where([
                    ['liboletim',$id],
                    ['lsstatus',$status],
                    ['empresa', $user->empresa]
                ]);
                // ->orWhere([
                //     ['id',$id],
                //     //['trabalhadors.empresa', $user->empresa]
                // ]);
            }
        })->first();
    }
    public function buscaTomador($id)
    {
        return Lancamentotabela::where('tomador',$id)->get();
    }
    public function verificaBoletimMes($dados,$novadata)
    {
        return Lancamentotabela::where(function($query) use ($dados,$novadata){
            $user = auth()->user();
            if ($user->hasPermissionTo('admin')) {
                $query->where([
                    ['liboletim',$dados['liboletim']],
                    ['lsstatus',$dados['status']]
                ])
                ->whereMonth('created_at',$novadata[1])
                ->whereYear('created_at',$novadata[0]);
            }else{
                $query->where([
                    ['liboletim',$dados['liboletim']],
                    ['lsstatus',$dados['status']],
                    ['empresa', $user->empresa]
                ])
                ->whereMonth('created_at',$novadata[1])
                ->whereYear('created_at',$novadata[0]);
            }
        })->count();
    }
    public function verificaBoletimDias($dados)
    {
        return Lancamentotabela::where(function($query) use ($dados){
            $user = auth()->user();
            if ($user->hasPermissionTo('admin')) {
                $query->where([
                    ['liboletim',$dados['liboletim']],
                    ['lsstatus',$dados['status']]
                ])
                ->whereDate('created_at',$dados['data']);
            }else{
                $query->where([
                    ['liboletim',$dados['liboletim']],
                    ['lsstatus',$dados['status']],
                    ['empresa', $user->empresa]
                ])
                ->whereDate('created_at',$dados['data']);
            }
        })->count();
    }
    public function relatorioBoletimTabela($id)
    {
        return DB::table('lancamentotabelas')
        // ->join('lancamentorublicas', 'trabalhadors.id', '=', 'lancamentorublicas.trabalhador')
        ->join('lancamentorublicas', 'lancamentotabelas.id', '=', 'lancamentorublicas.lancamento')
        ->join('tomadors', 'tomadors.id', '=', 'lancamentotabelas.tomador')
        ->join('empresas', 'empresas.id', '=', 'tomadors.empresa')
        ->select(
            // 'trabalhadors.tsnome as trabalhadornome',
            // 'trabalhadors.id as trabalhadorid',
            // 'trabalhadors.tsmatricula', 
            'lancamentorublicas.licodigo',
            'lancamentorublicas.lshistorico',
            'lancamentorublicas.lsquantidade',
            'lancamentorublicas.lfvalor',
            'lancamentorublicas.lftomador',
            'lancamentorublicas.trabalhador',
            'lancamentotabelas.liboletim',
            'lancamentotabelas.lsdata',
            'empresas.esnome',
            'tomadors.tsnome' 
            )
        ->where(function($query) use ($id){
            $user = auth()->user();
            if ($user->hasPermissionTo('admin')) {
                $query->where('lancamentotabelas.liboletim',$id);
            }else{
                $query->where([
                    ['lancamentotabelas.liboletim',$id],
                    ['lancamentotabelas.empresa', $user->empresa]
                ]);
            }
        })
        ->get();
    }
    public function relatoriocartaoponto($id) 
    {
        return DB::table('trabalhadors')
        ->join('bolcartaopontos', 'trabalhadors.id', '=', 'bolcartaopontos.trabalhador')
        ->join('lancamentotabelas', 'lancamentotabelas.id', '=', 'bolcartaopontos.lancamento')
        ->join('tomadors', 'tomadors.id', '=', 'lancamentotabelas.tomador')
        ->join('empresas', 'empresas.id', '=', 'tomadors.empresa')
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
            'empresas.esnome',
            'tomadors.tsnome' 
            )
        ->where(function($query) use ($id){
            $user = auth()->user();
            if ($user->hasPermissionTo('admin')) {
                $query->where('lancamentotabelas.liboletim',$id);
            }else{
                $query->where([
                    ['lancamentotabelas.liboletim',$id],
                    ['trabalhadors.empresa', $user->empresa]
                ]);
            }
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
            'tomador'=>$dados['tomador']
        ]);
    }
    public function deletar($id)
    {
      return Lancamentotabela::where('id', $id)->delete();
    }
    public function deletarTomador($id)
    {
        return Lancamentotabela::where('tomador', $id)->delete();
    }
}
