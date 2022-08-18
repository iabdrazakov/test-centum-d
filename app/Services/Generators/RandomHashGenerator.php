<?php

namespace App\Services\Generators;

class RandomHashGenerator
{
    const SYMBOLS = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    const HASH_LENGTH = 8;

    public function generate(): string
    {
        $pass = '';
        $alphaLength = strlen(self::SYMBOLS) - 1;
        for ($i = 0; $i < self::HASH_LENGTH; $i++) {
            $n = rand(0, $alphaLength);
            $pass .= self::SYMBOLS[$n];
        }

        return $pass;
    }
}
