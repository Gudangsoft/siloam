<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function index(Request $request)
    {
        $category = $request->query('category', '');
        $q        = $request->query('q', '');

        $query = Gallery::latest();

        if ($category && $category !== 'semua') {
            $query->where('category', $category);
        }
        if ($q) {
            $query->where('title', 'like', "%{$q}%");
        }

        $gallery    = $query->paginate(24)->withQueryString();
        $categories = Gallery::select('category')->distinct()->pluck('category')->filter()->sort()->values();
        $stats = [
            'total'     => Gallery::count(),
            'published' => Gallery::where('is_published', true)->count(),
            'draft'     => Gallery::where('is_published', false)->count(),
        ];

        return view('admin.gallery.index', compact('gallery', 'categories', 'stats', 'category', 'q'));
    }

    public function create()
    {
        $categories = Gallery::select('category')->distinct()->pluck('category')->filter()->sort()->values();
        return view('admin.gallery.form', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'    => 'required|string|max:255',
            'image'    => 'required|image|mimes:jpg,jpeg,png,webp|max:5120',
            'category' => 'nullable|string|max:100',
        ]);

        $path = $request->file('image')->store('gallery', 'public');

        Gallery::create([
            'title'        => $request->title,
            'description'  => $request->description,
            'image'        => $path,
            'category'     => $request->category ?: 'umum',
            'order'        => $request->input('order', 0),
            'is_published' => $request->boolean('is_published', true),
        ]);

        return redirect()->route('admin.gallery.index')
                         ->with('success', 'Foto berhasil ditambahkan!');
    }

    public function edit(Gallery $gallery)
    {
        $categories = Gallery::select('category')->distinct()->pluck('category')->filter()->sort()->values();
        return view('admin.gallery.form', compact('gallery', 'categories'));
    }

    public function update(Request $request, Gallery $gallery)
    {
        $request->validate([
            'title'    => 'required|string|max:255',
            'image'    => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'category' => 'nullable|string|max:100',
        ]);

        $data = [
            'title'        => $request->title,
            'description'  => $request->description,
            'category'     => $request->category ?: 'umum',
            'order'        => $request->input('order', 0),
            'is_published' => $request->boolean('is_published'),
        ];

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($gallery->image);
            $data['image'] = $request->file('image')->store('gallery', 'public');
        }

        $gallery->update($data);

        return redirect()->route('admin.gallery.index')
                         ->with('success', 'Foto berhasil diperbarui!');
    }

    public function destroy(Gallery $gallery)
    {
        Storage::disk('public')->delete($gallery->image);
        $gallery->delete();

        return redirect()->route('admin.gallery.index')
                         ->with('success', 'Foto berhasil dihapus!');
    }

    /** AJAX: toggle published */
    public function toggle(Gallery $gallery)
    {
        $gallery->update(['is_published' => !$gallery->is_published]);
        return response()->json(['is_published' => $gallery->is_published]);
    }

    /** AJAX: upload multiple files at once */
    public function bulkStore(Request $request)
    {
        $request->validate([
            'images'    => 'required|array|max:20',
            'images.*'  => 'image|mimes:jpg,jpeg,png,webp|max:5120',
            'category'  => 'nullable|string|max:100',
        ]);

        $category = $request->input('category', 'umum');
        $created  = [];

        foreach ($request->file('images') as $file) {
            $path = $file->store('gallery', 'public');
            $title = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $title = str_replace(['-', '_'], ' ', $title);

            $item = Gallery::create([
                'title'        => ucwords($title),
                'image'        => $path,
                'category'     => $category,
                'order'        => 0,
                'is_published' => true,
            ]);

            $created[] = [
                'id'    => $item->id,
                'title' => $item->title,
                'url'   => $item->image_url,
            ];
        }

        return response()->json(['success' => true, 'count' => count($created), 'items' => $created]);
    }
}
