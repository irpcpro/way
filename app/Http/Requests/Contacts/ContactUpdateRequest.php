<?php

namespace App\Http\Requests\Contacts;

use App\Http\Requests\AppRequest;
use App\Rules\NameRule;

class ContactUpdateRequest extends AppRequest
{

    public string $error_message_authorization = 'this contact id is not for current user.';

    public function authorize(): bool
    {
        $current_user_id = auth()->user()->id;
        $contact = $this->route('contact')->user_id;
        return ($current_user_id == $contact);
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'id' => $this->route('contact')->id
        ]);
    }

    public function rules(): array
    {
        return [
            'id' => ['required', 'bail', 'exists:contacts'],
            'name' => ['required', new NameRule],
        ];
    }

    public function messages()
    {
        return [
            'id.required' => 'contact id is required.',
            'id.exists' => 'contact id not exists.',
        ];
    }

}
