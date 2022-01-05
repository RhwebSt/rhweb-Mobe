<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ValorCalculo extends Model
{
    protected $fillable = [
        'vicodigo','vsdescricao','vireferencia','vivencimento','videsconto','basecalculo'
    ];
    public function cadastroHorasnormais($dados,$basecalculo,$i)
    {
        return ValorCalculo::create([
            'vicodigo'=> (int)$dados['horasNormais']['codigos'][$i],
            'vsdescricao'=>$dados['horasNormais']['rublicas'][$i],
            'vireferencia'=>$dados['horasNormais']['quantidade'][$i],
            'vivencimento'=>$dados['horasNormais']['valor'][$i],
            'basecalculo'=>$basecalculo
        ]);
    }
    public function cadastrodiariaNormais($dados,$basecalculo,$i)
    {
        return ValorCalculo::create([
            'vicodigo'=> (int)$dados['diariaNormais']['codigos'][$i],
            'vsdescricao'=>$dados['diariaNormais']['rublicas'][$i],
            'vireferencia'=>$dados['diariaNormais']['quantidade'][$i],
            'vivencimento'=>$dados['diariaNormais']['valor'][$i],
            'basecalculo'=>$basecalculo
        ]);
    }
    public function cadastroHorasEx50($dados,$basecalculo,$i)
    {
        return ValorCalculo::create([
            'vicodigo'=> (int)$dados['hora extra 50%']['codigos'][$i],
            'vsdescricao'=>$dados['hora extra 50%']['rublicas'][$i],
            'vireferencia'=>$dados['hora extra 50%']['quantidade'][$i],
            'vivencimento'=>$dados['hora extra 50%']['valor'][$i],
            'basecalculo'=>$basecalculo
        ]);
    }
    public function cadastroHorasEx100($dados,$basecalculo,$i)
    {
        return ValorCalculo::create([
            'vicodigo'=> (int)$dados['hora extra 100%']['codigos'][$i],
            'vsdescricao'=>$dados['hora extra 100%']['rublicas'][$i],
            'vireferencia'=>$dados['hora extra 100%']['quantidade'][$i],
            'vivencimento'=>$dados['hora extra 100%']['valor'][$i],
            'basecalculo'=>$basecalculo
        ]);
    }
    public function cadastroGratificacao($dados,$basecalculo,$i)
    {
        return ValorCalculo::create([
            'vicodigo'=> (int)$dados['gratificação']['codigos'][$i],
            'vsdescricao'=>$dados['gratificação']['rublicas'][$i],
            'vireferencia'=>$dados['gratificação']['quantidade'][$i],
            'vivencimento'=>$dados['gratificação']['valor'][$i],
            'basecalculo'=>$basecalculo
        ]);
    }
    public function cadastraAdiantamento($dados,$basecalculo,$i)
    {
        return ValorCalculo::create([
            'vicodigo'=> (int)$dados['adiantamento']['codigos'][$i],
            'vsdescricao'=>$dados['adiantamento']['rublicas'][$i],
            'vireferencia'=>$dados['adiantamento']['quantidade'][$i],
            'vivencimento'=>$dados['adiantamento']['valor'][$i],
            'basecalculo'=>$basecalculo
        ]);
    }
}
