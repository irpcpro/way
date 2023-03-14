<?php

namespace App\Models;

use App\Enums\MessageHookTypeEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MessageHook extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_message_hook';

    protected $casts = [
        'type' => MessageHookTypeEnum::class,
    ];

    protected $fillable = [
        'type'
    ];

    public function message_hook_members(): HasMany
    {
        return $this->hasMany(MessageHookMembers::class, 'id_message_hook', 'id_message_hook');
    }

}
