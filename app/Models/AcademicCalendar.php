<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AcademicCalendar extends Model
{
    protected $fillable = [
        'title', 'description', 'start_date', 'end_date',
        'semester', 'academic_year', 'color', 'is_published',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public function scopePublished($query)
    {
        return $query->where('is_published', true)->orderBy('start_date');
    }
}
