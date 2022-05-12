<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Tomador extends Model
{
    protected $fillable = [
        'tsnome','tsfantasia','tsstatusfantasia','tscnpj','tsmatricula','tstipo','tssimples','tstelefone','empresa_id'
    ];
    public function empresa()
    {
        return $this->hasMany(Empresa::class);
    }
    public function incidefolhar()
    {
        return $this->hasMany(IncideFolhar::class);
    }
    public function endereco()
    {
        return $this->hasMany(Endereco::class);
    }
    public function taxa()
    {
        return $this->hasMany(Taxa::class);
    }
    public function bancario()
    {
        return $this->hasMany(Bancario::class);
    }
    public function cartaoponto()
    {
        return $this->hasMany(CartaoPonto::class);
    }
    public function parametrosefip()
    {
        return $this->hasMany(Parametrosefip::class);
    }
    public function indicefatura()
    {
        return $this->hasMany(IndiceFatura::class);
    }
    public function tabelapreco()
    {
        return $this->hasMany(TabelaPreco::class);
    }
    public function lancamentotabela()
    {
        return $this->hasMany(Lancamentotabela::class);
    }
    public function fatura()
    {
        return $this->hasMany(Fatura::class);
    }
    public function basecalculo()
    {
        return $this->hasMany(BaseCalculo::class);
    }
    public function cadastro($dados)
    {
        
       return Tomador::create([
            'tsnome'=>$dados['nome__completo'],
            'tsfantasia'=>$dados['nome__fantasia'],
            'tsstatusfantasia'=>isset($dados['radio_fantasia'])?$dados['radio_fantasia']:null,
            'tscnpj'=>$dados['cnpj'],
            'tsmatricula'=>$dados['matricula'],
            'tssimples'=>$dados['simples'],
            'tstelefone'=>$dados['telefone'],
            'tstipo'=>$dados['tipo'],
            'empresa_id'=>$dados['empresa']

        ]);
    }
    
    public function verificaCadastroCnpj($dados)
    {
        $user = auth()->user();
        return Tomador::where([
            ['tscnpj',$dados['cnpj']],
            ['empresa_id',$user->empresa_id]
        ])
        ->count();
    }
    public function buscaListaTomador($tomador)
    {
        return Tomador::where('empresa_id',$tomador)->select('id')->get();
    }
    public function buscaListaTomadorPaginate($id,$condicao)
    {
        return Tomador::select(
            'id',
            'tsnome',
            'tscnpj',
            'tsmatricula'
        )
        ->where(function($query) use ($id,$condicao){
            $user = auth()->user();
            if ($id) {
                $query->orWhere([
                    ['tomadors.tsnome','like','%'.$id.'%'],
                    ['tomadors.empresa_id', $user->empresa_id]
                ])
                ->orWhere([
                    ['tomadors.tscnpj','like','%'.$id.'%'],
                    ['tomadors.empresa_id', $user->empresa_id]
                    ])
                ->orWhere([
                    ['tomadors.tsmatricula','like','%'.$id.'%'],
                    ['tomadors.empresa_id', $user->empresa_id]
                ]);
            }else{
                $query->where('tomadors.empresa_id', $user->empresa_id);
            }

            // if ($user->hasPermissionTo('admin')) {
            //     if ($id) {
            //         $query->orWhere('tsnome','like','%'.$id.'%')
            //         ->orWhere('tscnpj','like','%'.$id.'%')
            //         ->orWhere('tsmatricula','like','%'.$id.'%');
            //     }else{
            //         $query->where('tomadors.id','>',0);
            //     }
               
            // }else{
            //     if ($id) {
            //         $query->orWhere([
            //             ['tomadors.tsnome','like','%'.$id.'%'],
            //             ['tomadors.empresa', $user->empresa]
            //         ])
            //         ->orWhere([
            //             ['tomadors.tscnpj','like','%'.$id.'%'],
            //             ['tomadors.empresa', $user->empresa]
            //             ])
            //         ->orWhere([
            //             ['tomadors.tsmatricula','like','%'.$id.'%'],
            //             ['tomadors.empresa', $user->empresa]
            //         ]);
            //     }else{
            //         $query->where('tomadors.empresa', $user->empresa);
            //     }
               
            // }
           
        })
        ->orderBy('tsnome',$condicao) 
        ->orderBy('tsmatricula',$condicao)
        ->distinct()
        ->paginate(20);
    }
    public function first($id)
    {
       return DB::table('tomadors')
            ->join('enderecos', 'tomadors.id', '=', 'enderecos.tomador_id')
            ->join('taxas', 'tomadors.id', '=', 'taxas.tomador_id')
            // ->join('retencao_faturas', 'tomadors.id', '=', 'retencao_faturas.tomador')
            ->join('cartao_pontos', 'tomadors.id', '=', 'cartao_pontos.tomador_id')
            ->join('parametrosefips', 'tomadors.id', '=', 'parametrosefips.tomador_id')
            ->join('incide_folhars', 'tomadors.id', '=', 'incide_folhars.tomador_id')
            ->join('indice_faturas', 'tomadors.id', '=', 'indice_faturas.tomador_id')
            ->join('bancarios', 'tomadors.id', '=', 'bancarios.tomador_id')
            ->select(
                
                'enderecos.*',
                'taxas.*',
                // 'retencao_faturas.*',
                'cartao_pontos.*',
                'parametrosefips.*',
                'incide_folhars.*',
                'indice_faturas.*',
                'bancarios.*',
                'tomadors.*', 
            )
            ->where(function($query) use ($id){
                $user = auth()->user();
                $query->where([
                    ['tsnome',$id],
                    ['tomadors.empresa_id', $user->empresa_id]
                ])
                ->orWhere([
                    ['tscnpj',$id],
                    ['tomadors.empresa_id', $user->empresa_id],
                ])
                ->orWhere([
                    ['tomadors.id',$id],
                    ['tomadors.empresa_id', $user->empresa_id],
                ]);
                // ->orWhere([
                //     ['tsmatricula',$id],
                //     ['tomadors.empresa', $user->empresa],
                // ]);

                // if ($user->hasPermissionTo('admin')) {
                //     $query->where('tsnome',$id)
                //     ->orWhere('tscnpj',$id)
                //     // ->orWhere('tsmatricula',$id)
                //     ->orWhere('tomadors.id',$id); 
                // }else{
                //      $query->where([
                //             ['tsnome',$id],
                //             ['tomadors.empresa', $user->empresa]
                //         ])
                //         ->orWhere([
                //             ['tscnpj',$id],
                //             ['tomadors.empresa', $user->empresa],
                //         ])
                //         ->orWhere([
                //             ['tomadors.id',$id],
                //             ['tomadors.empresa', $user->empresa],
                //         ]);
                //         // ->orWhere([
                //         //     ['tsmatricula',$id],
                //         //     ['tomadors.empresa', $user->empresa],
                //         // ]);
                // }
               
            })
            ->first();
    }
    public function pesquisa($id)
    {
        return DB::table('tomadors')
        ->join('cartao_pontos', 'tomadors.id', '=', 'cartao_pontos.tomador_id')
        ->select(
            'tomadors.tsnome',
            'tomadors.tsmatricula',
            'tomadors.tscnpj',
            'cartao_pontos.tomador',
            'cartao_pontos.csdiasuteis',
            'cartao_pontos.cssabados',
            'cartao_pontos.csdomingos',
        ) 
        ->where(function($query) use ($id){
            $user = auth()->user();
            if ($id) {
                $query->where([
                       ['tsnome','like','%'.$id.'%'],
                       ['tomadors.empresa_id', $user->empresa_id]
                   ])
                   ->orWhere([
                       ['tscnpj','like','%'.$id.'%'],
                       ['tomadors.empresa_id', $user->empresa_id],
                   ])
                   ->orWhere([
                       ['tomadors.id','like','%'.$id.'%'],
                       ['tomadors.empresa_id', $user->empresa_id],
                   ])
                   ->orWhere([
                       ['tsmatricula','like','%'.$id.'%'],
                       ['tomadors.empresa_id', $user->empresa_id],
                   ]);
               }else{
                   $query->where([
                       ['tomadors.id','>',$id],
                       ['tomadors.empresa_id', $user->empresa_id]
                   ]);
               }

            // if ($user->hasPermissionTo('admin')) {
            //     if ($id) {
            //         $query->where('tsnome','like','%'.$id.'%')
            //         ->orWhere('tscnpj', 'like', '%'.$id.'%')
            //         ->orWhere('tsmatricula', 'like', '%'.$id.'%')
            //         ->orWhere('tomadors.id',$id);
            //     }else{
            //         $query->where('tomadors.id','>',$id);
            //     }
            // }else{
            //     if ($id) {
            //      $query->where([
            //             ['tsnome','like','%'.$id.'%'],
            //             ['tomadors.empresa', $user->empresa]
            //         ])
            //         ->orWhere([
            //             ['tscnpj','like','%'.$id.'%'],
            //             ['tomadors.empresa', $user->empresa],
            //         ])
            //         ->orWhere([
            //             ['tomadors.id','like','%'.$id.'%'],
            //             ['tomadors.empresa', $user->empresa],
            //         ])
            //         ->orWhere([
            //             ['tsmatricula','like','%'.$id.'%'],
            //             ['tomadors.empresa', $user->empresa],
            //         ]);
            //     }else{
            //         $query->where([
            //             ['tomadors.id','>',$id],
            //             ['tomadors.empresa', $user->empresa]
            //         ]);
            //     }
            // }
           
        })
        ->orderBy('tomadors.tsnome')
        ->distinct()
        ->limit(100)
        ->get();
    }
    public function editar($dados,$id)
    {
      return Tomador::where('id', $id)
      ->update(
        [
            'tsnome'=>$dados['nome__completo'],
            'tsfantasia'=>$dados['nome__fantasia'],
            'tsstatusfantasia'=>isset($dados['radio_fantasia'])?$dados['radio_fantasia']:null,
            'tscnpj'=>$dados['cnpj'],
            'tsmatricula'=>$dados['matricula'],
            'tssimples'=>$dados['simples'],
            'tstelefone'=>$dados['telefone'],
            'tstipo'=>$dados['tipo']
        ]
     );
    }
    public function deletar($id)
    {
      return Tomador::where('id', $id)->delete();
    }
    public function buscaNomeTomadorTabelaPreco($id)
    {
        return Tomador::where('id', $id)
        ->select('tsnome')
        ->first();
    }
    public function tomadorBoletim($id)
    {
        return DB::table('tomadors')
        ->join('empresas', 'empresas.id', '=', 'tomadors.empresa_id')
        ->select('empresas.esnome','tomadors.tsnome')
        ->where(function($query) use ($id){
            $user = auth()->user();
            $query->where([
                ['tomadors.id',$id],
                ['tomadors.empresa_id', $user->empresa_id]
            ]);
            // if ($user->hasPermissionTo('admin')) {
            //     $query->where('tomadors.id',$id);
            // }else{
            //     $query->where([
            //         ['tomadors.id',$id],
            //         ['tomadors.empresa', $user->empresa]
            //     ]);
            // }
           
        })
        ->first();
    }

    public function tomadorFatura($tomador,$inicio,$final)
    {
        return DB::table('enderecos')
        ->join('tomadors', 'tomadors.id', '=', 'enderecos.tomador_id')
        ->join('base_calculos', 'tomadors.id', '=', 'base_calculos.tomador_id')
        ->join('folhars', 'folhars.id', '=', 'base_calculos.folhar_id')
        ->join('bancarios', 'tomadors.id', '=', 'bancarios.tomador_id')
        ->join('parametrosefips', 'tomadors.id', '=', 'parametrosefips.tomador_id')
        ->select(
            'folhars.fscodigo',
            'tomadors.tsnome',
            'tomadors.tsmatricula',
            'tomadors.tscnpj',
            'tomadors.tstelefone',
            'tomadors.empresa_id',
            'enderecos.escep',
            'enderecos.eslogradouro',
            'enderecos.esnum',
            'enderecos.esmunicipio',
            'enderecos.esuf',
            'bancarios.bsbanco',
            'bancarios.bsagencia',
            'bancarios.bsoperacao',
            'bancarios.bsconta',
            'parametrosefips.psfpas',
            'parametrosefips.psconfpas',
            'parametrosefips.psgrps',
            'parametrosefips.psresol',
            'parametrosefips.pscnae',
            'parametrosefips.psfapaliquota',
            // 'parametrosefips.psrataaliquota',
            'parametrosefips.psratajustados',
            'parametrosefips.psfpasterceiros',
            'parametrosefips.psaliquotaterceiros',
             DB::raw('count(base_calculos.trabalhador_id) as trabalhador')
        )
        ->groupBy(
            'folhars.fscodigo',
            'tomadors.tsnome',
            'tomadors.tsmatricula',
            'tomadors.tscnpj',
            'tomadors.tstelefone',
            'tomadors.empresa_id',
            'enderecos.escep',
            'enderecos.eslogradouro',
            'enderecos.esnum',
            'enderecos.esmunicipio',
            'enderecos.esuf',
            'bancarios.bsbanco',
            'bancarios.bsagencia',
            'bancarios.bsoperacao',
            'bancarios.bsconta',
            'parametrosefips.psfpas',
            'parametrosefips.psconfpas',
            'parametrosefips.psgrps',
            'parametrosefips.psresol',
            'parametrosefips.pscnae',
            'parametrosefips.psfapaliquota',
            // 'parametrosefips.psrataaliquota',
            'parametrosefips.psratajustados',
            'parametrosefips.psfpasterceiros',
            'parametrosefips.psaliquotaterceiros',
        )
        ->where(function($query) use ($tomador,$inicio,$final){
            $user = auth()->user();
            $query->where([
                ['tomadors.id',$tomador],
                ['tomadors.empresa_id', $user->empresa_id]
            ])
            // ->whereDate('folhars.fsfinal', $final)
            ->whereBetween('folhars.fsfinal',[$inicio,$final]); 

            // if ($user->hasPermissionTo('admin')) {
            //     $query->where('tomadors.id',$tomador) 
            //     ->whereDate('folhars.fsfinal', $final);
            // }else{
            //     $query->where([
            //         ['tomadors.id',$tomador],
            //         ['tomadors.empresa', $user->empresa]
            //     ])->whereDate('folhars.fsfinal', $final);
            // }
           
        })
        ->first();
    }
    public function relatorioGeral($empresa)
    {
        return Tomador::where('empresa_id', $empresa)
        ->select('tsnome','tscnpj','tstelefone','tsmatricula','id')
        ->orderBy('tsnome', 'asc')
        ->get();
    }
    public function quantidadeTomador()
    {
        return DB::table('tomadors')
        ->join('empresas', 'empresas.id', '=', 'tomadors.empresa_id')
        ->count();
    }
}
