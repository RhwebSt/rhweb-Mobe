<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Trabalhador extends Model
{
    protected $fillable = [
        'tsnome','tscpf','tsmatricula','tsmae','tspai','tsuf','tstelefone','tssexo','tsescolaridade','tsirrf','user'
    ];
    public function cadastro($dados)
    {
        
       return Trabalhador::create([
            'tsnome'=>$dados['nome__completo'],
            'tscpf'=>$dados['cpf'],
            'tsmatricula'=>$dados['matricula'],
            'tsmae'=>$dados['nome__mae'],
            // 'tspai'=>$dados['simples'],
            'tstelefone'=>$dados['telefone'],
            'tssexo'=>$dados['sexo'],
            'tsescolaridade'=>$dados['grau__instrucao'],
            'tsirrf'=>$dados['irrf'],
            // 'user'=>$dados['user']
        ]);
    }
    public function first($id)
    {
        return DB::table('trabalhadors')
            ->join('documentos', 'trabalhadors.id', '=', 'documentos.trabalhador')
            ->join('nascimentos', 'trabalhadors.id', '=', 'nascimentos.trabalhador')
            ->join('categorias', 'trabalhadors.id', '=', 'categorias.trabalhador')
            ->join('nascimentos', 'trabalhadors.id', '=', 'nascimentos.trabalhador')
            ->join('bancarios', 'trabalhadors.id', '=', 'bancarios.trabalhador')
            ->join('enderecos', 'trabalhadors.id', '=', 'enderecos.trabalhador')
            // ->join('dependentes', 'trabalhadors.id', '=', 'dependentes.trabalhador')
            ->select(
                'trabalahdors.*', 
                'documentos.*', 
                'bancarios.*',
                'categoria.*',
                'nascimentos.*',
                'enderecos.*'
                )
            ->where('id', $id)
            ->first();
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
}
