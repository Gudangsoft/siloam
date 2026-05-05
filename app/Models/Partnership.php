<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Partnership extends Model
{
    protected $fillable = [
        'name', 'type', 'category', 'description', 'logo',
        'website', 'mou_date', 'mou_expiry', 'document', 'is_active', 'order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'mou_date' => 'date',
        'mou_expiry' => 'date',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('order');
    }
}
