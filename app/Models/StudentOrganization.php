<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentOrganization extends Model
{
    protected $fillable = [
        'name', 'abbreviation', 'type', 'description',
        'logo', 'chairman', 'advisor', 'email', 'is_active',
    ];

    protected $casts = ['is_active' => 'boolean'];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
