<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Attachment extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_attachment';

    protected $fillable = [
        'id_user',
        'type',
        'name',
        'extension',
        'size_b',
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

    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id_user', 'id_user');
    }

    public function messages(): BelongsToMany
    {
        return $this->belongsToMany(Message::class, 'attachment_message', 'id_attachment', 'id_message');
    }

}
