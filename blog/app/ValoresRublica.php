<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ValoresRublica extends Model
{
    protected $fillable = [
    'vsnrofatura','vsreciboavulso','vsmatricula','vsnrorequisicao','vsnroboletins','vsnrocartaoponto','vsnroequesocial','vsnroflha','vscbo','vimatricular','vitomador','empresa'
    ];
    public function cadastro($dados)
    {
        return ValoresRublica::create([
            'vsnrofatura'=>$dados['nro__fatura'],
            'vsreciboavulso'=>$dados['nro__reciboavulso'],
            'vsmatricula'=>$dados['matric__trabalhador'],
            'vsnrorequisicao'=>$dados['nro__requisicao'],
            'vsnroboletins'=>$dados['nro__boletins'],
            'vscbo'=>$dados['cbo'],
            'vsnrocartaoponto'=>$dados['nro__cartaoponto'],
            'vsnroequesocial'=>$dados['seq__esocial'],
            'vsnroflha'=>$dados['nro__folha'],
            'vimatricular'=>$dados['matricular'],
            'vimatriculartomador'=>$dados['matriculartomador'],
            'empresa'=>$dados['empresa'],
        ]);
    }
    public function editar($dados,$id)
    {
        return ValoresRublica::where('id', $id)
        ->orWhere('empresa', $id)
        ->update([
            'vsnrofatura'=>$dados['nro__fatura'],
            'vsreciboavulso'=>$dados['nro__reciboavulso'],
            'vsmatricula'=>$dados['matric__trabalhador'],
            'vsnrorequisicao'=>$dados['nro__requisicao'],
            'vsnroboletins'=>$dados['nro__boletins'],
            'vscbo'=>$dados['cbo'],
            'vsnrocartaoponto'=>$dados['nro__cartaoponto'],
            'vsnroequesocial'=>$dados['seq__esocial'],
            'vsnroflha'=>$dados['nro__folha'],
            'vimatricular'=>$dados['matricular'],
            'vimatriculartomador'=>$dados['matriculartomador'],
        ]);
    }
    public function editarMatricular($dados,$empresa)
    {
        return ValoresRublica::where('empresa', $empresa)
        ->update([
            'vimatricular'=>$dados['matricula'],
        ]);
    }
    public function editarAvuso($dados,$empresa)
    {
        return ValoresRublica::where('empresa', $empresa)
        ->update([
            'vsreciboavulso'=>$dados['codigo'],
        ]);
    }
    public function editarMatricularTomador($dados,$empresa)
    {
        return ValoresRublica::where('empresa', $empresa)
        ->update([
            'vimatriculartomador'=>$dados['matricula'],
        ]);
    }
    public function editarBoletimTabela($dados,$empresa)
    {
        return ValoresRublica::where('empresa', $empresa)
        ->update([
            'vsnroboletins'=>$dados['liboletim'],
        ]);
    }
    public function buscaUnidadeEmpresa($empresa)
    {
        return ValoresRublica::where('empresa', $empresa)->first();
    }
    public function editarUnidadeNuFolhar($empresa,$numerofolhar)
    {
        return ValoresRublica::where('empresa', $empresa)
        ->update(['vsnroflha'=>$numerofolhar]);
    }
    public function editarUnidadeNuCartaoPonto($empresa,$dados)
    {
        return ValoresRublica::where('empresa', $empresa)
        ->update(['vsnrocartaoponto'=>$dados['liboletim']]);
    }
    public function deletar($id)
    {
        return ValoresRublica::where('empresa', $id)->delete();
    }
    
}
