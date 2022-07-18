<?php

namespace App\Rules;

use App\Descontos;
use App\Empresa;
use App\Folhar;
use Illuminate\Contracts\Validation\Rule;

class DescontoFolhar implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    private $folhar,$desconto,$empresa;
    public function __construct()
    {
        $this->folhar = new Folhar;
        $this->desconto = new Descontos;
        $this->empresa = new Empresa;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        
        $user = auth()->user();
        $segunda = $this->folhar
        ->where(function($query) use ($value,$user){
            $datainicio = $value.'-16';
            $datafinal = $value.'-31';
            $query->where('empresa_id',$user->empresa_id)
            ->whereBetween('fsfinal',[$datainicio,$datafinal]);
           
        })->count();
        $primeira = $this->folhar
        ->where(function($query) use ($value,$user){
            $datainicio = $value.'-01';
            $datafinal = $value.'-15';
            $query->where('empresa_id',$user->empresa_id)
            ->whereBetween('fsfinal',[$datainicio,$datafinal]);
        })->count();
        return $primeira > 1;
        // if ($primeira) {
        //     // return $primeira > 1;
        // }elseif ($segunda) {
        //     return $segunda > 1;
        // }
       
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'A folha já foi cálculada nesta quizena';
    }
}
