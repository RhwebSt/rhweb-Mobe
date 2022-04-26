<?php

namespace App\Http\Requests\Tomador\TabelaPreco;

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
            'ano' => 'required|max:4',
            'rubricas' => 'required|max:30',
            'descricao' => 'required|max:60|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÏÔÕÛÙÜŸÑÆŒa-zàáâãçéèêëîïôõûùüÿñæœ 0-9_\-%]*$/',
            'valor' => 'required',
            'valor__tomador' => 'required'
        ];
    }
    public function messages()
    {
        // remova somente aquele validação que foi customizada na classe
        return [
            
        ];
    }
}
