<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Trabalhador extends Model
{
    protected $fillable = [
        'tsnome','tsfoto','tscpf','tsmatricula','tsmae','tspai','tsuf','tstelefone','tssexo','tsescolaridade','tsindice','tsirrf','empresa'
    ];
    public function cadastro($dados)
    {
        
       return Trabalhador::create([
            'tsnome'=>$dados['nome__completo'],
            'tsfoto'=>$dados['foto'],
            'tscpf'=>$dados['cpf'],
            'tsmatricula'=>$dados['matricula'],
            'tsmae'=>$dados['nome__mae'],
            // 'tspai'=>$dados['simples'],
            'tstelefone'=>$dados['telefone'],
            'tssexo'=>$dados['sexo'],
            'tsescolaridade'=>$dados['grau__instrucao'],
            'tsirrf'=>$dados['irrf'],
            'empresa'=>$dados['empresa']
        ]);
    }
    public function first($id)
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
                if ($user->hasPermissionTo('admin')) {
                    $query->where('tsnome', 'like', '%'.$id.'%') 
                    ->orWhere('tscpf',$id)
                    ->orWhere('tsmatricula',$id)
                    ->orWhere('trabalhadors.id',$id);
                    
                }else{
                    $query->where([
                        ['trabalhadors.tsnome',$id],
                        ['trabalhadors.empresa', $user->empresa]
                    ])
                    ->orWhere([
                        ['trabalhadors.tscpf',$id],
                        ['trabalhadors.empresa', $user->empresa],
                    ])
                    ->orWhere([
                        ['trabalhadors.tsmatricula',$id],
                        ['trabalhadors.empresa', $user->empresa],
                    ])
                    ->orWhere([
                        ['trabalhadors.id',$id],
                        ['trabalhadors.empresa', $user->empresa],
                    ]);
                }
               
            })
            ->get();
    }
    public function lista()
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
                'enderecos.*'
                )
                ->paginate(20);
    }
    public function editar($dados,$id)
    {
        return Trabalhador::where('id', $id)
        ->update([
            'tsnome'=>$dados['nome__completo'],
            'tsfoto'=>$dados['foto'],
            'tscpf'=>$dados['cpf'],
            'tsmatricula'=>$dados['matricula'],
            'tsmae'=>$dados['nome__mae'],
            // 'tspai'=>$dados['simples'],
            'tstelefone'=>$dados['telefone'],
            'tssexo'=>$dados['sexo'],
            'tsescolaridade'=>$dados['grau__instrucao'],
            'tsirrf'=>$dados['irrf'],
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
                if ($user->hasPermissionTo('admin')) {
                    $query->where('trabalhadors.id', '>', 0);
                }else{
                    $query->where('trabalhadors.empresa', $user->empresa);
                }
            })
        ->orderBy('tsnome', 'asc')
        ->get();
           
    }
}
