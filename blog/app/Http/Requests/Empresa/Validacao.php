<?php

namespace App\Http\Requests\Empresa;

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
            'esnome'=>'required|max:100',
            'escnpj'=>'required|max:100',
            'dataregistro'=>'required|max:30',
            'responsave'=>'required|max:30',
            'email'=>'required|max:100|email',
            'cnae__codigo'=>'required|max:10',
            'contribuicao__sindicato'=>'required|max:30',
            'telefone'=>'required|max:20',
            'cod__municipio'=>'required|max:10',
            'cep'=>'required|max:16',
            'logradouro'=>'required|max:50',
            'numero'=>'required|max:10',
            'bairro'=>'required:max:40',
            'localidade'=>'required|max:30',
            'uf'=>'required|max:2|uf',
        ];
    }
}
