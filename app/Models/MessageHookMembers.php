<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class MessageHookMembers extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_message_hook_member';

    protected $fillable = [
        'id_message_hook',
        'id_user',
    ];

    public function message_hook(): HasOne
    {
        return $this->hasOne(MessageHook::class, 'id_message_hook', 'id_message_hook');
    }

}
