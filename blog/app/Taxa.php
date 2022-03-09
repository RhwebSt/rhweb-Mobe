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
            'tftaxaadm'=>$dados['taxa_adm']?str_replace(",",".",str_replace(",",".",$dados['taxa_adm'])):0,
            // 'tfbenef'=>str_replace(",",".",str_replace(",",".",$dados['caixa_benef']),
            'tfdefaltor'=>$dados['deflator']?str_replace(",",".",str_replace(",",".",$dados['deflator'])):0,
            'tfdas'=>$dados['das']?str_replace(",",".",str_replace(",",".",$dados['das'])):0,
            'tftaxafed'=>$dados['taxa__fed']?str_replace(",",".",str_replace(",",".",$dados['taxa__fed'])):0,
            'tomador'=>$dados['tomador']
        ]);
    }
    public function editar($dados,$id)
    {
      return Taxa::where('tomador', $id)
      ->update([
        'tftaxaadm'=>str_replace(",",".",str_replace(",",".",$dados['taxa_adm'])),
            // 'tfbenef'=>str_replace(",",".",$dados['caixa_benef']),
        'tfdefaltor'=>str_replace(",",".",str_replace(",",".",$dados['deflator'])),
        'tfdas'=>str_replace(",",".",str_replace(",",".",$dados['das'])),
        'tftaxafed'=>str_replace(",",".",str_replace(",",".",$dados['taxa__fed'])),
    ]);
    }
    public function deletar($id)
    {
      return Taxa::where('tomador', $id)->delete();
    }
}
