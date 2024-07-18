<?php

namespace App\Helpers;

class EcuadorianIdGenerator
{
    public static function generateId()
    {
        $province = str_pad(rand(1, 24), 2, '0', STR_PAD_LEFT);
        $thirdDigit = rand(0, 5);
        $sequential = str_pad(rand(1, 999999), 6, '0', STR_PAD_LEFT);
        $cedulaWithoutVerifier = $province . $thirdDigit . $sequential;

        $sumOdd = 0;
        for ($i = 0; $i < 9; $i += 2) {
            $mul = $cedulaWithoutVerifier[$i] * 2;
            $sumOdd += $mul > 9 ? $mul - 9 : $mul;
        }

        $sumEven = 0;
        for ($i = 1; $i < 9; $i += 2) {
            $sumEven += $cedulaWithoutVerifier[$i];
        }

        $totalSum = $sumOdd + $sumEven;
        $verifier = 10 - ($totalSum % 10);
        $verifier = $verifier == 10 ? 0 : $verifier;

        return $cedulaWithoutVerifier . $verifier;
    }
}
