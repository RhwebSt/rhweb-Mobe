<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Certificado extends Model
{
    protected $fillable = [
        'apelido', 'diasvencimento', 'dtvencimento','csemail','handle','csnome','cssenha','empresa_id'
    ];
    public function cadastro($dados)
    {
       return Certificado::create([
            // 'apelido'=>$dados['apelido'],
            // 'diasvencimento'=>$dados['diasVencimento'],
            'dtvencimento'=>$dados['dtVencimento'],
            // 'csemail'=>$dados['email'],
            'handle'=>$dados['handle'],
            'csnome'=>$dados['nome'],
            // 'cssenha'=>$dados['senha'],
            'empresa_id'=>$dados['empresa']
        ]);
    }
    public function deletar($id)
    {
      return Certificado::where('empresa_id', $id)->delete();
    }
}
