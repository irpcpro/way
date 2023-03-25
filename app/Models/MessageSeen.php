<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class MessageSeen extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_message_seen';

    protected $fillable = [
        'id_message',
        'id_user'
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

    public function message(): HasOne
    {
        return $this->hasOne(User::class, 'id_message', 'id_message');
    }

}
