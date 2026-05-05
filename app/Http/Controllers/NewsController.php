<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        $category = $request->get('kategori', 'semua');
        $search   = $request->get('cari');

        $query = News::published()->latest();

        if ($category !== 'semua') {
            $query->where('category', $category);
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%')
                  ->orWhere('excerpt', 'like', '%' . $search . '%');
            });
        }

        $news     = $query->paginate(12)->appends($request->all());
        $featured = News::published()->where('is_featured', true)->latest()->take(3)->get();

        return view('frontend.news.index', compact('news', 'featured', 'category', 'search'));
    }

    public function show(News $news)
    {
        $news->increment('views');
        $related = News::published()
            ->where('id', '!=', $news->id)
            ->where('category', $news->category)
            ->latest()
            ->take(3)
            ->get();

        return view('frontend.news.show', compact('news', 'related'));
    }
}
