<?php

namespace App\Http\Requests\Avuso\Recibo;

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
            'search' => 'required|max:100|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôõûùúüÿñæœ 0-9_\-().]*$/',
            'ano_inicial1'=>'required|max:10|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÓÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôóõûùúüÿñæœ 0-9_\-().]*$/',
            'ano_final1'=>'required|max:10|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÓÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôóõûùúüÿñæœ 0-9_\-().]*$/',
        ];
    }
    public function messages()
    {
        // remova somente aquele validação que foi customizada na classe
        return [
            'search.required'=>'Campo não pode esta vazio.',
            'search.max'=>'Campo não ter mais de 100 caracteres.',
            'search.regex'=>'O campo nome social tem um formato inválido.',

            'ano_inicial1.required'=>'Campo não pode esta vazio.',
            'ano_inicial1.max'=>'Campo não ter mais de 10 caracteres.',
            'ano_inicial1.regex'=>'O campo nome social tem um formato inválido.',

            'ano_final1.required'=>'Campo não pode esta vazio.',
            'ano_final1.max'=>'Campo não ter mais de 10 caracteres.',
            'ano_final1.regex'=>'O campo nome social tem um formato inválido.',
        ];
    }
}
