<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidacaoTomador extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nome__completo' => 'required|max:100|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÓÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôõóûùúüÿñæœ 0-9-]*$/',
            //'nome__fantasia' => 'required|max:100|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÓÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôõóûùúüÿñæœ 0-9-]*$/',
            'cnpj' => 'required|max:19|cnpj',
            'matricula'=>'required|max:10|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÓÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôõóûùúüÿñæœ 0-9_\-().]*$/',
            'simples'=>'required|max:10|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÓÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôõóûùúüÿñæœ 0-9_\-().]*$/',
            'telefone'=>'required|max:16',
            'cep'=>'required|max:16|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÓÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôõóûùúüÿñæœ 0-9_\-().]*$/',
            'logradouro'=>'required|max:50|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÓÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôõóûùúüÿñæœ 0-9_\-().]*$/',
            'numero'=>'required|max:10|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÓÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôõóûùúüÿñæœ 0-9_\-().]*$/',
            'bairro'=>'required:max:40|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÓÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôõóûùúüÿñæœ 0-9_\-().]*$/',
            'localidade'=>'required|max:30|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÓÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôõóûùúüÿñæœ 0-9_\-().]*$/',
            'uf'=>'required|max:2|uf|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÓÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôõóûùúüÿñæœ]*$/',
            'taxa_adm'=>'',
            'taxa__fed'=>'',
            'deflator'=>'|max:100',
            'das'=>'',
            'cod__fpas'=>'',
            'cod__grps'=>'',
            'cod__recol'=>'',
            'cnae'=>'',
            'fap__aliquota'=>'',
            'rat__ajustado'=>'',
            'fpas__terceiros'=>'',
            'aliq__terceiros'=>'',
            'alimentacao'=>'',
            'transporte'=>'',
            'epi'=>'',
            'seguro__trabalhador'=>'',
            'folhartransporte'=>'',
            'folhartipotrans'=>'',
            'folharalim'=>'',
            'folhartipoalim'=>'',
            'dias_uteis'=>'required|max:5',
            'sabados'=>'max:5',
            'domingos'=>'max:5',
           
            'banco'=>'max:100',
            'agencia'=>'max:4',
            'operacao'=>'max:3',
            'conta'=>'max:10',
            'pix'=>'max:255'
        ];
    }
    public function messages()
    {
        // remova somente aquele validação que foi customizada na classe
        return [
            'nome__completo.required'=>'Este campo é obrigatório.',
            'nome__completo.max'=>'O campo não pode conter mais de 100 caracteres.',
            'nome__completo.regex'=>'O campo não pode conter caracteres especiais.',
            'nome__fantasia.required'=>'Este campo é obrigatório.',
            'nome__fantasia.max'=>'O campo não pode conter mais de 100 caracteres.',
            'nome__fantasia.regex'=>'O campo não pode conter caracteres especiais.',
            'cnpj.required'=>'Este campo é obrigatório.',
            'cnpj.max'=>'O campo não pode conter mais de 19 caracteres.',
            'cnpj.cnpj'=>'Não é um CNPJ valido.',
            'matricula.required'=>'Este campo é obrigatório.',
            'matricula.max'=>'O campo não pode conter mais de 10 caracteres.',
            'matricula.regex'=>'O campo não pode conter caracteres especiais.',
            'simples.required'=>'Este campo é obrigatório.',
            'simples.max'=>'O campo não pode conter mais de 10 caracteres.',
            'simples.regex'=>'O campo não pode conter caracteres especiais.',
            'telefone.required'=>'Este campo é obrigatório.',
            'telefone.max'=>'O campo não pode conter mais de 16 caracteres.',
            'cep.required'=>'Este campo é obrigatório.',
            'cep.max'=>'O campo não pode conter mais de 16 caracteres.',
            'cep.regex'=>'O campo não pode conter caracteres especiais.',
            'logradouro.required'=>'Este campo é obrigatório.',
            'logradouro.max'=>'O campo não pode conter mais de 50 caracteres.',
            'logradouro.regex'=>'O campo não pode conter caracteres especiais.',
            'numero.required'=>'Este campo é obrigatório.',
            'numero.max'=>'O campo não pode conter mais de 10 caracteres.',
            'numero.regex'=>'O campo não pode conter caracteres especiais.',
            'bairro.required'=>'Este campo é obrigatório.',
            'bairro.max'=>'O campo não pode conter mais de 40 caracteres.',
            'bairro.regex'=>'O campo não pode conter caracteres especiais.',
            'localidade.required'=>'Este campo é obrigatório.',
            'localidade.max'=>'O campo não pode conter mais de 30 caracteres.',
            'localidade.regex'=>'O campo não pode conter caracteres especiais.',
            'uf.required'=>'Este campo é obrigatório.',
            'uf.max'=>'O campo não pode conter mais de 2 caracteres.',
            'uf.regex'=>'O campo não pode conter caracteres especiais.',
            'uf.uf'=>'Esta sigla não está correta.',
            'deflator.required'=>'Este campo é obrigatório.',
            'deflator.max'=>'O campo não pode conter mais de 100 caracteres.',
            'taxa_adm.required'=>'Este campo é obrigatório.',
            'taxa__fed.required'=>'Este campo é obrigatório.',
            'das.required'=>'Este campo é obrigatório.',
            'cod__fpas.required'=>'Este campo é obrigatório.',
            'cod__fpas.required'=>'Este campo é obrigatório.',
            'cod__grps.required'=>'Este campo é obrigatório.',
            'cod__recol.required'=>'Este campo é obrigatório.',
            'cnae.required'=>'Este campo é obrigatório.',
            'fap__aliquota.required'=>'Este campo é obrigatório.',
            'rat__ajustado.required'=>'Este campo é obrigatório.',
            'fpas__terceiros.required'=>'Este campo é obrigatório.',
            'aliq__terceiros.required'=>'Este campo é obrigatório.',
            'alimentacao.required'=>'Este campo é obrigatório.',
            'transporte.required'=>'Este campo é obrigatório.',
            'epi.required'=>'Este campo é obrigatório.',
            'seguro__trabalhador.required'=>'Este campo é obrigatório.',
            'folhartransporte.required'=>'Este campo é obrigatório.',
            'folhartipotrans.required'=>'Este campo é obrigatório.',
            'folharalim.required'=>'Este campo é obrigatório.',
            'folhartipoalim.required'=>'Este campo é obrigatório.',
            'dias_uteis.required'=>'Este campo é obrigatório.',
            'dias_uteis.max'=>'O campo não pode conter mais de 5 caracteres.',
            'sabados.max'=>'O campo não pode conter mais de 5 caracteres.',
            'domingos.max'=>'O campo não pode conter mais de 5 caracteres.',
            'banco.max'=>'O campo não pode conter mais de 100 caracteres.',
            'agencia.max'=>'O campo não pode conter mais de 4 caracteres.',
            'operacao.max'=>'O campo não pode conter mais de 3 caracteres.',
            'conta.max'=>'O campo não pode conter mais de 10 caracteres.',
            'pix.max'=>'O campo não pode conter mais de 225 caracteres.'
        ];
    }
}
