<?php

namespace App\Rules\Folhar;

use App\Folhar;
use Illuminate\Contracts\Validation\Rule;

class Validacao implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    private $folhar;
    public function __construct()
    {
        $this->folhar = new Folhar;
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
        if (date('d',strtotime($value)) <= 15) {
            $user = auth()->user();
            $folhar30 = $this->folhar
            ->where(function($query) use ($value,$user){
                $query->where('empresa_id',$user->empresa_id)
                ->whereBetween('fsfinal',[date('Y-m',strtotime($value)).'-16',date('Y-m',strtotime($value)).'-31']);
            })->count();
            if ($folhar30) {
                return false;
            }else{
                return true;
            }
        }else{
            return true;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'A folha de 30 já foi calculada';
    }
}
