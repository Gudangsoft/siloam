<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StaffController extends Controller
{
    public function index()
    {
        $staff = Staff::orderBy('order')->paginate(20);
        return view('admin.staff.index', compact('staff'));
    }

    public function create()
    {
        return view('admin.staff.form');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'      => 'required|string|max:255',
            'position'  => 'required|string|max:255',
            'category'  => 'required|in:pimpinan,dosen,tendik',
            'nidn'      => 'nullable|string|max:20',
            'email'     => 'nullable|email|max:100',
            'phone'     => 'nullable|string|max:20',
            'education' => 'nullable|string|max:255',
            'expertise' => 'nullable|string|max:255',
            'bio'       => 'nullable|string',
            'photo'     => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:2048',
            'order'     => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('staff', 'public');
        }

        Staff::create($validated);
        return redirect()->route('admin.staff.index')->with('success', 'Data staff berhasil ditambahkan!');
    }

    public function edit(Staff $staff)
    {
        return view('admin.staff.form', compact('staff'));
    }

    public function update(Request $request, Staff $staff)
    {
        $validated = $request->validate([
            'name'      => 'required|string|max:255',
            'position'  => 'required|string|max:255',
            'category'  => 'required|in:pimpinan,dosen,tendik',
            'nidn'      => 'nullable|string|max:20',
            'email'     => 'nullable|email|max:100',
            'phone'     => 'nullable|string|max:20',
            'education' => 'nullable|string|max:255',
            'expertise' => 'nullable|string|max:255',
            'bio'       => 'nullable|string',
            'photo'     => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:2048',
            'order'     => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('photo')) {
            if ($staff->photo) Storage::disk('public')->delete($staff->photo);
            $validated['photo'] = $request->file('photo')->store('staff', 'public');
        }

        $staff->update($validated);
        return redirect()->route('admin.staff.index')->with('success', 'Data staff berhasil diperbarui!');
    }

    public function destroy(Staff $staff)
    {
        if ($staff->photo) Storage::disk('public')->delete($staff->photo);
        $staff->delete();
        return redirect()->route('admin.staff.index')->with('success', 'Data staff berhasil dihapus!');
    }
}
