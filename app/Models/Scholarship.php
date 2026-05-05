<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Scholarship extends Model
{
    protected $fillable = [
        'name', 'provider', 'description', 'requirements',
        'amount', 'deadline', 'contact', 'link', 'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'deadline' => 'date',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
