<?php

namespace App\Services;

use Str;

class MaskService
{

    public static function mask(string $value): string
    {
        $res = '';
        $symbols = ['-', '_', '@'];

        $arr = str_split($value);
        foreach ($arr as $value) {
            $res.= match ($value) {
                'N' => rand(0, 9),
                'A', 'X' => strtoupper(Str::random(1)),
                'Z' => $symbols[array_rand($symbols)],
                'a' => strtolower(Str::random(1)),
                default => $value,
            };
        }
        return $res;
    }

}
