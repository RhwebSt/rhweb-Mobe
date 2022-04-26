<?php

namespace App\Http\Requests\Boletim\CartaoPonto\Lanca;

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
            'nome__completo' => 'required|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÏÍÔÕÛÙÜŸÑÆŒa-zàáâãçéèêëîíïôõûùüÿñæœ 0-9_\-]*$/',
            'trabalhador'=>'required',
            'matricula'=>'required|max:4',
            'entrada1'=>'max:5',
            'saida'=>'max:5',
            'entrada2'=>'max:5',
            'saida2'=>'max:5',
            'entrada3'=>'max:5',
            'saida3'=>'max:5',
            'entrada4'=>'max:5',
            'saida4'=>'max:5',
            'total'=>'max:5|required'
        ];
    }
    public function messages()
    {
        // remova somente aquele validação que foi customizada na classe
        return [
             // 'total.required'=>'O campo não pode esta vazio!',
            // 'total.max'=>'Campo não pode ter mais de 5 caracteres!',
            // 'entrada1.max'=>'Campo não pode ter mais de 5 caracteres!',
            // 'saida.max'=>'Campo não pode ter mais de 5 caracteres!',
            // 'entrada2.max'=>'Campo não pode ter mais de 5 caracteres!',
            // 'saida2.max'=>'Campo não pode ter mais de 5 caracteres!',
            // 'entrada3.max'=>'Campo não pode ter mais de 5 caracteres!',
            // 'saida3.max'=>'Campo não pode ter mais de 5 caracteres!',
            // 'entrada4.max'=>'Campo não pode ter mais de 5 caracteres!',
            // 'saida4.max'=>'Campo não pode ter mais de 5 caracteres!',
            // 'nome__completo.required'=>'O campo não pode esta vazio!',
            // 'trabalhador.required'=>'O campo não pode esta vazio!',
            // 'matricula.required'=>'O campo não pode esta vazio!',
            // 'matricula.min'=>'O campo não pode ter menos de 4 caracteres'
        ];
    }
}
