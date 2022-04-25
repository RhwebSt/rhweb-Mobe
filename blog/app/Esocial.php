<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Esocial extends Model
{
    protected $fillable = [
        'esnome', 'escodigo', 'esid', 'esambiente', 'esstatus', 'trabalhador_id','tomador_id'
    ];
    public function trabalhador()
    {
        return $this->hasMany(Trabalhador::class);
    }
    public function cadastro($dados)
    {
        return Esocial::create([
            'esnome'=>$dados['nome'],
            'escodigo'=>$dados['codigo'],
            'esid'=>$dados['id'],
            'esambiente'=>$dados['ambiente'],
            'esstatus'=>$dados['status'],
            'trabalhador_id'=>isset($dados['trabalhador'])?$dados['trabalhador']:null,
            'tomador_id'=>isset($dados['tomador'])?$dados['tomador']:null,
        ]);
    }
    public function editar($dados,$id)
    {
        return Esocial::where('trabalhador_id', $id)
        ->update([
            'escodigo'=>$dados['codigo'],
            'esid'=>$dados['id'],
            'esstatus'=>$dados['status'],
            'trabalhador_id'=>isset($dados['trabalhador'])?$dados['trabalhador']:null,
            'tomador_id'=>isset($dados['tomador'])?$dados['tomador']:null,
        ]);
    }
    
    public function notificacaoCadastroTrabalhador()
    {
        return DB::table('empresas')
            ->join('trabalhadors', 'empresas.id', '=', 'trabalhadors.empresa_id')
            ->join('esocials', 'trabalhadors.id', '=', 'esocials.trabalhador_id')
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
