<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Lancamentorublica extends Model
{
    protected $fillable = [
        'lshistorico','lfvalor','lftomador','lsquantidade','licodigo','lsdescricao','trabalhador_id','lancamentotabela_id','created_at'
    ];
    public function lancamentotabela()
    {
        return $this->belongsTo(Lancamentotabela::class);
    }
    public function trabalhador()
    {
        return $this->belongsTo(Trabalhador::class);
    }
    public function cadastro($dados)
    {
       return Lancamentorublica::create([
            'lshistorico'=>$dados['rubrica'],
            'lsquantidade'=>str_replace(",",".",$dados['quantidade']),
            'licodigo'=>$dados['codigo'],
            'lsdescricao'=>$dados['descricao'],
            'trabalhador_id'=>$dados['trabalhador'],
            'lancamentotabela_id'=>$dados['lancamento'],
            'created_at'=>$dados['data'],
            'lfvalor'=>$dados['valor']?str_replace(",",".",$dados['valor']):0,
            'lftomador'=>$dados['lftomador']?str_replace(",",".",$dados['lftomador']):0        ]);
    }
    public function listacadastro($dados,$id,$status,$condicao)
    {
        return DB::table('trabalhadors')
        ->join('lancamentorublicas', 'trabalhadors.id', '=', 'lancamentorublicas.trabalhador_id')
        ->join('lancamentotabelas', 'lancamentotabelas.id', '=', 'lancamentorublicas.lancamentotabela_id')
        ->select(
            'trabalhadors.tsnome', 
            'lancamentorublicas.*', 
            )
            ->where(function($query) use ($status,$id,$dados){
                $user = auth()->user();
                if ($dados) {
                    $query->where([
                        ['lancamentotabelas.lsstatus',$status],
                        ['lancamentotabelas.empresa', $user->empresa_id],
                        ['lancamentotabelas.id',$id], 
                        ['lancamentotabelas.liboletim','like','%'.$dados.'%'] 
                    ])
                    ->orWhere([
                        ['lancamentotabelas.lsstatus',$status],
                        ['lancamentotabelas.empresa', $user->empresa_id],
                        ['lancamentotabelas.id',$id], 
                        ['trabalhadors.tsnome','like','%'.$dados.'%']
                    ]);
                    // ->orWhere([
                    //     ['lancamentotabelas.lsstatus',$status],
                    //     ['lancamentotabelas.empresa', $user->empresa],
                    //     ['tomadors.tscnpj','like','%'.$id.'%']
                    // ]);
                }else{
                    $query->where([
                        ['lancamentotabelas.lsstatus',$status],
                        ['lancamentotabelas.empresa_id', $user->empresa_id],
                        ['lancamentotabelas.id',$id] 
                    ]);
                }
            })
        ->orderBy('lancamentotabelas.liboletim', $condicao)
        ->paginate(5);
    }
    public function buscaUnidadeRublica($id) 
    {
        return DB::table('trabalhadors')
        ->join('lancamentorublicas', 'trabalhadors.id', '=', 'lancamentorublicas.trabalhador_id')
        ->join('lancamentotabelas', 'lancamentotabelas.id', '=', 'lancamentorublicas.lancamentotabela_id')
        ->join('tomadors', 'tomadors.id', '=', 'lancamentotabelas.tomador_id')
        ->select(
            'trabalhadors.*', 
            'lancamentorublicas.*', 
            )
        ->where(function($query) use ($id){
            $user = auth()->user();
            
            $query->where([
                ['lancamentorublicas.licodigo',$id],
                ['trabalhadors.empresa_id', $user->empresa_id]
            ])->orWhere([
                ['lancamentorublicas.id',$id],
                ['trabalhadors.empresa_id', $user->empresa_id]
            ]);
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
        ->join('lancamentorublicas', 'lancamentotabelas.id', '=', 'lancamentorublicas.lancamentotabela_id')
        ->where([
            ['lancamentorublicas.licodigo', $dados['codigo']],
            ['lancamentorublicas.trabalhador_id', $dados['trabalhador']],
            ['lancamentotabelas.tomador_id',$dados['tomador']]
        ])
        ->whereMonth('lancamentorublicas.created_at',$novadata[1])
        ->whereYear('lancamentorublicas.created_at',$novadata[0])
        ->count();
    }
    public function verificaTrabalhador($dados,$novadata)
    {
        return Lancamentorublica::select('trabalhador')
        ->where('lancamentotabela_id', $dados['lancamento'])
        ->distinct()
        ->whereMonth('created_at',$novadata[1])
        ->whereYear('created_at',$novadata[0])
        ->get();
    }
    public function buscaListaRelatorioLancamentoRublica($dados)
    {
        
        return DB::table('lancamentotabelas')
        ->join('lancamentorublicas', 'lancamentotabelas.id', '=', 'lancamentorublicas.lancamentotabela_id')
        ->join('tomadors', 'tomadors.id', '=', 'lancamentotabelas.tomador_id')
        ->select(
            'lancamentorublicas.*',
            'lancamentotabelas.tomador_id'
        )
       ->where(function($query) use ($dados){ 
            $user = auth()->user();
            if ($dados['tomador']) {
                $query->where([
                    ['lancamentorublicas.trabalhador',$dados['trabalhador']],
                    ['lancamentorublicas.empresa_id', $user->empresa]
                ]) 
                ->whereBetween('lancamentotabelas.lsdata',
                [$dados['ano_inicial'], 
                $dados['ano_final']]);
            }else{
                $query->where([
                    ['lancamentorublicas.trabalhador_id',$dados['trabalhador']],
                    ['lancamentorublicas.empresa_id', $user->empresa],
                    ['tomadors.id',$dados['tomador']]
                ]) 
                ->whereBetween('lancamentotabelas.lsdata',
                [$dados['ano_inicial'], 
                $dados['ano_final']]);
            }
            
            // if ($user->hasPermissionTo('admin')) {
            //     if ($dados['tomador']) {
            //         $query->where([
            //             ['lancamentorublicas.trabalhador',$dados['trabalhador']],
            //             ['tomadors.id',$dados['tomador']]
            //         ])
            //         ->whereBetween('lancamentotabelas.lsdata',[$dados['ano_inicial'], $dados['ano_final']]);
            //     }else{
            //         $query->where('lancamentorublicas.trabalhador',$dados['trabalhador'])
            //         ->whereBetween('lancamentotabelas.lsdata',
            //         [$dados['ano_inicial'], 
            //         $dados['ano_final']]);
            //     }
               
            // }else{
            //     if ($dados['tomador']) {
            //         $query->where([
            //             ['lancamentorublicas.trabalhador',$dados['trabalhador']],
            //             ['lancamentorublicas.empresa', $user->empresa]
            //         ]) 
            //         ->whereBetween('lancamentotabelas.lsdata',
            //         [$dados['ano_inicial'], 
            //         $dados['ano_final']]);
            //     }else{
            //         $query->where([
            //             ['lancamentorublicas.trabalhador',$dados['trabalhador']],
            //             ['lancamentorublicas.empresa', $user->empresa],
            //             ['tomadors.id',$dados['tomador']]
            //         ]) 
            //         ->whereBetween('lancamentotabelas.lsdata',
            //         [$dados['ano_inicial'], 
            //         $dados['ano_final']]);
            //     }
            // }
        })
        ->get();
    }
    public function buscaListaLancamentoRublica($tomador,$ano_inicio,$ano_final)
    {
        
        return DB::table('lancamentotabelas')
        ->join('lancamentorublicas', 'lancamentotabelas.id', '=', 'lancamentorublicas.lancamentotabela_id')
        ->join('tomadors', 'tomadors.id', '=', 'lancamentotabelas.tomador_id')
        ->select(
            'lancamentorublicas.*',
            'lancamentotabelas.tomador_id'
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
            //     ->whereBetween('lancamentotabelas.lsdata',[$ano_inicio, $ano_final]);
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
        ->join('lancamentorublicas', 'lancamentotabelas.id', '=', 'lancamentorublicas.lancamentotabela_id')
        ->join('tomadors', 'tomadors.id', '=', 'lancamentotabelas.tomador_id')
        ->select(
            'lancamentorublicas.*',
            'lancamentotabelas.tomador_id'
        )
        ->where(function($query) use ($empresa,$ano_inicio,$ano_final){
            $user = auth()->user();
            $query->where('lancamentotabelas.empresa_id',$empresa)
            ->whereBetween('lancamentorublicas.created_at',[$ano_inicio, $ano_final]);

            // if ($user->hasPermissionTo('admin')) {
            //     $query->where('lancamentotabelas.empresa',$empresa)
            //     ->whereBetween('lancamentorublicas.created_at',[$ano_inicio, $ano_final]);
            // }
        })
        ->get();
    }
    public function editar($dados,$id)
    {
        return Lancamentorublica::where('id', $id)
        ->update([
            // 'lshistorico'=>$dados['rubrica'],
            'lsquantidade'=>$dados['quantidade'],
            // 'licodigo'=>$dados['codigo'],
            // 'lsdescricao'=>$dados['descricao'],
            // 'trabalhador_id'=>$dados['trabalhador'],
            // 'lancamentotabela_id'=>$dados['lancamento'],
            // 'created_at'=>$dados['data'],
            // 'lfvalor'=>str_replace(",",".",$dados['valor']),
            // 'lftomador'=>str_replace(",",".",$dados['lftomador'])
        ]);
    }
    public function editarBoletim($dados,$id)
    {
        return Lancamentorublica::where('lancamentotabela_id', $id)
        ->update([
            'created_at'=>$dados['data'],
        ]);
    }
    public function deletar($id)
    {
      return Lancamentorublica::where('id', $id)->orWhere('lancamentotabela_id', $id)->delete();
    }
    public function deletarTrabalhador($id)
    {
        return Lancamentorublica::where('trabalhador_id', $id)->delete();
    }
    // public function boletimTabela($id)
    // {
    //     return Lancamentorublica::select(
    //         'lsquantidade',
    //         'lshistorico',
    //         'lfvalor',
    //         'lftomador',
    //         'licodigo',
    //         'lancamento'
    //         )
    //     ->whereIn('lancamento', $id)
    //     //->groupBy('lftomador','lfvalor','licodigo','lshistorico','liboletim','lsdata')
    //     ->get();
    // }
    public function boletimTabela($id)
    {
        return DB::table('lancamentotabelas')
        ->join('lancamentorublicas', 'lancamentotabelas.id', '=', 'lancamentorublicas.lancamentotabela_id')
        ->join('tomadors', 'tomadors.id', '=', 'lancamentotabelas.tomador_id')
        ->selectRaw(
            '
            lancamentorublicas.lsquantidade as quantidade,
            lancamentotabelas.liboletim,
            lancamentotabelas.lsdata,
            lancamentorublicas.lshistorico,
            lancamentorublicas.lfvalor,
            lancamentorublicas.lftomador,
            lancamentorublicas.licodigo'
        )
        // ->where(function($query) use ($id,$ano_inicio,$ano_final){
        //     $user = auth()->user();
        //     $query->where('lancamentotabelas.tomador',$id)
        //     ->whereBetween('lancamentorublicas.created_at',[$ano_inicio, $ano_final]);

        //     // if ($user->hasPermissionTo('admin')) {
        //     //     $query->where('lancamentotabelas.tomador',$id)
        //     //     ->whereBetween('lancamentorublicas.created_at',[$ano_inicio, $ano_final]);
        //     // }
        // })
        ->whereIn('lancamentorublicas.lancamentotabela_id', $id)
        ->groupBy('lancamentorublicas.lsquantidade','lancamentorublicas.lftomador','lancamentorublicas.lfvalor','lancamentorublicas.licodigo','lancamentorublicas.lshistorico','lancamentotabelas.liboletim','lancamentotabelas.lsdata')
        ->get();
    }
    public function buscaListaTablelaTrabalhador($id)
    {
        return DB::table('trabalhadors')
        ->join('lancamentorublicas', 'trabalhadors.id', '=', 'lancamentorublicas.trabalhador_id')
        ->join('lancamentotabelas', 'lancamentotabelas.id', '=', 'lancamentorublicas.lancamentotabela_id')
        ->join('tomadors', 'tomadors.id', '=', 'lancamentotabelas.tomador_id')
        ->select(
            'lancamentotabelas.*', 
            'tomadors.tsnome'
            )
        ->where('trabalhadors.id',$id)
        ->orderBy('lancamentotabelas.lsdata', 'desc')
        ->distinct()
        ->get();
    }
}
