<?php

namespace App\Models;

use App\Enums\MessageHookTypeEnum;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MessageHook extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_message_hook';

    protected $casts = [
        'type' => MessageHookTypeEnum::class,
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    protected $fillable = [
        'type'
    ];

    public function getCreatedAtAttribute($date)
    {
        return Carbon::parse($date)->format(MODELS_CREATED_AT_FORMAT);
    }

    public function getUpdatedAtAttribute($date)
    {
        return Carbon::parse($date)->format(MODELS_CREATED_AT_FORMAT);
    }

    public function message_hook_members(): HasMany
    {
        return $this->hasMany(MessageHookMembers::class, 'id_message_hook', 'id_message_hook');
    }

    public function messages(): HasMany
    {
        return $this->hasMany(Message::class, 'id_message_hook', 'id_message_hook');
    }

}
