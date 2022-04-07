<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Trabalhador extends Model
{
    protected $fillable = [
        'tsnome','tsnomesocial','tssocial','tsfoto','tscpf','tsmatricula','tsmae','tspai','tsuf','tstelefone','tssexo','tsescolaridade','tsindice','empresa'
    ];
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
            'empresa'=>$dados['empresa']
        ]);
    }
    public function VerificarCadastroCpf($dados)
    {
        $user = auth()->user();
        return Trabalhador::where([
            ['tscpf',$dados['cpf']],
            ['empresa',$user->empresa]
        ])
        ->count();
    }
    public function relatorioBoletimTabela($dados)
    {
        return Trabalhador::select('tsnome','id','tsmatricula')->whereIn('id', $dados)->get();
    }
    public function buscaListaTrabalhador($id)
    {
        
        return Trabalhador::select(
            'tsnome',
            'id',
            'tscpf',
            'tsmatricula',
            'created_at'
        ) 
        ->where(function($query) use ($id){
            $user = auth()->user();
            if ($id) {
                $query->where([
                    ['trabalhadors.tsnome','like','%'.$id.'%'],
                    ['trabalhadors.empresa', $user->empresa]
                ])
                ->orWhere([
                    ['trabalhadors.tscpf','like','%'.$id.'%'],
                    ['trabalhadors.empresa', $user->empresa],
                ])
                ->orWhere([
                    ['trabalhadors.tsmatricula','like','%'.$id.'%'],
                    ['trabalhadors.empresa', $user->empresa],
                ]);
            }else{
                $query->where([
                    ['trabalhadors.id','>',$id],
                    ['trabalhadors.empresa', $user->empresa]
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
            ->join('documentos', 'trabalhadors.id', '=', 'documentos.trabalhador')
            ->join('nascimentos', 'trabalhadors.id', '=', 'nascimentos.trabalhador')
            ->join('categorias', 'trabalhadors.id', '=', 'categorias.trabalhador')
            ->join('bancarios', 'trabalhadors.id', '=', 'bancarios.trabalhador')
            ->join('enderecos', 'trabalhadors.id', '=', 'enderecos.trabalhador')
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
                    ['trabalhadors.empresa', $user->empresa]
                ])
                ->orWhere([
                    ['trabalhadors.tscpf','like','%'.$id.'%'],
                    ['trabalhadors.empresa', $user->empresa],
                ])
                ->orWhere([
                    ['trabalhadors.tsmatricula','like','%'.$id.'%'],
                    ['trabalhadors.empresa', $user->empresa],
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
            ->join('documentos', 'trabalhadors.id', '=', 'documentos.trabalhador')
            ->join('nascimentos', 'trabalhadors.id', '=', 'nascimentos.trabalhador')
            ->join('categorias', 'trabalhadors.id', '=', 'categorias.trabalhador')
            ->join('bancarios', 'trabalhadors.id', '=', 'bancarios.trabalhador')
            ->join('enderecos', 'trabalhadors.id', '=', 'enderecos.trabalhador')
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
                        ['trabalhadors.empresa', $user->empresa]
                    ])
                    ->orWhere([
                        ['trabalhadors.tscpf',$id],
                        ['trabalhadors.empresa', $user->empresa],
                    ])
                    // ->orWhere([
                    //     ['trabalhadors.tsmatricula',$id],
                    //     ['trabalhadors.empresa', $user->empresa],
                    // ])
                    ->orWhere([
                        ['trabalhadors.id',$id],
                        ['trabalhadors.empresa', $user->empresa],
                    ]);
                }
               
            })
        ->first();
        }
    public function lista($id,$condicao)
    {
        return DB::table('trabalhadors')
            ->join('documentos', 'trabalhadors.id', '=', 'documentos.trabalhador')
            ->join('nascimentos', 'trabalhadors.id', '=', 'nascimentos.trabalhador')
            ->join('categorias', 'trabalhadors.id', '=', 'categorias.trabalhador')
            ->join('bancarios', 'trabalhadors.id', '=', 'bancarios.trabalhador')
            ->join('enderecos', 'trabalhadors.id', '=', 'enderecos.trabalhador')
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
                        ['trabalhadors.empresa', $user->empresa]
                    ])
                    ->orWhere([
                        ['trabalhadors.tscpf','like','%'.$id.'%'],
                        ['trabalhadors.empresa', $user->empresa],
                    ])
                    ->orWhere([
                        ['trabalhadors.tsmatricula','like','%'.$id.'%'],
                        ['trabalhadors.empresa', $user->empresa],
                    ])
                    ->where('trabalhadors.empresa', $user->empresa);

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
        ->join('documentos', 'trabalhadors.id', '=', 'documentos.trabalhador')
        ->join('empresas', 'empresas.id', '=', 'trabalhadors.empresa')
        ->join('nascimentos', 'trabalhadors.id', '=', 'nascimentos.trabalhador')
        ->join('categorias', 'trabalhadors.id', '=', 'categorias.trabalhador')
        ->join('bancarios', 'trabalhadors.id', '=', 'bancarios.trabalhador')
        ->join('enderecos', 'trabalhadors.id', '=', 'enderecos.trabalhador')
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
            ->where('trabalhadors.empresa',$user->empresa);
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
        ->join('documentos', 'trabalhadors.id', '=', 'documentos.trabalhador')
        ->join('nascimentos', 'trabalhadors.id', '=', 'nascimentos.trabalhador')
        ->join('categorias', 'trabalhadors.id', '=', 'categorias.trabalhador')
        ->select(
            'trabalhadors.*', 
            'documentos.*', 
            'categorias.*',
            'nascimentos.*',
            )
            ->where(function($query){
                $user = auth()->user();
                $query->where('trabalhadors.empresa', $user->empresa);
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
        ->join('empresas', 'empresas.id', '=', 'trabalhadors.empresa')
        ->count();
    }
    public function listaTrabalhadorEmpresa()
    {
        return DB::table('trabalhadors')
        ->join('categorias', 'trabalhadors.id', '=', 'categorias.trabalhador')
        ->join('empresas', 'empresas.id', '=', 'trabalhadors.empresa')
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
