<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Parametrosefip extends Model
{
    protected $fillable = [
        'psfpas','psgrps','psresol','pscnae','psfapaliquota','psratajustados','psfpasterceiros','psaliquotaterceiros','tomador'
    ];
    public function cadastro($dados)
    {
        
       return Parametrosefip::create([
            'psfpas'=>$dados['cod__fpas'],
            'psgrps'=>$dados['cod__grps'],
            'psresol'=>$dados['cod__recol'],
            'pscnae'=>$dados['cnae'],
            'psfapaliquota'=>str_replace(",",".",$dados['fap__aliquota']),
            'psratajustados'=>str_replace(",",".",$dados['rat__ajustado']),
            'psfpasterceiros'=>$dados['fpas__terceiros'],
            'psaliquotaterceiros'=>$dados['aliq__terceiros'],
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
        'pscnae'=>$dados['cnae'],
        'psfapaliquota'=>$dados['fap__aliquota'],
        'psratajustados'=>$dados['rat__ajustado'],
        'psfpasterceiros'=>$dados['fpas__terceiros'],
        'psaliquotaterceiros'=>$dados['aliq__terceiros'],
       
    ]);
    }
    public function deletar($id)
    {
      return Parametrosefip::where('tomador', $id)->delete();
    }
}
