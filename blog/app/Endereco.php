<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    protected $fillable = [
        'escep','eslogradouro','esbairro','estipo','esmunicipio','esuf','escomplemento','esnum','empresa_id','trabalhador_id','tomador_id','pessoais_id'
    ];
    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }
    public function trabalhador()
    {
        return $this->belongsTo(Trabalhador::class);
    }
    public function tomador()
    {
        return $this->belongsTo(Tomador::class);
    }
    public function cadastro($dados)
    {
        return Endereco::create([
            'eslogradouro'=>isset($dados['logradouro'])?$dados['logradouro']:null,
            'esbairro'=>isset($dados['bairro'])?$dados['bairro']:null,
            'escep'=>isset($dados['cep'])?$dados['cep']:null,
            'esmunicipio'=>isset($dados['localidade'])?$dados['localidade']:null,
            'esuf'=>isset($dados['uf'])?$dados['uf']:null,
            'escomplemento'=>isset($dados['complemento__endereco'])?$dados['complemento__endereco']:null,
            'esnum'=>isset($dados['numero'])?$dados['numero']:null,
            'tomador_id'=>isset($dados['tomador'])?$dados['tomador']:null,
            'trabalhador_id'=>isset($dados['trabalhador'])?$dados['trabalhador']:null,
            'empresa_id'=>isset($dados['empresa'])?$dados['empresa']:null,
            'pessoais_id'=>isset($dados['pessoal'])?$dados['pessoal']:null
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
            'esuf'=>$dados['uf'],
            'escomplemento'=>$dados['complemento__endereco'],
            'esnum'=>$dados['numero'],
        ]);
    }
    public function editarEmpresa($dados,$id)
    {
        return Endereco::where('empresa_id', $id)
        ->update([
            'eslogradouro'=>$dados['logradouro'],
            'esbairro'=>$dados['bairro'],
            'escep'=>$dados['cep'],
            'esmunicipio'=>$dados['localidade'],
            'esuf'=>$dados['uf'],
            'escomplemento'=>$dados['complemento__endereco'],
            'esnum'=>$dados['numero'],
        ]);
    }

    public function editarUsuario($dados)
    {
        return Endereco::where('pessoais_id', $dados['pessoal'])
        ->update([
            'eslogradouro'=>$dados['logradouro'],
            'esbairro'=>$dados['bairro'],
            'escep'=>$dados['cep'],
            'esmunicipio'=>$dados['localidade'],
            'esuf'=>$dados['uf'],
            'escomplemento'=>$dados['complemento__endereco'],
            'esnum'=>$dados['numero'],
        ]);
    }
    
    public function deletar($id)
    {
        return Endereco::where('eiid', $id)->delete();
    }
    public function deletarTrabalhador($id)
    {
        return Endereco::where('trabalhador_id', $id)->delete();
    }
    public function deletarTomador($id)
    {
        return Endereco::where('tomador_id', $id)->delete();
    }
    public function deletarEmpresa($id)
    {
        return Endereco::where('empresa_id', $id)->delete();
    }
}
