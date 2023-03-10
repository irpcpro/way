<?php

namespace App\Http\Requests\SearchUser;

use App\Http\Requests\AppRequest;
use App\Rules\MobileRule;
use App\Rules\UsernameRule;

class SearchUserRequest extends AppRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'username' => ['nullable', 'required_without:mobile', new UsernameRule],
            'mobile' => ['nullable', 'required_without:username', new MobileRule],
        ];
    }

    public function messages()
    {
        return [
            'username.required_without' => "username or mobile shouldn't be empty.",
            'mobile.required_without' => "username or mobile shouldn't be empty",
        ];
    }

}
