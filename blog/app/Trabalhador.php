<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Trabalhador extends Model
{
    protected $fillable = [
        'tsnome','tsnomesocial','tssocial','tsfoto','tscpf','tsmatricula','tsmae','tspai','tsuf','tstelefone','tssexo','tsescolaridade','tsindice','empresa_id'
    ];
    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }
    public function esocial()
    {
        return $this->belongsTo(Esocial::class);
    }
    public function documento()
    {
        return $this->hasMany(Documento::class);
    }
    public function categoria()
    {
        return $this->hasMany(Categoria::class);
    }
    public function nascimento()
    {
        return $this->hasMany(Nascimento::class);
    }
    public function basecalculo()
    {
        return $this->hasMany(BaseCalculo::class);
    }
    public function endereco()
    {
        return $this->hasMany(Endereco::class);
    }
    public function comissionado()
    {
        return $this->hasMany(Comissionado::class);
    }
    public function depedente()
    {
        return $this->hasMany(Dependente::class);
    }
    public function bancario()
    {
        return $this->hasMany(Bancario::class);
    }
    public function epi()
    {
        return $this->hasMany(Epi::class);
    }
    public function bolcartaoponto()
    {
        return $this->hasMany(Bolcartaoponto::class);
    }
    public function lancamentorublica()
    {
        return $this->hasMany(Lancamentorublica::class);
    }
    public function valorcalculo()
    {
        return $this->hasMany(ValorCalculo::class);
    }
    public function cadastro($dados)
    {
        
       return Trabalhador::create([
            'tsnome'=>$dados['nome__completo'],
            'tsnomesocial'=>$dados['nome__social'],
            'tssocial'=> isset($dados['radio_social'])?$dados['radio_social']:null,
            'tsfoto'=>$dados['foto'],
            'tscpf'=>$dados['cpf'],
            'tsmatricula'=>$dados['matricula'],
            'tsmae'=>$dados['nome__mae'],
            // 'tspai'=>$dados['simples'],
            'tstelefone'=>$dados['telefone'],
            'tssexo'=>$dados['sexo'],
            'tsescolaridade'=>$dados['grau__instrucao'],
            'empresa_id'=>$dados['empresa']
        ]);
    }
    public function VerificarCadastroCpf($dados)
    {
        $user = auth()->user();
        return Trabalhador::where([
            ['tscpf',$dados['cpf']],
            ['empresa_id',$user->empresa_id]
        ])
        ->count();
    }
    public function relatorioBoletimTabela($dados)
    {
        return Trabalhador::select('tsnome','id','tsmatricula')->whereIn('id', $dados)->get();
    }
    public function buscaListaTrabalhador($id)
    {
        return DB::table('trabalhadors')
        ->join('categorias', 'trabalhadors.id', '=', 'categorias.trabalhador_id')
        ->select(
            'trabalhadors.tsnome',
            'trabalhadors.id',
            'trabalhadors.tscpf',
            'trabalhadors.tsmatricula',
            'trabalhadors.created_at'
        ) 
        ->where(function($query) use ($id){
            $user = auth()->user();
            if ($id) {
                $query->where([
                    ['trabalhadors.tsnome','like','%'.$id.'%'],
                    ['trabalhadors.empresa_id', $user->empresa_id],
                    ['categorias.cssituacao','Ativo']
                ])
                ->orWhere([
                    ['trabalhadors.tscpf','like','%'.$id.'%'],
                    ['trabalhadors.empresa_id', $user->empresa_id],
                    ['categorias.cssituacao','Ativo']
                ])
                ->orWhere([
                    ['trabalhadors.tsmatricula','like','%'.$id.'%'],
                    ['trabalhadors.empresa_id', $user->empresa_id],
                    ['categorias.cssituacao','Ativo']
                ]);
            }else{
                $query->where([
                    ['trabalhadors.id','>',$id],
                    ['trabalhadors.empresa_id', $user->empresa_id],
                    ['categorias.cssituacao','Ativo']
                ]);
            }
            // if ($user->hasPermissionTo('admin')) {
            //     if ($id) {
            //         $query->where('tsnome','like','%'.$id.'%') 
            //         ->orWhere('tscpf','like','%'.$id.'%')
            //         ->orWhere('tsmatricula','like','%'.$id.'%');
            //     }else{
            //         $query->where('id','>',$id);
            //     }
            // }else{
            //     if ($id) {
            //         $query->where([
            //             ['trabalhadors.tsnome','like','%'.$id.'%'],
            //             ['trabalhadors.empresa', $user->empresa]
            //         ])
            //         ->orWhere([
            //             ['trabalhadors.tscpf','like','%'.$id.'%'],
            //             ['trabalhadors.empresa', $user->empresa],
            //         ])
            //         ->orWhere([
            //             ['trabalhadors.tsmatricula','like','%'.$id.'%'],
            //             ['trabalhadors.empresa', $user->empresa],
            //         ]);
            //     }else{
            //         $query->where([
            //             ['trabalhadors.id','>',$id],
            //             ['trabalhadors.empresa', $user->empresa]
            //         ]);
            //     }
            // }
            
        })
        ->orderBy('created_at','desc')
        ->distinct()
        ->limit(100)
        ->get();
      
    }
    public function listaCompletaTrabalhador($id)
    {
        return DB::table('trabalhadors')
            ->join('documentos', 'trabalhadors.id', '=', 'documentos.trabalhador_id')
            ->join('nascimentos', 'trabalhadors.id', '=', 'nascimentos.trabalhador_id')
            ->join('categorias', 'trabalhadors.id', '=', 'categorias.trabalhador_id')
            ->join('bancarios', 'trabalhadors.id', '=', 'bancarios.trabalhador_id')
            ->join('enderecos', 'trabalhadors.id', '=', 'enderecos.trabalhador_id')
            // ->join('dependentes', 'trabalhadors.id', '=', 'dependentes.trabalhador')
            ->select(
                'trabalhadors.*', 
                'documentos.*', 
                'bancarios.*',
                'categorias.*',
                'nascimentos.*',
                'enderecos.eslogradouro',
                'enderecos.esbairro',
                'enderecos.esestado',
                'enderecos.esmunicipio',
                'enderecos.esuf',
                'enderecos.escomplemento',
                'enderecos.esnum',
                'enderecos.escep',
                'enderecos.eiid'
                )
            ->where(function($query) use ($id){
                $user = auth()->user();
                $query->where([
                    ['trabalhadors.tsnome','like','%'.$id.'%'],
                    ['trabalhadors.empresa_id', $user->empresa_id]
                ])
                ->orWhere([
                    ['trabalhadors.tscpf','like','%'.$id.'%'],
                    ['trabalhadors.empresa_id', $user->empresa_id],
                ])
                ->orWhere([
                    ['trabalhadors.tsmatricula','like','%'.$id.'%'],
                    ['trabalhadors.empresa_id', $user->empresa_id], 
                ]);

                // if ($user->hasPermissionTo('admin')) {
                //     $query->orWhere('tsnome','like','%'.$id.'%') 
                //         ->orWhere('tscpf','like','%'.$id.'%')
                //         ->orWhere('tsmatricula','like','%'.$id.'%');
                // }else{
                //     $query->where([
                //         ['trabalhadors.tsnome','like','%'.$id.'%'],
                //         ['trabalhadors.empresa', $user->empresa]
                //     ])
                //     ->orWhere([
                //         ['trabalhadors.tscpf','like','%'.$id.'%'],
                //         ['trabalhadors.empresa', $user->empresa],
                //     ])
                //     ->orWhere([
                //         ['trabalhadors.tsmatricula','like','%'.$id.'%'],
                //         ['trabalhadors.empresa', $user->empresa],
                //     ]);
                // }
               
            })
            ->get();
    }
    public function buscaUnidadeTrabalhador($id)
    {
        return DB::table('trabalhadors')
            ->join('documentos', 'trabalhadors.id', '=', 'documentos.trabalhador_id')
            ->join('nascimentos', 'trabalhadors.id', '=', 'nascimentos.trabalhador_id')
            ->join('categorias', 'trabalhadors.id', '=', 'categorias.trabalhador_id')
            ->join('bancarios', 'trabalhadors.id', '=', 'bancarios.trabalhador_id')
            ->join('enderecos', 'trabalhadors.id', '=', 'enderecos.trabalhador_id')
            // ->join('dependentes', 'trabalhadors.id', '=', 'dependentes.trabalhador')
            ->select(
                'documentos.*', 
                'bancarios.*',
                'categorias.*',
                'nascimentos.*',
                'enderecos.eslogradouro',
                'enderecos.esbairro',
                'enderecos.esestado',
                'enderecos.esmunicipio',
                'enderecos.esuf',
                'enderecos.escomplemento',
                'enderecos.esnum',
                'enderecos.escep',
                'enderecos.eiid',
                'trabalhadors.*'
                )
            ->where(function($query) use ($id){
                $user = auth()->user();
                if ($user->hasPermissionTo('Super Admin')) {
                    $query->where('trabalhadors.id',$id);
                }else{
                    $query->where([
                        ['trabalhadors.tsnome',$id],
                        ['trabalhadors.empresa_id', $user->empresa_id]
                    ])
                    ->orWhere([
                        ['trabalhadors.tscpf',$id],
                        ['trabalhadors.empresa_id', $user->empresa_id],
                    ])
                    // ->orWhere([
                    //     ['trabalhadors.tsmatricula',$id],
                    //     ['trabalhadors.empresa', $user->empresa],
                    // ])
                    ->orWhere([
                        ['trabalhadors.id',$id],
                        ['trabalhadors.empresa_id', $user->empresa],
                    ]);
                }
               
            })
        ->first();
        }
    public function lista($id,$condicao)
    {
        return DB::table('trabalhadors')
            ->join('documentos', 'trabalhadors.id', '=', 'documentos.trabalhador_id')
            ->join('nascimentos', 'trabalhadors.id', '=', 'nascimentos.trabalhador_id')
            ->join('categorias', 'trabalhadors.id', '=', 'categorias.trabalhador_id')
            ->join('bancarios', 'trabalhadors.id', '=', 'bancarios.trabalhador_id')
            ->join('enderecos', 'trabalhadors.id', '=', 'enderecos.trabalhador_id')
            // ->join('dependentes', 'trabalhadors.id', '=', 'dependentes.trabalhador')
            ->select(
                'documentos.*', 
                'bancarios.*',
                'categorias.*',
                'nascimentos.*',
                'enderecos.*',
                'trabalhadors.*',
                )
                ->where(function($query) use ($id){
                    $user = auth()->user();
                    $query->where([
                        ['trabalhadors.tsnome','like','%'.$id.'%'],
                        ['trabalhadors.empresa_id', $user->empresa_id]
                    ])
                    ->orWhere([
                        ['trabalhadors.tscpf','like','%'.$id.'%'],
                        ['trabalhadors.empresa_id', $user->empresa_id],
                    ])
                    ->orWhere([
                        ['trabalhadors.tsmatricula','like','%'.$id.'%'],
                        ['trabalhadors.empresa_id', $user->empresa_id],
                    ])
                    ->where('trabalhadors.empresa_id', $user->empresa_id);

                    // if ($user->hasPermissionTo('admin')) {
                    //     if ($id) {
                    //         $query->orWhere('tsmatricula','like','%'.$id.'%')
                    //         ->orWhere('tsnome','like','%'.$id.'%')
                    //         ->orWhere('tscpf','like','%'.$id.'%');
                    //     }else{
                    //         $query->where('trabalhadors.id','>',0);
                    //     }
                    // }else{
                    //     $query->where([
                    //         ['trabalhadors.tsnome','like','%'.$id.'%'],
                    //         ['trabalhadors.empresa', $user->empresa]
                    //     ])
                    //     ->orWhere([
                    //         ['trabalhadors.tscpf','like','%'.$id.'%'],
                    //         ['trabalhadors.empresa', $user->empresa],
                    //     ])
                    //     ->orWhere([
                    //         ['trabalhadors.tsmatricula','like','%'.$id.'%'],
                    //         ['trabalhadors.empresa', $user->empresa],
                    //     ])
                    //     ->where('trabalhadors.empresa', $user->empresa);
                    // }
                   
                })
            ->orderBy('trabalhadors.tsnome', $condicao)
            ->paginate(20);
    }
    public function listaTrabalhadorInt($trabalhador)
    {
        return DB::table('trabalhadors')
        ->join('documentos', 'trabalhadors.id', '=', 'documentos.trabalhador_id')
        ->join('empresas', 'empresas.id', '=', 'trabalhadors.empresa_id')
        ->join('nascimentos', 'trabalhadors.id', '=', 'nascimentos.trabalhador_id')
        ->join('categorias', 'trabalhadors.id', '=', 'categorias.trabalhador_id')
        ->join('bancarios', 'trabalhadors.id', '=', 'bancarios.trabalhador_id')
        ->join('enderecos', 'trabalhadors.id', '=', 'enderecos.trabalhador_id')
        ->select(
            'trabalhadors.id',
            'trabalhadors.tsnome',
            'trabalhadors.tsmatricula',
            'trabalhadors.tscpf',
            'empresas.esnome',
            'empresas.escnpj', 
            'documentos.dspis', 
            'bancarios.*',
            'categorias.cbo',
            'enderecos.eslogradouro',
            'enderecos.esbairro',
            'enderecos.esestado',
            'enderecos.esmunicipio',
            'enderecos.esuf',
            'enderecos.escomplemento',
            'enderecos.esnum',
            'enderecos.escep',
            'enderecos.eiid'
            )
        ->where(function($query) use ($trabalhador){
            $user = auth()->user();
            $query->whereIn('trabalhadors.id',$trabalhador)
            ->where('trabalhadors.empresa_id',$user->empresa_id);
            // if ($user->hasPermissionTo('admin')) {
            //     $query->whereIn('trabalhadors.id',$trabalhador);
            // }else{
            //     $query->whereIn('trabalhadors.id',$trabalhador)
            //     ->where('trabalhadors.empresa',$user->empresa);
            // }
        })
        ->get();
    }
    public function editar($dados,$id)
    {
        return Trabalhador::where('id', $id)
        ->update([
            'tsnome'=>$dados['nome__completo'],
            'tsnomesocial'=>$dados['nome__social'],
            'tssocial'=>isset($dados['radio_social'])?$dados['radio_social']:null,
            'tsfoto'=>$dados['foto'],
            'tscpf'=>$dados['cpf'],
            'tsmatricula'=>$dados['matricula'],
            'tsmae'=>$dados['nome__mae'],
            // 'tspai'=>$dados['simples'],
            'tstelefone'=>$dados['telefone'],
            'tssexo'=>$dados['sexo'],
            'tsescolaridade'=>$dados['grau__instrucao'],
        ]);
    }
   
    public function deletar($id)
    {
        return Trabalhador::where('id', $id)->delete();
    }
    public function roltrabalhado()
    {
        return DB::table('trabalhadors')
        ->join('documentos', 'trabalhadors.id', '=', 'documentos.trabalhador_id')
        ->join('nascimentos', 'trabalhadors.id', '=', 'nascimentos.trabalhador_id')
        ->join('categorias', 'trabalhadors.id', '=', 'categorias.trabalhador_id')
        ->select(
            'trabalhadors.*', 
            'documentos.*', 
            'categorias.*',
            'nascimentos.*',
            )
            ->where(function($query){
                $user = auth()->user();
                $query->where('trabalhadors.empresa_id', $user->empresa_id);
                // if ($user->hasPermissionTo('admin')) {
                //     $query->where('trabalhadors.id', '>', 0);
                // }else{
                //     $query->where('trabalhadors.empresa', $user->empresa);
                // }
            })
        ->orderBy('tsnome', 'asc')
        ->get();
           
    }
    public function quantidadeTrabalhador()
    {
        return DB::table('trabalhadors')
        ->join('empresas', 'empresas.id', '=', 'trabalhadors.empresa_id')
        ->count();
    }
    public function listaTrabalhadorEmpresa()
    {
        return DB::table('trabalhadors')
        ->join('categorias', 'trabalhadors.id', '=', 'categorias.trabalhador_id')
        ->join('empresas', 'empresas.id', '=', 'trabalhadors.empresa_id')
        ->select(
            'trabalhadors.id',
            'trabalhadors.tsnome',
            'trabalhadors.tscpf', 
            'categorias.csadmissao',
            'empresas.esnome',
            'empresas.escnpj'
        )
        ->distinct()
        ->paginate(10);
    }
}
