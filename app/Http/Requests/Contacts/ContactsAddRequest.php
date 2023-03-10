<?php

namespace App\Http\Requests\Contacts;

use App\Http\Requests\AppRequest;
use App\Rules\NameRule;

class ContactsAddRequest extends AppRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'user_id' => ['required', 'exists:users,id'],
            "mobile" => ['nullable', "exists:users,mobile"],
            'name' => ['nullable', new NameRule],
        ];
    }

    public function messages()
    {
        return [
            'user_id.required' => 'user id should be entered.',
            'user_id.exists' => "user id doesn't exists.",
            'mobile.exists' => 'mobile number not exists.',
        ];
    }

}
