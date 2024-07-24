<?php

namespace App\Helpers;

class EcuadorianIdGenerator
{
    /**
     * Generate a unique identification number.
     *
     * This function generates a unique identification number that adheres to specific validation rules.
     * It creates a valid "Cédula" (an identification number used in Ecuador) by following these steps:
     *
     * 1. Generate a random province code (01 to 24).
     * 2. Generate a random third digit (0 to 5).
     * 3. Generate a random six-digit sequential number.
     * 4. Calculate the verifier digit using the Luhn algorithm to ensure the ID is valid.
     *
     * @return string The generated identification number.
     */
    public static function generateId()
    {
        // Step 1: Generate random province code (01 to 24)
        $province = str_pad(rand(1, 24), 2, '0', STR_PAD_LEFT);

        // Step 2: Generate a random third digit (0 to 5)
        $thirdDigit = rand(0, 5);

        // Step 3: Generate a random six-digit sequential number
        $sequential = str_pad(rand(1, 999999), 6, '0', STR_PAD_LEFT);

        // Combine province code, third digit, and sequential number
        $cedulaWithoutVerifier = $province . $thirdDigit . $sequential;

        // Step 4: Calculate the verifier digit using the Luhn algorithm

        // Calculate the sum of the odd-positioned digits, each multiplied by 2
        $sumOdd = 0;
        for ($i = 0; $i < 9; $i += 2) {
            $mul = $cedulaWithoutVerifier[$i] * 2;
            $sumOdd += $mul > 9 ? $mul - 9 : $mul;
        }

        // Calculate the sum of the even-positioned digits
        $sumEven = 0;
        for ($i = 1; $i < 9; $i += 2) {
            $sumEven += $cedulaWithoutVerifier[$i];
        }

        // Total sum of all digits
        $totalSum = $sumOdd + $sumEven;

        // Calculate the verifier digit
        $verifier = 10 - ($totalSum % 10);
        $verifier = $verifier == 10 ? 0 : $verifier;

        // Return the complete ID with the verifier digit
        return $cedulaWithoutVerifier . $verifier;
    }

}
