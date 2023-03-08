<?php

namespace App\Http\Requests\Authentication;

use App\Http\Requests\AppRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class SendCodeRequest extends AppRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'mobile' => ['required', 'bail', 'regex:' . REGEX_MOBILE],
            'name' => ['string']
        ];
    }

    public function messages()
    {
        return [
            'mobile.required' => 'mobile number is required.',
            'mobile.regex' => 'mobile format is incorrect.',
        ];
    }

}
