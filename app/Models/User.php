<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Enums\GenderEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;

    protected $primaryKey = 'id_user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'mobile',
        'name',
        'username',
        'password',
        'gender',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'mobile',
        'remember_token',
        'created_at',
        'updated_at',
        'password',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'gender' => GenderEnum::class,
    ];

    public function getNameAttribute()
    {
        $name = $this->attributes['name'];
        return $name != null ? $name : USERNAME_ANONYMOUS;
    }

    public function authenticationCodes(): HasMany
    {
        return $this->hasMany(AuthenticationCode::class, 'id_user', 'id_user');
    }

    public function avatar(): HasOne
    {
        return $this->hasOne(Avatar::class, 'id_user', 'id_user')->latest();
    }

    public function avatars(): HasMany
    {
        return $this->hasMany(Avatar::class, 'id_user', 'id_user')->orderBy('created_at', 'desc');
    }

    public function contacts(): hasMany
    {
        return $this->hasMany(Contact::class, 'id_user', 'id_user');
    }

    public function message_hook_member(): HasMany
    {
        return $this->hasMany(MessageHookMembers::class, 'id_user', 'id_user');
    }

}
