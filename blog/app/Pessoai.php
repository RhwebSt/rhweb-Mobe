<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Pessoai extends Model
{
    protected $fillable = [
        'pscpf','psnascimento','pstelefone','user_id'
    ];
    public function cadastra($dados)
    {
        return Pessoai::create([
            'pscpf'=>isset($dados['cpf'])?$dados['cpf']:null,
            'psnascimento'=>isset($dados['data__nascimento'])?$dados['data__nascimento']:null,
            'pstelefone'=>isset($dados['telefone'])?$dados['telefone']:null,
            'user_id'=>$dados['user']
        ]);
    }
    public function editar($id)
    {
        return DB::table('users')
        ->join('pessoais', 'users.id', '=', 'pessoais.user_id')
        ->join('enderecos', 'pessoais.id', '=', 'enderecos.pessoais_id')
        ->select(
            'users.name',
            'users.email',
            'pessoais.id',
            'pessoais.pscpf',
            'pessoais.psnascimento',
            'pessoais.pstelefone',
            'enderecos.eslogradouro',
            'enderecos.esbairro',
            'enderecos.esestado',
            'enderecos.esmunicipio',
            'enderecos.esuf',
            'enderecos.escomplemento',
            'enderecos.esnum',
            'enderecos.escep',
            )
        ->where('users.id', $id)
        ->first();
    }
    public function atualizar($dados,$id)
    {
        return Pessoai::where('user_id', $id)
        ->update([
            'pscpf'=>$dados['cpf'],
            'psnascimento'=>$dados['data__nascimento'],
            'pstelefone'=>$dados['telefone'],
        ]);
    } 
    public function buscaUnidadePessoais($id)
    {
        return Pessoai::where('user_id', $id)->first();
    }
    
}
