<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Staff extends Model
{
    protected $table = 'staff';

    protected $fillable = [
        'name', 'position', 'category',
        'nidn', 'nuptk',
        'birth_place', 'birth_date', 'church',
        'email', 'phone',
        'photo', 'bio',
        'education', 'expertise', 'courses',
        'social_media', 'order', 'is_active',
    ];

    protected $casts = [
        'is_active'  => 'boolean',
        'birth_date' => 'date',
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
