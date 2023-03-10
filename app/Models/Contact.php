<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'contact_user_id',
        'contact_user_name',
        'contact_user_mobile',
    ];

    public function contact_contacts(): hasMany
    {
        return $this->hasMany(Contact::class, 'user_id', 'contact_user_id');
    }

}
