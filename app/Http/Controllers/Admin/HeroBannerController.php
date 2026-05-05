<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HeroBanner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HeroBannerController extends Controller
{
    public function index()
    {
        $banners = HeroBanner::orderBy('order')->get();
        return view('admin.hero-banners.index', compact('banners'));
    }

    public function create()
    {
        return view('admin.hero-banners.form');
    }

    public function store(Request $request)
    {
        $showText = $request->input('show_text', '1') !== '0';
        $request->validate([
            'title'         => $showText ? 'required|string|max:255' : 'nullable|string|max:255',
            'subtitle'      => 'nullable|string|max:255',
            'description'   => 'nullable|string',
            'button_text'   => 'nullable|string|max:100',
            'button_link'   => 'nullable|string|max:255',
            'button_text_2' => 'nullable|string|max:100',
            'button_link_2' => 'nullable|string|max:255',
            'image'         => 'nullable|image|max:4096',
            'order'         => 'nullable|integer',
            'is_active'     => 'nullable|boolean',
            'show_text'     => 'nullable',
        ]);

        $data = $request->except('image', '_token');
        $data['is_active'] = $request->boolean('is_active');
        $data['show_text'] = $showText;

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('banners', 'public');
        }

        HeroBanner::create($data);
        return redirect()->route('admin.hero-banners.index')->with('success', 'Banner berhasil ditambahkan!');
    }

    public function edit(HeroBanner $heroBanner)
    {
        return view('admin.hero-banners.form', ['banner' => $heroBanner]);
    }

    public function update(Request $request, HeroBanner $heroBanner)
    {
        $showText = $request->input('show_text', '1') !== '0';
        $request->validate([
            'title'         => $showText ? 'required|string|max:255' : 'nullable|string|max:255',
            'subtitle'      => 'nullable|string|max:255',
            'description'   => 'nullable|string',
            'button_text'   => 'nullable|string|max:100',
            'button_link'   => 'nullable|string|max:255',
            'button_text_2' => 'nullable|string|max:100',
            'button_link_2' => 'nullable|string|max:255',
            'image'         => 'nullable|image|max:4096',
            'order'         => 'nullable|integer',
            'is_active'     => 'nullable|boolean',
            'show_text'     => 'nullable',
        ]);

        $data = $request->except('image', '_token', '_method');
        $data['is_active'] = $request->boolean('is_active');
        $data['show_text'] = $showText;

        if ($request->hasFile('image')) {
            if ($heroBanner->image) Storage::disk('public')->delete($heroBanner->image);
            $data['image'] = $request->file('image')->store('banners', 'public');
        }

        $heroBanner->update($data);
        return redirect()->route('admin.hero-banners.index')->with('success', 'Banner berhasil diperbarui!');
    }

    public function destroy(HeroBanner $heroBanner)
    {
        if ($heroBanner->image) Storage::disk('public')->delete($heroBanner->image);
        $heroBanner->delete();
        return redirect()->route('admin.hero-banners.index')->with('success', 'Banner berhasil dihapus!');
    }
}
