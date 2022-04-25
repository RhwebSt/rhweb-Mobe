<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Bolcartaoponto extends Model
{
    protected $fillable = [
        'horas_normais','bsentradanoite','bssaidanoite','bsentradamadrugada','bssaidamadrugada','bsentradamanhao','bssaidamanhao','bsentradatarde','bssaidatarde','bstotal','bshoraex','bshoraexcem','bsadinortuno','trabalhador_id','lancamento_id','created_at'
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
            'trabalhador_id'=>$dados['trabalhador'],
            'lancamento_id'=>$dados['lancamento'],
        ]);
    }
    public function listaCartaoPontoPaginacao($id,$data)
    {
        return DB::table('trabalhadors')
        ->join('bolcartaopontos', 'trabalhadors.id', '=', 'bolcartaopontos.trabalhador_id')
        ->join('lancamentotabelas', 'lancamentotabelas.id', '=', 'bolcartaopontos.lancamento_id')
        ->select(
            'trabalhadors.*', 
            'bolcartaopontos.*', 
            )
        // ->where('lancamentotabelas.id', $id)
        ->where(function($query) use ($id,$data){
            $user = auth()->user();
            $query->where([
                ['lancamentotabelas.id',$id],
                ['trabalhadors.empresa', $user->empresa]
            ])
            ->whereDate('bolcartaopontos.created_at', $data);
            // if ($user->hasPermissionTo('admin')) {
            //     $query->where('lancamentotabelas.id',$id)
            //     ->whereDate('bolcartaopontos.created_at', $data);
            // }else{
            //     $query->where([
            //         ['lancamentotabelas.id',$id],
            //         ['trabalhadors.empresa', $user->empresa]
            //     ])
            //     ->whereDate('bolcartaopontos.created_at', $data);
            // }
        })
        ->paginate(15);
    } 
    public function buscaBoletimCartaoPonto($id,$boletim,$data)
    {
        return DB::table('trabalhadors')
        ->join('bolcartaopontos', 'trabalhadors.id', '=', 'bolcartaopontos.trabalhador_id')
        ->join('lancamentotabelas', 'lancamentotabelas.id', '=', 'bolcartaopontos.lancamento_id')
        ->join('tomadors', 'tomadors.id', '=', 'lancamentotabelas.tomador')
        ->select(
            'trabalhadors.*', 
            'bolcartaopontos.*', 
            )
        ->where(function($query) use ($id,$boletim,$data){ 
            $user = auth()->user();
            $query->where([
                ['trabalhadors.tsnome',$id],
                ['bolcartaopontos.lancamento_id',$boletim],
                ['trabalhadors.empresa_id', $user->empresa]
            ])
            ->whereDate('bolcartaopontos.created_at', $data);
            // if ($user->hasPermissionTo('admin')) {
            //     $query->where([
            //         ['trabalhadors.tsnome', 'like', '%'.$id.'%'],
            //         ['bolcartaopontos.lancamento',$boletim]
            //     ])
            //     ->whereDate('bolcartaopontos.created_at', $data);
            // }else{
            //     $query->where([
            //         ['trabalhadors.tsnome',$id],
            //         ['bolcartaopontos.lancamento',$boletim],
            //         ['trabalhadors.empresa', $user->empresa]
            //     ])
            //     ->whereDate('bolcartaopontos.created_at', $data);
            // }
        })
        ->first();
    }
    public function buscaUnidadeLancamento($id)
    {
        return DB::table('lancamentotabelas')
        ->join('bolcartaopontos', 'lancamentotabelas.id', '=', 'bolcartaopontos.lancamento_id')
        ->select(
            'lancamentotabelas.liboletim',
            'lancamentotabelas.lsdata',
            'lancamentotabelas.tomador_id',
            'lancamentotabelas.lsferiado',
            'lancamentotabelas.id',
            )
        ->where('bolcartaopontos.id',$id)
        ->first();
    }
   public function buscaListaRelatorioLancamentoBolcartao($dados)
   {
       return DB::table('lancamentotabelas')
       ->join('bolcartaopontos', 'lancamentotabelas.id', '=', 'bolcartaopontos.lancamento_id')
       ->join('tomadors', 'tomadors.id', '=', 'lancamentotabelas.tomador_id')
       ->select(
            'bolcartaopontos.*',
            'lancamentotabelas.tomador_id',
        )
        ->where(function($query) use ($dados){ 
            $user = auth()->user();
            if (!$dados['idtomador']) {
                $query->where([
                    ['bolcartaopontos.trabalhador_id',$dados['trabalhador']],
                    ['lancamentotabelas.empresa_id', $user->empresa],
                    ['tomadors.id',$dados['idtomador']]
                ]) 
                ->whereBetween('bolcartaopontos.created_at',
                [$dados['ano_inicial'], 
                $dados['ano_final']]);
            }else{
                $query->where([
                    ['bolcartaopontos.trabalhador_id',$dados['trabalhador']],
                    ['lancamentotabelas.empresa_id', $user->empresa]
                ]) 
                ->whereBetween('bolcartaopontos.created_at',
                [$dados['ano_inicial'], 
                $dados['ano_final']]);
            }
            // if ($user->hasPermissionTo('admin')) {
            //     if ( isset($dados['idtomador'])) {
            //         $query->where([
            //             ['bolcartaopontos.trabalhador',$dados['trabalhador']],
            //             ['tomadors.id',$dados['idtomador']]
            //         ])
            //         ->whereBetween('bolcartaopontos.created_at',[$dados['ano_inicial'], $dados['ano_final']]);
            //     }else{
            //         $query->where('bolcartaopontos.trabalhador',$dados['trabalhador'])
            //         ->whereBetween('bolcartaopontos.created_at',[$dados['ano_inicial'], $dados['ano_final']]);
            //     }
               
            // }else{
            //     if (!$dados['idtomador']) {
            //         $query->where([
            //             ['bolcartaopontos.trabalhador',$dados['trabalhador']],
            //             ['lancamentotabelas.empresa', $user->empresa],
            //             ['tomadors.id',$dados['idtomador']]
            //         ]) 
            //         ->whereBetween('bolcartaopontos.created_at',
            //         [$dados['ano_inicial'], 
            //         $dados['ano_final']]);
            //     }else{
            //         $query->where([
            //             ['bolcartaopontos.trabalhador',$dados['trabalhador']],
            //             ['lancamentotabelas.empresa', $user->empresa]
            //         ]) 
            //         ->whereBetween('bolcartaopontos.created_at',
            //         [$dados['ano_inicial'], 
            //         $dados['ano_final']]);
            //     }

            // }
        })
        ->get();
   }

   public function buscaListaLancamentoBolcartao($tomador,$ano_inicio,$ano_final)
   {
        return DB::table('lancamentotabelas')
        ->join('bolcartaopontos', 'lancamentotabelas.id', '=', 'bolcartaopontos.lancamento_id')
        ->join('tomadors', 'tomadors.id', '=', 'lancamentotabelas.tomador_id')
        ->select(
            'bolcartaopontos.*',
            'lancamentotabelas.tomador_id',
        )
        ->where(function($query) use ($tomador,$ano_inicio,$ano_final){
            $user = auth()->user();
            $query->where([
                ['lancamentotabelas.tomador_id',$tomador],
                ['lancamentotabelas.empresa_id',$user->empresa]
            ])
            ->whereBetween('lancamentotabelas.lsdata',[$ano_inicio, $ano_final]);

            // if ($user->hasPermissionTo('admin')) {
            //     $query->where('lancamentotabelas.tomador',$tomador)
            //     ->whereBetween('bolcartaopontos.created_at',[$ano_inicio, $ano_final]);
            // }else{
            //     $query->where([
            //         ['lancamentotabelas.tomador',$tomador],
            //         ['lancamentotabelas.empresa',$user->empresa]
            //     ])
            //     ->whereBetween('lancamentotabelas.lsdata',[$ano_inicio, $ano_final]);
            // }
        })
        ->get();
   }
   public function buscaListaGeral($empresa,$ano_inicio,$ano_final)
   {
    return DB::table('lancamentotabelas')
    ->join('bolcartaopontos', 'lancamentotabelas.id', '=', 'bolcartaopontos.lancamento_id')
    ->join('tomadors', 'tomadors.id', '=', 'lancamentotabelas.tomador_id')
    ->select(
        'bolcartaopontos.*',
        'lancamentotabelas.tomador_id',
    )
    ->where(function($query) use ($empresa,$ano_inicio,$ano_final){
        $user = auth()->user();
        $query->where('lancamentotabelas.empresa_id',$empresa)
        ->whereBetween('bolcartaopontos.created_at',[$ano_inicio, $ano_final]);
        // if ($user->hasPermissionTo('admin')) {
        //     $query->where('lancamentotabelas.empresa',$empresa)
        //     ->whereBetween('bolcartaopontos.created_at',[$ano_inicio, $ano_final]);
        // }
    })
    ->get();
   }
    public function verifica($dados)
    {
        return Bolcartaoponto::where([
            ['lancamento_id', $dados['lancamento']],
            ['trabalhador_id', $dados['trabalhador']],
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
    public function editarBoletim($dados,$id)
    {
        return Bolcartaoponto::where('lancamento_id', $id)
        ->update([
            'created_at'=>$dados['data'],
        ]);
    }
    public function deletar($id) 
    {
      return Bolcartaoponto::where('id', $id)->delete();
    }
    public function deletarLancamentoTabela($id)
    {
        return Bolcartaoponto::where('lancamento_id', $id)->delete();
    }
    public function deletarTrabalador($id)
    {
        return Bolcartaoponto::where('trabalhador_id', $id)->delete();
    }
    public function CartaoPonto($id)
    {
        return Bolcartaoponto::select(
            'bolcartaopontos.*'
        )
        ->whereIn('lancamento_id', $id)
        ->get();
    }
    public function boletimCartaoPonto($id,$ano_inicio,$ano_final) 
    {
        return DB::table('lancamentotabelas')
        ->join('bolcartaopontos', 'lancamentotabelas.id', '=', 'bolcartaopontos.lancamento_id')
        ->join('tomadors', 'tomadors.id', '=', 'lancamentotabelas.tomador_id')
        ->select(
            'bolcartaopontos.*',
            'lancamentotabelas.liboletim',
            'lancamentotabelas.lsdata'
        )
        ->where(function($query) use ($id,$ano_inicio,$ano_final){
            $user = auth()->user();
            $query->where('tomadors.id',$id)
            ->whereBetween('bolcartaopontos.created_at',[$ano_inicio, $ano_final]);
            // if ($user->hasPermissionTo('admin')) {
            //     $query->where('tomadors.id',$id)
            //     ->whereBetween('bolcartaopontos.created_at',[$ano_inicio, $ano_final]);
            // }
        })
        ->get();
    }
    public function buscaListaCartaoPontoTrabalhador($id)
    {
        return DB::table('trabalhadors')
        ->join('bolcartaopontos', 'trabalhadors.id', '=', 'bolcartaopontos.trabalhador_id')
        ->join('lancamentotabelas', 'lancamentotabelas.id', '=', 'bolcartaopontos.lancamento_id')
        ->join('tomadors', 'tomadors.id', '=', 'lancamentotabelas.tomador_id')
        ->select(
            'lancamentotabelas.*', 
            'tomadors.tsnome'
            )
        ->where('trabalhadors.id',$id)
        ->orderBy('lancamentotabelas.lsdata', 'desc')
        ->get();
    }
}
