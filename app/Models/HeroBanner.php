<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class HeroBanner extends Model
{
    protected $fillable = [
        'title', 'subtitle', 'description', 'image',
        'button_text', 'button_link', 'button_text_2', 'button_link_2',
        'order', 'is_active', 'show_text',
    ];

    protected $casts = ['is_active' => 'boolean', 'show_text' => 'boolean'];

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('order');
    }

    public function getImageUrlAttribute(): string
    {
        return $this->image ? Storage::disk('public')->url($this->image) : '';
    }
}
