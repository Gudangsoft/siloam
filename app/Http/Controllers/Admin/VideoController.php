<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function index()
    {
        $videos = Video::latest()->paginate(15);
        return view('admin.videos.index', compact('videos'));
    }

    public function create()
    {
        return view('admin.videos.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'youtube_url' => 'required|url',
            'category'    => 'nullable|string|max:100',
            'description' => 'nullable|string',
            'is_featured' => 'nullable|boolean',
            'is_published'=> 'nullable|boolean',
        ]);

        Video::create([
            'title'       => $request->title,
            'youtube_url' => $request->youtube_url,
            'category'    => $request->category ?? 'umum',
            'description' => $request->description,
            'is_featured' => $request->boolean('is_featured'),
            'is_published'=> $request->boolean('is_published'),
        ]);

        return redirect()->route('admin.videos.index')->with('success', 'Video berhasil ditambahkan!');
    }

    public function edit(Video $video)
    {
        return view('admin.videos.form', compact('video'));
    }

    public function update(Request $request, Video $video)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'youtube_url' => 'required|url',
        ]);

        $video->update([
            'title'       => $request->title,
            'youtube_url' => $request->youtube_url,
            'category'    => $request->category ?? 'umum',
            'description' => $request->description,
            'is_featured' => $request->boolean('is_featured'),
            'is_published'=> $request->boolean('is_published'),
        ]);

        return redirect()->route('admin.videos.index')->with('success', 'Video berhasil diperbarui!');
    }

    public function destroy(Video $video)
    {
        $video->delete();
        return redirect()->route('admin.videos.index')->with('success', 'Video berhasil dihapus!');
    }
}
