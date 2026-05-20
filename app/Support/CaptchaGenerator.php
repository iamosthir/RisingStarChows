<?php

namespace App\Support;

use Gregwar\Captcha\CaptchaBuilder;
use Illuminate\Support\Facades\Crypt;

class CaptchaGenerator
{
    /**
     * Build a fresh captcha image and its signed answer token.
     *
     * @return array{image: string, token: string}
     */
    public static function make(): array
    {
        $phrase = self::randomPhrase();

        $builder = new CaptchaBuilder($phrase);
        $builder->build(220, 70);

        return [
            'image' => $builder->inline(),
            'token' => Crypt::encryptString(strtolower($phrase)),
        ];
    }

    protected static function randomPhrase(int $length = 5): string
    {
        // Excludes visually ambiguous characters (0/O, 1/I/L).
        $pool = 'ABCDEFGHJKMNPQRSTUVWXYZ23456789';
        $phrase = '';

        for ($i = 0; $i < $length; $i++) {
            $phrase .= $pool[random_int(0, strlen($pool) - 1)];
        }

        return $phrase;
    }
}
