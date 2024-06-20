<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Facade;
use Illuminate\Support\ServiceProvider;

class ReCaptchaService
{
    public static function verify($token)
    {
        $secret_key = config('recaptcha.secret_key');
        $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => $secret_key,
            'response' => $token,
        ]);
        
        $body = $response->json();

        return $body['success'];
    }
}