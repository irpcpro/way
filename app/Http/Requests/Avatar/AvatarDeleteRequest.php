<?php

namespace App\Http\Requests\Avatar;

use App\Http\Requests\AppRequest;
use function auth;

class AvatarDeleteRequest extends AppRequest
{

    public string $error_message_authorization = 'this avatar id is not for current user.';

    public function authorize(): bool
    {
        $current_user_id = auth()->user()->id;
        $avatar_user_id = $this->route('avatar')->user_id;
        return ($current_user_id == $avatar_user_id);
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'id' => $this->route('avatar')->id
        ]);
    }

    public function rules(): array
    {
        return [
            'id' => ['required', 'bail', 'exists:avatars'],
        ];
    }

    public function messages()
    {
        return [
            'id.required' => 'avatar id is required.',
            'id.exists' => 'avatar id not exists.',
        ];
    }

}
