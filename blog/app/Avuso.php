<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Avuso extends Model
{
    protected $fillable = [
     'asinicial', 'asfinal','aicodigo','ailiquido', 'asnome', 'ascpf','empresa'
    ];
    public function cadastro($dados)
    {
        return Avuso::create([
            'asinicial'=>$dados['ano_inicial'],
            'asfinal'=>$dados['ano_final'],
            'aicodigo'=>$dados['codigo'],
            'ailiquido'=>$dados['liquido'],
            'asnome'=>$dados['nome'],
            'ascpf'=>$dados['cpf'],
            'empresa'=>$dados['empresa']
        ]);
    }
    public function buscaListaRecibos()
    {
        return Avuso::where(function($query){
            $user = auth()->user();
            if ($user->hasPermissionTo('admin')) {
                $query->where('avusos.id','>',0);
            }else{
                $query->where('avusos.empresa', $user->empresa);
            }
        })
        ->paginate(10);
    }
    public function buscaListaRecibosOrdem($condicao)
    {
        return Avuso::where(function($query){
            $user = auth()->user();
            if ($user->hasPermissionTo('admin')) {
                $query->where('avusos.id','>',0);
            }else{
                $query->where('avusos.empresa', $user->empresa);
            }
        })
        ->orderBy('avusos.aicodigo', $condicao)
        ->paginate(10);
    }
    public function filtraPesquisa($dados)
    {
        return Avuso::where(function($query) use($dados){
            $user = auth()->user();
            if ($user->hasPermissionTo('admin')) {
                $query->where([
                    ['avusos.aicodigo',$dados['pesquisa']],
                ])
                ->orWhere([
                    ['avusos.asnome',$dados['pesquisa']],
                ])
                ->orWhere([
                    ['avusos.ascpf',$dados['pesquisa']],
                ])
                ->whereBetween('avusos.asfinal',[$dados['ano_inicial1'], $dados['ano_final1']]);
            }else{
                $query->where([
                    ['avusos.aicodigo',$dados['pesquisa']],
                    ['avusos.empresa',$user->empresa]
                ])
                ->orWhere([
                    ['avusos.asnome',$dados['pesquisa']],
                    ['avusos.empresa',$user->empresa]
                ])
                ->orWhere([
                    ['avusos.ascpf',$dados['pesquisa']],
                    ['avusos.empresa',$user->empresa]
                ])
                ->whereBetween('avusos.asfinal',[$dados['ano_inicial1'], $dados['ano_final1']]);
            }
        })
        ->paginate(10);
    }
    public function buscaListaAvuso($id)
    {
        return Avuso::select(
            'asnome',
            'id',
            'ascpf'
        ) 
        ->where(function($query) use ($id){
            $user = auth()->user();
            if ($user->hasPermissionTo('admin')) {
                if ($id) {
                    $query->where('asnome','like','%'.$id.'%') 
                    ->orWhere('ascpf','like','%'.$id.'%');
                }else{
                    $query->where('id','>',$id);
                }
            }else{
                if ($id) {
                    $query->where([
                        ['asnome','like','%'.$id.'%'],
                        ['empresa', $user->empresa]
                    ])
                    ->orWhere([
                        ['tscpf','like','%'.$id.'%'],
                        ['empresa', $user->empresa],
                    ]);
                }else{
                    $query->where([
                        ['id','>',$id],
                        ['empresa', $user->empresa]
                    ]);
                }
            }
            
        })
        ->orderBy('asnome','asc')
        ->distinct()
        ->limit(100)
        ->get();
      
    }
    public function buscaTrabalhador($trabalhador,$inicio,$final)
    {
        return DB::table('avusos')
        ->join('empresas', 'empresas.id', '=', 'avusos.empresa')
        ->join('enderecos', 'empresas.id', '=', 'enderecos.empresa')
        ->select(
            'empresas.escnpj',
            'empresas.esnome',
            'empresas.estelefone',
            'enderecos.eslogradouro',
            'enderecos.esnum',
            'enderecos.escep',
            'enderecos.esbairro',
            'enderecos.esuf',
            'enderecos.esestado',
            'enderecos.esmunicipio',
            'empresas.esfoto',
            'avusos.aicodigo',
            'avusos.asnome',
            'avusos.ascpf',
            'avusos.id',
            'avusos.asinicial',
            'avusos.asfinal',
            'avusos.created_at',
        ) 
        ->where(function($query) use ($trabalhador,$inicio,$final){
            $user = auth()->user();
            if ($user->hasPermissionTo('admin')) {
                $query->where('avusos.id',$trabalhador)
                ->whereBetween('avusos.asfinal',[$inicio,$final]);
            }else{
                $query->where([
                    ['avusos.id',$trabalhador],
                    ['empresa', $user->empresa],
                ])
                ->whereBetween('avusos.asfinal',[$inicio,$final]);
            }
            
        })
        ->first(); 
    }
    public function buscaUnidadeTrabalhador($id = null,$trabalhador,$inicio = null,$final = null)
    {
        return DB::table('avusos')
        ->join('trabalhadors', 'trabalhadors.id', '=', 'avusos.trabalhador')
        ->join('empresas', 'empresas.id', '=', 'trabalhadors.empresa')
        ->join('enderecos', 'empresas.id', '=', 'enderecos.empresa')
        ->join('categorias','trabalhadors.id','=','categorias.trabalhador')
        ->join('documentos','trabalhadors.id','=','documentos.trabalhador')
        ->select(
            'trabalhadors.tsnome',
            'trabalhadors.tsmatricula',
            'trabalhadors.tscpf',
            'documentos.dspis',
            'categorias.cbo',
            'avusos.aicodigo',
            'avusos.id',
            'avusos.asinicial',
            'avusos.asfinal',
            'avusos.created_at',
            'categorias.cbo',
            'empresas.escnpj',
            'empresas.esnome',
            'empresas.estelefone',
            'enderecos.eslogradouro',
            'enderecos.esnum',
            'enderecos.escep',
            'enderecos.esbairro',
            'enderecos.esuf',
            'enderecos.esestado',
            'enderecos.esmunicipio',
            'empresas.esfoto',
           
        )
        ->where([
            ['avusos.id',$id],
            ['trabalhadors.id',$trabalhador]
        ])
        ->orWhere(function($query) use ($trabalhador,$inicio,$final){
            $query->where('trabalhadors.id',$trabalhador)
            ->whereBetween('avusos.asfinal',[$inicio,$final]);
        })
        ->first();
    }
    public function buscaTrabalhadorRecibo($trabalhador,$inicio,$final)
    {
        return Avuso::where('id',$trabalhador)
        ->whereBetween('asfinal',[$inicio,$final])
        ->get();
    }
    public function deletar($id)
    {
        return Avuso::where('id',$id)->delete();
    }
}
