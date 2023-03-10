<?php

namespace App\Http\Requests\Contacts;

use App\Http\Requests\AppRequest;
use App\Rules\MobileRule;
use App\Rules\NameRule;

class ContactUpdateRequest extends AppRequest
{

    public string $error_message_authorization = 'this contact id is not for current user.';

    public function authorize(): bool
    {
        $current_id_user = auth()->user()->id_user;
        $contact_id_user = $this->route('contact')->id_user;
        return ($current_id_user == $contact_id_user);
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'id_contact' => $this->route('contact')->id_contact
        ]);
    }

    public function rules(): array
    {
        return [
            'id_contact' => ['required', 'bail', 'exists:contacts,id_contact'],
            'name' => ['required', new NameRule],
            "mobile" => ['nullable', "exists:users,mobile", new MobileRule],
        ];
    }

    public function messages()
    {
        return [
            'id_contact.required' => 'contact id is required.',
            'id_contact.exists' => 'contact id not exists.',
        ];
    }

}
