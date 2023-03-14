<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

}
