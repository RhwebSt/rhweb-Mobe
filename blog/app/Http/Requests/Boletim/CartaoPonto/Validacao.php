<?php

namespace App\Http\Requests\Boletim\CartaoPonto;

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
            'tomador'=>'required',
            'liboletim'=>'required|numeric',
            'num__trabalhador'=>'required',
            'data'=>'required'
        ];
    }
    public function messages()
    {
        // remova somente aquele validação que foi customizada na classe
        return [
            'nome__completo.required'=>'O campo não pode estar vazio!',
            'tomador.required'=>'O campo não pode estar vazio!',
            'num__trabalhador.required'=>'O campo não pode estar vazio!',
            'num__trabalhador.numeric'=>'O campo não pode conter letras',
            'liboletim.required'=>'O campo não pode estar vazio!',
            'liboletim.numeric'=>'O campo não pode conter letras',
            'liboletim.exists'=>'Este boletim ja está cadastrado',
            'data.required'=>'O campo não pode estar vazio!'
        ];
    }
}
