<?php

namespace App\Http\Requests\Usuario\Perfil;

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
            'nome' => 'required|max:100|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÓÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôóõûùúüÿñæœ 0-9_\-().]*$/',
            'cpf' => 'required|max:15|cpf|formato_cpf',
            'data__nascimento'=>'required|max:10|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÓÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôóõûùúüÿñæœ 0-9_\-().]*$/',
            'telefone'=>'required|max:16',
            'cep'=>'required|max:16|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÓÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôóõûùúüÿñæœ 0-9_\-().]*$/',
            'logradouro'=>'required|max:50|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÓÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôóõûùúüÿñæœ 0-9_\-().]*$/',
            'numero'=>'required|max:10|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÓÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôóõûùúüÿñæœ 0-9_\-().]*$/',
            'bairro'=>'required:max:40|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÓÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôóõûùúüÿñæœ 0-9_\-().]*$/',
            'localidade'=>'required|max:30|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÓÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôóõûùúüÿñæœ 0-9_\-().]*$/',
            'uf'=>'required|max:2|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÓÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôóõûùúüÿñæœ 0-9_\-().]*$/',
        ];
    }
    public function messages()
    {
        // remova somente aquele validação que foi customizada na classe
        return [
            'nome.required'=>'O campo não pode estar vazio.',
            'nome.max'=>'O campo não pode conter mais de 100 caracteres.',
            'nome.regex'=>'O campo nome social tem um formato inválido.',
         
            
            'cpf.required'=>'O campo não pode estar vazio.',
            'cpf.max'=>'O campo não pode conter mais de 15 caracteres.',
            'cpf.cpf'=>'Este CPF é invalido.',
            'cpf.formato_cpf'=>'Este CPF não possui um formato valido.',
            
            
            
            'data__nascimento.required'=>'O campo não pode estar vazio.',
            'data__nascimento.max'=>'O campo não pode conter mais de 10 caracteres.',
            'data__nascimento.regex'=>'O campo nome social possui um formato inválido.',
            
           
            
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
        ];
    }
}
