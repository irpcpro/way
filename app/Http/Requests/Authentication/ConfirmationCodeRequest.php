<?php

namespace App\Http\Requests\Authentication;

use App\Http\Requests\AppRequest;


class ConfirmationCodeRequest extends AppRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'mobile' => ['required', 'bail', 'exists:users,mobile', 'regex:' . REGEX_MOBILE],
            'code' => ['required', 'string', 'max:' . AUTH_CODE_LENGTH]
        ];
    }

    public function messages()
    {
        return [
            'mobile.required' => 'mobile number is required.',
            'mobile.regex' => 'mobile format is incorrect.',
            'mobile.exists' => 'mobile number not found.',
            'code.required' => 'code is required.',
            'code.max' => 'code length must be ' . AUTH_CODE_LENGTH . ' character.',
        ];
    }

}
