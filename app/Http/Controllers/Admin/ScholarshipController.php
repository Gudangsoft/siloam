<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Scholarship;
use Illuminate\Http\Request;

class ScholarshipController extends Controller
{
    public function index()
    {
        $scholarships = Scholarship::latest()->paginate(15);
        return view('admin.scholarships.index', compact('scholarships'));
    }

    public function create()
    {
        return view('admin.scholarships.form');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'         => 'required|string|max:255',
            'provider'     => 'required|string|max:255',
            'description'  => 'nullable|string',
            'requirements' => 'nullable|string',
            'amount'       => 'nullable|string|max:100',
            'deadline'     => 'nullable|date',
            'contact'      => 'nullable|string|max:255',
            'link'         => 'nullable|url',
            'is_active'    => 'nullable|boolean',
        ]);

        $validated['is_active'] = $request->boolean('is_active');
        Scholarship::create($validated);
        return redirect()->route('admin.scholarships.index')->with('success', 'Beasiswa berhasil ditambahkan!');
    }

    public function edit(Scholarship $scholarship)
    {
        return view('admin.scholarships.form', compact('scholarship'));
    }

    public function update(Request $request, Scholarship $scholarship)
    {
        $validated = $request->validate([
            'name'         => 'required|string|max:255',
            'provider'     => 'required|string|max:255',
            'description'  => 'nullable|string',
            'requirements' => 'nullable|string',
            'amount'       => 'nullable|string|max:100',
            'deadline'     => 'nullable|date',
            'contact'      => 'nullable|string|max:255',
            'link'         => 'nullable|url',
            'is_active'    => 'nullable|boolean',
        ]);

        $validated['is_active'] = $request->boolean('is_active');
        $scholarship->update($validated);
        return redirect()->route('admin.scholarships.index')->with('success', 'Beasiswa berhasil diperbarui!');
    }

    public function destroy(Scholarship $scholarship)
    {
        $scholarship->delete();
        return redirect()->route('admin.scholarships.index')->with('success', 'Beasiswa berhasil dihapus!');
    }
}
