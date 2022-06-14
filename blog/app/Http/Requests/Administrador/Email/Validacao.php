<?php

namespace App\Http\Requests\Administrador\Email;

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
            'titulo__msg-email' => 'required|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôõûùúüÿñæœ 0-9_\-().]*$/',
            'descricao__msg-email'=>'required|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÓÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôóõûùúüÿñæœ 0-9_\-().]*$/',
        ];
    }
    public function messages()
    {
        // remova somente aquele validação que foi customizada na classe
        return [
            'titulo__msg-email.required'=>'Campo não pode esta vazio.',
            'titulo__msg-email.regex'=>'O campo nome social tem um formato inválido.',
            'descricao__msg-email.required'=>'Campo não pode esta vazio.',
            'descricao__msg-email.regex'=>'O campo nome social tem um formato inválido.',
        ];
    }
}
