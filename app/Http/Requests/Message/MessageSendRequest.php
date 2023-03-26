<?php

namespace App\Http\Requests\Message;

use App\Http\Requests\AppRequest;
use function auth;
use const CHAT_MESSAGE_CHARACTER_LIMIT;

class MessageSendRequest extends AppRequest
{

    public string $error_message_authorization = 'id_user or id_message_hook is required.';

    public function authorize(): bool
    {
        $current_user = auth()->user();
        $id_user = $this->id_user;
        $id_message_hook = $this->id_message_hook;

        // check id_user is not current_user->id
        if($id_user == $current_user->id_user){
            $this->error_message_authorization = "user can't send message to himself.";
            return false;
        }

        // check if id_message_hook is for current_user
        if(isset($id_message_hook) && $id_message_hook != null){
            $get_message_hook = $current_user->message_hook_member()->whereHas('message_hook', function($query) use($id_message_hook){
                $query->where('id_message_hook', $id_message_hook);
            });
            if($get_message_hook->exists() === false){
                $this->error_message_authorization = 'this id_message_hook is not for current user.';
                return false;
            }else{
                return true;
            }
        }

        // if id_user has entered, check to current_user doesn't have message_hook with him
        if(isset($id_user) && $id_user != null){
            $search_hook = $current_user->message_hook_member()->whereHas('message_hook', function($query) use ($id_user){
                $query->whereHas('message_hook_members', function($q1) use ($id_user){
                    $q1->where('id_user', $id_user);
                });
            });
            if($search_hook->exists() === true){
                $this->error_message_authorization = 'this id_user has message_hook with you and you have to send message with message_hook_id.';
                return false;
            }else{
                return true;
            }
        }

        return false;
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'context' => htmlspecialchars($this->context)
        ]);
    }

    public function rules(): array
    {
        return [
            'id_user' => ['nullable', 'required_without:id_message_hook', 'exists:users,id_user', 'bail'],
            'id_message_hook' => ['nullable', 'required_without:id_user', 'exists:message_hooks,id_message_hook'],
            'context' => ['required', 'string', 'max:' . CHAT_MESSAGE_CHARACTER_LIMIT]
        ];
    }

    public function messages()
    {
        return [
            'id_user.required' => 'user id is required.',
            'id_user.exists' => 'user id not exists.',
            'id_message_hook.required' => 'message_hook id is required.',
            'id_message_hook.exists' => 'message_hook id not exists.',
            'context.required' => 'context is required.',
            'context.max' => "context shouldn't be more than " . CHAT_MESSAGE_CHARACTER_LIMIT . " character",
        ];
    }

}
