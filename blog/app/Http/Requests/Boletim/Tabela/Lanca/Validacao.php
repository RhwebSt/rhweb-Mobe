<?php

namespace App\Http\Requests\Boletim\Tabela\Lanca;

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
            'nome__completo' => 'required',
            'matricula'=>'required|max:4',
            'codigo'=>'required|max:4', 
            'rubrica'=>'required|max:60',
            'quantidade'=>'required'
        ];
    }
    public function messages()
    {
        // remova somente aquele validação que foi customizada na classe
        return [
            'codigo.required'=>'O campo codigo é obrigatório.',
            'codigo.max'=>'O campo código não pode ser superior a 4 caracteres.'
        ];
    }
}
