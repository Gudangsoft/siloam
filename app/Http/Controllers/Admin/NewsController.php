<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::latest()->paginate(15);
        return view('admin.news.index', compact('news'));
    }

    public function create()
    {
        return view('admin.news.form');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'        => 'required|string|max:255',
            'category'     => 'required|in:berita,artikel,pengumuman',
            'content'      => 'required',
            'excerpt'      => 'nullable|string',
            'author'       => 'nullable|string|max:100',
            'image'        => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:2048',
            'is_featured'  => 'nullable|boolean',
            'is_published' => 'nullable|boolean',
            'published_at' => 'nullable|date',
        ]);

        $validated['slug'] = Str::slug($validated['title']);
        $validated['is_featured']  = $request->boolean('is_featured');
        $validated['is_published'] = $request->boolean('is_published');

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('news', 'public');
        }

        News::create($validated);

        return redirect()->route('admin.news.index')->with('success', 'Berita berhasil ditambahkan!');
    }

    public function edit(News $news)
    {
        return view('admin.news.form', compact('news'));
    }

    public function update(Request $request, News $news)
    {
        $validated = $request->validate([
            'title'        => 'required|string|max:255',
            'category'     => 'required|in:berita,artikel,pengumuman',
            'content'      => 'required',
            'excerpt'      => 'nullable|string',
            'author'       => 'nullable|string|max:100',
            'image'        => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:2048',
            'is_featured'  => 'nullable|boolean',
            'is_published' => 'nullable|boolean',
            'published_at' => 'nullable|date',
        ]);

        $validated['is_featured']  = $request->boolean('is_featured');
        $validated['is_published'] = $request->boolean('is_published');

        if ($request->hasFile('image')) {
            if ($news->image) Storage::disk('public')->delete($news->image);
            $validated['image'] = $request->file('image')->store('news', 'public');
        }

        $news->update($validated);

        return redirect()->route('admin.news.index')->with('success', 'Berita berhasil diperbarui!');
    }

    public function destroy(News $news)
    {
        if ($news->image) Storage::disk('public')->delete($news->image);
        $news->delete();
        return redirect()->route('admin.news.index')->with('success', 'Berita berhasil dihapus!');
    }
}
