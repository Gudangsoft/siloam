<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Model
{
    use SoftDeletes;

    protected $fillable = ['slug', 'title', 'content', 'meta_title', 'meta_description'];

    public static function findBySlug(string $slug): ?self
    {
        return static::where('slug', $slug)->first();
    }

    public static function findOrCreateBySlug(string $slug, string $title = ''): self
    {
        $page = static::withTrashed()->where('slug', $slug)->first();
        if (!$page) {
            return static::create([
                'slug'    => $slug,
                'title'   => $title ?: ucwords(str_replace('-', ' ', $slug)),
                'content' => '',
            ]);
        }
        if ($page->trashed()) {
            $page->restore();
        }
        return $page;
    }
}
