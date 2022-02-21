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
            'lsquantidade'=>str_replace(",",".",$dados['quantidade']),
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
        ->paginate(5);
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
    public function verificaTrabalhador($dados,$novadata)
    {
        return Lancamentorublica::select('trabalhador')
        ->where('lancamento', $dados['lancamento'])
        ->distinct()
        ->whereMonth('created_at',$novadata[1])
        ->whereYear('created_at',$novadata[0])
        ->get();
    }
    public function buscaListaRelatorioLancamentoRublica($dados)
    {
        
        return DB::table('lancamentotabelas')
        ->join('lancamentorublicas', 'lancamentotabelas.id', '=', 'lancamentorublicas.lancamento')
        ->join('tomadors', 'tomadors.id', '=', 'lancamentotabelas.tomador')
        ->select(
            'lancamentorublicas.*',
            'lancamentotabelas.tomador'
        )
       ->where(function($query) use ($dados){ 
            $user = auth()->user();
            if ($user->hasPermissionTo('admin')) {
                if ($dados['tomador']) {
                    $query->where([
                        ['lancamentorublicas.trabalhador',$dados['trabalhador']],
                        ['tomadors.id',$dados['tomador']]
                    ])
                    ->whereBetween('lancamentotabelas.lsdata',[$dados['ano_inicial'], $dados['ano_final']]);
                }else{
                    $query->where('lancamentorublicas.trabalhador',$dados['trabalhador'])
                    ->whereBetween('lancamentotabelas.lsdata',
                    [$dados['ano_inicial'], 
                    $dados['ano_final']]);
                }
               
            }else{
                if ($dados['tomador']) {
                    $query->where([
                        ['lancamentorublicas.trabalhador',$dados['trabalhador']],
                        ['lancamentorublicas.empresa', $user->empresa]
                    ]) 
                    ->whereBetween('lancamentotabelas.lsdata',
                    [$dados['ano_inicial'], 
                    $dados['ano_final']]);
                }else{
                    $query->where([
                        ['lancamentorublicas.trabalhador',$dados['trabalhador']],
                        ['lancamentorublicas.empresa', $user->empresa],
                        ['tomadors.id',$dados['tomador']]
                    ]) 
                    ->whereBetween('lancamentotabelas.lsdata',
                    [$dados['ano_inicial'], 
                    $dados['ano_final']]);
                }
            }
        })
        ->get();
    }
    public function buscaListaLancamentoRublica($tomador,$ano_inicio,$ano_final)
    {
        
        return DB::table('lancamentotabelas')
        ->join('lancamentorublicas', 'lancamentotabelas.id', '=', 'lancamentorublicas.lancamento')
        ->join('tomadors', 'tomadors.id', '=', 'lancamentotabelas.tomador')
        ->select(
            'lancamentorublicas.*',
            'lancamentotabelas.tomador'
        )
        ->where(function($query) use ($tomador,$ano_inicio,$ano_final){
            $user = auth()->user();
            if ($user->hasPermissionTo('admin')) {
                $query->where('lancamentotabelas.tomador',$tomador)
                ->whereBetween('lancamentotabelas.lsdata',[$ano_inicio, $ano_final]);
            }else{
                $query->where([
                    ['lancamentotabelas.tomador',$tomador],
                    ['lancamentotabelas.empresa',$user->empresa]
                ])
                ->whereBetween('lancamentotabelas.lsdata',[$ano_inicio, $ano_final]);
            }
        })
        ->get();
    }
    public function buscaListaGeral($empresa,$ano_inicio,$ano_final)
    {
        return DB::table('lancamentotabelas')
        ->join('lancamentorublicas', 'lancamentotabelas.id', '=', 'lancamentorublicas.lancamento')
        ->join('tomadors', 'tomadors.id', '=', 'lancamentotabelas.tomador')
        ->select(
            'lancamentorublicas.*',
            'lancamentotabelas.tomador'
        )
        ->where(function($query) use ($empresa,$ano_inicio,$ano_final){
            $user = auth()->user();
            if ($user->hasPermissionTo('admin')) {
                $query->where('lancamentotabelas.empresa',$empresa)
                ->whereBetween('lancamentorublicas.created_at',[$ano_inicio, $ano_final]);
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
    public function boletimTabela($id,$ano_inicio,$ano_final)
    {
        return DB::table('lancamentotabelas')
        ->join('lancamentorublicas', 'lancamentotabelas.id', '=', 'lancamentorublicas.lancamento')
        ->join('tomadors', 'tomadors.id', '=', 'lancamentotabelas.tomador')
        ->selectRaw(
            '
            SUM(lancamentorublicas.lsquantidade) as quantidade,
            lancamentotabelas.liboletim,
            lancamentotabelas.lsdata,
            lancamentorublicas.lshistorico,
            lancamentorublicas.lfvalor,
            lancamentorublicas.lftomador,
            lancamentorublicas.licodigo'
        )
        ->where(function($query) use ($id,$ano_inicio,$ano_final){
            $user = auth()->user();
            if ($user->hasPermissionTo('admin')) {
                $query->where('lancamentotabelas.tomador',$id)
                ->whereBetween('lancamentorublicas.created_at',[$ano_inicio, $ano_final]);
            }
        })
        ->groupBy('lancamentorublicas.lftomador','lancamentorublicas.lfvalor','lancamentorublicas.licodigo','lancamentorublicas.lshistorico','lancamentotabelas.liboletim','lancamentotabelas.lsdata')
        ->get();
    }
}
