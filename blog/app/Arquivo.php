<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Arquivo extends Model
{
    protected $fillable = [
        'dstipo','dsnumero','dsemissao','dsuf','trabalhador_id'
    ];
    public function trabalhador()
    {
        return $this->belongsTo(Trabalhador::class);
    }
    public function cadastrorg($dados)
    {
       return Arquivo::create([
            'dstipo'=>'rg',
            'dsnumero'=>$dados['rg'],
            'dsemissao'=>$dados['dataEmissaoRg'],
            'dsuf'=>$dados['ufRg'],
            'trabalhador_id'=>$dados['trabalhador'],
        ]);
    }
    public function editarg($dados,$id)
    {
       
        return Arquivo::where('trabalhador_id', $id)
        ->update([
            'dstipo'=>'rg',
            'dsnumero'=>$dados['rg'],
            'dsemissao'=>$dados['dataEmissaoRg'],
            'dsuf'=>$dados['ufRg'],
        ]);
    }
}
