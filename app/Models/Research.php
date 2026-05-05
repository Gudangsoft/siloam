<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Research extends Model
{
    protected $table = 'research';

    protected $fillable = [
        'title', 'slug', 'type', 'abstract', 'researcher',
        'year', 'funding_source', 'document', 'link', 'is_published',
    ];

    protected $casts = ['is_published' => 'boolean'];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (!$model->slug) {
                $model->slug = Str::slug($model->title);
            }
        });
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    public function scopeByType($query, string $type)
    {
        return $query->where('type', $type);
    }
}
