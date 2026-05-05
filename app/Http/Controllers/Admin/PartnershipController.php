<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Partnership;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PartnershipController extends Controller
{
    public function index()
    {
        $partnerships = Partnership::orderBy('order')->paginate(20);
        return view('admin.partnerships.index', compact('partnerships'));
    }

    public function create()
    {
        return view('admin.partnerships.form');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'       => 'required|string|max:255',
            'type'       => 'required|in:nasional,internasional',
            'category'   => 'nullable|string|max:100',
            'description'=> 'nullable|string',
            'website'    => 'nullable|url|max:255',
            'mou_date'   => 'nullable|date',
            'mou_expiry' => 'nullable|date',
            'logo'       => 'nullable|image|max:2048',
            'is_active'  => 'nullable|boolean',
            'order'      => 'nullable|integer',
        ]);

        $validated['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo')->store('partnerships', 'public');
        }

        Partnership::create($validated);
        return redirect()->route('admin.partnerships.index')->with('success', 'Kerjasama berhasil ditambahkan!');
    }

    public function edit(Partnership $partnership)
    {
        return view('admin.partnerships.form', compact('partnership'));
    }

    public function update(Request $request, Partnership $partnership)
    {
        $validated = $request->validate([
            'name'       => 'required|string|max:255',
            'type'       => 'required|in:nasional,internasional',
            'category'   => 'nullable|string|max:100',
            'description'=> 'nullable|string',
            'website'    => 'nullable|url|max:255',
            'mou_date'   => 'nullable|date',
            'mou_expiry' => 'nullable|date',
            'logo'       => 'nullable|image|max:2048',
            'is_active'  => 'nullable|boolean',
            'order'      => 'nullable|integer',
        ]);

        $validated['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('logo')) {
            if ($partnership->logo) Storage::disk('public')->delete($partnership->logo);
            $validated['logo'] = $request->file('logo')->store('partnerships', 'public');
        }

        $partnership->update($validated);
        return redirect()->route('admin.partnerships.index')->with('success', 'Kerjasama berhasil diperbarui!');
    }

    public function destroy(Partnership $partnership)
    {
        if ($partnership->logo) Storage::disk('public')->delete($partnership->logo);
        $partnership->delete();
        return redirect()->route('admin.partnerships.index')->with('success', 'Kerjasama berhasil dihapus!');
    }
}
