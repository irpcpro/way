<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Message extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_message';

    protected $fillable = [
        'id_user',
        'id_message_hook',
        'type',
        'context',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function getCreatedAtAttribute($date)
    {
        return Carbon::parse($date)->format(MODELS_CREATED_AT_FORMAT);
    }

    public function getUpdatedAtAttribute($date)
    {
        return Carbon::parse($date)->format(MODELS_CREATED_AT_FORMAT);
    }

    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id_user', 'id_user');
    }

    public function seen(): HasMany
    {
        return $this->hasMany(MessageSeen::class, 'id_message', 'id_message');
    }

    public function message_hook(): HasOne
    {
        return $this->hasOne(MessageHook::class, 'id_message_hook', 'id_message_hook');
    }

}
