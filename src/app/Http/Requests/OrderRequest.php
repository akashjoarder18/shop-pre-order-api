<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\Order;
use App\Rules\Recaptcha;

class OrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required','max:255'],
            'email' => ['required','email','max:255'],
            'product_id' => 'required|numeric',
            'quantity' => ['required','min:1',Rule::notIn([0]), 'between:1,1000'],
            'recaptchaToken' => 'required',
        ];
    }
}
