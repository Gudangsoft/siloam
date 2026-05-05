<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Research;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ResearchController extends Controller
{
    public function index()
    {
        $research = Research::latest()->paginate(15);
        return view('admin.research.index', compact('research'));
    }

    public function create()
    {
        return view('admin.research.form');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'          => 'required|string|max:255',
            'type'           => 'required|in:penelitian,pengabdian,hibah,publikasi,jurnal',
            'abstract'       => 'nullable|string',
            'researcher'     => 'nullable|string|max:255',
            'year'           => 'nullable|string|max:10',
            'funding_source' => 'nullable|string|max:255',
            'link'           => 'nullable|url|max:255',
            'document'       => 'nullable|file|max:5120',
            'is_published'   => 'nullable|boolean',
        ]);

        $validated['slug'] = Str::slug($validated['title'] . '-' . ($validated['year'] ?? date('Y')));
        $validated['is_published'] = $request->boolean('is_published');

        if ($request->hasFile('document')) {
            $validated['document'] = $request->file('document')->store('research', 'public');
        }

        Research::create($validated);
        return redirect()->route('admin.research.index')->with('success', 'Data penelitian berhasil ditambahkan!');
    }

    public function edit(Research $research)
    {
        return view('admin.research.form', compact('research'));
    }

    public function update(Request $request, Research $research)
    {
        $validated = $request->validate([
            'title'          => 'required|string|max:255',
            'type'           => 'required|in:penelitian,pengabdian,hibah,publikasi,jurnal',
            'abstract'       => 'nullable|string',
            'researcher'     => 'nullable|string|max:255',
            'year'           => 'nullable|string|max:10',
            'funding_source' => 'nullable|string|max:255',
            'link'           => 'nullable|url|max:255',
            'is_published'   => 'nullable|boolean',
        ]);

        $validated['is_published'] = $request->boolean('is_published');
        $research->update($validated);
        return redirect()->route('admin.research.index')->with('success', 'Data penelitian berhasil diperbarui!');
    }

    public function destroy(Research $research)
    {
        $research->delete();
        return redirect()->route('admin.research.index')->with('success', 'Data penelitian berhasil dihapus!');
    }
}
