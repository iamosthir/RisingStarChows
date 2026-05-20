<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Crypt;

class MathCaptcha implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $token = request()->input('captcha_token');

        if (! $token) {
            $fail('The spam check could not be verified. Please try again.');

            return;
        }

        try {
            $expected = Crypt::decryptString($token);
        } catch (\Throwable $e) {
            $fail('The spam check expired. Please solve the new question and resubmit.');

            return;
        }

        if ((string) $value !== (string) $expected) {
            $fail('The answer to the math question is incorrect.');
        }
    }
}
