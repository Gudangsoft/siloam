<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Gallery extends Model
{
    protected $table = 'gallery';

    protected $fillable = ['title', 'description', 'image', 'category', 'order', 'is_published'];

    protected $casts = ['is_published' => 'boolean'];

    public function scopePublished($query)
    {
        return $query->where('is_published', true)->orderBy('order');
    }

    public function getImageUrlAttribute(): string
    {
        return $this->image ? Storage::disk('public')->url($this->image) : '';
    }
}
