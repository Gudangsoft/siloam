<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StudentOrganization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StudentOrganizationController extends Controller
{
    public function index()
    {
        $organizations = StudentOrganization::latest()->paginate(15);
        return view('admin.student-organizations.index', compact('organizations'));
    }

    public function create()
    {
        return view('admin.student-organizations.form');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'         => 'required|string|max:255',
            'abbreviation' => 'nullable|string|max:20',
            'type'         => 'required|in:BEM,UKM,HIMA,lainnya',
            'description'  => 'nullable|string',
            'chairman'     => 'nullable|string|max:255',
            'advisor'      => 'nullable|string|max:255',
            'email'        => 'nullable|email|max:100',
            'logo'         => 'nullable|image|max:2048',
            'is_active'    => 'nullable|boolean',
        ]);

        $validated['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo')->store('organizations', 'public');
        }

        StudentOrganization::create($validated);
        return redirect()->route('admin.student-organizations.index')->with('success', 'Organisasi berhasil ditambahkan!');
    }

    public function edit(StudentOrganization $organization)
    {
        return view('admin.student-organizations.form', compact('organization'));
    }

    public function update(Request $request, StudentOrganization $organization)
    {
        $validated = $request->validate([
            'name'         => 'required|string|max:255',
            'abbreviation' => 'nullable|string|max:20',
            'type'         => 'required|in:BEM,UKM,HIMA,lainnya',
            'description'  => 'nullable|string',
            'chairman'     => 'nullable|string|max:255',
            'advisor'      => 'nullable|string|max:255',
            'email'        => 'nullable|email|max:100',
            'logo'         => 'nullable|image|max:2048',
            'is_active'    => 'nullable|boolean',
        ]);

        $validated['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('logo')) {
            if ($organization->logo) Storage::disk('public')->delete($organization->logo);
            $validated['logo'] = $request->file('logo')->store('organizations', 'public');
        }

        $organization->update($validated);
        return redirect()->route('admin.student-organizations.index')->with('success', 'Organisasi berhasil diperbarui!');
    }

    public function destroy(StudentOrganization $organization)
    {
        if ($organization->logo) Storage::disk('public')->delete($organization->logo);
        $organization->delete();
        return redirect()->route('admin.student-organizations.index')->with('success', 'Organisasi berhasil dihapus!');
    }
}
