<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class AuthenticationCode extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_authentication_code';

    protected $fillable = [
        'id_user',
        'code',
        'expired',
    ];

    public function scopeNotExpired(Builder $query): void
    {
        $query->where('expired', false);
    }

    public function scopeGetUserLastActiveCode(Builder $query)
    {
        $query->where('created_at', '>', now()->subSecond(AUTH_CODE_EXPIRE_TIME));
        $query->notExpired();
    }

    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id_user', 'id_user');
    }

}
