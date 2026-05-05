<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Menu extends Model
{
    protected $fillable = [
        'title', 'url', 'icon', 'parent_id',
        'order', 'is_active', 'target', 'location',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /** Relasi: sub-menu (children) */
    public function children(): HasMany
    {
        return $this->hasMany(Menu::class, 'parent_id')
                    ->where('is_active', true)
                    ->orderBy('order');
    }

    /** Relasi: induk menu */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(Menu::class, 'parent_id');
    }

    /** Semua children (termasuk non-aktif, untuk admin) */
    public function childrenAll(): HasMany
    {
        return $this->hasMany(Menu::class, 'parent_id')->orderBy('order');
    }

    /** Scope: hanya menu induk (top-level) */
    public function scopeTopLevel($query)
    {
        return $query->whereNull('parent_id');
    }

    /** Scope: aktif */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /** Scope: berdasarkan lokasi */
    public function scopeLocation($query, string $location)
    {
        return $query->where('location', $location);
    }
}
