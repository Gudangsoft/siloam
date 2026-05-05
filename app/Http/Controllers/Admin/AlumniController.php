<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Alumni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AlumniController extends Controller
{
    public function index()
    {
        $alumni = Alumni::orderByDesc('graduation_year')->paginate(20);
        return view('admin.alumni.index', compact('alumni'));
    }

    public function create()
    {
        return view('admin.alumni.form');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'             => 'required|string|max:255',
            'nim'              => 'nullable|string|max:20',
            'study_program'    => 'required|string|max:255',
            'graduation_year'  => 'required|string|max:4',
            'current_position' => 'nullable|string|max:255',
            'current_company'  => 'nullable|string|max:255',
            'email'            => 'nullable|email|max:100',
            'phone'            => 'nullable|string|max:20',
            'testimonial'      => 'nullable|string',
            'photo'            => 'nullable|image|max:2048',
            'is_featured'      => 'nullable|boolean',
            'is_published'     => 'nullable|boolean',
        ]);

        $validated['is_featured']  = $request->boolean('is_featured');
        $validated['is_published'] = $request->boolean('is_published');

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('alumni', 'public');
        }

        Alumni::create($validated);
        return redirect()->route('admin.alumni.index')->with('success', 'Data alumni berhasil ditambahkan!');
    }

    public function edit(Alumni $alumni)
    {
        return view('admin.alumni.form', compact('alumni'));
    }

    public function update(Request $request, Alumni $alumni)
    {
        $validated = $request->validate([
            'name'             => 'required|string|max:255',
            'study_program'    => 'required|string|max:255',
            'graduation_year'  => 'required|string|max:4',
            'photo'            => 'nullable|image|max:2048',
            'is_featured'      => 'nullable|boolean',
            'is_published'     => 'nullable|boolean',
        ]);

        $validated['is_featured']  = $request->boolean('is_featured');
        $validated['is_published'] = $request->boolean('is_published');

        if ($request->hasFile('photo')) {
            if ($alumni->photo) Storage::disk('public')->delete($alumni->photo);
            $validated['photo'] = $request->file('photo')->store('alumni', 'public');
        }

        $alumni->update($validated + $request->only(['nim','current_position','current_company','email','phone','testimonial']));
        return redirect()->route('admin.alumni.index')->with('success', 'Data alumni berhasil diperbarui!');
    }

    public function destroy(Alumni $alumni)
    {
        if ($alumni->photo) Storage::disk('public')->delete($alumni->photo);
        $alumni->delete();
        return redirect()->route('admin.alumni.index')->with('success', 'Data alumni berhasil dihapus!');
    }
}
