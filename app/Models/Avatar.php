<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Avatar extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'extension',
        'path',
        'width',
        'height',
        'user_id',
    ];

    protected $casts = [
        'created_at',
        'updated_at'
    ];

    protected $hidden = [
        'id',
        'name',
        'extension',
        'path',
        'user_id',
        'full_name',
        'full_path',
        'updated_at'
    ];

    protected $appends = [
        'full_name',
        'full_path',
        'url'
    ];

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

    public function getCreatedAtAttribute($date): string
    {
        return Carbon::make($date)->format(GENERAL_DATE_TIME_FORMAT);
    }

}