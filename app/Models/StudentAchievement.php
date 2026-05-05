<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class StudentAchievement extends Model
{
    protected $fillable = [
        'title', 'student_name', 'study_program', 'level',
        'award', 'description', 'image', 'year', 'is_published',
    ];

    protected $casts = ['is_published' => 'boolean'];

    public function scopePublished($query)
    {
        return $query->where('is_published', true)->orderByDesc('year');
    }

    public function getImageUrlAttribute(): string
    {
        return $this->image ? Storage::disk('public')->url($this->image) : '';
    }
}
