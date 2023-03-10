<?php

namespace App\Http\Controllers\Systems\AuthenticationCode;

use App\Models\AuthenticationCode;
use App\Models\User;

class AuthenticationCodeController
{

    public function __construct(
        public User $user
    )
    {
        //
    }

    private function generateCode(): string
    {
        $code = '';
        for($i = 0; $i < AUTH_CODE_LENGTH; $i++)
            $code .= AUTH_CODE_FAKE ? "1" : rand(0, 9);
        return $code;
    }

    public function getCode(): bool|string
    {
        // generate code
        $code = $this->generateCode();

        // store in authentication code table
        $authenticationCode = AuthenticationCode::create([
            'id_user' => $this->user->id_user,
            'code' => $code,
        ]);

        return (isset($authenticationCode->id_authentication_code) && $authenticationCode->id_authentication_code > 0) ? $code : false;
    }

}
