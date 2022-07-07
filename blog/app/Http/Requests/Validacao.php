<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Validacao extends FormRequest
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
            'nome__completo' => 'required|max:100|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÓÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôóõûùúüÿñæœ ]*$/',
            'nome__social' => 'max:100',
            'cpf' => 'required|max:15|cpf|formato_cpf',
            'pis'=>'required|max:20|pis',
            'data_nascimento'=>'required|max:10|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÓÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôóõûùúüÿñæœ 0-9_\-().]*$/',
            'dataEmissaoRg'=>'required|max:10|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÓÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôóõûùúüÿñæœ 0-9_\-().]*$/',
            'ufRg'=>'required|max:2|uf',
            'rg'=>'required',
            'pais__nascimento'=>'required|max:60|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÓÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôóõûùúüÿñæœ 0-9 -]*$/',
            'pais__nacionalidade'=>'required|max:60|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÓÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôóõûùúüÿñæœ 0-9 -]*$/',
            'nome__mae'=>'required|max:50|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÓÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôóõûùúüÿñæœ ]*$/',
            'telefone'=>'required|max:16',
            'cep'=>'required|max:16|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÓÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôóõûùúüÿñæœ 0-9_\-().]*$/',
            'logradouro'=>'required|max:50|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÓÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôóõûùúüÿñæœ 0-9_\-().]*$/',
            'numero'=>'required|max:10|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÓÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôóõûùúüÿñæœ 0-9_\-().]*$/',
            'bairro'=>'required:max:40|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÓÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôóõûùúüÿñæœ 0-9_\-().]*$/',
            'localidade'=>'required|max:30|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÓÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôóõûùúüÿñæœ 0-9_\-().]*$/',
            'uf'=>'required|max:2|uf',
            'data__admissao'=>'max:10',
            'categoria__contrato'=>'max:255',
            'cbo'=>'max:255',
            'ctps'=>'max:20',
            'serie__ctps'=>'max:20',
            'uf__ctps'=>'max:2',
            'data__afastamento'=>'max:10',
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
            'nome__completo.required'=>'O campo não pode estar vazio.',
            'nome__completo.max'=>'O campo não pode conter mais de 100 caracteres.',
            'nome__completo.regex'=>'O campo nome social tem um formato inválido.',
            
            'nome__social.required'=>'O campo não pode estar vazio.',
            'nome__social.max'=>'O campo não pode conter mais de 100 caracteres.',
            'nome__social.regex'=>'O campo nome social tem um formato inválido.',
            
            'cpf.required'=>'O campo não pode estar vazio.',
            'cpf.max'=>'O campo não pode conter mais de 15 caracteres.',
            'cpf.cpf'=>'Este CPF é invalido.',
            'cpf.formato_cpf'=>'Este CPF não possui um formato valido.',
            
            'pis.required'=>'O campo não pode estar vazio.',
            'pis.max'=>'O campo não pode conter mais de 20 caracteres.',
            'pis.pis'=>'Este PIS é invalido.',
            
            'data_nascimento.required'=>'O campo não pode estar vazio.',
            'data_nascimento.max'=>'O campo não pode conter mais de 10 caracteres.',
            'data_nascimento.regex'=>'O campo nome social possui um formato inválido.',
            
            'pais__nascimento.required'=>'O campo não pode estar vazio.',
            'pais__nascimento.max'=>'O campo não pode conter mais de 60 caracteres.',
            'pais__nascimento.regex'=>'O campo nome social possui um formato inválido.',
            
            'pais__nacionalidade.required'=>'O campo não pode estar vazio.',
            'pais__nacionalidade.max'=>'O campo não pode conter mais de 60 caracteres.',
            'pais__nacionalidade.regex'=>'O campo nome social possui um formato inválido.',
            
            'nome__mae.required'=>'O campo não pode estar vazio.',
            'nome__mae.max'=>'O campo não pode conter mais de 60 caracteres.',
            'nome__mae.regex'=>'O campo nome social tem um formato inválido.',
            
            'telefone.required'=>'O campo não pode estar vazio.',
            'telefone.max'=>'O campo não pode conter mais de 16 caracteres.',
            'telefone.celular_com_ddd'=>'Este DDD não é valido.',
            
            'telefone.required'=>'O campo não pode estar vazio.',
            'telefone.max'=>'O campo não pode conter mais de 16 caracteres.',
            'telefone.celular_com_ddd'=>'Este DDD não é valido.',
            
            'cep.required'=>'O campo não pode estar vazio.',
            'cep.max'=>'O campo não pode conter mais de 16 caracteres.',
            'cep.regex'=>'O campo nome social possui um formato inválido.',
            
            'logradouro.required'=>'O campo não pode estar vazio.',
            'logradouro.max'=>'O campo não pode conter mais de 50 caracteres.',
            'logradouro.regex'=>'O campo nome social possui um formato inválido.',
            
            'numero.required'=>'O campo não pode estar vazio.',
            'numero.max'=>'O campo não pode conter mais de 10 caracteres.',
            'numero.regex'=>'O campo nome social possui um formato inválido.',
            
            'bairro.required'=>'O campo não pode estar vazio.',
            'bairro.max'=>'O campo não pode conter mais de 10 caracteres.',
            'bairro.regex'=>'O campo nome social possui um formato inválido.',
            
            'localidade.required'=>'O campo não pode estar vazio.',
            'localidade.max'=>'O campo não pode conter mais de 10 caracteres.',
            'localidade.regex'=>'O campo nome social possui um formato inválido.',
            
            'uf.required'=>'O campo não pode estar vazio.',
            'uf.max'=>'O campo não pode conter mais de 10 caracteres.',
            'uf.regex'=>'O campo nome social possui um formato inválido.',
            
            'data__admissao.required'=>'O campo não pode estar vazio.',
            'data__admissao.max'=>'O campo não pode conter mais de 10 caracteres.',
            'data__admissao.regex'=>'O campo nome social possui um formato inválido.',
            
            'categoria__contrato.required'=>'O campo não pode estar vazio.',
            'categoria__contrato.max'=>'O campo não pode conter mais de 255 caracteres.',
            'categoria__contrato.regex'=>'O campo nome social possui um formato inválido.',
            
            'cbo.required'=>'O campo não pode estar vazio.',
            'cbo.max'=>'O campo não pode conter mais de 225 caracteres.',
            'cbo.regex'=>'O campo nome social possui um formato inválido.',
            
            'ctps.required'=>'O campo não pode estar vazio.',
            'ctps.max'=>'O campo não pode conter mais de 20 caracteres.',
            
            'serie__ctps.required'=>'O campo não pode estar vazio.',
            'serie__ctps.max'=>'O campo não pode conter mais de 20 caracteres.',
            
            'uf__ctps.required'=>'O campo não pode estar vazio.',
            'uf__ctps.max'=>'O campo não ter mais de 255 caracteres.',
            'uf__ctps.regex'=>'O campo nome social possui um formato inválido.',
            'ufRg.required'=>'O campo não pode estar vazio.',
            'ufRg.max'=>'O campo não pode conter mais de 2 caracteres.',
            'dataEmissaoRg.required'=>'O campo não pode estar vazio.',
            'dataEmissaoRg.max'=>'O campo não pode conter mais de 10 caracteres.',
            // 'ufRg.uf'=>'Este campo tem que conte letra ma.',
            'rg.required'=>'O campo não pode estar vazio.',
            'data__afastamento.max'=>'O campo não pode conter mais de 10 caracteres.',
            'banco.max'=>'O campo não pode conter mais de 100 caracteres.',
            'agencia.max'=>'O campo não pode conter mais de 4 caracteres.',
            'operacao.max'=>'O campo não pode conter mais de 3 caracteres.',
            'conta.max'=>'O campo não pode conter mais de 10 caracteres.',
            'pix.max'=>'O campo não pode conter mais de 225 caracteres.'
        ];
    }
}
