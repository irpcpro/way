<?php

namespace App\Http\Requests;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class AppRequest extends FormRequest
{

    public string $error_message = 'Error in input values.';
    public int $error_code = 422;

    public string $error_message_authorization = 'error in request authorization.some validation on inputs are prevented to execute of request.';
    public int $error_code_authorization = 403;

    protected function failedValidation(Validator $validator)
    {
        $response = APIResponse($this->error_message, $this->error_code);
        if(!empty($validator->errors())){
            $response = $response->setExtra([
                'errors' => $validator->errors()
            ]);
        }
        throw new HttpResponseException(
            $response->send()
        );
    }

    protected function failedAuthorization()
    {
        throw new AuthorizationException($this->error_message_authorization, $this->error_code_authorization);
    }

}
