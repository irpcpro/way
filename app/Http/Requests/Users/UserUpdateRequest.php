<?php

namespace App\Http\Requests\Users;

use App\Enums\GenderEnum;
use App\Http\Requests\AppRequest;
use Illuminate\Validation\Rules\Enum;

class UserUpdateRequest extends AppRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $current_user_id = auth()->user()->id;
        return [
            'name' => '',
            'gender' => [new Enum(GenderEnum::class)],
            'username' => ['nullable', 'bail', 'unique:users,username,' . $current_user_id, 'max:' . USERNAME_LENGTH, 'regex:' . REGEX_USERNAME]
        ];
    }

    public function messages()
    {
        return [
            'gender' => 'value of gender in incorrect.',
            'username.max' => 'username length should not be more than '.USERNAME_LENGTH.' characters.',
            'username.regex' => 'the character of username should be just letter or specific characters.',
            'username.unique' => 'this username was taken.',
        ];
    }

}
