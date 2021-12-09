<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Lancamentotabela extends Model
{
    protected $fillable = [
        'liboletim','lsdata','lsnumero','lsstatus','tomador',
    ];
    public function cadastro($dados)
    {
       return Lancamentotabela::create([
            'liboletim'=>$dados['liboletim'],
            'lsdata'=>$dados['data'],
            'lsnumero'=>$dados['num__trabalhador'],
            'lsstatus'=>$dados['status'],
            'tomador'=>$dados['tomador'],
        ]);
    }
    public function buscaListaLancamentoTab($id,$status)
    {
        return Lancamentotabela::where(function($query) use ($id,$status){
            $user = auth()->user();
            if ($user->hasPermissionTo('admin')) {
                $query->where([
                    ['liboletim','like','%'.$id.'%'],
                    ['lsstatus',$status]
                ])->orWhere('id',$id);
            }else{
                $query->where([
                    ['liboletim','like','%'.$id.'%'],
                    ['lsstatus',$status],
                    // ['trabalhadors.empresa', $user->empresa]
                ])->orWhere([
                    ['id',$id],
                    // ['trabalhadors.empresa', $user->empresa]
                ]);
            }
        })->get();
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
                    // ['trabalhadors.empresa', $user->empresa]
                ])->orWhere([
                    ['id',$id],
                    // ['trabalhadors.empresa', $user->empresa]
                ]);
            }
        })->first();
    }
    // public function buscaListaLacamentoTab($id)
    // {
    //     return Lancamentotabela::where('tomador',$id)->get();
    // }
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
                    ['trabalhadors.empresa', $user->empresa]
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
        ]);
    }
    public function deletar($id)
    {
      return Lancamentotabela::where('id', $id)->orWhere('tomador',$id)->delete();
    }
}
