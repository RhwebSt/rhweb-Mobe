<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Parametrosefip extends Model
{
    protected $fillable = [
        'psfpas','psgrps','psresol','pscnae','psfapaliquota','psratajustados','psfpasterceiros','psaliquotaterceiros','pssocial','tomador'
    ];
    public function cadastro($dados)
    {
        
       return Parametrosefip::create([
            'psfpas'=>$dados['cod__fpas'],
            'psgrps'=>$dados['cod__grps'],
            'psresol'=>$dados['cod__recol'],
            'pscnae'=>$dados['cnae'],
            'psfapaliquota'=>$dados['fap__aliquota'],
            'psratajustados'=>$dados['rat__ajustado'],
            'psfpasterceiros'=>$dados['fpas__terceiros'],
            'psaliquotateceiros'=>$dados['aliq__terceiros'],
            'pssocial'=>$dados['esocial'],
            'tomador'=>$dados['tomador']
        ]);
    }
    public function editar($dados)
    {
       return Parametrosefip::where('id', $dados['id'])
      ->update([
        'psfpas'=>$dados['cod__fpas'],
        'psgrps'=>$dados['cod__grps'],
        'psresol'=>$dados['cod__recol'],
        'psnae'=>$dados['cnae'],
        'psfapaliquota'=>$dados['fap__aliquota'],
        'pasratajustados'=>$dados['rat__ajustado'],
        'psfpasterceiros'=>$dados['psfpasterceiros'],
        'psaliquotateceiros'=>$dados['aliq__terceiros'],
        'pssocial'=>$dados['esocial'],
    ]);
    }
}
