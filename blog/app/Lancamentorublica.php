<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Lancamentorublica extends Model
{
    protected $fillable = [
        'lshistorico','lfvalor','lftomador','lsquantidade','licodigo','lsdescricao','trabalhador','lancamento','created_at'
    ];
    public function cadastro($dados)
    {
       return Lancamentorublica::create([
            'lshistorico'=>$dados['rubrica'],
            'lsquantidade'=>$dados['quantidade'],
            'licodigo'=>$dados['codigo'],
            'lsdescricao'=>$dados['descricao'],
            'trabalhador'=>$dados['trabalhador'],
            'lancamento'=>$dados['lancamento'],
            'created_at'=>$dados['data'],
            'lfvalor'=>str_replace(",",".",$dados['valor']),
            'lftomador'=>str_replace(",",".",$dados['lftomador'])
        ]);
    }
    public function listacadastro($id)
    {
        return DB::table('trabalhadors')
        ->join('lancamentorublicas', 'trabalhadors.id', '=', 'lancamentorublicas.trabalhador')
        ->join('lancamentotabelas', 'lancamentotabelas.id', '=', 'lancamentorublicas.lancamento')
        ->select(
            'trabalhadors.tsnome', 
            'lancamentorublicas.*', 
            )
        ->where('lancamentotabelas.id', $id)
        ->get();
    }
    public function buscaUnidadeRublica($id)
    {
        return DB::table('trabalhadors')
        ->join('lancamentorublicas', 'trabalhadors.id', '=', 'lancamentorublicas.trabalhador')
        ->join('lancamentotabelas', 'lancamentotabelas.id', '=', 'lancamentorublicas.lancamento')
        ->join('tomadors', 'tomadors.id', '=', 'lancamentotabelas.tomador')
        ->select(
            'trabalhadors.*', 
            'lancamentorublicas.*', 
            )
        ->where(function($query) use ($id){
            $user = auth()->user();
            if ($user->hasPermissionTo('admin')) {
                // $query->where('trabalhadors.tsnome', 'like', '%'.$id.'%');
                $query->where('lancamentorublicas.licodigo',$id)
                ->orWhere('lancamentorublicas.id',$id);
            }else{
                $query->where([
                    ['lancamentorublicas.licodigo',$id],
                    ['trabalhadors.empresa', $user->empresa]
                ])->orWhere([
                    ['lancamentorublicas.id',$id],
                    ['trabalhadors.empresa', $user->empresa]
                ]);
            }
        })
        ->first();
    }
    public function UnidadeRublica($id)
    {
        return Lancamentorublica::where('id',$id)->first();
    }
    public function verifica ($dados,$novadata)
    {
        return DB::table('lancamentotabelas')
        ->join('lancamentorublicas', 'lancamentotabelas.id', '=', 'lancamentorublicas.lancamento')
        ->where([
            ['lancamentorublicas.licodigo', $dados['codigo']],
            ['lancamentorublicas.trabalhador', $dados['trabalhador']],
            ['lancamentotabelas.tomador',$dados['tomador']]
        ])
        ->whereMonth('lancamentorublicas.created_at',$novadata[1])
        ->whereYear('lancamentorublicas.created_at',$novadata[0])
        ->count();
    }
    public function buscaListaRelatorioLancamentoRublica($dados)
    {
        return DB::table('lancamentotabelas')
        ->join('lancamentorublicas', 'lancamentotabelas.id', '=', 'lancamentorublicas.lancamento')
        ->join('tomadors', 'tomadors.id', '=', 'lancamentotabelas.tomador')
        ->select(
            'lancamentorublicas.*',
        )
        ->where(function($query) use ($dados){ 
            $user = auth()->user();
            if ($user->hasPermissionTo('admin')) {
                $query->where('lancamentorublicas.trabalhador',$dados['trabalhador'])
                ->whereBetween('lancamentotabelas.created_at',[$dados['ano_inicial'], $dados['ano_final']]);
            }else{
                $query->where([
                    ['lancamentorublicas.trabalhador',$dados['trabalhador']],
                    ['lancamentorublicas.empresa', $user->empresa]
                ]) 
                ->whereBetween('lancamentorublicas.created_at',[$dados['ano_inicial'], $dados['ano_final']]);
            }
        })
        ->get();
    }
    public function editar($dados,$id)
    {
        return Lancamentorublica::where('id', $id)
        ->update([
            'lshistorico'=>$dados['rubrica'],
            'lsquantidade'=>$dados['quantidade'],
            'licodigo'=>$dados['codigo'],
            'lsdescricao'=>$dados['descricao'],
            'trabalhador'=>$dados['trabalhador'],
            'lancamento'=>$dados['lancamento'],
            'created_at'=>$dados['data'],
            'lfvalor'=>str_replace(",",".",$dados['valor']),
            'lftomador'=>str_replace(",",".",$dados['lftomador'])
        ]);
    }
    public function deletar($id)
    {
      return Lancamentorublica::where('id', $id)->orWhere('lancamento', $id)->delete();
    }
    public function deletarTrabalhador($id)
    {
        return Lancamentorublica::where('trabalhador', $id)->delete();
    }
}
