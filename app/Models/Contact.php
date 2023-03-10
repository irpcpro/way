<?php

namespace App\Models;

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

    public function contact_contacts(): hasMany
    {
        return $this->hasMany(Contact::class, 'id_user', 'contact_user_id');
    }

    public function user_contact(): HasOne
    {
        return $this->hasOne(User::class, 'id_user', 'contact_user_id');
    }

}
