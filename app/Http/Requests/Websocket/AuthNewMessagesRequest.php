<?php

namespace App\Http\Requests\Websocket;

use App\Http\Requests\AppRequest;

class AuthNewMessagesRequest extends AppRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'socket_id' => ['required'],
            'channel_names' => ['required','array'],
            'channel_names.*' => ['string']
        ];
    }

    public function messages()
    {
        return [
            'socket_id.required' => 'socket_id in required.',
            'channel_names.required' => 'channel_names in required.',
            'channel_names.array' => 'channel_names should be array of string.',
            'channel_names.*.string' => 'channel_name should be string.',
        ];
    }

}
