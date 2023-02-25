<?php

namespace App\Http\Requests\Authentication;

use App\Http\Requests\AppRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class registerRequest extends AppRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'mobile' => ['required', 'bail', 'unique:users,mobile', 'regex:' . REGEX_MOBILE],
            'name' => ['required', 'string']
        ];
    }

    public function messages()
    {
        return [
            'mobile.required' => 'شماره همراه الزامی است',
            'mobile.regex' => 'فرمت شماره همراه اشتباه است',
            'name.required' => 'نام الزامی است',
        ];
    }

}
