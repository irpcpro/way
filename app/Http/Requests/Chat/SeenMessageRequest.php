<?php

namespace App\Http\Requests\Chat;

use App\Http\Requests\AppRequest;
use App\Models\Message;

class SeenMessageRequest extends AppRequest
{

    public function authorize(): bool
    {
        $id_messages = $this->id_messages;
        $current_user_id = auth()->user()->id_user;

        $getMessages = Message::query();
        $getMessages = $getMessages->whereIn('id_message', $id_messages);
        $getMessages = $getMessages->whereHas('message_hook', function($query) use ($current_user_id){
            $query->whereHas('message_hook_members', function($query) use ($current_user_id){
                $query->where('id_user', $current_user_id);
            });
        });
        if($getMessages->count() != count($id_messages)){
            $this->error_message_authorization = 'some of id_messages that you entered, is not for current user.';
            return false;
        }

        return true;
    }

    public function rules(): array
    {
        return [
            'id_messages.*' => ['required', 'bail', 'exists:messages,id_message'],
            'id_messages' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'id_messages.required' => 'id_message_hook is required.',
        ];
    }

}
