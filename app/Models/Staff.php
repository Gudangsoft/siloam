<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Staff extends Model
{
    protected $table = 'staff';

    protected $fillable = [
        'name', 'position', 'category', 'nidn', 'email', 'phone',
        'photo', 'bio', 'education', 'expertise', 'social_media', 'order', 'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'social_media' => 'array',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('order');
    }

    public function scopeByCategory($query, string $category)
    {
        return $query->where('category', $category);
    }

    public function getPhotoUrlAttribute(): string
    {
        return $this->photo ? Storage::disk('public')->url($this->photo) : '';
    }
}
