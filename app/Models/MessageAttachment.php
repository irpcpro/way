<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MessageAttachment extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_message_attachment';

    protected $fillable = [
        'type',
        'name',
        'extension',
        'path',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    protected $appends = [
        'full_name',
        'full_path',
        'url'
    ];

    public function getCreatedAtAttribute($date)
    {
        return Carbon::parse($date)->format(MODELS_CREATED_AT_FORMAT);
    }

    public function getUpdatedAtAttribute($date)
    {
        return Carbon::parse($date)->format(MODELS_CREATED_AT_FORMAT);
    }

    public function getFullNameAttribute(): string
    {
        return $this->name . '.' . $this->extension;
    }

    public function getFullPathAttribute(): string
    {
        return $this->path . $this->full_name;
    }

    public function geturlAttribute(): string
    {
        return asset($this->full_path);
    }

}
