<?php

namespace App\Rules;

use App\Models\Profile;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Database\QueryException;

class EcuadorCedulaOrRuc implements Rule
{
    protected $value;

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if (strlen($value) === 10) {
            return $this->validateCedula($value);
        } elseif (strlen($value) === 13) {
            return $this->validateRuc($value);
        }

        return false;
    }

    /**
     * Validate an Ecuadorian cédula.
     *
     * @param  string  $value
     * @return bool
     */
    protected function validateCedula($value)
    {
        // Check if the length is exactly 10 digits
        if (strlen($value) !== 10) {
            return false;
        }

        // Extract the province code and verify it is valid (01-24)
        $provinceCode = (int)substr($value, 0, 2);
        if ($provinceCode < 1 || $provinceCode > 24) {
            return false;
        }

        // Extract the third digit and verify it is less than 6 (natural persons)
        $thirdDigit = (int)$value[2];
        if ($thirdDigit >= 6) {
            return false;
        }

        // Validate the last digit (checksum)
        $multipliers = [2, 1, 2, 1, 2, 1, 2, 1, 2];
        $sum = 0;

        for ($i = 0; $i < 9; $i++) {
            $digit = (int)$value[$i] * $multipliers[$i];
            $sum += ($digit >= 10) ? $digit - 9 : $digit;
        }

        $lastDigit = (int)$value[9];
        $expectedDigit = (10 - ($sum % 10)) % 10;

        return $lastDigit === $expectedDigit;
    }

    /**
     * Validate an Ecuadorian RUC.
     *
     * @param  string  $value
     * @return bool
     */
    protected function validateRuc($value)
    {
        // The first 10 digits should pass the cédula validation
        if (!$this->validateCedula(substr($value, 0, 10))) {
            return false;
        }

        // The RUC must end with "001"
        return substr($value, -3) === '001';
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('The :attribute field is not a valid Ecuadorian cédula or RUC');
    }
}

