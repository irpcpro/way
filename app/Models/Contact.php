<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Contact extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_contact';

    protected $fillable = [
        'id_user',
        'contact_user_id',
        'contact_user_name',
        'contact_user_mobile',
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

    public function contact_contacts(): hasMany
    {
        return $this->hasMany(Contact::class, 'id_user', 'contact_user_id');
    }

    public function user_contact(): HasOne
    {
        return $this->hasOne(User::class, 'id_user', 'contact_user_id');
    }

}
