<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\Response as ClientResponse;

class RegisterRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ];

        if (config('services.recaptcha.secret')) {
            $rules['g-recaptcha-response'] = 'required';
        }

        return $rules;
    }

    public function withValidator($validator)
    {
        if (!config('services.recaptcha.secret')) {
            return;
        }

        $validator->after(function ($validator) {
            $token = $this->input('g-recaptcha-response');

            if (!$token || !$this->verifyRecaptcha($token)) {
                $validator->errors()->add('recaptcha', 'reCAPTCHA verification failed. Please try again.');
            }
        });
    }

    protected function verifyRecaptcha($token)
    {
        $secret = config('services.recaptcha.secret');
        if (!$secret) {
            return true;
        }

        /** @var ClientResponse $response */
        $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => $secret,
            'response' => $token,
            'remoteip' => $this->ip(),
        ]);

        $success = data_get($response->json(), 'success');
        return $response->successful() && filter_var($success, FILTER_VALIDATE_BOOLEAN) === true;
    }
}
