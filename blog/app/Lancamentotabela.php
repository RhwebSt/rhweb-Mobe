<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Lancamentotabela extends Model
{
    protected $fillable = [
        'liboletim','lsdata','lsnumero','tomador'
    ];
    public function cadastro($dados)
    {
       return Lancamentotabela::create([
            'liboletim'=>$dados['liboletim'],
            'lsdata'=>$dados['data'],
            'lsnumero'=>$dados['num__trabalhador'],
            'tomador'=>$dados['tomador'],
        ]);
    }
    public function listacomun($id)
    {
        return Lancamentotabela::where('liboletim',$id)->orWhere('id',$id)->first();
    }
    public function listaget($id)
    {
        return Lancamentotabela::where('tomador',$id)->get();
    }
    public function relatorioboletimtabela($id)
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
