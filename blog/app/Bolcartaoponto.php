<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Bolcartaoponto extends Model
{
    protected $fillable = [
        'horas_normais','bsentradanoite','bssaidanoite','bsentradamadrugada','bssaidamadrugada','bsentradamanhao','bssaidamanhao','bsentradatarde','bssaidatarde','bstotal','bshoraex','bshoraexcem','bsadinortuno','trabalhador','lancamento','created_at'
    ];
    public function cadastro($dados)
    {
       return Bolcartaoponto::create([
            'bsentradamanhao'=>$dados['entrada1'],
            'bssaidamanhao'=>$dados['saida'],
            'bsentradatarde'=>$dados['entrada2'],
            'bssaidatarde'=>$dados['saida2'],
            'bsentradanoite'=>$dados['entrada3'],
            'bssaidanoite'=>$dados['saida3'],
            'bsentradamadrugada'=>$dados['entrada4'],
            'bssaidamadrugada'=>$dados['saida4'],
            'created_at'=>$dados['data'],
            'bstotal'=>str_replace(",",".",$dados['total']),
            'horas_normais'=>str_replace(",",".",$dados['horas_normais']),
            'bshoraex'=>str_replace(",",".",$dados['hora__extra']),
            'bshoraexcem'=>str_replace(",",".",$dados['horas__cem']),
            'bsadinortuno'=>str_replace(",",".",$dados['adc__noturno']),
            'trabalhador'=>$dados['trabalhador'],
            'lancamento'=>$dados['lancamento'],
        ]);
    }
    public function listaCartaoPontoPaginacao($id)
    {
        return DB::table('trabalhadors')
        ->join('bolcartaopontos', 'trabalhadors.id', '=', 'bolcartaopontos.trabalhador')
        ->join('lancamentotabelas', 'lancamentotabelas.id', '=', 'bolcartaopontos.lancamento')
        ->select(
            'trabalhadors.*', 
            'bolcartaopontos.*', 
            )
        // ->where('lancamentotabelas.id', $id)
        ->where(function($query) use ($id){
            $user = auth()->user();
            if ($user->hasPermissionTo('admin')) {
                $query->where('lancamentotabelas.id',$id);
            }else{
                $query->where([
                    ['lancamentotabelas.id',$id],
                    ['trabalhadors.empresa', $user->empresa]
                ]);
            }
        })
        ->paginate(15);
    } 
    public function buscaBoletimCartaoPonto($id,$boletim)
    {
        return DB::table('trabalhadors')
        ->join('bolcartaopontos', 'trabalhadors.id', '=', 'bolcartaopontos.trabalhador')
        ->join('lancamentotabelas', 'lancamentotabelas.id', '=', 'bolcartaopontos.lancamento')
        ->join('tomadors', 'tomadors.id', '=', 'lancamentotabelas.tomador')
        ->select(
            'trabalhadors.*', 
            'bolcartaopontos.*', 
            )
        ->where(function($query) use ($id,$boletim){ 
            $user = auth()->user();
            if ($user->hasPermissionTo('admin')) {
                $query->where([
                    ['trabalhadors.tsnome', 'like', '%'.$id.'%'],
                    ['bolcartaopontos.lancamento',$boletim]
                ]);
            }else{
                $query->where([
                    ['trabalhadors.tsnome',$id],
                    ['bolcartaopontos.lancamento',$boletim],
                    ['trabalhadors.empresa', $user->empresa]
                ]);
            }
        })
        ->first();
    }
    public function buscaUnidadeLancamento($id)
    {
        return DB::table('lancamentotabelas')
        ->join('bolcartaopontos', 'lancamentotabelas.id', '=', 'bolcartaopontos.lancamento')
        ->select(
            'lancamentotabelas.liboletim',
            'lancamentotabelas.lsdata',
            'lancamentotabelas.tomador',
            'lancamentotabelas.lsferiado',
            'lancamentotabelas.id',
            )
        ->where('bolcartaopontos.id',$id)
        ->first();
    }
   public function buscaListaRelatorioLancamentoBolcartao($dados)
   {
       return DB::table('lancamentotabelas')
       ->join('bolcartaopontos', 'lancamentotabelas.id', '=', 'bolcartaopontos.lancamento')
       ->join('tomadors', 'tomadors.id', '=', 'lancamentotabelas.tomador')
       ->select(
            'bolcartaopontos.*',
            'lancamentotabelas.tomador',
        )
        ->where(function($query) use ($dados){ 
            $user = auth()->user();
            if ($user->hasPermissionTo('admin')) {
                if ( isset($dados['idtomador'])) {
                    $query->where([
                        ['bolcartaopontos.trabalhador',$dados['trabalhador']],
                        ['tomadors.id',$dados['idtomador']]
                    ])
                    ->whereBetween('bolcartaopontos.created_at',[$dados['ano_inicial'], $dados['ano_final']]);
                }else{
                    $query->where('bolcartaopontos.trabalhador',$dados['trabalhador'])
                    ->whereBetween('bolcartaopontos.created_at',[$dados['ano_inicial'], $dados['ano_final']]);
                }
               
            }else{
                if (!$dados['idtomador']) {
                    $query->where([
                        ['bolcartaopontos.trabalhador',$dados['trabalhador']],
                        ['lancamentotabelas.empresa', $user->empresa],
                        ['tomadors.id',$dados['idtomador']]
                    ]) 
                    ->whereBetween('bolcartaopontos.created_at',
                    [$dados['ano_inicial'], 
                    $dados['ano_final']]);
                }else{
                    $query->where([
                        ['bolcartaopontos.trabalhador',$dados['trabalhador']],
                        ['lancamentotabelas.empresa', $user->empresa]
                    ]) 
                    ->whereBetween('bolcartaopontos.created_at',
                    [$dados['ano_inicial'], 
                    $dados['ano_final']]);
                }

            }
        })
        ->get();
   }

   public function buscaListaLancamentoBolcartao($tomador,$ano_inicio,$ano_final)
   {
        return DB::table('lancamentotabelas')
        ->join('bolcartaopontos', 'lancamentotabelas.id', '=', 'bolcartaopontos.lancamento')
        ->join('tomadors', 'tomadors.id', '=', 'lancamentotabelas.tomador')
        ->select(
            'bolcartaopontos.*',
            'lancamentotabelas.tomador',
        )
        ->where(function($query) use ($tomador,$ano_inicio,$ano_final){
            $user = auth()->user();
            if ($user->hasPermissionTo('admin')) {
                $query->where('lancamentotabelas.tomador',$tomador)
                ->whereBetween('bolcartaopontos.created_at',[$ano_inicio, $ano_final]);
            }
        })
        ->get();
   }
   public function buscaListaGeral($empresa,$ano_inicio,$ano_final)
   {
    return DB::table('lancamentotabelas')
    ->join('bolcartaopontos', 'lancamentotabelas.id', '=', 'bolcartaopontos.lancamento')
    ->join('tomadors', 'tomadors.id', '=', 'lancamentotabelas.tomador')
    ->select(
        'bolcartaopontos.*',
        'lancamentotabelas.tomador',
    )
    ->where(function($query) use ($empresa,$ano_inicio,$ano_final){
        $user = auth()->user();
        if ($user->hasPermissionTo('admin')) {
            $query->where('lancamentotabelas.empresa',$empresa)
            ->whereBetween('bolcartaopontos.created_at',[$ano_inicio, $ano_final]);
        }
    })
    ->get();
   }
    public function verifica($dados)
    {
        return Bolcartaoponto::where([
            ['lancamento', $dados['lancamento']],
            ['trabalhador', $dados['trabalhador']],
        ])
        ->whereDate('created_at', $dados['data'])
        ->count();
    }
    public function editar($dados,$id)
    {
        return Bolcartaoponto::where('id', $id)
        ->update([
           'bsentradamanhao'=>$dados['entrada1'],
            'bssaidamanhao'=>$dados['saida'],
            'bsentradatarde'=>$dados['entrada2'],
            'bssaidatarde'=>$dados['saida2'],
            'bsentradanoite'=>$dados['entrada3'],
            'bssaidanoite'=>$dados['saida3'],
            'bsentradamadrugada'=>$dados['entrada4'],
            'bssaidamadrugada'=>$dados['saida4'],
            'created_at'=>$dados['data'],
            'bstotal'=>str_replace(",",".",$dados['total']),
            'horas_normais'=>str_replace(",",".",$dados['horas_normais']),
            'bshoraex'=>str_replace(",",".",$dados['hora__extra']),
            'bshoraexcem'=>str_replace(",",".",$dados['horas__cem']),
            'bsadinortuno'=>str_replace(",",".",$dados['adc__noturno']),
        ]);
    }
    public function deletar($id) 
    {
      return Bolcartaoponto::where('id', $id)->delete();
    }
    public function deletarLancamentoTabela($id)
    {
        return Bolcartaoponto::where('lancamento', $id)->delete();
    }
    public function deletarTrabalador($id)
    {
        return Bolcartaoponto::where('trabalhador', $id)->delete();
    }
}
