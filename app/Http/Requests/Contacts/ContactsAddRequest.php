<?php

namespace App\Http\Requests\Contacts;

use App\Http\Requests\AppRequest;
use App\Rules\MobileRule;
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
            'id_user' => ['required', 'exists:users,id_user'],
            "mobile" => ['nullable', "exists:users,mobile", new MobileRule],
            'name' => ['nullable', new NameRule],
        ];
    }

    public function messages()
    {
        return [
            'id_user.required' => 'user id should be entered.',
            'id_user.exists' => "user id doesn't exists.",
            'mobile.exists' => 'mobile number not exists.',
        ];
    }

}
