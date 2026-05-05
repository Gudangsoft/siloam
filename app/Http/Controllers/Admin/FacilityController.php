<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Facility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FacilityController extends Controller
{
    public function index()
    {
        $facilities = Facility::orderBy('order')->paginate(20);
        return view('admin.facilities.index', compact('facilities'));
    }

    public function create()
    {
        return view('admin.facilities.form');
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|string|max:255', 'image' => 'nullable|image|max:2048']);

        $data = $request->except('image', '_token');
        $data['is_published'] = $request->boolean('is_published');

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('facilities', 'public');
        }

        Facility::create($data);
        return redirect()->route('admin.facilities.index')->with('success', 'Fasilitas berhasil ditambahkan!');
    }

    public function edit(Facility $facility)
    {
        return view('admin.facilities.form', compact('facility'));
    }

    public function update(Request $request, Facility $facility)
    {
        $request->validate(['name' => 'required|string|max:255', 'image' => 'nullable|image|max:2048']);

        $data = $request->except('image', '_token', '_method');
        $data['is_published'] = $request->boolean('is_published');

        if ($request->hasFile('image')) {
            if ($facility->image) Storage::disk('public')->delete($facility->image);
            $data['image'] = $request->file('image')->store('facilities', 'public');
        }

        $facility->update($data);
        return redirect()->route('admin.facilities.index')->with('success', 'Fasilitas berhasil diperbarui!');
    }

    public function destroy(Facility $facility)
    {
        if ($facility->image) Storage::disk('public')->delete($facility->image);
        $facility->delete();
        return redirect()->route('admin.facilities.index')->with('success', 'Fasilitas berhasil dihapus!');
    }
}
