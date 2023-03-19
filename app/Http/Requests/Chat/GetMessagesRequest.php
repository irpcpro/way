<?php

namespace App\Http\Requests\Chat;

use App\Http\Requests\AppRequest;
use App\Models\Message;
use App\Models\MessageHook;

class GetMessagesRequest extends AppRequest
{

    public string $error_message_authorization = 'error in input validations.';

    public function authorize(): bool
    {
        // get variables
        $current_user = auth()->user();
        $offset = $this->offset;
        $id_message_hook = $this->route('message_hook')->id_message_hook;

        // check id_message_hook is for current_user
        $get_message_hook = $current_user->message_hook_member()->whereHas('message_hook', function($query) use($id_message_hook){
            $query->where('id_message_hook', $id_message_hook);
        });
        if($get_message_hook->exists() === false){
            $this->error_message_authorization = 'this id_message_hook is not for current user.';
            return false;
        }

        // check for offset is related to message_hook
        if(isset($offset) && $offset !== null){
            $offset_exists_in_msg_hook = Message::query()->where([
                ['id_message', '=', $offset],
                ['id_message_hook', '=', $id_message_hook]
            ]);
            if($offset_exists_in_msg_hook->exists() === false){
                $this->error_message_authorization = 'this offset is not for this message_hook.';
                return false;
            }
        }

        return true;
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'id_message_hook' => $this->route('message_hook')->id_message_hook,
            'offset' => $this->route('offset')
        ]);
    }

    public function rules(): array
    {
        return [
            'id_message_hook' => ['required', 'exists:message_hooks,id_message_hook', 'bail'],
            'offset' => ['nullable', 'exists:messages,id_message'],
        ];
    }

    public function messages()
    {
        return [
            'id_message_hook.required' => 'id_message_hook is required.',
            'id_message_hook.exists' => 'id_message_hook not exists.',
            'offset.exists' => 'offset not exists.',
        ];
    }

}
