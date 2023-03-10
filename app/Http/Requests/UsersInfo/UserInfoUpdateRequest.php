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
        $current_id_user = auth()->user()->id_user;
        return [
            'name' => ['nullable', new NameRule],
            'gender' => [new Enum(GenderEnum::class)],
            'username' => ['unique:users,username,' . $current_id_user . ',id_user', new UsernameRule]
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
