<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Http;

class Recaptcha implements Rule
{
    public function __construct()
    {
        //
    }

    public function passes($attribute, $value)
    {
        $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => env('RECAPTCHA_SECRET_KEY'),
            'response' => $value,
        ]);

        return $response->json()['success'];
    }

    public function message()
    {
        return 'The reCAPTCHA validation failed. Please try again.';
    }
}

