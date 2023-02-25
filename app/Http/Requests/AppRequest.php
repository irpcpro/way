<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class AppRequest extends FormRequest
{

    public string $error_message = 'خطا در مقادیر ورودی';
    public int $error_code = 422;

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

}
