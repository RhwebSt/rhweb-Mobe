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
            'psconfpas'=>$dados['cod__fap'],
            'pscnae'=>$dados['cnae'],
            'psfapaliquota'=>str_replace(",",".",$dados['fap__aliquota']),
            'psratajustados'=>str_replace(",",".",$dados['rat__ajustado']),
            'psfpasterceiros'=>$dados['fpas__terceiros'],
            'psaliquotaterceiros'=>str_replace(",",".",$dados['aliq__terceiros']),
            'tomador'=>$dados['tomador']
        ]);
    }
    public function editar($dados,$id)
    {
       return Parametrosefip::where('tomador', $id)
      ->update([
        'psfpas'=>$dados['cod__fpas'],
        'psconfpas'=>$dados['cod__fap'],
        'psgrps'=>$dados['cod__grps'],
        'psresol'=>$dados['cod__recol'],
        'pscnae'=>$dados['cnae'],
        'psfapaliquota'=>str_replace(",",".",$dados['fap__aliquota']),
        'psratajustados'=>str_replace(",",".",$dados['rat__ajustado']),
        'psfpasterceiros'=>$dados['fpas__terceiros'],
        'psaliquotaterceiros'=>str_replace(",",".",$dados['aliq__terceiros']),
       
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
