<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Empresa extends Model
{
    protected $fillable = [
        'esnome', 'escnpj', 'escpf', 'esfoto', 'estelefone', 'esdataregitro', 'esresponsavel', 'esemail', 'esseguro', 'escnae', 'escondicaosindicato', 'esretemferias', 'essindicalizado', 'escodigomunicipio','esesocial'
    ];
    public function cadastro($dados)
    {
        return Empresa::create([
            'esnome' => $dados['esnome'],
            'esfoto' => $dados['foto'],
            'estelefone' => $dados['telefone'],
            'escnpj' => $dados['escnpj'],
            'escpf' => $dados['cpf'],
            'esdataregitro' => $dados['dataregistro'],
            'esresponsavel' => $dados['responsave'],
            'esemail' => $dados['email'],
            'escnae' => $dados['cnae__codigo'],
            'escondicaosindicato' => $dados['contribuicao__sindicato'],
            'esretemferias' => $dados['retem__ferias'],
            'essindicalizado' => $dados['sincalizado'],
            'escodigomunicipio' => $dados['cod__municipio'],
            'esseguro' => $dados['seguro'],
        ]);
    }
    public function avuso()
    {
        return $this->hasMany(Avuso::class);
    }
    public function user()
    {
        return $this->hasMany(User::class);
    }
    public function trabalhador()
    {
        return $this->hasMany(Trabalhador::class);
    }
    public function tomador()
    {
        return $this->hasMany(Tomador::class);
    }
    public function endereco()
    {
        return $this->hasMany(Endereco::class);
    }
    public function valoresrublica()
    {
        return $this->hasMany(ValoresRublica::class);
    }
    public function lancamentotabela()
    {
        return $this->hasMany(Lancamentotabela::class);
    }
    public function fatura()
    {
        return $this->hasMany(Fatura::class);
    }
    public function buscaUnidadeEmpresa($id)
    {
        return DB::table('empresas')
            ->join('enderecos', 'empresas.id', '=', 'enderecos.empresa_id')
            // ->join('valores_rublicas', 'empresas.id', '=', 'valores_rublicas.empresa')
            ->select(
                'empresas.*',
                'enderecos.*',
                // 'valores_rublicas.*',
            )
            ->where(function ($query) use ($id) {
                $user = auth()->user();
                $query->where([
                    ['empresas.esnome', $id],
                    ['empresas.id', $user->empresa_id]
                ])
                    ->orWhere([
                        ['empresas.escnpj', $id],
                        ['empresas.id', $user->empresa_id]
                    ])
                    // ->orWhere([
                    //     ['empresas.escnae','like','%'.$id.'%'],
                    //     ['empresas.id', $user->empresa]
                    // ])
                    // ->orWhere([
                    //     ['empresas.escodigomunicipio','like','%'.$id.'%'],
                    //     ['empresas.id', $user->empresa]
                    // ])
                    ->orWhere([
                        ['empresas.id', $id],
                        ['empresas.id', $user->empresa_id]
                    ]);

                // if ($user->hasPermissionTo('admin')) {
                //     $query->where('empresas.esnome',$id)
                //     ->orWhere('empresas.escnpj',$id)
                //     // ->orWhere('empresas.escnae',$id)
                //     // ->orWhere('empresas.escodigomunicipio',$id)
                //     ->orWhere('empresas.id',$id);
                // }else{
                //     $query->where([
                //         ['empresas.esnome',$id],
                //         ['empresas.id', $user->empresa]
                //     ])
                //     ->orWhere([
                //         ['empresas.escnpj',$id],
                //         ['empresas.id', $user->empresa]
                //     ])
                //     // ->orWhere([
                //     //     ['empresas.escnae','like','%'.$id.'%'],
                //     //     ['empresas.id', $user->empresa]
                //     // ])
                //     // ->orWhere([
                //     //     ['empresas.escodigomunicipio','like','%'.$id.'%'],
                //     //     ['empresas.id', $user->empresa]
                //     // ])
                //     ->orWhere([
                //         ['empresas.id',$id],
                //         ['empresas.id', $user->empresa] 
                //     ]);
                // }
            })
            ->first();
    }
    public function EmpresaSefip($id)
    {
        return DB::table('empresas')
            ->join('enderecos', 'empresas.id', '=', 'enderecos.empresa_id')
            ->join('valores_rublicas', 'empresas.id', '=', 'valores_rublicas.empresa_id')
            ->select(
                'empresas.*',
                'enderecos.*',
            )
            ->where(function ($query) use ($id) {
                
                $query->where('empresas.id', $id);
                // if ($user->hasPermissionTo('admin')) {
                //     $query->where('empresas.id',$id);
                // }else{
                //     $query->where('empresas.id', $user->empresa);
                // }
            })
            ->first();
    }
    public function buscaListaEmpresaInt($id)
    {
        return Empresa::whereIn('id', $id)->select('esnome')->get();
    }
    public function buscaListaEmpresa($id)
    {
        return Empresa::select('id', 'esnome', 'escnpj', 'esresponsavel', 'estelefone')->where(function ($query) use ($id) {
            $user = auth()->user();
                if ($id) {
                    $query->where([
                        ['empresas.esnome', 'like', '%' . $id . '%'],
                        ['empresas.id', $user->empresa]
                    ])->orWhere([
                        ['empresas.escnpj', 'like', '%' . $id . '%'],
                        ['empresas.id', $user->empresa]
                    ])->orWhere([
                        ['empresas.escnae', 'like', '%' . $id . '%'],
                        ['empresas.id', $user->empresa]
                    ])->orWhere([
                        ['empresas.escodigomunicipio', 'like', '%' . $id . '%'],
                        ['empresas.id', $user->empresa]
                    ])
                    ->orWhere([
                            ['empresas.id', $id],
                            ['empresas.id', $user->empresa]
                    ]);
                }
            })
            ->orderBy('empresas.esnome', 'asc')
            ->distinct()
            ->limit(100)
            ->get();
    }
    public function buscaListaEmpresaPaginate($id, $condicao)
    {
        return Empresa::select('id', 'esnome', 'escnpj', 'esresponsavel', 'estelefone')->where(function ($query) use ($id) {
            $user = auth()->user();
            $query->where([
                ['empresas.esnome', 'like', '%' . $id . '%'],
                ['empresas.id', $user->empresa]
            ])->orWhere([
                ['empresas.escnpj', 'like', '%' . $id . '%'],
                ['empresas.id', $user->empresa]
            ])->orWhere([
                ['empresas.escnae', 'like', '%' . $id . '%'],
                ['empresas.id', $user->empresa]
            ])->orWhere([
                ['empresas.escodigomunicipio', 'like', '%' . $id . '%'],
                ['empresas.id', $user->empresa]
            ])
                ->orWhere([
                    ['empresas.id', $id],
                    ['empresas.id', $user->empresa]
                ]);

            // if ($user->hasPermissionTo('admin')) {
            //     if ($id) {
            //         $query->where('empresas.esnome','like','%'.$id.'%')
            //         ->orWhere('empresas.escnpj','like','%'.$id.'%')
            //         ->orWhere('empresas.esresponsavel','like','%'.$id.'%')
            //         ->orWhere('empresas.escnae','like','%'.$id.'%')
            //         ->orWhere('empresas.escodigomunicipio','like','%'.$id.'%');
            //     }else{
            //         $query->orWhere('empresas.id','>',0);
            //     }
            // }else{
            //     $query->where([
            //         ['empresas.esnome','like','%'.$id.'%'],
            //         ['empresas.id', $user->empresa]
            //     ])->orWhere([
            //         ['empresas.escnpj','like','%'.$id.'%'],
            //         ['empresas.id', $user->empresa]
            //     ])->orWhere([
            //         ['empresas.escnae','like','%'.$id.'%'],
            //         ['empresas.id', $user->empresa]
            //     ])->orWhere([
            //         ['empresas.escodigomunicipio','like','%'.$id.'%'],
            //         ['empresas.id', $user->empresa]
            //     ])
            //     ->orWhere([
            //         ['empresas.id',$id],
            //         ['empresas.id', $user->empresa] 
            //     ]);
            // }
        })
            ->orderBy('empresas.esnome', $condicao)
            ->distinct()
            ->limit(100)
            ->paginate(10);
    }
    public function buscaUsuario($id)
    {
        return DB::table('empresas')
            ->join('users', 'empresas.id', '=', 'users.empresa')
            ->select(
                'empresas.*',
                'users.name',
                'users.cargo',
                'users.id',
                'users.empresa'
            )
            ->where('name', $id)
            ->first();
    }
    public function buscaContribuicaoSidicato($id)
    {
        return Empresa::where([
            ['id', $id],
            ['essindicalizado', '1-Sim']
        ])
            ->select('escondicaosindicato', 'esseguro')
            ->first();
    }
    public function buscaSeguro($id)
    {
        return Empresa::where('id', $id)
            ->select('esseguro','escondicaosindicato')
            ->first();
    }
    public function editar($dados, $id)
    {
        return Empresa::where('id', $id)
            ->update([
                'esnome' => $dados['esnome'],
                'esfoto' => $dados['foto'],
                'estelefone' => $dados['telefone'],
                'escnpj' => $dados['escnpj'],
                'escpf' => $dados['cpf'],
                'esdataregitro' => $dados['dataregistro'],
                'esresponsavel' => $dados['responsave'],
                'esemail' => $dados['email'],
                'escnae' => $dados['cnae__codigo'],
                'escondicaosindicato' => $dados['contribuicao__sindicato'],
                'esretemferias' => $dados['retem__ferias'],
                'essindicalizado' => $dados['sincalizado'],
                'escodigomunicipio' => $dados['cod__municipio'],
                'esseguro' => $dados['seguro'],
                'esesocial' => $dados['inivalid']
            ]);
    }
    public function deletar($id)
    {
        return Empresa::where('id', $id)->delete();
    }
    public function editarFoto($dados)
    {
        return Empresa::where('id', $dados['empresa'])
            ->update(['esfoto' => $dados['image_file']]);
    }
    public function buscaEmpresaUsuario()
    {
        return DB::table('empresas')
        ->join('users', 'empresas.id', '=', 'users.empresa')
        ->select(
            'empresas.esnome',
            'users.name',
        )
        ->get();
    }
}
