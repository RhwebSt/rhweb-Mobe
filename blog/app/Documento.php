<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Documento extends Model
{
    protected $fillable = [
        'dstipo','dsserie','dsuf','dsctps','dspis','trabalhador'
    ];
    public function cadastro($dados)
    {
       return Documento::create([
            // 'dstipo'=>$dados['categoria__contrato'],
            // 'dsemissao'=>$dados['data__admissao'],
            'dsuf'=>$dados['uf__ctps'],
            'dsserie'=>$dados['serie__ctps'],
            'dsctps'=>$dados['ctps'],
            'dspis'=>$dados['pis'],
            'trabalhador'=>$dados['trabalhador'],
        ]);
    }
    public function editar($dados,$id)
    {
        return Documento::where('trabalhador', $id)
        ->update([
            'dsuf'=>$dados['uf__ctps'],
            'dsserie'=>$dados['serie__ctps'],
            'dsctps'=>$dados['ctps'],
            'dspis'=>$dados['pis']
        ]);
    }
    public function deletar($id)
    {
        return Documento::where('trabalhador', $id)->delete();
    }
    public function VerificarCadastroPis($dados)
    {
        $user = auth()->user();
        return DB::table('trabalhadors')
        ->join('documentos', 'trabalhadors.id', '=', 'documentos.trabalhador')
        ->where([
            ['documentos.dspis',$dados['pis']],
            ['trabalhadors.empresa',$user->empresa]
        ])
        ->count();
    }
    public function VerificarCadastroCtps($dados)
    {
        $user = auth()->user();
        return DB::table('trabalhadors')
        ->join('documentos', 'trabalhadors.id', '=', 'documentos.trabalhador')
        ->where([
            ['documentos.dsctps',$dados['ctps']],
            ['trabalhadors.empresa',$user->empresa]
        ])
        ->count();
    }
}
