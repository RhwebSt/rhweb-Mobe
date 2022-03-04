<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Pessoai extends Model
{
    protected $fillable = [
        'pscpf','psnascimento','pstelefone','user'
    ];
    public function cadastra($dados)
    {
        return Pessoai::create([
            'pscpf'=>$dados['cpf'],
            'psnascimento'=>$dados['data__nascimento'],
            'pstelefone'=>$dados['telefone'],
            'user'=>$dados['user']
        ]);
    }
    public function editar($id)
    {
        return DB::table('users')
        ->join('pessoais', 'users.id', '=', 'pessoais.user')
        ->join('enderecos', 'pessoais.id', '=', 'enderecos.pessoal')
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
    public function Atualizar($dados,$id)
    {
        return User::where('user', $id)
        ->update([
            'pscpf'=>$dados['cpf'],
            'psnascimento'=>$dados['data__nascimento'],
            'pstelefone'=>$dados['telefone'],
        ]);
    }
}
