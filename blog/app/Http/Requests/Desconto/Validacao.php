<?php

namespace App\Http\Requests\Desconto;

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
            // 'competencia' => 'required|max:20',
            // 'descricao'=>'required|max:100|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÓÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôóõûùúüÿñæœ 0-9_\-().]*$/',
            // 'quinzena'=>'required|max:17|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÓÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôóõûùúüÿñæœ 0-9_\-().]*$/',
            // 'valor'=>'required',
        ];
    }
    public function messages()
    {
        // remova somente aquele validação que foi customizada na classe
        return [
            'competencia.required'=>'O campo não pode estar vazio.',
            'competencia.max'=>'O campo não ter mais de 100 caracteres.',
        
            'descricao.required'=>'O campo não pode estar vazio.',
            'descricao.max'=>'O campo não ter mais de 100 caracteres.',
            'descricao.regex'=>'O campo possui um formato inválido.',

            'quinzena.required'=>'O campo não pode estar vazio.',
            'quinzena.max'=>'O campo não ter mais de 100 caracteres.',
            'quinzena.regex'=>'O campo possui um formato inválido.',
            'valor.required'=>'O campo não pode estar vazio.',
        ];
    }
}
