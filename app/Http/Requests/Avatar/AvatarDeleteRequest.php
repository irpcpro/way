<?php

namespace App\Http\Requests\Avatar;

use App\Http\Requests\AppRequest;

class AvatarDeleteRequest extends AppRequest
{

    public string $error_message_authorization = 'this avatar id is not for current user.';

    public function authorize(): bool
    {
        $current_id_user = auth()->user()->id_user;
        $avatar_id_user = $this->route('avatar')->id_user;
        return ($current_id_user == $avatar_id_user);
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'id_avatar' => $this->route('avatar')->id_avatar
        ]);
    }

    public function rules(): array
    {
        return [
            'id_avatar' => ['required', 'bail', 'exists:avatars,id_avatar'],
        ];
    }

    public function messages()
    {
        return [
            'id_avatar.required' => 'avatar id is required.',
            'id_avatar.exists' => 'avatar id not exists.',
        ];
    }

}
