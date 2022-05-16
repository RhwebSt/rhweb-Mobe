<?php

namespace App\Http\Requests\Avuso;

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
            'nome' => 'required|max:60|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôõûùúüÿñæœ 0-9_\-().]*$/',
            'cpf' => 'required|max:15|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôõûùúüÿñæœ 0-9_\-().]*$/',
            'ano_inicial'=>'required|max:10|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÓÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôóõûùúüÿñæœ 0-9_\-().]*$/',
            'ano_final'=>'required|max:10|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÓÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôóõûùúüÿñæœ 0-9_\-().]*$/',
            'descricao0'=>'required|max:60|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÓÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôóõûùúüÿñæœ 0-9_\-().]*$/',
            'valor0'=>'required',
        ];
    }
    public function messages()
    {
        // remova somente aquele validação que foi customizada na classe
        return [
            'descricao0.required'=>'Campo não pode esta vazio.',
            'descricao0.max'=>'Campo não ter mais de 60 caracteres.',
            'descricao0.regex'=>'O campo nome social tem um formato inválido.',

            'ano_inicial.required'=>'Campo não pode esta vazio.',
            'ano_inicial.max'=>'Campo não ter mais de 60 caracteres.',
            'ano_inicial.regex'=>'O campo nome social tem um formato inválido.',

            'ano_final.required'=>'Campo não pode esta vazio.',
            'ano_final.max'=>'Campo não ter mais de 60 caracteres.',
            'ano_final.regex'=>'O campo nome social tem um formato inválido.',

            'valor0.required'=>'Campo não pode esta vazio.',
        ];
    }
}
