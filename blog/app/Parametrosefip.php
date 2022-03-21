<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Parametrosefip extends Model
{
    protected $fillable = [
        'psfpas','psconfpas','psgrps','psresol','pscnae','psfapaliquota','psratajustados','psfpasterceiros','psaliquotaterceiros','tomador'
    ];
    public function cadastro($dados)
    {
        
       return Parametrosefip::create([
            'psfpas'=>$dados['cod__fpas'],
            'psgrps'=>$dados['cod__grps'],
            'psresol'=>$dados['cod__recol'],
            'psconfpas'=>$dados['cod__fap']?str_replace(",",".",$dados['cod__fap']):0,
            'pscnae'=>$dados['cnae'],
            'psfapaliquota'=>$dados['fap__aliquota']?str_replace(",",".",$dados['fap__aliquota']):0,
            'psratajustados'=>$dados['rat__ajustado']?str_replace(",",".",$dados['rat__ajustado']):0,
            'psfpasterceiros'=>$dados['fpas__terceiros'],
            'psaliquotaterceiros'=>$dados['aliq__terceiros']?str_replace(",",".",$dados['aliq__terceiros']):0,
            'tomador'=>$dados['tomador']
        ]);
    }
    public function editar($dados,$id)
    {
       return Parametrosefip::where('tomador', $id)
      ->update([
        'psfpas'=>$dados['cod__fpas'],
        'psgrps'=>$dados['cod__grps'],
        'psresol'=>$dados['cod__recol'],
        'psconfpas'=>$dados['cod__fap']?str_replace(",",".",$dados['cod__fap']):0,
        'pscnae'=>$dados['cnae'],
        'psfapaliquota'=>$dados['fap__aliquota']?str_replace(",",".",$dados['fap__aliquota']):0,
        'psratajustados'=>$dados['rat__ajustado']?str_replace(",",".",$dados['rat__ajustado']):0,
        'psfpasterceiros'=>$dados['fpas__terceiros'],
        'psaliquotaterceiros'=>$dados['aliq__terceiros']?str_replace(",",".",$dados['aliq__terceiros']):0,
       
    ]);
    }
    public function deletar($id)
    {
      return Parametrosefip::where('tomador', $id)->delete();
    }
    public function buscaUnidadeTomador($tomador)
    {
        return Parametrosefip::where('tomador', $tomador)->first();
    }
}
