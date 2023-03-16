<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\DB;

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
        return Carbon::createFromFormat(MODELS_CREATED_AT_DEFAULT_FORMAT, $date)->format(MODELS_CREATED_AT_FORMAT);
    }

    public function getUpdatedAtAttribute($date)
    {
        return Carbon::createFromFormat(MODELS_UPDATED_AT_DEFAULT_FORMAT, $date)->format(MODELS_UPDATED_AT_FORMAT);
    }

    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id_user', 'id_user');
    }

}
