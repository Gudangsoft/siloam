<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function index()
    {
        $gallery = Gallery::latest()->paginate(20);
        return view('admin.gallery.index', compact('gallery'));
    }

    public function create()
    {
        return view('admin.gallery.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'    => 'required|string|max:255',
            'image'    => 'required|image|max:4096',
            'category' => 'nullable|string|max:100',
        ]);

        $path = $request->file('image')->store('gallery', 'public');

        Gallery::create([
            'title'        => $request->title,
            'description'  => $request->description,
            'image'        => $path,
            'category'     => $request->category ?? 'umum',
            'order'        => $request->order ?? 0,
            'is_published' => $request->boolean('is_published'),
        ]);

        return redirect()->route('admin.gallery.index')->with('success', 'Foto berhasil ditambahkan!');
    }

    public function edit(Gallery $gallery)
    {
        return view('admin.gallery.form', compact('gallery'));
    }

    public function update(Request $request, Gallery $gallery)
    {
        $request->validate([
            'title'    => 'required|string|max:255',
            'image'    => 'nullable|image|max:4096',
            'category' => 'nullable|string|max:100',
        ]);

        $data = [
            'title'        => $request->title,
            'description'  => $request->description,
            'category'     => $request->category ?? 'umum',
            'order'        => $request->order ?? 0,
            'is_published' => $request->boolean('is_published'),
        ];

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($gallery->image);
            $data['image'] = $request->file('image')->store('gallery', 'public');
        }

        $gallery->update($data);
        return redirect()->route('admin.gallery.index')->with('success', 'Foto berhasil diperbarui!');
    }

    public function destroy(Gallery $gallery)
    {
        Storage::disk('public')->delete($gallery->image);
        $gallery->delete();
        return redirect()->route('admin.gallery.index')->with('success', 'Foto berhasil dihapus!');
    }
}
