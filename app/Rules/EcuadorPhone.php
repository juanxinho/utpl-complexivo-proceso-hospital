<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class EcuadorPhone implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        // Regular expression for validating Ecuadorian phone numbers
        return preg_match('/^(0[2-7][0-9]{7}|09[0-9]{8})$/', $value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute field is not a valid Ecuadorian phone number.';
    }
}
