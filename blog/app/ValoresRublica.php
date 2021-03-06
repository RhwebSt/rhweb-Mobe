<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ValoresRublica extends Model
{
    protected $fillable = [
    'vsnrofatura','vsreciboavulso','vsmatricula','vsnrorequisicao','vsnroboletins','vsnrocartaoponto','vsnroequesocial','vsnrofolha','vscbo','vimatricular','vitomador','empresa_id'
    ];
    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }
    public function cadastro($dados)
    {
        return ValoresRublica::create([
            'vsnrofatura'=>isset($dados['nro__fatura'])?$dados['nro__fatura']:null,
            'vsreciboavulso'=>isset($dados['nro__reciboavulso'])?$dados['nro__reciboavulso']:null,
            'vsmatricula'=>isset($dados['matric__trabalhador'])?$dados['matric__trabalhador']:null,
            'vsnrorequisicao'=>isset($dados['nro__requisicao'])?$dados['nro__requisicao']:null,
            'vsnroboletins'=>isset($dados['nro__boletins'])?$dados['nro__boletins']:null,
            'vscbo'=>isset($dados['cbo'])?$dados['cbo']:null,
            'vsnrocartaoponto'=>isset($dados['nro__cartaoponto'])?$dados['nro__cartaoponto']:null,
            'vsnroequesocial'=>isset($dados['seq__esocial'])?$dados['seq__esocial']:null,
            'vsnrofolha'=>isset($dados['nro__folha'])?$dados['nro__folha']:null,
            'vimatricular'=>isset($dados['matricular'])?$dados['matricular']:null,
            'vimatriculartomador'=>isset($dados['matriculartomador'])?$dados['matriculartomador']:null,
            'empresa_id'=>$dados['empresa'],
        ]);
    }
    public function editar($dados,$id)
    {
        return ValoresRublica::where('id', $id)
        ->orWhere('empresa_id', $id)
        ->update([
            'vsnrofatura'=>$dados['nro__fatura'],
            'vsreciboavulso'=>$dados['nro__reciboavulso'],
            'vsmatricula'=>$dados['matric__trabalhador'],
            // 'vsnrorequisicao'=>$dados['nro__requisicao'],
            'vsnroboletins'=>$dados['nro__boletins'],
            // 'vscbo'=>$dados['cbo'],
            'vsnrocartaoponto'=>$dados['nro__cartaoponto'],
            'vsnroequesocial'=>$dados['seq__esocial'],
            'vsnrofolha'=>$dados['nro__folha'],
            'vimatricular'=>$dados['matric__trabalhador'],
            'vimatriculartomador'=>$dados['matric__tomador'],
        ]);
    }
    public function editarMatricular($dados,$empresa)
    {
        return ValoresRublica::where('empresa_id', $empresa)
        ->update([
            'vimatricular'=>$dados['matricula'],
        ]);
    }
    public function editarAvuso($dados,$empresa)
    {
        return ValoresRublica::where('empresa_id', $empresa)
        ->update([
            'vsreciboavulso'=>$dados['codigo'],
        ]);
    }
    public function editarMatricularTomador($dados,$empresa)
    {
        return ValoresRublica::where('empresa_id', $empresa)
        ->update([
            'vimatriculartomador'=>$dados['matricula'],
        ]);
    }
    public function editarFatura($quantidade,$empresa)
    {
        return ValoresRublica::where('empresa_id', $empresa)
        ->update([
            'vsnrofatura'=>$quantidade,
        ]);
    }
    public function editarBoletimTabela($dados,$empresa)
    {
        return ValoresRublica::where('empresa_id', $empresa)
        ->update([
            'vsnroboletins'=>$dados['liboletim'],
        ]);
    }
    public function buscaUnidadeEmpresa($empresa)
    {
        return ValoresRublica::where('empresa_id', $empresa)->first();
    }
    public function editarUnidadeNuFolhar($empresa,$numerofolhar)
    {
        return ValoresRublica::where('empresa_id', $empresa)
        ->update(['vsnrofolha'=>$numerofolhar]);
    }
    public function editarUnidadeNuCartaoPonto($empresa,$dados)
    {
        return ValoresRublica::where('empresa_id', $empresa)
        ->update(['vsnrocartaoponto'=>$dados['liboletim']]);
    }
    public function deletar($id)
    {
        return ValoresRublica::where('empresa_id', $id)->delete();
    }
    
}
