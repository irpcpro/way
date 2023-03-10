<?php

namespace App\Http\Requests\UsersInfo;

use App\Enums\GenderEnum;
use App\Http\Requests\AppRequest;
use App\Rules\NameRule;
use App\Rules\UsernameRule;
use Illuminate\Validation\Rules\Enum;

class UserInfoUpdateRequest extends AppRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $current_user_id = auth()->user()->id;
        return [
            'name' => ['nullable', new NameRule],
            'gender' => [new Enum(GenderEnum::class)],
//            'username' => ['nullable', 'bail', 'unique:users,username,' . $current_user_id, 'max:' . USERNAME_LENGTH, 'regex:' . REGEX_USERNAME]
//            'username' => 'username|unique:users,username,' . $current_user_id
            'username' => ['unique:users,username,' . $current_user_id, new UsernameRule]
        ];
    }

    public function messages()
    {
        return [
            'gender' => 'value of gender in incorrect.',
            'username.unique' => 'this username was taken.',
        ];
    }

}
