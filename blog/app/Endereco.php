<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    protected $fillable = [
        'escep','eslogradouro','esbairro','estipo','esmunicipio','esuf','escomplemento','esnum','empresa','trabalhador','tomador'
    ];
    public function cadastro($dados)
    {
        return Endereco::create([
            'eslogradouro'=>$dados['logradouro'],
            'esbairro'=>$dados['bairro'],
            'escep'=>$dados['cep'],
            'estipo'=>$dados['complemento__endereco'],
            'esmunicipio'=>$dados['localidade'],
            'esuf'=>$dados['uf'],
            // 'escomplemento'=>$dados['complemento__endereco'],
            'esnum'=>$dados['numero'],
            'tomador'=>$dados['tomador'],
            'trabalhador'=>$dados['trabalhador'],
            'empresa'=>$dados['empresa']
        ]);
    }
    // public function editar($dados,$id)
    // {
    //   return Endereco::where('id', $id)
    //   ->update([
    //     'eslogradouro'=>$dados['logradouro'],
    //     'esbairro'=>$dados['bairro'],
    //     // 'estipo'=>$dados['tf13'],
    //     'esmunicipio'=>$dados['localidade'],
    //     'esesuf'=>$dados['uf'],
    //     'escomplemento'=>$dados['complemento__endereco'],
    //     'esnum'=>$dados['numero'],
    // ]);
    // }
    public function first($id,$campo)
    {
        return Endereco::where($campo,$id)
        // ->orWhere($campo,$id)
        // ->orWhere(function($query) use ($id){
        //     $query->where('trabalhador', $id)
        //           ->whereNull('empresa')
        //           ->whereNull('tomador');
        // })
        // ->orWhere(function($query) use ($id){
        //     $query->where('empresa', $id)
        //           ->whereNull('trabalhador')
        //           ->whereNull('tomador');
        // })
        // ->orWhere(function($query) use ($id){
        //     $query->where('tomador', $id)
        //           ->whereNull('empresa')
        //           ->whereNull('trabalhador');
        // })
        ->first();
    }
    public function editar($dados,$id)
    {
        return Endereco::where('eiid', $id)
        // ->orWhere('trabalhador', $id)
        // ->orWhere('empresa', $id)
        // ->orWhere('tomador', $id)
        ->update([
            'eslogradouro'=>$dados['logradouro'],
            'esbairro'=>$dados['bairro'],
            'escep'=>$dados['cep'],
            'esmunicipio'=>$dados['localidade'],
            'estipo'=>$dados['complemento__endereco'],
            'esuf'=>$dados['uf'],
            // 'escomplemento'=>$dados['complemento__endereco'],
            'esnum'=>$dados['numero'],
        ]);
    }
    
    public function deletar($id)
    {
        return Endereco::where('eiid', $id)->delete();
    }
}
