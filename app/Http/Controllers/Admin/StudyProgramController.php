<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StudyProgram;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class StudyProgramController extends Controller
{
    public function index()
    {
        $programs = StudyProgram::orderBy('order')->get();
        return view('admin.study-programs.index', compact('programs'));
    }

    public function create()
    {
        return view('admin.study-programs.form');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'             => 'required|string|max:255',
            'degree'           => 'required|in:S1,S2,S3,D3,D4',
            'accreditation'    => 'nullable|string|max:10',
            'description'      => 'nullable|string',
            'vision'           => 'nullable|string',
            'mission'          => 'nullable|string',
            'objectives'       => 'nullable|string',
            'career_prospects' => 'nullable|string',
            'head_name'        => 'nullable|string|max:255',
            'image'            => 'nullable|image|max:2048',
            'is_active'        => 'nullable|boolean',
            'order'            => 'nullable|integer',
        ]);

        $validated['slug']      = Str::slug($validated['name']);
        $validated['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('programs', 'public');
        }

        StudyProgram::create($validated);
        return redirect()->route('admin.study-programs.index')->with('success', 'Program studi berhasil ditambahkan!');
    }

    public function edit(StudyProgram $studyProgram)
    {
        return view('admin.study-programs.form', ['program' => $studyProgram]);
    }

    public function update(Request $request, StudyProgram $studyProgram)
    {
        $validated = $request->validate([
            'name'             => 'required|string|max:255',
            'degree'           => 'required|in:S1,S2,S3,D3,D4',
            'accreditation'    => 'nullable|string|max:10',
            'description'      => 'nullable|string',
            'vision'           => 'nullable|string',
            'mission'          => 'nullable|string',
            'objectives'       => 'nullable|string',
            'career_prospects' => 'nullable|string',
            'head_name'        => 'nullable|string|max:255',
            'image'            => 'nullable|image|max:2048',
            'is_active'        => 'nullable|boolean',
            'order'            => 'nullable|integer',
        ]);

        $validated['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('image')) {
            if ($studyProgram->image) Storage::disk('public')->delete($studyProgram->image);
            $validated['image'] = $request->file('image')->store('programs', 'public');
        }

        $studyProgram->update($validated);
        return redirect()->route('admin.study-programs.index')->with('success', 'Program studi berhasil diperbarui!');
    }

    public function destroy(StudyProgram $studyProgram)
    {
        if ($studyProgram->image) Storage::disk('public')->delete($studyProgram->image);
        $studyProgram->delete();
        return redirect()->route('admin.study-programs.index')->with('success', 'Program studi berhasil dihapus!');
    }
}
