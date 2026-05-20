<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Crypt;

class ImageCaptcha implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $token = request()->input('captcha_token');

        if (! $token) {
            $fail('The captcha could not be verified. Please refresh it and try again.');

            return;
        }

        try {
            $expected = Crypt::decryptString($token);
        } catch (\Throwable $e) {
            $fail('The captcha expired. Please refresh the image and try again.');

            return;
        }

        if (strtolower(trim((string) $value)) !== $expected) {
            $fail('The characters you entered do not match the image.');
        }
    }
}
