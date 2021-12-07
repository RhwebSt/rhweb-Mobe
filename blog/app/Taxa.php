<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Taxa extends Model
{
    protected $fillable = [
        'tftaxaadm','tfdefaltor','tfdas','tftaxafed','tomador'
    ];
    public function cadastro($dados)
    {
        return Taxa::create([
            'tftaxaadm'=>str_replace(",",".",$dados['taxa_adm']),
            // 'tfbenef'=>str_replace(",",".",$dados['caixa_benef']),
            'tfdefaltor'=>$dados['deflator'],
            'tfdas'=>str_replace(",",".",$dados['das']),
            'tftaxafed'=>str_replace(",",".",$dados['taxa__fed']),
            'tomador'=>$dados['tomador']
        ]);
    }
    public function editar($dados,$id)
    {
      return Taxa::where('id', $id)
      ->update([
        'tftaxaadm'=>str_replace(",",".",$dados['taxa_adm']),
            // 'tfbenef'=>str_replace(",",".",$dados['caixa_benef']),
            'tfdefaltor'=>$dados['deflator'],
            'tfdas'=>str_replace(",",".",$dados['das']),
            'tftaxafed'=>str_replace(",",".",$dados['taxa__fed']),
    ]);
    }
    public function deletar($id)
    {
      return Taxa::where('tomador', $id)->delete();
    }
}
