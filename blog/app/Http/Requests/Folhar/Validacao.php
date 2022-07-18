<?php

namespace App\Http\Requests\Folhar;

use App\Rules\Folhar\Validacao as FolharValidacao;
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
            'ano_inicial'=>'required|max:10',
            'ano_final'=>['required','max:10',new FolharValidacao],
            'competencia'=>'required|max:10'
        ];
    }
    public function messages()
    {
        // remova somente aquele validação que foi customizada na classe
        return [
            'ano_inicial.required'=>'Este campo e obrigatório',
            'ano_inicial.max'=>'O campo não pode conter mais de 10 caracteres.',
            'ano_final.required'=>'Este campo e obrigatório',
            'ano_final.max'=>'O campo não pode conter mais de 10 caracteres.',
            'competencia.required'=>'Este campo e obrigatório',
            'competencia.max'=>'O campo não pode conter mais de 10 caracteres.'
        ];
    }
}
