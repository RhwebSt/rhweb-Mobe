<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Esocial extends Model
{
    protected $fillable = [
        'esnome', 'escodigo', 'esid', 'esambiente', 'esstatus', 'trabalhador','tomador'
    ];
    public function cadastro($dados)
    {
        return Esocial::create([
            'esnome'=>$dados['nome'],
            'escodigo'=>$dados['codigo'],
            'esid'=>$dados['id'],
            'esambiente'=>$dados['ambiente'],
            'esstatus'=>$dados['status'],
            'trabalhador'=>isset($dados['trabalhador'])?$dados['trabalhador']:null,
            'tomador'=>isset($dados['tomador'])?$dados['tomador']:null,
        ]);
    }
    public function editar($dados,$id)
    {
        return Esocial::where('trabalhador', $id)
        ->update([
            'escodigo'=>$dados['codigo'],
            'esid'=>$dados['id'],
            'esstatus'=>$dados['status'],
            'trabalhador'=>isset($dados['trabalhador'])?$dados['trabalhador']:null,
            'tomador'=>isset($dados['tomador'])?$dados['tomador']:null,
        ]);
    }
    public function verificarTrabalhador($id)
    {
        return Esocial::where('trabalhador', $id)->count();
    }
    public function notificacaoCadastroTrabalhador()
    {
        return DB::table('empresas')
            ->join('trabalhadors', 'empresas.id', '=', 'trabalhadors.empresa')
            ->join('esocials', 'trabalhadors.id', '=', 'esocials.trabalhador')
            ->select(
                'trabalhadors.tsnome',
                'esocials.created_at',
            )
            ->where([
                ['esocials.escodigo',' '],
                ['esocials.esid', ' '],
            ])
            ->get();
    }
}
